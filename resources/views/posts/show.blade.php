<h1>詳細表示</h1>
<a href="{{ route('posts.index') }}">一覧に戻る</a>
	<p>{{ $posts["id"] }}</p> 
	<p>{{ $posts["description"] }}</p> 
	<a href="{{ route('posts.edit',['post'=> $posts["id"]]) }}">編集</a>
	<form action="{{ route('posts.destroy',['post'=> $posts["id"]]) }}" method="POST">
		@method('DELETE')
		@csrf
		<button>削除</button>
	</form>