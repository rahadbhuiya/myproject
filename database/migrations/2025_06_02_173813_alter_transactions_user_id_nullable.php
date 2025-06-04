<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTransactionsUserIdNullable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // First drop the existing foreign key constraint on user_id
            $table->dropForeign(['user_id']);

            // Then make the user_id column nullable
            $table->foreignId('user_id')->nullable()->change();

            // Recreate the foreign key constraint, allowing nulls and nulling on delete
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Drop the modified foreign key first
            $table->dropForeign(['user_id']);

            // Make the user_id column non-nullable again
            $table->foreignId('user_id')->nullable(false)->change();

            // Recreate the original foreign key constraint (cascade on delete)
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }
}
