<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model {

	protected $table = 'replies';

	protected $fillable = ['user_id','topic_id','body','is_block','tip_user'];

}
