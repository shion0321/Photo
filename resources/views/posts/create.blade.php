@extends('layouts.app')
@section('content')
	<h1>新規登録</h1>
	<a href="{{ route('posts.index') }}">一覧に戻る</a>
	<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
		@csrf
		<div>
			<label for="desctiption">内容</label>
			<input type="text" name="description" id="description">
		</div>
		<div>
			<label for="photo_image">写真</label>
			<input type="file" name="photo_image"> 
		</div>
		<div class="form-group">
			<label for="tags">タグ</label>
			<input type="text" name="tags" id="" class="form-control">
		</div>
		<button>送信</button>
	</form>
@endsection