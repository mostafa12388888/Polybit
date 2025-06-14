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
        Schema::create('cards', function (Blueprint $table) {
            $table->id();
            $table->json('title')->nullable();
            $table->json('description')->nullable();
            $table->string('link', 255)->nullable();
            $table->unsignedBigInteger('image_or_video')->nullable();
            $table->json('external_videos')->nullable();

            $table->enum('is_video', [1, 2, 3])->default(1);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cards');
    }
};
