<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;
use App\Comment;
use App\Tag;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
	protected $fillable = [
		'description'
	];

	protected $appends = [
		'is_like',
		'like_id',
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
	public function comments()
	{
		return $this->hasMany(Comment::class);
	}

	public function likes()
	{
		return $this->hasMany(Like::class);
	}

	public function getLikeIdAttribute(){

		return Like::buildQueryByUserIdAndPostId(Auth::id(),$this->id);
	}

	public function getIsLikeAttribute()
	{
		return Like::buildQueryByUserIdAndPostId(Auth::id(), $this->id)->exists();
	}

	public function tags()
	{
		return $this->belongsToMany(Tag::class,'post_tags');
	}
}
