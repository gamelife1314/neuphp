<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model {

	protected $table = "votes";

	protected $fillable = ['topic_id','user_id','vote_up','vote_down'];

}
