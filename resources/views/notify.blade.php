@extends('layouts.app')

@section('content')

<div class="container">
		@forelse($nots as $not)
		<div class="card mb-">

		<div class="card-body">
			<article>
				<a style="font-size: 1rem;" href="{{route('profile.show', $not->data['commenterUsername'])}}">
					{{ $not->data['commenterUsername'] }}
				</a>

				<span>
					commented on your post, 
					<a style="font-size: 1rem;" href="{{ route('posts.show', $not->data['postSlug']) }}">
						{{ $not->data['postTitle'] }}
					</a>
				</span>
				
			</article>

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