<h1>新規登録</h1>
<a href="{{ route('posts.index') }}">一覧に戻る</a>
<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
	@csrf
	<!-- フォームの説明 -->
	<label for="desctiption">内容</label>
	<input type="text" name="description" id="description">
	<label for="photo_image">写真</label>
	<input type="file" name="photo_image"> 
	<button>送信</button>
</form>