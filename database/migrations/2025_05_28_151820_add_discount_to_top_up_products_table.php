<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('top_up_products', function (Blueprint $table) {
            // Adds a 'discount' column after 'product_name' with default value 0
            $table->decimal('discount', 5, 2)->default(0)->after('product_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('top_up_products', function (Blueprint $table) {
            $table->dropColumn('discount');
        });
    }
};
