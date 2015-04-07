<?php namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \DB;
use Illuminate\Http\Request;
use App\BBS\Michelf\Markdown;
use Illuminate\Validation\Factory;
use \Mail;
use App\User;
use \Request as BBS_Request;
use App\BBS\Common\Common;
use \Auth;
use \Crypt;
use \Hash;
use App\BBS;
use \Session;
use \Validator;
use App\Tip;
use App\Favorite;
class UserController extends Controller {

   public function __construct()
   {
    $this->middleware('auth',['only' => ['edit','updateAvatar','uploadAvatar','updateProfile','updatePassword']]);
   }

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
          if ($topic[0] != null)
               $collectTopics[] = array_shift($topic);
        }


        //获得该用户的回复
        $repliesID = DB::table('replies')->where('user_id','=',$id)
                                         ->orderBy('id','desc')
                                         ->paginate(8);


        $replies = [];
        foreach ($repliesID as $key => $value) {
        	$topic =  DB::table('topics')->where('id', '=', $value->topic_id)
        	                            ->select('id','title','user_id')
        	                            ->get();
          if(isset($topic[0])){
              $topic_user = DB::table('users')->where('id','=',$topic[0]->user_id)
                                              ->select('id','name')
                                              ->get();
              $repliesID[$key]->body = Markdown::defaultTransform($repliesID[$key]->body);
              array_push($replies,array_merge(['reply' => $repliesID[$key]],['reply_topic' =>$topic[0]],['topic_user' =>$topic_user[0]]));
             }
        }

         //取得用户的发帖
        $posts = DB::table('topics')->where('user_id','=',$id)
                                    ->get();

        //获得用户最爱
        $favorites = User::find($id)->favorites()->orderBy('id','desc')->get();

        $favorites_topics = [];

        foreach ($favorites as $key => $value) {

          $favorite_topic =  Favorite::find($value->id)->topic($value->topic_id)
                                                         ->select('id','title')
                                                         ->first();
          $favorite_topic = $favorite_topic->toArray();
          $favorite_topic['favoriteTime'] = $value->created_at;

          $favorites_topics[] = $favorite_topic;

        }


		    return view('layouts.home.user')->with('userInf',$userInf)
		                                    ->with('collectTopics',$collectTopics)
		                                    ->with('replies',$replies)
		                                    ->with('posts',$posts)
		                                    ->with('pagination',$repliesID)
                                        ->with('favorites_topics',$favorites_topics);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $request, Factory $v)
	{
		$input = $request->all();

		$rules = [
        'email' =>['email','unique:users','required'],
        'user_name' => ['unique:users,name','required','between:5,16'],
        'password'  => ['alpha_dash','between:8,24','confirmed','required']
		];
		$validator = $v->make($input, $rules);

		if($validator->fails()) {
			$request->flashOnly('email','user_name');

			return redirect('login')->withErrors($validator->errors());
		}
		else {

			$url = route('user.active',Crypt::encrypt($input['user_name']));

			 User::create([
		   	           'name' => $input['user_name'],
		   	           'email' => $input['email'],
		   	           'password' => Hash::make($input['password']),
		   	           'image_url' => 'image/avatars/img'.rand(1,BBS::find(1)->avatars_count ?: 15).'.png']);

       BBS::find(1)->increment('register_count');

       Mail::send('layouts.home.email', ['user' => $input['user_name'],'url' => $url], function($message)
                {
                 $message->to($_POST['email'])->subject('您已注册成功,请您激活');
                });

       DB::table('site_state')->where('id')->increment('register_count');

         $returnInf = [];
         array_push($returnInf,trans('bbs.Regist Successfully!',['name' => $input['user_name']]));
         array_push($returnInf,trans('bbs.Enter Your Email and Active Your Account Now !'));
         Session::flash('returnInf',$returnInf);
         Session::flash('operationResult','am-alert-success');

       return redirect()->back();
		}
	}
     /**
      * active account
      * @return [type] [description]
      */
     public function active($user_name)
     {
       $user_name = Crypt::decrypt($user_name);

       $user = User::where('name','=',$user_name)->firstOrFail();
       if (!$user->active) {
       	   $user->active = 1;
       	   $user->save();
       }

         $returnInf = [];
         array_push($returnInf,trans('bbs.Successfully Activated!'));
         Session::flash('returnInf',$returnInf);
         Session::flash('operationResult','am-alert-success');

         return redirect()->route('login');
     }
     /**
      * user login
      * @return [type] [description]
      */
     public function login()
     {

      $returnInf = [];
      $input = BBS_Request::all();

      if(Auth::attempt(['email' => $input['email'],'password' => $input['password'],'active' => '1','is_banned' => "0"],isset($input['remember']) ? $input['remember'] : 'false'))
     {

        array_push($returnInf,trans('bbs.Login Successfully!'));
        Session::flash('returnInf',$returnInf);
        Session::flash('operationResult','am-alert-success');

     	  return redirect()->to(Session::get('urlBeforeLogin', $_SERVER['HTTP_HOST']."/"));
     }
     else {

       array_push($returnInf,trans('bbs.Login Failed!'));
       Session::flash('returnInf',$returnInf);
       Session::flash('operationResult','am-alert-warning');

     	return redirect()->back();
     }
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
	public function edit(User $user)
	{
        if ($user->id == Auth::id()) {

            $avatars_img = [];
            $avatars_count = BBS::find(1)->avatars_count;
            for ($i = 1; $i <= $avatars_count; $i++) {
                array_push($avatars_img,'image/avatars/img'.$i.'.png');
            }

            $user_tips = Tip::where('positive_user_id', '=', $user->id)->orderBy('id','desc')->get();

            foreach ($user_tips as  $user_tip) {

               $user_tip->body = Markdown::defaultTransform($user_tip->body);
               $user_tip->view = 1;
               $user_tip->save();
            }

          $new_user_tips_count = $user->tips;
          $user->tips = 0;
          $user->save();

           return view('layouts.home.edit_user')->with('avatars_img',$avatars_img)
                                                ->with('user',$user)
                                                ->with('user_tips',$user_tips)
                                                ->with('tips_count',$new_user_tips_count);
        } else {

              $returnInf = [];
              array_push($returnInf,trans('bbs.Illegal Operation!'));
              Session::flash('returnInf',$returnInf);
              Session::flash('operationResult','am-alert-warning');

              return redirect()->back();
        }
   }
    /**
     * [updateAvatars choose avatar from bbs]
     * @return [type] [description]
     */
   public function updateAvatar()
   {

   	$user = User::find(BBS_Request::input('user_id'));
   	$user->image_url = 'image/avatars/img'.BBS_Request::input('focus_image_id').'.png';
   	$user->save();

    $returnInf = [];
    array_push($returnInf,trans('bbs.Operated Successfully!'));
    Session::flash('returnInf',$returnInf);
    Session::flash('operationResult','am-alert-success');

    return redirect()->back();
   }
   /**
    * [uploadAvatar upload custom avatar]
    * @return [type] [description]
    */
   public function uploadAvatar()
   {
    $user_id = BBS_Request::input('user_id');
    $img_url = BBS_Request::input('image_url');

    list($img_inf,$img_content) = explode(';base64,',$img_url);
    $ext =  "";
    switch ($img_inf) {
      case 'data:image/gif':
        $ext = 'gif';
        break;

      case 'data:image/png':
        $ext = 'png';
        break;

      case 'data:image/jpeg':
        $ext = 'jpeg';
        break;

      default: $ext = "error";
        break;
    }

     $returnInf = [];

    if ($ext == "error") {

          array_push($returnInf,trans('bbs.Format Error!'));
          Session::flash('operationResult','am-alert-warning');

    } else {

       if(!is_dir(public_path()."\uploads"))

              mkdir(public_path()."\uploads");

       if(!is_dir(public_path()."\uploads\avatars"))

             mkdir(public_path()."\uploads\avatars");

        $file = fopen(public_path()."\uploads\avatars"."\img".$user_id.".".$ext, "w");

        if (fwrite($file, base64_decode($img_content))) {

             array_push($returnInf,trans('bbs.Operated Successfully!'));
             Session::flash('operationResult','am-alert-success');

             $user =  User::find($user_id);
             $user->image_url  = "uploads/avatars/"."img".$user_id.".".$ext;
             $user->save();
         }
        else{

              array_push($returnInf,trans('bbs.Operation Failure!'));
              Session::flash('operationResult','am-alert-warning');
        }

        fclose($file);

    }
    Session::flash('returnInf',$returnInf);
    return redirect()->back();
   }
	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateProfile()
	{
    $returnInf = [];

    if(User::where('id', '=', BBS_Request::input('id'))->update(array_slice(BBS_Request::all(),2))) {

             array_push($returnInf,trans('bbs.Updated Successfully!'));
             Session::flash('operationResult','am-alert-success');
    }
    else {
             array_push($returnInf,trans('bbs.Updated Failed!'));
             Session::flash('operationResult','am-alert-warning');
    }

    Session::flash('returnInf',$returnInf);
    return redirect()->back();
	}
  /**
   * [updatePassword description]
   * @return [type] [description]
   */
  public function updatePassword()
  {

    $returnInf = [];

    $user = User::find(BBS_Request::input('id'));

   if (Auth::attempt(['id' => $user->id,'password' => BBS_Request::input('old_password')])) {

        $rules = ['new_password'  => ['alpha_dash','between:8,24','confirmed','required']];
        $validator = Validator::make(BBS_Request::all(), $rules);

        if ($validator->fails()) {

          $messages = $validator->messages();
          foreach (array_dot($messages->toArray()) as  $value) {
              array_push($returnInf,$value);
          }
          Session::flash('operationResult','am-alert-warning');

        } else {

         $user->password = Hash::make(BBS_Request::input('new_password'));
         $user->save();

         Session::flash('operationResult','am-alert-success');
          array_push($returnInf,trans('bbs.Updated Successfully!'));
          array_push($returnInf,trans('bbs.Login Again!'));
         Session::flash('returnInf',$returnInf);

         return redirect()->route('login');

        }

   } else {

       array_push($returnInf,trans('bbs.Old Password is Wrong!'));
       Session::flash('operationResult','am-alert-warning');
   }

      Session::flash('returnInf',$returnInf);

      return redirect()->back();
  }

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function logout()
	{
		Auth::logout();
		return redirect()->back();
	}

}
