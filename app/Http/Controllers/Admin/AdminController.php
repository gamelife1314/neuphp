<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Session;
use App\BBS;
use App\Collect;
use App\User;
use App\Topic;
use App\Favorite;
use App\Reply;
use App\BBS\Common\Common;
use \Crypt;
use \Mail;
use App\Tip;
use App\Vote;
use \DB;
use \Request;
use App\Node;
class AdminController extends Controller {

   /**
    * [getIndex description]
    * @return [type] [description]
    */
	public function index()
	{
      return view('layouts.admin.index')->with('site_state',BBS::find(1))
                                        ->with('tips',DB::table('tips')->get())
                                        ->with('abouts',DB::table('abouts')->get())
                                        ->with('documents',DB::table('documents')->get())
                                        ->with('markdown',DB::table('markdown')->get())
                                        ->with('parentNodes',DB::table('nodes')->where('parent_node','=',null)->get())
                                        ->with('topics',DB::table('topics')->paginate(15));
	}
    /**
     * [autofix description]
     * @return [type] [description]
     */
	public function autofix()
	{

	 $start = time();

	 $returnInf = [];

      foreach (Collect::all() as $collect) {
      	if (User::find($collect->user_id) == null || Topic::find($collect->topic_id) == null) {
             $collect->delete();
      	 }
      }

      foreach (Favorite::all() as  $favorite) {
      	if (User::find($favorite->user_id) == null || Topic::find($favorite->topic_id) == null) {
             $favorite->delete();
      	 }
      }

      foreach (Reply::all() as  $reply) {
      	if (User::find($reply->user_id) == null || Topic::find($reply->topic_id) == null) {
      		$reply->delete;
      	}
      }

     $site_state = BBS::find(1);
     $site_state->register_count == User::count() ?: $site_state->register_count = User::count();
     $site_state->topic_count == Topic::count() ?: $site_state->topic_count = Topic::count();
     $site_state->reply_count == Reply::count() ?: $site_state->reply_count = Reply::count();
     $site_state->avatars_count = count(scandir(public_path().'/image/avatars')) - 2;
     $site_state->emjoy_count = count(scandir(public_path().'/image/emjoy')) - 2;
     $site_state->save();

     if(!is_dir(public_path()."/uploads"))

              mkdir(public_path()."/uploads");

      if(!is_dir(public_path()."/uploads/topics"))

              mkdir(public_path()."/uploads/topics");

      if(!is_dir(public_path()."/uploads/avatars"))

             mkdir(public_path()."/uploads/avatars");

      foreach (Topic::all() as $topic) {
      	$topic->reply_count >= 0 ?: $topic->reply_count = 0;
      	$topic->vote_count >= 0 ?: $topic->vote_count = 0;
      	$topic->save();
      }

      foreach (User::all() as $user) {
      	$user->topic_count >= 0 ?: $user->topic_count = 0;
      	$user->reply_count >= 0 ?: $user->reply_count = 0;
      	// if ($user->active == 0) {

       //      $url = route('user.active',['user_name' => Crypt::encrypt($user->name),'time' => Crypt::encrypt(time())]);
       //      Session::flash('email',$user->email);
       //      @Mail::queue('layouts.home.active_view', ['user' => $user->name,'url' => $url], function($message)
       //      {
       //        $message->to(session('email'))->subject('NEU PHP 账户激活');
       //      });
      	// }
        $user->save();

      }

      foreach (Tip::all() as $tip) {
      	Topic::find($tip->topic_id) != null ?: $tip->delete();
      }

      foreach (Vote::all() as $vote) {
      	Topic::find($vote->topic_id) != null ?: $vote->delete();
      }

     $end = time();

      Session::flash('operationResult','am-alert-success');
      $returnInf[] = trans('bbs.Automatic Maintenance Done!').trans('bbs.Take Time!',['time' => Common::calculateTopicTime($end - $start)]);
      Session::flash('returnInf',$returnInf);

   return redirect()->back();
   }
    /**
     * [updateSite description]
     * @return [type] [description]
     */
   public function updateSite()
   {

    $site_state = BBS::find(1);
     $site_state->register_count == User::count() ?: $site_state->register_count = User::count();
     $site_state->topic_count == Topic::count() ?: $site_state->topic_count = Topic::count();
     $site_state->reply_count == Reply::count() ?: $site_state->reply_count = Reply::count();
     $site_state->avatars_count = count(scandir(public_path().'/image/avatars')) - 2;
     $site_state->emjoy_count = count(scandir(public_path().'/image/emjoy')) - 2;
     $site_state->save();

    $returnInf = [];

    Session::flash('operationResult','am-alert-success');
    $returnInf[] = trans('bbs.Updated Successfully!');
    Session::flash('returnInf',$returnInf);

    return redirect()->back();
   }
  /**
   * [deleteTip description]
   * @param  [type] $bid [description]
   * @return [type]      [description]
   */
   public function deleteTip($bid)
   {

     DB::table('tips')->where('id','=',$bid)->delete();

     return redirect()->back();
   }
   /**
    * [addTip description]
    */
   public function addTip()
   {

    DB::table('tips')->insert(['content' => Request::input('content')]);

    return redirect()->back();
   }
   /**
    * [updateAbout description]
    * @return [type] [description]
    */
   public function updateAbout()
   {

    DB::table('abouts')->where('id',1)->update(['body' => Request::input('body')]);

    return redirect()->back();
   }
   /**
    * [updateDocument description]
    * @return [type] [description]
    */
   public function deleteDocument($did)
   {

   DB::table('documents')->where('id',$did)->delete();
   return redirect()->back();
   }
   /**
    * [addDocument description]
    */
   public function addDocument()
   {

   DB::table('documents')->insert(['name' => Request::input('name'),'url' => Request::input('url')]);

   return redirect()->back();
   }
    /**
     * [updateMarkdown description]
     * @return [type] [description]
     */
   public function updateMarkdown()
   {

    DB::table('markdown')->where('id',1)->update(['body' => Request::input('body')]);

    return redirect()->back();
   }
   /**
    * [addNode description]
    */
   public function addNode()
   {

    if (Request::input('root')) {
      Node::create([
        'name' => Request::input('name'),
        'slug' => Request::input('name'),
        'description' => Request::input('description'),
        'parent_node' => null]);
    }
    else {

      Node::create([
        'name' => Request::input('name'),
        'slug' => Request::input('name'),
        'description' => Request::input('description'),
        'parent_node' => Request::input('parent')]);

    }

    return redirect()->back();
   }
   /**
    * [banUser description]
    * @return [type] [description]
    */
   public function banUser()
   {
    if (Request::input('evidence') == 1) {
      $user = @User::where('id','=',Request::input('name'))->get()[0];
    }
    else if (Request::input('evidence') == 2) {
      $user = @User::where('name','=',Request::input('name'))->get()[0];
    }

    if ($user != null) {

       $user->is_banned = 1;
       $user->active = 0;
        if ($user->save()) {
           self::normal();
        }
        else {
          self::error();
        }
    }
    else {
      self::noUser();
    }
    return redirect()->back();
   }
  /**
   * [sendEmail description]
   * @return [type] [description]
   */
   public function sendEmail()
   {

      $user = @User::where('name','=',Request::input('name'))->get()[0];

     if ($user != null) {

       $url = route('user.active',['user_name' => Crypt::encrypt($user->name),'time' => Crypt::encrypt(time())]);
       Session::flash('email',$user->email);
       @Mail::queue('layouts.home.active_view', ['user' => $user->name,'url' => $url], function($message)
         {
          $message->to(session('email'))->subject('NEU PHP 账户激活');
         });

      self::normal();

     }
     else {
         self::noUser();
     }

    return redirect()->back();
   }
  /**
   * [activeUser description]
   * @return [type] [description]
   */
   public function activeUser()
   {
      $user = @User::where('name','=',Request::input('name'))->get()[0];

      if ($user != null) {

        $user->is_banned = 0;
        $user->active = 1;
        if ($user->save()) {
          self::normal();
        }
       else {
          self::error();
       }
      }
      else {
        self::noUser();
      }

    return redirect()->back();
   }
   /**
    * [excellentTopic description]
    * @return [type] [description]
    */
   public function excellentTopic($tid)
   {

    $topic = Topic::find($tid);

    $topic->is_excellent = !$topic->is_excellent;
    $topic->updated_at = date('Y-m-d H:i:s');

    if ($topic->save()) {
      self::normal();
    }
    else {
       self::error();
    }
    return redirect()->back();
   }
   /**
    * [stickTopic description]
    * @param  [type] $tid [description]
    * @return [type]      [description]
    */
   public function stickTopic($tid)
   {
    $topic = Topic::find($tid);

    $topic->stick = !$topic->stick;
    $topic->updated_at = date('Y-m-d H:i:s');

    if ($topic->save()) {
      self::normal();
    }
    else {
       self::error();
    }
    return redirect()->back();
   }
   /**
    * [deleteTopic description]
    * @param  [type] $tid [description]
    * @return [type]      [description]
    */
   public function deleteTopic($tid)
   {
      $topic = Topic::find($tid);

      Node::find($topic->node_id)->decrement('topic_count');

      $user = User::find($topic->user_id);
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

      foreach (Vote::where('topic_id','=',$tid)->get() as $vote) {
        $vote->delete();
      }

      if ($topic->delete()) {
        self::normal();
      }
      else {
        self::error();
      }

      return redirect()->route('home.community');
   }
  /**
   * [recommendTopic description]
   * @return [type] [description]
   */
   public function recommendTopic($tid)
   {

    $topic = Topic::find($tid);

    $topic->recommend = !$topic->recommend;
    $topic->updated_at = date('Y-m-d H:i:s');

    if ($topic->save()) {
      self::normal();
    }
    else {
       self::error();
    }
    return redirect()->back();

   }
   /**
    * [adminRecommend description]
    * @return [type] [description]
    */
   public function adminRecommend($tid)
   {
    $topic = Topic::find($tid);

    $topic->is_right_recommend = !$topic->is_right_recommend;
    $topic->updated_at = date('Y-m-d H:i:s');

    if ($topic->save()) {
      self::normal();
    }
    else {
       self::error();
    }
    return redirect()->back();

   }
   /**
    * [wikiTopic description]
    * @param  [type] $tid [description]
    * @return [type]      [description]
    */
   public function wikiTopic($tid)
   {

    $topic = Topic::find($tid);

    $topic->is_wiki = !$topic->is_wiki;
    $topic->updated_at = date('Y-m-d H:i:s');

    if ($topic->save()) {
      self::normal();
    }
    else {
       self::error();
    }
    return redirect()->back();

   }
   /**
    * [normal description]
    * @return [type] [description]
    */
   public function normal()
   {

      $returnInf = [];

      Session::flash('operationResult','am-alert-success');
      $returnInf[] = trans('bbs.Operated Successfully!');
      Session::flash('returnInf',$returnInf);

   }
   /**
    * [error description]
    * @return [type] [description]
    */
   public function error()
   {
     $returnInf = [];

      Session::flash('operationResult','am-alert-warning');
      $returnInf[] = trans('bbs.Operation Failure!');
      Session::flash('returnInf',$returnInf);

   }
   /**
    * [noUser description]
    * @return [type] [description]
    */
   public function noUser()
   {
        $returnInf = [];

      Session::flash('operationResult','am-alert-warning');
      $returnInf[] = trans('bbs.No User!');
      Session::flash('returnInf',$returnInf);
   }

}

