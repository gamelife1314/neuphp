<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name')->unique();
			$table->string('email')->unique()->index();
			$table->string('password', 60);
			$table->rememberToken()->nullable();
			$table->boolean('is_banned')->default(false);
			$table->string('image_url')->nullable();
			$table->integer('topic_count')->default(0)->index();
			$table->integer('reply_count')->default(0)->index();
			$table->string('academy')->nullable();
			$table->string('major')->nullable();
			$table->string('introduction')->nullable();
			$table->string('personal_website')->nullable();
			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
