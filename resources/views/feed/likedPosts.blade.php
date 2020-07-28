
@extends('layouts.app')

@section('content')

	<x-feed :feed="$likedPosts" >
		
		<x-slot name="title">
			Liked Posts
		</x-slot>

		<x-slot name="empty">
			<p>You have not liked any post. Go <a href="/">home</a> to like some posts.</p>
		</x-slot>
	</x-feed>

@endsection

