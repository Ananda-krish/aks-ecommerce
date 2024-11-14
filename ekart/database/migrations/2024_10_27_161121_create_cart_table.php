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
        Schema::create('cart', function (Blueprint $table) {
            
                $table->id(); // Auto-incrementing ID
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key to users
                $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Foreign key to products
                $table->integer('quantity'); // Quantity of the product
                $table->double('price', 15, 2); // Price with two decimal points
                $table->timestamps(); // created_at and updated_at
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart');
    }
};
