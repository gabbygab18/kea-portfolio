<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_add_sort_order_to_artworks_table.php
public function up(): void
{
    Schema::table('artworks', function (Blueprint $table) {
        $table->unsignedInteger('sort_order')->default(0)->after('featured');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artworks', function (Blueprint $table) {
            //
        });
    }
};
