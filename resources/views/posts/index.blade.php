投稿一覧
<p>
	<a href="{{ route('posts.create') }}">新規登録</a>
</p> 

@isset($posts)

@foreach ($posts as $post)
	<p>{{ $post->id }}</p>
	<p>{{ $post->description }}</p>
	<a href="{{ route('posts.show',['post'=>$post->id]) }}">詳細</a>
@endforeach

@endisset
