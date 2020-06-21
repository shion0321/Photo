<h1>新規登録</h1>
<a href="{{ route('posts.index') }}">一覧に戻る</a>
<form action="{{ route('posts.store') }}" method="POST">
	@csrf
	<!-- フォームの説明 -->
	<label for="desctiption">内容</label>
	<input type="text" name="description" id="description">
	<button>送信</button>
</form>