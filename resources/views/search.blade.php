@extends('layouts.app')

@section('content')

<div class="container">
	<p>
		@if($results->count() > 0) <strong>{{ $results->total() }}</strong> @else No @endif
		
		Search Results for <strong>{{request()->input('q')}}</strong></p>

	<br />


	@forelse($results as $result)
	
	<div class="card mb-1">
		<div class="card-body">
			<div class="card-title">
			<a href="{{ route('posts.show', $result->slug) }}"> 
				{{$result->title}}
			</a>   <span> by </span>
			<a href="{{ route('profile.show', $result->user->slug ) }}"> 
				{{$result->user->name}}
			</a>

			<span>{{ $result->created_at->diffForHumans()}}</span>
		</div>	
		<hr>
		<div class="card-text">
			{{ Str::limit($result->desc, 200)}}
		</div>	

	</div>
	</div>
	@empty
	<div class="card">
		<div class="card-body">No result was found!</div>
	</div>
	
	@endforelse

		{{-- {{ $results->appends(request()->query())->links()}} --}}
		{{ $results->appends(Request::toArray())->links()}}




	</div>


@endsection