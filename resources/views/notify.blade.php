@extends('layouts.app')

@section('content')

<div class="container">
		@forelse($nots as $not)
		<div class="card">

		<div class="card-body">{{ $not->data['message'] ?? "" }} {{ $not->created_at->diffForHumans() }}

			<p>
				Check <a 
					href="{{route('profile.show', $not->data['slug'])}}"
					>
					{{ $not->data['name']}}<span>'s</span>
					</a>
				profile.
			</p>
			<br>
		@if(isset($not->data['id']))
		<friending 
			:userid=" {{$not->data['id']}} "
		></friending>
		@endif

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