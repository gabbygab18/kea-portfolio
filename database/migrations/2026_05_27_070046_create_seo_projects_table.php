<?php
// ═══════════════════════════════════════════════════════
// MIGRATION: database/migrations/xxxx_create_seo_projects_table.php
// Run: php artisan make:migration create_seo_projects_table
// Then replace up()/down() with the code below.
// ═══════════════════════════════════════════════════════

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('client')->nullable();
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->text('overview')->nullable();
            $table->string('link')->nullable();
            $table->boolean('featured')->default(false);
            $table->json('tools')->nullable();
            $table->json('results')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });

        Schema::create('seo_tools', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category')->nullable();
            $table->text('description')->nullable();
            $table->string('icon_path')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_projects');
        Schema::dropIfExists('seo_tools');
    }
};
