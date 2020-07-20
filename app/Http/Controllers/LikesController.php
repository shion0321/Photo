<?php

namespace App\Http\Controllers;

use App\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikesController extends Controller
{
	
	public function store(Request $request)
	{
		$params = $request->all();
		$like = new Like();

		$like->fill($params);
		$like->user_id = Auth::id();
		$like->save();

		return redirect()->back();
	}

	public function destroy($id)
	{	
		$like = Like::where('user_id',Auth::id())
					->where('post_id',$id)
					->first();

		$like->delete();

		return redirect()->back();
	}
}
