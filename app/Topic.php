<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model {

	protected  $fillable = ['title','content','user_id','node_id','last_reply_user_id','created_at','updated_at'];

	public $timestamps = false;

	public function favorites()
	{
		return $this->hasMany('App\Favorite');
	}

}
