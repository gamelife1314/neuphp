<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model {

	protected $table = 'favorites';

	protected $fillable = ['user_id','topic_id'];

	public function topic($tid)
	{
		return $this->belongsTo('App\Topic')->where('topics.id','=',$tid);
	}


}
