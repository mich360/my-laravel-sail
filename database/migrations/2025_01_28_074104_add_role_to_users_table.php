<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRoleToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 'users'テーブルに'role'カラムを追加
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default('user'); // デフォルトは 'user'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // 'users'テーブルから'role'カラムを削除
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });
    }
}
