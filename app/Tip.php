<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model {

	protected $table = 'user_tips';

	protected $fillable = ['body','topic_id','active_user_id','positive_user_id'];

}
