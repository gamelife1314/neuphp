<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWebsiteTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('site_state',function(Blueprint $table){
			$table->increments('id');
            $table->string('day')->index();
            $table->integer('register_count')->default(0);
            $table->integer('topic_count')->default(0);
            $table->integer('reply_count')->default(0);
            $table->integer('emjoy_count')->default(0);
            $table->integer('avatars_count')->default(0);
            $table->timestamps();
		});
		self::initialize();
	}
    /**
     * 初始化程序
     * @return [type] [description]
     */
    public function initialize()
    {
    	\DB::table('site_state')->insert(['day' => 'today',
    		                              'register_count' => '120',
    		                              'topic_count' =>'679',
    		                              'avatars_count' => '44',
    		                              'reply_count' => '564',
    		                              'emjoy_count' => 18]);
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('site_state');
	}

}
