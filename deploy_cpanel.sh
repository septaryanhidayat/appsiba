#!/bin/bash
set +e

echo "=== MEMULAI DEPLOYMENT CPANEL APPSI BANYUASIN ==="

TARGET1="/home/berandad/appsiba.berandadigital.net"
TARGET2="/home/berandad/public_html/appsiba.berandadigital.net"

for TARGET in "$TARGET1" "$TARGET2"; do
    echo "--- Menyiapkan direktori: $TARGET ---"
    /bin/mkdir -p "$TARGET"
    /bin/mkdir -p "$TARGET/public"

    echo "Menyalin file proyek ke $TARGET..."
    /bin/cp -rf * "$TARGET/" 2>/dev/null || true
    
    # Salin file konfigurasi & dotfiles
    [ -f .htaccess ] && /bin/cp -f .htaccess "$TARGET/.htaccess" 2>/dev/null || true
    [ -f index.php ] && /bin/cp -f index.php "$TARGET/index.php" 2>/dev/null || true
    [ -f .env.production ] && /bin/cp -f .env.production "$TARGET/.env" 2>/dev/null || true
    [ -f public/.htaccess ] && /bin/cp -f public/.htaccess "$TARGET/public/.htaccess" 2>/dev/null || true
    [ -f public/index.php ] && /bin/cp -f public/index.php "$TARGET/public/index.php" 2>/dev/null || true

    # Siapkan direktori storage & framework cache
    /bin/mkdir -p "$TARGET/storage/framework/views" \
                 "$TARGET/storage/framework/sessions" \
                 "$TARGET/storage/framework/cache" \
                 "$TARGET/storage/logs" \
                 "$TARGET/storage/app/public" \
                 "$TARGET/bootstrap/cache" 2>/dev/null || true

    # Atur permission chmod
    /bin/chmod -R 775 "$TARGET/storage" "$TARGET/bootstrap/cache" 2>/dev/null || true

    # Buat symlink storage jika artisan tersedia
    if [ -f "$TARGET/artisan" ]; then
        (cd "$TARGET" && php artisan storage:link 2>/dev/null || true)
    fi

    echo "Deployment ke $TARGET selesai."
done

echo "=== DEPLOYMENT CPANEL BERHASIL SELESAI ==="
exit 0
