<h1>編集</h1>
{{-- {{ dd($posts['description']) }} --}}
<a href="{{ route('posts.index') }}">一覧に戻る</a>
<form action="{{ route('posts.update',['post'=> $posts["id"]]) }}" method="POST">
	{{-- <input type="hidden" name="_method" id="" value="PUT"> --}}
	@method('PUT')
	@csrf
	<!-- フォームの説明 -->
	<label for="desctiption">内容</label>
	<input type="text" name="description" id="description" value="">
	<button>送信</button>
</form>