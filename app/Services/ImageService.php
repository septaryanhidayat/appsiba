<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageService
{
    /**
     * Upload an image and convert it automatically to WebP format.
     *
     * @param  UploadedFile  $file  The uploaded file
     * @param  string  $directory  Target directory on storage disk (e.g. 'posts', 'galleries', 'members')
     * @param  string  $disk  Storage disk name (default 'public')
     * @param  int  $quality  WebP compression quality (0-100, default 82)
     * @return string Relative path of the saved file
     */
    public static function uploadAndConvertToWebp(
        UploadedFile $file,
        string $directory,
        string $disk = 'public',
        int $quality = 82,
        int $maxDimension = 1600
    ): string {
        $realPath = $file->getRealPath();
        $randomName = Str::random(40).'.webp';
        $relativePath = trim($directory, '/').'/'.$randomName;

        // Try converting to WebP using GD
        $image = self::createImageFromUploadedFile($realPath, $file->getClientMimeType() ?: $file->getMimeType());

        if ($image !== false) {
            $origWidth = imagesx($image);
            $origHeight = imagesy($image);

            // Scale down if larger than maxDimension while preserving aspect ratio
            if ($origWidth > $maxDimension || $origHeight > $maxDimension) {
                if ($origWidth >= $origHeight) {
                    $newWidth = $maxDimension;
                    $newHeight = (int) max(1, round(($origHeight / $origWidth) * $maxDimension));
                } else {
                    $newHeight = $maxDimension;
                    $newWidth = (int) max(1, round(($origWidth / $origHeight) * $maxDimension));
                }

                $resizedImage = imagecreatetruecolor($newWidth, $newHeight);
                imagealphablending($resizedImage, false);
                imagesavealpha($resizedImage, true);
                imagecopyresampled($resizedImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
                imagedestroy($image);
                $image = $resizedImage;
            }

            // Buffer the WebP stream with high efficiency compression
            ob_start();
            imagewebp($image, null, $quality);
            $webpData = ob_get_clean();
            imagedestroy($image);

            if (! empty($webpData)) {
                Storage::disk($disk)->put($relativePath, $webpData);

                // If storing on public disk, mirror to public/storage if directory exists
                if ($disk === 'public') {
                    $publicDestDir = public_path('storage/'.trim($directory, '/'));
                    if (! is_dir($publicDestDir)) {
                        @mkdir($publicDestDir, 0777, true);
                    }
                    @file_put_contents($publicDestDir.'/'.$randomName, $webpData);

                    $directPublicDir = public_path(trim($directory, '/'));
                    if (is_dir($directPublicDir)) {
                        @file_put_contents($directPublicDir.'/'.$randomName, $webpData);
                    }
                }

                return $relativePath;
            }
        }

        // Fallback: if conversion fails, store original file
        $stored = $file->store($directory, $disk);
        if ($disk === 'public') {
            $publicDestDir = public_path('storage/'.trim($directory, '/'));
            if (! is_dir($publicDestDir)) {
                @mkdir($publicDestDir, 0777, true);
            }
            @copy(Storage::disk('public')->path($stored), public_path('storage/'.$stored));

            $directPublicDir = public_path(trim($directory, '/'));
            if (is_dir($directPublicDir)) {
                @copy(Storage::disk('public')->path($stored), public_path($stored));
            }
        }

        return $stored;
    }

    /**
     * Alias for uploadAndConvertToWebp.
     */
    public static function convertToWebp(
        UploadedFile $file,
        string $directory,
        string $disk = 'public',
        int $quality = 82
    ): string {
        return self::uploadAndConvertToWebp($file, $directory, $disk, $quality);
    }

    /**
     * Convert an existing file path to WebP.
     */
    public static function convertFileToWebp(string $sourcePath, string $destinationPath, int $quality = 82): bool
    {
        $info = @getimagesize($sourcePath);
        if (! $info) {
            return false;
        }

        $image = self::createImageFromPath($sourcePath, $info['mime']);
        if (! $image) {
            return false;
        }

        $destDir = dirname($destinationPath);
        if (! is_dir($destDir)) {
            @mkdir($destDir, 0777, true);
        }

        $result = imagewebp($image, $destinationPath, $quality);
        imagedestroy($image);

        return $result;
    }

    /**
     * Create a GD image resource from file path and mime type.
     */
    protected static function createImageFromPath(string $path, string $mime)
    {
        switch ($mime) {
            case 'image/jpeg':
                $image = @imagecreatefromjpeg($path);
                if ($image && function_exists('exif_read_data')) {
                    $exif = @exif_read_data($path);
                    if (! empty($exif['Orientation'])) {
                        $image = match ($exif['Orientation']) {
                            3 => imagerotate($image, 180, 0),
                            6 => imagerotate($image, -90, 0),
                            8 => imagerotate($image, 90, 0),
                            default => $image,
                        };
                    }
                }

                return $image;

            case 'image/png':
                $image = @imagecreatefrompng($path);
                if ($image) {
                    imagepalettetotruecolor($image);
                    imagealphablending($image, true);
                    imagesavealpha($image, true);
                }

                return $image;

            case 'image/webp':
                return @imagecreatefromwebp($path);

            case 'image/gif':
                $image = @imagecreatefromgif($path);
                if ($image) {
                    imagepalettetotruecolor($image);
                }

                return $image;

            default:
                return false;
        }
    }

    /**
     * Delete an image from storage and mirror folder safely.
     */
    public static function delete(?string $path, string $disk = 'public'): bool
    {
        if (empty($path)) {
            return false;
        }

        // Avoid deleting static default assets
        if (str_starts_with($path, 'assets/')) {
            return false;
        }

        $cleanPath = str_replace('storage/', '', $path);
        if (Storage::disk($disk)->exists($cleanPath)) {
            Storage::disk($disk)->delete($cleanPath);
        }

        $publicFile = public_path('storage/'.$cleanPath);
        if (is_file($publicFile)) {
            @unlink($publicFile);
        }

        $directPublicFile = public_path($cleanPath);
        if (is_file($directPublicFile)) {
            @unlink($directPublicFile);
        }

        return true;
    }
}
