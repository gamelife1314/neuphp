<?php namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class NodeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($nid = 7, $pid = 1)
	{
        //获得公告内容
    	$tips = \DB::table("tips")->first();
        //获得推荐内容
    	$recommend = \DB::table('topics')->where('recommend','=','1')
    	                                 ->orderBy('id','desc')
    	                                 ->select('id','title')
    	                                 ->take(5)
    	                                 ->get();
        //获得站点信息
        $siteInf = \DB::table('site_state')->first();
       //获得当前结点
        $currentNode = \DB::table('nodes')->where('id', '=', $nid)->get();

        //关于分页
        $pageSize = 20;
        $topicCount = \DB::table('topics')->where('node_id', '=', $nid)->count();
        $pageNumber = ceil($topicCount / $pageSize);
        $max_pid = $pageNumber > ($pid + 4) ? ($pid + 4) : $pageNumber;

        $returnTopics = \DB::table('topics')->where('node_id','=', $nid)
                                   ->leftJoin('users', 'topics.user_id', '=', 'users.id')
                                   ->leftJoin('nodes','topics.node_id', '=', 'nodes.id')
                                   ->leftJoin('users as last_reply_user','topics.last_reply_user_id','=','last_reply_user.id')
                                   ->orderBy('topics.id','asc')
                                   ->select('topics.*','users.image_url as user_image_url','nodes.name as node_name','last_reply_user.name as last_user_name')
                                   ->skip(($pid - 1) * $pageSize)
                                   ->take($pageSize)
                                   ->get();
        // dd($currentNode);
        return view('layouts.home.node')->with("tips",$tips)
    	                                ->with('recommend',$recommend)
    	                                ->with('arg',$nid)
    	                                ->with('returnTopics',$returnTopics)
    	                                ->with('max_pid',$max_pid)
    	                                ->with('current_pid',$pid)
    	                                ->with('pageNumber',$pageNumber)
    	                                ->with('siteInf',$siteInf)
                                        ->with('siteNode',"nodes")
                                        ->with('currentNode',$currentNode)
                                        ->with('topicCount',$topicCount);

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
