<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('artworks', function (Blueprint $table) {
            // gallery: JSON array of {label, file} objects
            $table->json('gallery')->nullable()->after('meta');
            // hero_image: separate hero/mockup image (herotuc.png equivalent)
            $table->string('hero_image')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('artworks', function (Blueprint $table) {
            $table->dropColumn(['gallery', 'hero_image']);
        });
    }
};
