<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//---------站点主页-----------
Route::get('/', 'Home\HomeController@index');

//.......首页导航-------------
Route::group(['namespace' => 'Home'],function(){

//------------------首页导航-------------------

	Route::get('/',[
        'as'  => 'home',
		    'uses' => 'HomeController@index']);

   Route::get('/community/{arg?}/{pid?}',[
   	    'as' => 'home.community',
   	    'uses' => 'HomeController@community']);

   Route::get('/wiki',[
   	    'as' => 'home.wiki',
   	    'uses' => 'HomeController@wiki']);

   Route::get('/about',[
   	     'as' => 'home.about',
   	     'uses' => 'HomeController@about']);

  Route::get('/member',[
  	      'as' => 'home.member',
  	      'uses' => 'HomeController@member']);

  Route::get('/documents',[
  	      'as' => 'home.documents',
  	      'uses' => 'HomeController@documents']);

  Route::get('/markdowm',[
          'as' => 'home.markdown',
          'uses' => 'HomeController@markdown']);

   Route::post('/view/markdowm/result',[
          'as' => 'home.viewMarkdownResult',
          'uses' => 'HomeController@viewMarkdownResult']);

//---------------结点导航或者结点查看-----------------------

  Route::get('/nodes/{nid?}/{pid?}',[
  	      'as' => 'read.node',
  	      'uses' => 'NodeController@index']);

  Route::get('/read/nodes/{nid?}/{pid?}',[
          'as' => 'read.node',
          'uses' => 'NodeController@index']);

//----------------关于帖子------------------------
  Route::get('/vote/topics/{tid}',[
          'as'   => 'vote.topic',
          'uses' => 'TopicController@vote']);

  Route::get('/read/topics/{tid}',[
          'as'   => 'read.topic',
          'uses' => 'TopicController@show']);

//-----------------关于User-------------------

 Route::get('/read/users/{uid}',[
          'uses' => 'UserController@index',
          'as'   => 'read.user']);
});




