<?php namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \DB;
use Illuminate\Http\Request;
use App\BBS\Michelf\Markdown;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
        //取得用户信息
		$userInf = DB::table('users')->where('id','=', $id)->get();

        //取得用户收藏帖子
        $collectTopicID = DB::table('collects')->where('collects.user_id', '=', $id)
                                                   ->select('topic_id')
                                                   ->get();
        $collectTopics = [];
        foreach ($collectTopicID as $key => $value) {
        	$topic = DB::table('topics')->where('id', '=', $value->topic_id)
        	                            ->select('id','title','created_at')
        	                            ->get();
        	array_push($collectTopics,$topic[0]);
        }

        //获得该用户的回复
        $repliesID = DB::table('replies')->where('user_id','=',$id)
                                         ->get();

        $replies = [];
        foreach ($repliesID as $key => $value) {
        	$topic =  DB::table('topics')->where('id', '=', $value->topic_id)
        	                            ->select('id','title','user_id')
        	                            ->get();
            $topic_user = DB::table('users')->where('id','=',$topic[0]->user_id)
                                            ->select('id','name')
                                            ->get();
            $repliesID[$key]->body = Markdown::defaultTransform($repliesID[$key]->body);
            array_push($replies,array_merge(['reply' => $repliesID[$key]],['reply_topic' =>$topic[0]],['topic_user' =>$topic_user[0]]));
        }

         //取得用户的发帖
        $posts = DB::table('topics')->where('user_id','=',$id)
                                    ->get();
		return view('layouts.home.user')->with('userInf',$userInf)
		                                ->with('collectTopics',$collectTopics)
		                                ->with('replies',$replies)
		                                ->with('posts',$posts);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
