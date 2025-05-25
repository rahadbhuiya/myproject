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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // গেমের নাম
            $table->string('logo'); // গেমের লোগো
            $table->text('description'); // গেমের বর্ণনা
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // গেমের ক্যাটেগরি
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
