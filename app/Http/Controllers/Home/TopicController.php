<?php namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BBS\Michelf\Markdown;
use Illuminate\Http\Request;
use App\BBS\Common\Common;

class TopicController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}
//为帖子投票
    public function vote($tid)
    {
       \DB::table('topics')->where('id', '=', $tid)->increment('vote_count');
       return \Redirect::back();
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
         //获得公告内容
    	 $tips = \DB::table("tips")->get();
         //获得推荐内容
    	 $recommend = \DB::table('topics')->where('is_right_recommend','=','1')
    	                                 ->orderBy('id','desc')
    	                                 ->select('id','title')
    	                                 ->take(5)
    	                                 ->get();
        //获得站点信息
        $siteInf = \DB::table('site_state')->first();
        //返回需要的内容
        $returnTopics = \DB::table('topics')->where('topics.id', '=', $id)
                                           ->leftJoin('users','topics.user_id','=','users.id')
                                           ->leftJoin('nodes','topics.node_id', '=', 'nodes.id')
                                           ->leftJoin('users as last_reply_user','topics.last_reply_user_id','=','last_reply_user.id')
                                           ->select('topics.*','users.image_url as user_image_url','users.name as user_name','nodes.name as node_name','last_reply_user.name as last_user_name')
                                           ->get();
        $returnTopics[0]->content = Markdown::defaultTransform($returnTopics[0]->content);

        $postTime = Common::calculateTopicTime(time() - strtotime($returnTopics[0]->created_at));
        $lastReplyTime = Common::calculateTopicTime(time() - strtotime($returnTopics[0]->updated_at));
        //获得本贴的回复信息
        $replies = \DB::table('replies')->where('replies.topic_id', '=', $id)
                                        ->leftJoin('users','users.id','=','replies.user_id')
                                        ->orderBy('replies.id','desc')
                                        ->select('replies.*','users.name as user_name','users.image_url as user_image_url')
                                        ->paginate(10);
        foreach ($replies as $key => $value) {
        	$value->body = Markdown::defaultTransform($value->body);
        	$value->replyTime = Common::calculateTopicTime(time() - strtotime($value->created_at));
        }
		return view('layouts.home.read_topic')->with("tips",$tips)
    	                                      ->with('recommend',$recommend)
    	                                      ->with('siteInf',$siteInf)
    	                                      ->with('returnTopics',$returnTopics)
    	                                      ->with('postTime',$postTime)
    	                                      ->with('lastReplyTime',$lastReplyTime)
    	                                      ->with('replies',$replies);
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
