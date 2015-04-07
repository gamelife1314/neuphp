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

//.......用户操作-------------
Route::group(['namespace' => 'Home'],function(){

//----------------用户操作------------------

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
  Route::get('/login',[
          'as' =>'login',
          'uses' => 'HomeController@login']);

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

  Route::get('/vote/up/topics/{tid}',[
          'as'   => 'vote.up',
          'uses' => 'TopicController@voteUp']);

  Route::get('/vote/down/topics/{tid}',[
          'as'   => 'vote.down',
          'uses' => 'TopicController@voteDown']);

  Route::get('/vote/reply/{rid}',[
          'as'   => 'vote.reply',
          'uses' => 'TopicController@voteReply']);

  Route::get('/delete/reply/{rid}',[
          'as'   => 'delete.reply',
          'uses' => 'TopicController@deleteReply']);

  Route::post('/reply/topic',[
          'as'   => 'reply.topic',
          'uses' => 'TopicController@replyTopic']);

  Route::get('/collect/{tid}',[
          'as' => 'collect.topic',
          'uses' => 'TopicController@collect']);

  Route::get('/favorite/{tid}',[
          'as' => 'favorite.topic',
          'uses' => 'TopicController@favorite']);

  Route::get('/read/topics/{tid}',[
          'as'   => 'read.topic',
          'uses' => 'TopicController@show']);

  Route::get('/post/topic',[
          'as' => 'home.post',
          'uses' => 'HomeController@post']);

  Route::post('/post/topic',[
           'as' => 'post.topic',
           'uses' => 'TopicController@create']);

  Route::post('/upload/topicImage',[
           'as' => 'upload.topicImage',
           'uses' => 'TopicController@uploadTopicImage']);

//-----------------关于User-------------------

 Route::get('/read/users/{uid}',[
          'uses' => 'UserController@index',
          'as'   => 'read.user']);

 Route::post('/regist',[
          'as' => 'regist',
          'uses' => 'UserController@create']);

 Route::get('/user/active/{user_name}',[
         'as' => 'user.active',
         'uses' => 'UserController@active']);

 Route::post("/login",[
         'uses' => 'UserController@login',
         'as' => 'user.login']);

 Route::get("/edit/user/{user}",[
         'uses' => 'UserController@edit',
         'as' => 'edit.user']);

 Route::get("/logout",[
         'uses' => 'UserController@logout',
         'as' => 'logout']);

 Route::post("/update/avatar",[
         'as' => 'update.avatar',
         'uses' => 'UserController@updateAvatar']);

 Route::post("/upload/avatar",[
         'as' => 'upload.avatar',
         'uses' => 'UserController@uploadAvatar']);

 Route::post('/update/profile',[
         'as' => 'update.profile',
         'uses' => 'UserController@updateProfile']);

 Route::post('/update/password',[
         'as' => 'update.password',
         'uses' => 'UserController@updatePassword']);
});




