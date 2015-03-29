> **NEU PHP** 安装与介绍 

###项目安装

>*  安装Apache，MySQL，php(5.4以上)
>
>*  安装[composer](https://getcomposer.org/)

>*  安装[Git](http://git-scm.com/downloads/)[关于使用,请参考](http://www.bootcss.com/p/git-guide/)

>*  克隆项目

  >具体操作，参考上方的使用方法

>*  切换到项目目录，执行命令`composer update`,下载必要的插件,需要国际网支持（可以使用[国内镜像](http://pkg.phpcomposer.com/)）

>*  配置项目数据库，config\database.php

>*  继续在本目录下，执行命令`php artisan migrate`,创建数据库

>*  然后执行命令`php artisan db:seed`，填充数据库，虚假数据，用于测试，到此项目配置完毕

>*  最后执行`php artisan serve`,开启服务，在浏览器地址栏中输入localhost:8000就可以看到项目咯


##项目介绍

 **NEU PHP**的开发是为了本校童鞋学习php，laravel开发网站而提供一个交流平台，由于本人也在学习中，依然是一个菜鸟，敬请各路大神指教，谢谢

  