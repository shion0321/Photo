<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{	
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		if (Auth::id()) {

			$posts = Post::latest()->simplePaginate(5);
			# 1 + N 問題
			# ここ意味わからないから調べる
			$posts->load('user','comments.user','likes');
		} else {

			$posts = Post::latest()->simplePaginate(5);
		}

		return view('posts.index', compact('posts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('posts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{
		$posts = new Post;
		$posts->fill($request->all());
		$posts->user_id = Auth::id();

		# 画像アップロード
		if (isset($request->photo_image)) {

			$fullFilePath = $this->_edit_post_image($request);
			$posts->photo_image = $fullFilePath;
		}

		$tags_id = $this->_add_tag($request);

		$posts->save();
		$posts->tags()->attach($tags_id);
		
		return redirect()->route('posts.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$post = Post::find($id);

		return view('posts.show', compact('post'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id)
	{
		$posts = Post::find($id);

		return view('posts.edit', compact('posts'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		$post = Post::find($id);
		$post->description = $request->description;
		$post->save();

		return redirect()->route('posts.index');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id)
	{
		$post = Post::find($id);
		$post->delete();
		return redirect()->route('posts.index');
	}

	public function search(Request $request)
	{	
		$posts = Post::where('description','like',"%{$request->description}%")->simplePaginate(5);

		return view('posts.index', compact('posts'));
	}

	/*
	 処理まとめ
	*/

	private function _edit_post_image( $request )
	{
		$fileName = $request->file('photo_image')->getClientOriginalName();
		# storage以下のディレクトリ
		$request->file('photo_image')->storeAs('public/post_images', $fileName);
		# public以下のディレクトリ 
		$fullFilePath = '/storage/post_images/' . $fileName;

		return $fullFilePath;
	}

	private function _add_tag($request)
	{
		preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tags, $match);
		$tags = [];
		// $matchの中でも#が付いていない方を使用する(配列番号で言うと1)
		foreach ($match[1] as $tag) {

			// dd($tag);
			// firstOrCreateで重複を防ぎながらタグを作成している。
			$record = Tag::firstOrCreate(['name' => $tag]);
			array_push($tags, $record);
		}

		$tags_id = [];
		foreach ($tags as $tag) {
			array_push($tags_id, $tag->id);
		}

		return $tags_id;
	}		
}
