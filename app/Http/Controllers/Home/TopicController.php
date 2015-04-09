<?php namespace App\Http\Controllers\Home;

use App\HttpRequests;
use App\Http\Controllers\Controller;
use App\BBS\Michelf\Markdown;
use Illuminate\HttpRequest;
use App\BBS\Common\Common;
use App\Vote;
use App\User;
use App\Topic;
use App\Collect;
use App\Favorite;
use App\Reply;
use App\Tip;
use App\Node;
use App\BBS;
use \Auth;
use \Session;
use \Request;
use \DB;
use \Validator;

class TopicController extends Controller {

	public function __construct()
	{
		 $this->middleware('auth',['only' => ['uploadTopicImage','voteUp','voteDown','collect','vote','favorite','voteReply','replyTopic','deleteReply','deleteTopic','editTopic','update']]);
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

    public function vote($tid)
    {
       // DB::table('topics')->where('id', '=', $tid)->increment('vote_count');
       // return \Redirect::back();
       return redirect()->route('read.topic',$tid);
    }
    /**
     * [voteUp description]
     * @param  [type] $tid [description]
     * @return [type]      [description]
     */
    public function voteUp($tid)
    {
      $returnInf = [];

      $vote = Vote::firstOrCreate(['user_id' => Auth::id(),'topic_id' => $tid]);

      if ($vote->vote_up) {

      	$vote->vote_down = 0;
      	$vote->save();

      	Session::flash('operationResult','am-alert-warning');
      	array_push($returnInf,trans('bbs.Voted Already!'));

      }
      else {

        $vote->vote_up = 1;
        $vote->vote_down = 0;
      	$vote->save();

        Topic::find($tid)->increment('vote_count');

        Session::flash('operationResult','am-alert-success');
      	array_push($returnInf,trans('bbs.Vote Successfully!'));

      }

      Session::flash('returnInf',$returnInf);

      return redirect()->back();
    }
    /**
     * [voteDown description]
     * @param  [type] $tid [description]
     * @return [type]      [description]
     */
    public function voteDown($tid)
    {
      $returnInf = [];

      $vote = Vote::firstOrCreate(['user_id' => Auth::id(),'topic_id' => $tid]);

      if ($vote->vote_down) {

      	$vote->vote_up = 0;
      	$vote->save();

      	Session::flash('operationResult','am-alert-warning');
      	array_push($returnInf,trans('bbs.Voted Already!'));

      }
      else {

        $vote->vote_up = 0;
        $vote->vote_down = 1;
      	$vote->save();

        Topic::find($tid)->decrement('vote_count');

        Session::flash('operationResult','am-alert-success');
      	array_push($returnInf,trans('bbs.Vote Successfully!'));

      }

      Session::flash('returnInf',$returnInf);

      return redirect()->back();

    }
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$input = Request::all();

		$rules = ['title' => ['unique:topics'],
              'content' => ['min:20']];
		$validator = Validator::make($input, $rules);

		$returnInf = [];

	   if ($validator->fails()) {

	   	  $messages = $validator->messages();
          foreach (array_dot($messages->toArray()) as  $value)
          {
              array_push($returnInf,$value);
          }
          Session::flash('operationResult','am-alert-warning');
          Session::flash('returnInf',$returnInf);
          return redirect()->back()->withInput(Request::flash());

	   } else {

	   	$topic =  Topic::create(['title' => $input['title'],
			               'content' => Common::encodeTopicContent($input['content']),
			               'node_id' => $input['node_id'],
			               'user_id' => $input['user_id'],
			               'last_reply_user_id'  => $input['user_id'],
			               'updated_at' => date('Y-m-d H:i:s'),
			               'created_at' => date('Y-m-d H:i:s')]);
		   	if ($topic->id > 0) {

		   		 Session::flash('operationResult','am-alert-success');
		   		 array_push($returnInf,trans('bbs.Post Successfully!',['tid' => $topic->id]));

           Node::find($input['node_id'])->increment('topic_count');

           BBS::find(1)->increment('topic_count');

           User::find($input['user_id'])->increment('topic_count');
		   	} else {
		   		  Session::flash('operationResult','am-alert-warning');
		   		  array_push($returnInf,trans('bbs.Unknow Error!'));
		   	}
	   }

      Session::flash('returnInf',$returnInf);

      return redirect()->back();
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
		 Topic::find($id)->increment('view_count');
         //获得公告内容
    	 $tips = DB::table("tips")->get();
         //获得推荐内容
    	 $recommend = DB::table('topics')->where('is_right_recommend','=','1')
    	                                 ->orderBy('id','desc')
    	                                 ->select('id','title')
    	                                 ->take(5)
    	                                 ->get();
        //获得站点信息
        $siteInf = DB::table('site_state')->first();
        //返回需要的内容
        $returnTopics = DB::table('topics')->where('topics.id', '=', $id)
                                           ->leftJoin('users','topics.user_id','=','users.id')
                                           ->leftJoin('nodes','topics.node_id', '=', 'nodes.id')
                                           ->leftJoin('users as last_reply_user','topics.last_reply_user_id','=','last_reply_user.id')
                                           ->select('topics.*','users.image_url as user_image_url','users.name as user_name','nodes.name as node_name','last_reply_user.name as last_user_name')
                                           ->get();
        $returnTopics[0]->content = Markdown::defaultTransform($returnTopics[0]->content);

        $postTime = Common::calculateTopicTime(time() - strtotime($returnTopics[0]->created_at));
        $lastReplyTime = Common::calculateTopicTime(time() - strtotime($returnTopics[0]->updated_at));
        //获得本贴的回复信息
        $replies = DB::table('replies')->where('replies.topic_id', '=', $id)
                                        ->leftJoin('users','users.id','=','replies.user_id')
                                        ->orderBy('replies.vote_count','desc')
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
    	                                      ->with('replies',$replies)
                                            ->with('emjoy_count',BBS::find(1)->emjoy_count);
	}
	/**
	 * [uploadTopicFile description]
	 * @return [type] [description]
	 */
    public function uploadTopicImage()
    {
      return "hellow world";
    }
    /**
     * [collect description]
     * @param  [type] $tid [description]
     * @return [type]      [description]
     */
    public function collect($tid)
    {
    	$returnInf = [];

    	Collect::firstOrCreate(['topic_id' => $tid, 'user_id' => Auth::id()]);

    	Session::flash('operationResult','am-alert-success');
        array_push($returnInf,trans('bbs.Collected Successfully!',['uid' => Auth::id()]));

    	Session::flash('returnInf',$returnInf);

        return redirect()->back();
    }
    /**
     * [favorite description]
     * @param  [type] $tid [description]
     * @return [type]      [description]
     */
    public function favorite($tid)
    {
        $returnInf = [];

    	Favorite::firstOrCreate(['topic_id' => $tid, 'user_id' => Auth::id()]);

    	Session::flash('operationResult','am-alert-success');
        array_push($returnInf,trans('bbs.Mark This Topic as Favorite Successfully!',['uid' => Auth::id()]));

    	Topic::find($tid)->increment('favorite_count');

      Session::flash('returnInf',$returnInf);

        return redirect()->back();
    }
    /**
     * [voteReply description]
     * @return [type] [description]
     */
    public function voteReply($rid)
    {
    	$returnInf = [];

    	Reply::find($rid)->increment('vote_count');

    	Session::flash('operationResult','am-alert-success');
        array_push($returnInf,trans('bbs.Applaud Successfully!'));

    	Session::flash('returnInf',$returnInf);

        return redirect()->back();

    }
    /**
     * [replyTopic description]
     * @return [type] [description]
     */
    public function replyTopic()
    {
      $returnInf = [];

      $contentLength = 10;

      $input = Request::all();

      $tipUser = explode('@;;@',$input['tipUser']);
      array_pop($tipUser);
      $tipUser = Common::dealReplyContent($tipUser);

      $reply =   explode('@;;@',$input['replyContent']);
      $replyContent = array_pop($reply);
      $reply = Common::dealReplyContent($reply);

      $finalTipUser = Common::compareAndCombine($reply,$tipUser);

      $replyTipsUser = "";

      if (strlen($replyContent) > $contentLength) {

      	foreach ($finalTipUser as $key => $value) {

      		$user = User::find($value);
      		$user->increment('tips');

            Tip::create(['topic_id' => $input['topic_id'],
            	         'active_user_id' => Auth::id(),
            	         'positive_user_id' => $value,
            	         'body' => "用户".trans('bbs.user',['username' => $user->name,'uid' => $value])."在".trans('bbs.topic',['title' => $input['topic_title'],'tid' => $input['topic_id']])."中提到了你"]);


            $replyTipsUser .= trans('bbs.@user',['username' => $user->name,'uid' => $value]);

             $user->save();

      	}

       Reply::create(['body' => $replyTipsUser.Common::encodeTopicContent($replyContent),
       	              'user_id' => Auth::id(),
       	              'topic_id' => $input['topic_id'],
       	              'is_block' => 0,
                      'tip_user' => implode(';',$finalTipUser)]);

        BBS::find(1)->increment('reply_count');

        $topic = Topic::find($input['topic_id']);
        $topic->increment('reply_count');
        $topic->last_reply_user_id = Auth::id();
        $topic->updated_at = date('Y-m-d H:i:s');
        $topic->save();

        User::find(Auth::id())->increment('reply_count');

        Session::flash('operationResult','am-alert-success');
        $returnInf[] = trans('bbs.Reply Successfully!');

      }
      else {
        Request::flashOnly('tipUser','replyContent');

        Session::flash('operationResult','am-alert-warning');
        $returnInf[] = trans('bbs.ReplyContent is Too Short!',['min' => $contentLength]);

        // return redirect()->route('read.topic',$input['topic_id'])->withInput();
      }

      Session::flash('returnInf',$returnInf);

      return redirect()->back();
    }
   /**
    * [deleteReply description]
    * @return [type] [description]
    */
    public function deleteReply($rid)
    {

     $reply = Reply::find($rid);
     $reply_user_id = $reply->user_id;
     $reply_topic_id = $reply->topic_id;
     $tipUsers = explode(';',$reply->tip_user);

     foreach ($tipUsers as  $value) {

     $tip = Tip::where('active_user_id', '=', Auth::id())->where('positive_user_id','=',$value)->first();

        if ($tip->view == 0) {

           User::find($value)->decrement('tips');
          }

          $tip->delete();
    }

     User::find($reply_user_id)->decrement('reply_count');

     Topic::find($reply_topic_id)->decrement('reply_count');

     $reply->delete();

     BBS::find(1)->decrement('reply_count');

     Topic::find($reply_topic_id)->decrement('reply_count');

     $returnInf = [];

     Session::flash('operationResult','am-alert-success');
     $returnInf[] = trans('bbs.Delete Reply Successfully!');

     Session::flash('returnInf',$returnInf);

     return redirect()->back();

    }
   /**
    * used for delete topic
    * @param  [type] $tid [description]
    * @return [type]      [description]
    */
    public function deleteTopic($tid)
    {
      $topic = Topic::find($tid);

      Node::find($topic->node_id)->decrement('topic_count');

      $user = User::find(Auth::id());
      $user->decrement('topic_count');

      BBS::find(1)->decrement('topic_count');

      $replies = Reply::where('topic_id', '=',$tid)->get();
      foreach ($replies as  $reply) {

        User::find($reply->user_id)->decrement('reply_count');

        BBS::find(1)->decrement('reply_count');

        $reply->delete();
      }

      $tips =  Tip::where('topic_id','=',$tid)->get();
      foreach ($tips as  $tip) {

        if ($tip->view == 0) {

          User::find($tip->positive_user_id)->decrement('tips');
        }

        $tip->delete();
      }

      $topic->delete();

      $returnInf = [];

      Session::flash('operationResult','am-alert-success');
      $returnInf[] = trans('bbs.Delete Topic Successfully!');

      Session::flash('returnInf',$returnInf);

      return redirect()->back();

    }
	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function editTopic(Topic $topic)
	{
       $tips = DB::table("tips")->get();

       $recommend = DB::table('topics')->where('is_right_recommend','=','1')
                                       ->orderBy('id','desc')
                                       ->select('id','title')
                                       ->take(5)
                                       ->get();

    $siteInf = DB::table('site_state')->first();

    $nodes = Node::where('parent_node','!=','null')->get();
    // dd($topic);
		return view('layouts.home.edit_topic')->with('nodes',$nodes)
                                          ->with('topic',$topic)
                                          ->with("tips",$tips)
                                          ->with('recommend',$recommend)
                                          ->with('siteInf',$siteInf);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update()
	{

    $input = Request::all();

    $returnInf = [];

    $rules = ['content' => ['min:20']];
    $validator = Validator::make($input, $rules);

    if ($validator->fails()) {

          $messages = $validator->messages();
          foreach (array_dot($messages->toArray()) as  $value)
          {
              $returnInf[] = $value;
          }

          Session::flash('operationResult','am-alert-warning');
          Session::flash('returnInf',$returnInf);

          return redirect()->back()->withInput(Request::flash());

    }
    else {

        $topic= Topic::find($input['topic_id']);
        $old_nid = $topic->node_id;
        $new_nid = $input['node_id'];

        if ($old_nid != $new_nid) {

          Node::find($old_nid)->decrement('topic_count');
          Node::find($new_nid)->increment('topic_count');

          $topic->node_id = $new_nid;
        }

        $topic->content = Common::encodeTopicContent($input['content']);
        $topic->created_at = date('Y-m-d H:i:s');
        $topic->save();

        Session::flash('operationResult','am-alert-success');
        $returnInf[] = trans('bbs.Edit Successfully!');
        Session::flash('returnInf', $returnInf);

    }

   return redirect()->route('read.topic',$input['topic_id']);
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
