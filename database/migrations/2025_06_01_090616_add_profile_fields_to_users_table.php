<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // $table->string('phone')->nullable()->after('email'); // REMOVE if already exists
            // $table->string('language')->nullable()->default('English'); // REMOVE if exists
            $table->string('timezone')->nullable()->default('Asia/Dhaka');
            $table->boolean('notifications_enabled')->default(true);
            $table->timestamp('last_login_at')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->string('last_login_device')->nullable();
            $table->integer('active_sessions_count')->default(1);
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('users', 'phone')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('phone');
            });
        }
        if (Schema::hasColumn('users', 'language')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('language');
            });
        }
        // repeat for other columns
    }


};
