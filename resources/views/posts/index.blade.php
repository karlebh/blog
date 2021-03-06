@extends('layouts.app')


@section('content')
<div class="container px-4">
	@forelse($posts as $post)
		<div class="row"><a href="{{ route('posts.show', $post->slug) }}" >{{ $post->title }}</a></div>

		@empty 
			<p>No post yet.</p>
	@endforelse

	{{$posts->links()}}

		@can('create', $posts)

		<br>
		<br>
		<br>
		
		<p><a href="{{ route('posts.create') }}">Create new post!</a></p>
		@endcan
</div>

@endsection