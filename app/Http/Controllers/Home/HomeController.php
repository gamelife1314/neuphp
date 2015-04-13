<?php namespace App\Http\Controllers\Home;

use App\HttpRequests;
use App\Http\Controllers\Controller;
use App\BBS\Michelf\Markdown;
use App\BBS\Common\Common;
use Illuminate\HttpRequest;
use \Auth;
use \DB;
use \Session;
use \Request;
use App\Node;
use \App;

class HomeController extends Controller {

    public function __construct()
   {
    $this->middleware('auth',['only' => ['post']]);
   }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

    // if (Auth::check() && Auth::user()->is_banned)

    //         Auth::logout();
     // App::setLocale('en');

		$excellenTopics = DB::table('topics') ->where('is_excellent','=', '1')
		                                        ->leftJoin('users', 'topics.user_id', '=', 'users.id')
		                                        ->leftJoin('nodes','topics.node_id', '=', 'nodes.id')
		                                        ->leftJoin('users as last_reply_user','topics.last_reply_user_id','=','last_reply_user.id')
		                                        ->orderBy('topics.id','DESC')
		                                        ->select('topics.*','users.image_url as user_image_url','nodes.name as node_name','last_reply_user.name as last_user_name','nodes.slug as node_slug')
		                                        ->take(20)
		                                        ->get();
    foreach ($excellenTopics as  $value) {
      $value->postTime = Common::calculateTopicTime(time() - strtotime($value->updated_at));
    }

		return view('layouts.home.index')->with('excellenTopics',$excellenTopics)
                                     ->with('nodes',DB::table('nodes')->get());
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
        	$topicCount = DB::table('topics')->count();
	        if($arg == "default") {
	        	$returnTopics = DB::table('topics')->where('stick','=','1')
                                   ->orWhere('recommend','=','1')
                                   ->orWhere('title', '!=', ' ')
                                   ->leftJoin('users', 'topics.user_id', '=', 'users.id')
                                   ->leftJoin('nodes','topics.node_id', '=', 'nodes.id')
                                   ->leftJoin('users as last_reply_user','topics.last_reply_user_id','=','last_reply_user.id')
                                   ->orderBy('topics.stick','desc')
                                   ->orderBy('topics.recommend','desc')
                                   ->orderBy('updated_at','desc')
                                   ->orderBy('topics.view_count','desc')
                                   ->select('topics.*','users.image_url as user_image_url','nodes.name as node_name','last_reply_user.name as last_user_name')
                                   ->skip(($pid - 1) * $pageSize)
                                   ->take($pageSize)
                                   ->get();
	        }
	        else {
	        	$returnTopics = DB::table('topics')->leftJoin('users', 'topics.user_id', '=', 'users.id')
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
        	$topicCount = DB::table('topics')->count();
        	$returnTopics = DB::table('topics')->leftJoin('users', 'topics.user_id', '=', 'users.id')
                                   ->leftJoin('nodes','topics.node_id', '=', 'nodes.id')
                                   ->leftJoin('users as last_reply_user','topics.last_reply_user_id','=','last_reply_user.id')
                                   ->orderBy('topics.id','desc')
                                   ->select('topics.*','users.image_url as user_image_url','nodes.name as node_name','last_reply_user.name as last_user_name')
                                   ->skip(($pid - 1) * $pageSize)
                                   ->take($pageSize)
                                   ->get();
        }
        else if ($arg == "excellent") {
        	$topicCount = DB::table('topics')->where('is_excellent','=', '1')->count();
        	$returnTopics = DB::table('topics')->where('is_excellent','=', '1')
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
        	$topicCount = DB::table('topics')->where('view_count','=', '0')->count();
        	$returnTopics = DB::table('topics')->where('view_count','=', '0')
                                   ->leftJoin('users', 'topics.user_id', '=', 'users.id')
                                   ->leftJoin('nodes','topics.node_id', '=', 'nodes.id')
                                   ->leftJoin('users as last_reply_user','topics.last_reply_user_id','=','last_reply_user.id')
                                   ->orderBy('topics.id','asc')
                                   ->select('topics.*','users.image_url as user_image_url','nodes.name as node_name','last_reply_user.name as last_user_name')
                                   ->skip(($pid - 1) * $pageSize)
                                   ->take($pageSize)
                                   ->get();
        }

        $pageNumber = ceil($topicCount / $pageSize);

    	$tips = DB::table("tips")->get();

    	$recommend = DB::table('topics')->where('is_right_recommend','=','1')
    	                                 ->orderBy('updated_at','desc')
    	                                 ->select('id','title')
    	                                 ->take(5)
    	                                 ->get();

    $siteInf = DB::table('site_state')->first();
    $max_pid = $pageNumber > ($pid + 4) ? ($pid + 4) : $pageNumber;
    foreach ($returnTopics as  $value) {
     $value->replyTime = Common::calculateTopicTime(time() - strtotime($value->created_at));
    }
    return view('layouts.home.community')->with("tips",$tips)
    	                                 ->with('recommend',$recommend)
    	                                 ->with('returnTopics',$returnTopics)
    	                                 ->with('max_pid',$max_pid)
    	                                 ->with('current_pid',$pid)
    	                                 ->with('arg',$arg)
    	                                 ->with('pageNumber',$pageNumber)
                                       ->with('siteInf',$siteInf)
                                       ->with('siteNode',"community")
                                       ->with('topicCount',$topicCount)
                                       ->with('nodes',DB::table('nodes')->get());
    }

    /**
     * [member description]
     * @return [type] [description]
     */
    public function member()
    {
      $bbsMember = DB::table('users')->select('id','image_url','name','active')
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
      $wikiTopics =  DB::table('topics')->where('is_wiki', '=', '1')
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
     $abouts = DB::table('abouts')->first()->body;

     // dd(Markdown::defaultTransform($abouts));
     return view('layouts.home.about')->with('abouts',Markdown::defaultTransform($abouts));
   }

   /**
    * [document description]
    * @return [type] [description]
    */
    public function documents()
    {
      $documents = DB::table('documents')->orderBy('id',"ASC")->get();
      // dd($documents);
      return view('layouts.home.document')->with('documentTopics',$documents);
    }

    /**
     * [markdown description]
     * @return [type] [description]
     */
    public function markdown()
    {
      $markdown = DB::table('markdown')->first()->body;
      return view('layouts.home.markdown')->with('markdown',Markdown::defaultTransform($markdown))
                                          ->with('example',$markdown);
    }

   public function viewMarkdownResult()
   {
     $markdownInput = Request::input('markdownInput');

     $explainInput = Markdown::defaultTransform($markdownInput);

     return view('layouts.home.result')->with('explainResult',$explainInput);
   }
  /**
   * return view for login
   * @return [type] [description]
   */
	public function login()
  {
    if (Auth::check()) {

      $returnInf = [];
      Session::flash('operationResult','am-alert-warning');
      $returnInf[] = trans('bbs.Login Already!');
      Session::flash('returnInf',$returnInf);

      return redirect()->back();
    }
    Session::put('urlBeforeLogin', Request::header('referer'));
    return view('layouts.home.login');
  }
  /**
   * [post topic view]
   * @return [type] [description]
   */
  public function post()
  {

       $tips = DB::table("tips")->get();

       $recommend = DB::table('topics')->where('is_right_recommend','=','1')
                                       ->orderBy('updated_at','desc')
                                       ->select('id','title')
                                       ->take(5)
                                       ->get();

        $siteInf = DB::table('site_state')->first();

        $nodes = Node::where('parent_node','!=','null')->get();

        return view('layouts.home.post_topic')->with("tips",$tips)
                                              ->with('recommend',$recommend)
                                              ->with('siteInf',$siteInf)
                                              ->with('nodes',$nodes)
                                              ->with('nodes',DB::table('nodes')->get());
  }
 /**
  * [search description]
  * @return [type] [description]
  */
  public function search()
  {

   if (Request::has('keyword')) {

      return redirect()->route('search.result',['keyword' => Request::input('keyword')]);

   }

   else {

    return redirect()->back();

   }
  }
  /**
   * [searchResult description]
   * @return [type] [description]
   */
  public function searchResult($keyword)
  {

       $tips = DB::table("tips")->get();

       $recommend = DB::table('topics')->where('is_right_recommend','=','1')
                                       ->orderBy('updated_at','desc')
                                       ->select('id','title')
                                       ->take(5)
                                       ->get();

        $siteInf = DB::table('site_state')->first();

        $nodes = Node::where('parent_node','!=','null')->get();

        $searchs = DB::table('topics')->where('title','like',"%".$keyword."%")
                                       ->orderBy('updated_at','desc')
                                       ->select('id','title')
                                       ->paginate(15);

        return view('layouts.home.search')->with("tips",$tips)
                                              ->with('recommend',$recommend)
                                              ->with('siteInf',$siteInf)
                                              ->with('nodes',$nodes)
                                              ->with('nodes',DB::table('nodes')->get())
                                              ->with('keyword',$keyword)
                                              ->with('searchs',$searchs);

  }
}
