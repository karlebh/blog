@extends('layouts.app')

@section('content')

<div class="container">
		@forelse($nots as $not)
		<div class="card">

		<div class="card-body">
			<h5>{{ $not->data['message'] ?? "" }} {{ $not->created_at->diffForHumans() }}</h5>
			<br>
			<a class="mt-2" href="{{route('profile.show', $not->data['username'])}}">
				<h4> {{ $not->data['extra'] }} </h4>
			</a>
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