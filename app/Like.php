<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $fillable = [
		'id',
		'user_id',
		'post_id',
	];

	public function posts(Type $var = null)
	{
		# code...
	}

	public function scopeBuildQueryByUserIdAndPostId($query,int $user_id,int $post_id): Builder
	{
		return $query->where('user_id',$user_id)
					 ->where('post_id',$post_id);
	}
}
