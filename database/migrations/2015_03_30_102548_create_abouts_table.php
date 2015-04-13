<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAboutsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('abouts', function(Blueprint $table)
			{
				$table->increments('id');
				$table->text('body');
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
      \DB::table('abouts')->insert(['body' => "> **NEU PHP** 安装与介绍 

###项目安装

>*  安装Apache，MySQL，php(5.4以上)
>
>*  安装[composer](https://getcomposer.org/)

>*  安装[Git](http://git-scm.com/downloads/)，关于使用，请参考[这个](http://www.bootcss.com/p/git-guide/)

>*  克隆项目,具体操作，参考上方的使用方法

>*  切换到项目目录，执行命令`composer update`,下载必要的插件,需要国际网支持（可以使用[国内镜像](http://pkg.phpcomposer.com/)）

>*  配置项目数据库，config\database.php

>*  继续在本目录下，执行命令`php artisan migrate`,创建数据库

>*  然后执行命令`php artisan db:seed`，填充数据库，虚假数据，用于测试，到此项目配置完毕

>*  最后执行`php artisan serve`,开启服务，在浏览器地址栏中输入`localhost:8000`就可以看到项目咯


###项目介绍

> **NEU PHP**的开发是为了童鞋学习php，laravel以及其他框架与知识开发网站而提供一个交流平台，由于本人正在学习中，还是一个大菜鸟，敬请各路大神指教，谢谢

> 本网站采用的php框架为`laravel 5.0`，UI框架为`Amaze UI 2.2`

###关于我

>关于我没什么可说的，所以邮箱电话的什么的就不写啦



  "]);
    }

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('abouts');
	}

}
