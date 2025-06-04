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
	if (!Schema::hasColumn('top_up_products', 'amount')) {
	    Schema::table('top_up_products', function (Blueprint $table) {
		$table->integer('amount')->after('product_name');
	    });
	}
    }

    public function down(): void
    {
        Schema::table('top_up_products', function (Blueprint $table) {
            $table->dropColumn('amount');
        });
    }

};
