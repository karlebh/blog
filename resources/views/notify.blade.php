@extends('layouts.app')

@section('content')

<div class="container">
		@forelse($nots as $not)
		<div class="card mb-">

		<div class="card-body">
			<h5>{{ $not->data['name'] ?? "" }} {{ $not->created_at->diffForHumans() }}</h5>
			<br>
			<a class="mt-2" href="{{route('profile.show', $not->data['name'])}}">
				<h4> {{ $not->data['name'] }} </h4>
			</a>

			<p>commented on your post 
				<a href="{{ route('posts.show', $not->data['postSlug']) }}">
					<h1>{{ $not->data['postTitle'] }}</h1>
				</a>
			</p>
			<br>
	  </div>
		</div>
		@empty
		<div class="card">
			<div class="card-body">No new notification</div>
		</div>
		
		@endforelse
	</div>
</div>

@endsection