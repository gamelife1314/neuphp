<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVotesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('votes', function(Blueprint $table)
			{
				$table->increments('id');
				$table->integer('topic_id')->index();
                $table->integer('user_id')->index();
                $table->boolean('vote_up')->default(0);
                $table->boolean('vote_down')->default(0);
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
		Schema::drop('votes');
	}

}
