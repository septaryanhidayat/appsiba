<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->nullable();
            $table->string('session_id', 100)->nullable();
            $table->string('url', 255)->default('/');
            $table->string('route_name', 100)->nullable();
            $table->string('method', 10)->default('GET');
            $table->string('referrer', 500)->nullable();
            $table->string('referrer_domain', 150)->nullable();
            $table->string('referrer_type', 50)->nullable();
            $table->string('user_agent', 500)->nullable();
            $table->string('device_type', 30)->default('Desktop');
            $table->string('browser', 60)->default('Browser Lainnya');
            $table->string('platform', 60)->default('OS Lainnya');
            $table->timestamps();

            $table->index(['created_at', 'ip_address']);
            $table->index(['session_id', 'created_at']);
            $table->index(['url', 'created_at']);
            $table->index('referrer_domain');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_logs');
    }
};
