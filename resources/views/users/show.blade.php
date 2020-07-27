@extends('layouts.app')

@section('content')
{{-- {{ dd($user["profile_image"]) }} --}}
ユーザー詳細ページ
{{-- {{ dd($user) }} --}}
<!-- ログインユーザー -->
@if($user['id'] == $login_user_id)
<form action="{{ route('users.update',$login_user_id) }}" method="POST" enctype="multipart/form-data">
	@method('PUT')
	@csrf
	<div>
		<div>
			<!-- name -->
			<input type="text" name="" id="" value="{{ $user->name }}">
		</div>
		<div>
			<!-- email -->
			<input type="text" name="email" value="{{ $user->email }}">
		</div>
		<div class="profile_image">
			<img src="{{ $user["profile_image"] }}" class="">
		</div>
		<div>
			<!-- profile_image -->
			<input type="file" name="profile_image" id="">
		</div>
		<div>
			<button>編集する</button>
		</div>
	</div>
</form>
@else
<!-- ログインユーザーではない場合 -->

<div>
	<div>
		<p>名前</p>
		<p>{{ $user->name }}</p>
	</div>

	<div>
		<p>メールアドレス</p>
		<p>{{ $user->email }}</p>
	</div>

	<div class="profile_image">
		<img src="{{ $user["profile_image"] }}">
	</div>
</div>

@endif

@endsection

