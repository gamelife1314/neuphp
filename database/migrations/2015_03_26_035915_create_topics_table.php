<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('topics', function (Blueprint $table)
		{
          $table->increments('id');
          $table->string('title')->index();
          $table->text('content');
          $table->integer('user_id')->index();
          $table->integer('node_id')->index();
          $table->boolean('is_excellent')->default(false)->index();
          $table->boolean('is_wiki')->default(false)->idnex();
          $table->boolean('recommend')->default(false)->index();
          $table->boolean('stick')->default(false)->index();
          $table->integer('reply_count')->default(0)->index();
          $table->integer('view_count')->default(0)->index();
          $table->integer('favorite_count')->default(0)->index();
          $table->integer('vote_count')->default(0)->indx();
          $table->integer('last_reply_user_id')->nullable();
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
		Schema::drop('topics');
	}

}
