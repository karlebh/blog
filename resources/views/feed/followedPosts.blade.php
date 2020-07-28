@extends('layouts.app')

@section('content')

	<x-feed :feed="$followedPosts" >
		<x-slot name="title">
			Followed Posts
		</x-slot>

		<x-slot name="empty">
			<p>You are not following any post. Go <a href="/">home</a> to follow posts.</p>
		</x-slot>
	</x-feed>
@endsection