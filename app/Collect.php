<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model {

	protected $table = 'collects';

	protected $fillable = ['user_id','topic_id'];

}
