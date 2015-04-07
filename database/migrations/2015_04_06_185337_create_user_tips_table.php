<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTipsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_tips', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('body');
			$table->integer('topic_id');
			$table->integer('active_user_id');
			$table->integer('positive_user_id');
			$table->boolean('view')->default('0');
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
		Schema::drop('user_tips');
	}

}
