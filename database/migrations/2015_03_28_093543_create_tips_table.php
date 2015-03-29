<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTipsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("tips", function(Blueprint $table){
          $table->increments('id');
          $table->string('content')->nullable();
          $table->softDeletes();
          $table->timestamps();
        });
       self::initialize();
	}
    /**
     * [initialize description]
     * @return [type] [description]
     */
     public function initialize()
     {

      \DB::table('tips')->insert(['content' => 'welcome visit neuphp']);
     }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
