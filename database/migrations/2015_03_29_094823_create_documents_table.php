<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create("documents", function(Blueprint $table)
			{
				$table->increments('id');
				$table->string('name');
				$table->string("url");
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
      $documents = [
         ['name' => 'laravel 文档','url' => 'http://www.golaravel.com/'],
         ['name' => 'Amaze UI 官方文档', 'url' => 'http://amazeui.org/'],
         ['name' => 'boostrap 教程', 'url' => 'http://www.bootcss.com/'],
         ['name' => 'php 官网','url' => 'http://php.net/'],
         ['name' => 'javascript 官方网站', 'url' => 'http://www.javascriptsource.com/'],
         ['name' => 'jQuery 官网','url' => 'http://jquery.com/'],
         ['name' =>'thinkPHP 国人自主开发','url' => "http://www.thinkphp.cn/"],
         ['name' =>'W3C School 在线学校', 'url' => 'http://www.w3school.com.cn/'],
         ['name' => 'composer 官网', 'url' => 'https://getcomposer.org/']];
      \DB::table('documents')->insert($documents);
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("documents");
	}

}
