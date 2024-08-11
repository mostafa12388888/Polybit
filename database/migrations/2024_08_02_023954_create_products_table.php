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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('slug')->unique()->index();
            $table->string('sku')->unique();
            $table->longText('description')->nullable();
            $table->decimal('price', 20, 2)->nullable();
            $table->decimal('price_before_discount', 20, 2)->nullable();
            $table->decimal('rate', 3, 1)->nullable();
            $table->boolean('is_available')->default(true);
            $table->foreignId('category_id')->nullable()->constrained('store_categories')->cascadeOnDelete();
            $table->json('attributes')->nullable();
            $table->json('locales')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
