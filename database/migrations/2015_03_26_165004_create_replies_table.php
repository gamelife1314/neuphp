<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('replies', function (Blueprint $table) {
            $table->increments('id');
            $table->text('body');
            $table->integer('user_id')->index();
            $table->integer('topic_id')->index();
            $table->string('tip_user')->nullable();
            $table->boolean('is_block')->index()->default(false);
            $table->integer('vote_count')->index()->default(0);
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
		Schema::drop('replies');
	}

}
