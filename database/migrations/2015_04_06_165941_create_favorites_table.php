<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateFavoritesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('favorites', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('topic_id');
            $table->integer('user_id');
            $table->softDeletes();
			$table->timestamps();
		});

		$this->initialize();
	}

	public function initialize()
	{
      for ($i=0; $i < 300; $i++) {
      	\DB::table('favorites')->insert(['user_id' => rand(1,100), 'topic_id' => rand(1,500)]);
      }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('favorites');
	}

}
