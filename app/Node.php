<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model {

	protected $table = 'nodes';

	protected $fillable = ['name','slug','description','parent_node'];

}
