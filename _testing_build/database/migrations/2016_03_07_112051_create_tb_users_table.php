<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTbUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('tb_users', function (Blueprint $table)
		{
			$table->increments('id')->unique();
			$table->integer('group_id');
			$table->string('username');
			$table->string('password');
			$table->string('email');
			$table->string('first_name');
			$table->string('last_name');
			$table->string('avatar');
			$table->unsignedTinyInteger('active');
			$table->tinyInteger('login_attempt');
			$table->dateTime('last_login');
			$table->timestamp('created_at');
			$table->timestamp('updated_at');
			$table->string('reminder');
			$table->string('activation');
			$table->string('remember_token');
			$table->integer('last_activity');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('tb_users');
	}
}




//use Illuminate\Database\Schema\Blueprint;
//use Illuminate\Database\Migrations\Migration;
//
//class CreateDatabase extends Migration
//{
//    /**
//     * Run the migrations.
//     *
//     * @return void
//     */
//    public function up()
//    {
//        //DB::select("CREATE DATABASE IF NOT EXISTS laravelatrest");
//    }
//
//    /**
//     * Reverse the migrations.
//     *
//     * @return void
//     */
//    public function down()
//    {
//        //
//    }
//}

