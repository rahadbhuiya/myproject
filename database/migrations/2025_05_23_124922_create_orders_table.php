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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->onDelete('set null');
            $table->string('email');
            $table->string('game_uid');
            $table->string('sender_number');
            $table->string('transaction_id')->unique();
            $table->string('payment_method');

            // Foreign key to top_up_products (main product)
            $table->foreignId('product_id')->constrained('top_up_products')->onDelete('cascade');

            // Optional: Foreign key to top_up_products (secondary, optional)
            $table->foreignId('top_up_product_id')
                ->nullable()
                ->constrained('top_up_products')
                ->onDelete('set null');

            // Foreign key to games
            $table->foreignId('game_id')->constrained('games')->onDelete('cascade');

            $table->decimal('price', 10, 2);
            $table->string('status')->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
