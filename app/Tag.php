<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $fillable=[
    	'name','slug'];

	public function posts()
    {
    	return $this->belongsToMany('App\Post', 'post_tags', 'tag_id', 'post_id');
    }
}
