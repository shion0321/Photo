<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{
	

	public function show($id)
	{
		# TODO : ログインユーザーの場合の処理

		# TODO : ログインユーザーじゃない場合の処理
		$login_user_id = Auth::id();
		$user = User::find( $id );
		return view('users.show',['user' => $user, 'login_user_id' => $login_user_id]);
	}

	public function update(Request $request){
		$params = $request->all();
		
		$user = User::find(Auth::id());
		if (isset($request->profile_image)) {

			if ($request->profile_image->isValid()) {
				#
				$fileName = $request->file('profile_image')->getClientOriginalName();

				$request->file('profile_image')->storeAs('public/profile_images', $fileName);

				$fullFilePath = '/storage/profile_images/' . $fileName;

				$user->profile_image = $fullFilePath;
			}
		}

		$user->fill($params);
		$user->save();

		return redirect()->route('users.show',$user->id);
	}
}