<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('newsletter_photos', function (Blueprint $table) {
            $table->id();
            $table->string('image_path');         // stored path under storage/app/public
            $table->string('alt')->nullable();     // alt text / label
            $table->string('column')->default('left');  // 'left' | 'right'
            $table->unsignedSmallInteger('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newsletter_photos');
    }
};
