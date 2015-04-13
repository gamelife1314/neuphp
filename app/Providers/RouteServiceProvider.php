<?php namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider {

	/**
	 * This namespace is applied to the controller routes in your routes file.
	 *
	 * In addition, it is set as the URL generator's root namespace.
	 *
	 * @var string
	 */
	protected $namespace = 'App\Http\Controllers';

	/**
	 * Define your route model bindings, pattern filters, etc.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function boot(Router $router)
	{
		parent::boot($router);
		$router->pattern('nid','[0-9]+'); //node id
		$router->pattern('pid','[0-9]+');  // page id
		$router->pattern('tid','[0-9]+');// topic id
		$router->pattern('uid','[0-9]+'); // user id
		$router->pattern('rid','[0-9]+');// reply id
		$router->pattern('bid','[0-9]+');// bbs tip id
		$router->pattern('did','[0-9]+');// document id
		$router->model('user','App\User'); // user 模型
		$router->model('topic','App\Topic');// topic 模型

		//
	}

	/**
	 * Define the routes for the application.
	 *
	 * @param  \Illuminate\Routing\Router  $router
	 * @return void
	 */
	public function map(Router $router)
	{
		$router->group(['namespace' => $this->namespace], function($router)
		{
			require app_path('Http/routes.php');
		});
	}

}
