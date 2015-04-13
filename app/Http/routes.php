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

      Route::get('/',['as'  => 'home','uses' => 'HomeController@index']);

      Route::get('/community/{arg?}/{pid?}',['as' => 'home.community','uses' => 'HomeController@community']);

      Route::get('/wiki',['as' => 'home.wiki','uses' => 'HomeController@wiki']);

      Route::get('/about',['as' => 'home.about','uses' => 'HomeController@about']);

      Route::get('/member',['as' => 'home.member','uses' => 'HomeController@member']);

      Route::get('/documents',['as' => 'home.documents','uses' => 'HomeController@documents']);

      Route::get('/markdowm',['as' => 'home.markdown','uses' => 'HomeController@markdown']);

      Route::post('/view/markdowm/result',['as' => 'home.viewMarkdownResult','uses' => 'HomeController@viewMarkdownResult']);

      Route::get('/login',['as' =>'login','uses' => 'HomeController@login']);

      Route::post('search',['as' => 'search.submmit','uses' => 'HomeController@search']);
      Route::get('search/{keyword}',['as' => 'search.result','uses' => 'HomeController@searchResult']);

//---------------结点导航或者结点查看-----------------------

      Route::get('/nodes/{nid?}/{pid?}',['as' => 'read.node','uses' => 'NodeController@index']);

      Route::get('/read/nodes/{nid?}/{pid?}',['as' => 'read.node','uses' => 'NodeController@index']);

//----------------关于帖子------------------------
      Route::get('/vote/topics/{tid}',['as'   => 'vote.topic','uses' => 'TopicController@vote']);

      Route::get('/vote/up/topics/{tid}',['as'   => 'vote.up','uses' => 'TopicController@voteUp']);

      Route::get('/vote/down/topics/{tid}',['as'   => 'vote.down','uses' => 'TopicController@voteDown']);

      Route::get('/vote/reply/{rid}',['as'   => 'vote.reply','uses' => 'TopicController@voteReply']);

      Route::get('/delete/reply/{rid}',['as'   => 'delete.reply','uses' => 'TopicController@deleteReply']);

      Route::get('/delete/topic/{tid}',['as' => 'delete.topic','uses' => 'TopicController@deleteTopic']);

      Route::get('/edit/topic/{topic}',['as' => 'edit.topic','uses' => 'TopicController@editTopic']);

      Route::post('/edit/topic',['as' => 'edit.store','uses' => 'TopicController@update']);

      Route::post('/reply/topic',['as'   => 'reply.topic','uses' => 'TopicController@replyTopic']);

      Route::get('/collect/{tid}',['as' => 'collect.topic','uses' => 'TopicController@collect']);

      Route::get('/favorite/{tid}',['as' => 'favorite.topic','uses' => 'TopicController@favorite']);

      Route::get('/read/topics/{tid}',['as'   => 'read.topic','uses' => 'TopicController@show']);

      Route::get('/post/topic',['as' => 'home.post','uses' => 'HomeController@post']);

      Route::post('/post/topic',['as' => 'post.topic','uses' => 'TopicController@create']);

      Route::post('/upload/topicImage',['as' => 'upload.topicImage','uses' => 'TopicController@uploadTopicImage']);

//-----------------关于User-------------------

     Route::get('/read/users/{uid}',['uses' => 'UserController@index','as'   => 'read.user']);

     Route::post('/regist',['as' => 'regist','uses' => 'UserController@create']);

     Route::get('/user/active/{user_name}/{time}',['as' => 'user.active','uses' => 'UserController@active']);

     Route::post("/login",['uses' => 'UserController@login','as' => 'user.login']);

     Route::get("/edit/user/{user}",['uses' => 'UserController@edit','as' => 'edit.user']);

     Route::get("/logout",['uses' => 'UserController@logout','as' => 'logout']);

     Route::post("/update/avatar",['as' => 'update.avatar','uses' => 'UserController@updateAvatar']);

     Route::post("/upload/avatar",['as' => 'upload.avatar','uses' => 'UserController@uploadAvatar']);

     Route::post('/update/profile',['as' => 'update.profile','uses' => 'UserController@updateProfile']);

     Route::post('/update/password',['as' => 'update.password','uses' => 'UserController@updatePassword']);

     Route::post('/validate/user/exist',['as' => 'user.exist','uses' => 'UserController@exist']);

      Route::post('/user/set',['as' => 'user.set','uses' => 'UserController@set']);


});

Route::group(['namespace' => "Admin",'middleware' => 'admin','prefix' => 'admin'],function(){

   Route::get('/',['as' => 'admin','uses' => 'AdminController@index']);

   Route::get('/autofix',['as' => 'admin.autofix','uses' => 'AdminController@autofix']);

   Route::get('/update/site_state',['as' => 'update.site_state','uses' => 'AdminController@updateSite']);

   Route::get('/tip/delete/{bid}',['as' => 'tip.delete','uses' => 'AdminController@deleteTip']);
   Route::post('/tip/add',['as' => 'tip.add','uses' => 'AdminController@addTip']);

   Route::post('/about/update',['as' => 'update.about','uses' => 'AdminController@updateAbout']);

   Route::get('/document/delete/{did}',['as' => 'delete.document','uses' => 'AdminController@deleteDocument']);
   Route::post('/document/add',['as' => 'add.document','uses' => 'AdminController@addDocument']);

   Route::post('/markdowm/update',['as' => 'update.markdowm','uses' => 'AdminController@updateMarkdown']);

   Route::post('/node/add',['as' => 'add.node', 'uses' => 'AdminController@addNode']);

   Route::post('/user/ban',['as' => 'ban.user', 'uses' => 'AdminController@banUser']);
   Route::post('/user/send/email',['as' => 'send.active.email', 'uses' => 'AdminController@sendEmail']);
   Route::post('/user/active',['as' => 'active.user', 'uses' => 'AdminController@activeUser']);

   Route::get('/topic/excellent/{tid}',['as' => 'excellent.topic', 'uses' => 'AdminController@excellentTopic']);
   Route::get('/topic/stick/{tid}',['as' => 'stick.topic', 'uses' => 'AdminController@stickTopic']);
   Route::get('/topic/delete/{tid}',['as' => 'admin.delete.topic', 'uses' => 'AdminController@deleteTopic']);
   Route::get('/topic/recommend/{tid}',['as' => 'recommend.topic', 'uses' => 'AdminController@recommendTopic']);
   Route::get('/topic/admin/recommend/{tid}',['as' => 'admin.recommend', 'uses' => 'AdminController@adminRecommend']);
   Route::get('/topic/wiki/{tid}',['as' => 'wiki.topic', 'uses' => 'AdminController@wikiTopic']);
});





