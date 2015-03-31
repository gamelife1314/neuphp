<?php namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\BBS\Michelf\Markdown;

use Illuminate\Http\Request;

class HomeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$excellenTopics = \DB::table('topics') ->where('is_excellent','=', '1')
		                                        ->leftJoin('users', 'topics.user_id', '=', 'users.id')
		                                        ->leftJoin('nodes','topics.node_id', '=', 'nodes.id')
		                                        ->leftJoin('users as last_reply_user','topics.last_reply_user_id','=','last_reply_user.id')
		                                        ->orderBy('topics.id','ASC')
		                                        ->select('topics.*','users.image_url as user_image_url','nodes.name as node_name','last_reply_user.name as last_user_name')
		                                        ->take(20)
		                                        ->get();
       //dd($excellenTopics);
		return view('layouts.home.index')->with('excellenTopics',$excellenTopics);
	}

	/**
	 * [community description]
	 * @return [type] [description]
	 */
    public function community($arg = "default", $pid = 1)
    {
//设定页面容量
    	$pageSize = 20;
//计算相应帖子数目
        if ($arg == "default" or $arg == "maxvote") {
        	$topicCount = \DB::table('topics')->count();
	        if($arg == "default") {
	        	$returnTopics = \DB::table('topics')->where('stick','=','1')
                                   ->orWhere('recommend','=','1')
                                   ->orWhere('title', '!=', ' ')
                                   ->leftJoin('users', 'topics.user_id', '=', 'users.id')
                                   ->leftJoin('nodes','topics.node_id', '=', 'nodes.id')
                                   ->leftJoin('users as last_reply_user','topics.last_reply_user_id','=','last_reply_user.id')
                                   ->orderBy('topics.stick','desc')
                                   ->orderBy('topics.recommend','desc')
                                   ->orderBy('topics.view_count','desc')
                                   ->select('topics.*','users.image_url as user_image_url','nodes.name as node_name','last_reply_user.name as last_user_name')
                                   ->skip(($pid - 1) * $pageSize)
                                   ->take($pageSize)
                                   ->get();
	        }
	        else {
	        	$returnTopics = \DB::table('topics')->leftJoin('users', 'topics.user_id', '=', 'users.id')
                                   ->leftJoin('nodes','topics.node_id', '=', 'nodes.id')
                                   ->leftJoin('users as last_reply_user','topics.last_reply_user_id','=','last_reply_user.id')
                                   ->orderBy('topics.vote_count','desc')
                                   ->select('topics.*','users.image_url as user_image_url','nodes.name as node_name','last_reply_user.name as last_user_name')
                                   ->skip(($pid - 1) * $pageSize)
                                   ->take($pageSize)
                                   ->get();
	        }
        }
        else if ($arg == "recent") {
        	$topicCount = \DB::table('topics')->count();
        	$returnTopics = \DB::table('topics')->leftJoin('users', 'topics.user_id', '=', 'users.id')
                                   ->leftJoin('nodes','topics.node_id', '=', 'nodes.id')
                                   ->leftJoin('users as last_reply_user','topics.last_reply_user_id','=','last_reply_user.id')
                                   ->orderBy('topics.created_at','desc')
                                   ->select('topics.*','users.image_url as user_image_url','nodes.name as node_name','last_reply_user.name as last_user_name')
                                   ->skip(($pid - 1) * $pageSize)
                                   ->take($pageSize)
                                   ->get();
        }
        else if ($arg == "excellent") {
        	$topicCount = \DB::table('topics')->where('is_excellent','=', '1')->count();
        	$returnTopics = \DB::table('topics')->where('is_excellent','=', '1')
                                   ->leftJoin('users', 'topics.user_id', '=', 'users.id')
                                   ->leftJoin('nodes','topics.node_id', '=', 'nodes.id')
                                   ->leftJoin('users as last_reply_user','topics.last_reply_user_id','=','last_reply_user.id')
                                   ->orderBy('topics.id','desc')
                                   ->select('topics.*','users.image_url as user_image_url','nodes.name as node_name','last_reply_user.name as last_user_name')
                                   ->skip(($pid - 1) * $pageSize)
                                   ->take($pageSize)
                                   ->get();
        }
        else if($arg == "nobodyview") {
        	$topicCount = \DB::table('topics')->where('view_count','=', '0')->count();
        	$returnTopics = \DB::table('topics')->where('view_count','=', '0')
                                   ->leftJoin('users', 'topics.user_id', '=', 'users.id')
                                   ->leftJoin('nodes','topics.node_id', '=', 'nodes.id')
                                   ->leftJoin('users as last_reply_user','topics.last_reply_user_id','=','last_reply_user.id')
                                   ->orderBy('topics.id','asc')
                                   ->select('topics.*','users.image_url as user_image_url','nodes.name as node_name','last_reply_user.name as last_user_name')
                                   ->skip(($pid - 1) * $pageSize)
                                   ->take($pageSize)
                                   ->get();
        }
//计算出分页数目
        $pageNumber = ceil($topicCount / $pageSize);
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
    //dd($topicCount);
    $max_pid = $pageNumber > ($pid + 4) ? ($pid + 4) : $pageNumber;
    return view('layouts.home.community')->with("tips",$tips)
    	                                 ->with('recommend',$recommend)
    	                                 ->with('returnTopics',$returnTopics)
    	                                 ->with('max_pid',$max_pid)
    	                                 ->with('current_pid',$pid)
    	                                 ->with('arg',$arg)
    	                                 ->with('pageNumber',$pageNumber)
                                       ->with('siteInf',$siteInf)
                                       ->with('siteNode',"community")
                                       ->with('topicCount',$topicCount);
    }

    /**
     * [member description]
     * @return [type] [description]
     */
    public function member()
    {
      $bbsMember = \DB::table('users')->select('id','image_url','name')
                                      ->orderBy('id','ASC')
                                      ->get();
      //dd($bbsMember);
      return view('layouts.home.member')->with('bbsMember',$bbsMember);
    }

    /**
     * [wiki description]
     * @return [type] [description]
     */
    public function wiki()
    {
      $wikiTopics =  \DB::table('topics')->where('is_wiki', '=', '1')
                                         ->select('id','title')
                                         ->orderBy('id','DESC')
                                         ->get();
     // dd($wikiTopics);
      return view('layouts.home.wiki')->with('wikiTopics',$wikiTopics);
    }

   /**
    * [about description]
    * @return [type] [description]
    */
   public function about()
   {
     $abouts = \DB::table('abouts')->first()->body;

     // dd(Markdown::defaultTransform($abouts));
     return view('layouts.home.about')->with('abouts',Markdown::defaultTransform($abouts));
   }

   /**
    * [document description]
    * @return [type] [description]
    */
    public function documents()
    {
      $documents = \DB::table('documents')->orderBy('id',"ASC")->get();
      // dd($documents);
      return view('layouts.home.document')->with('documentTopics',$documents);
    }

    /**
     * [markdown description]
     * @return [type] [description]
     */
    public function markdown()
    {
      $markdown = \DB::table('markdown')->first()->body;
      return view('layouts.home.markdown')->with('markdown',Markdown::defaultTransform($markdown))
                                          ->with('example',$markdown);
    }

   public function viewMarkdownResult(Request $request)
   {
     $markdownInput = $request->input('markdownInput');

     $explainInput = Markdown::defaultTransform($markdownInput);

     return view('layouts.home.result')->with('explainResult',$explainInput);
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
