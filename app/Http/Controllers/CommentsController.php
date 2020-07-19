<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
	public function store(Request $request)
	{	
		$comment = $request->all();

		$model = new Comment();

		$model->fill($comment);
		$model->user_id = Auth::id();
		$model->save();

		return redirect()->route('posts.index');
	}
}
