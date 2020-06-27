@extends('layouts.app')

@section('content')




<div class="container">
	 @foreach ($friends as $friend)
		@foreach ($friend->posts as $feed)
			
		<div class="bg-white p-4 mb-4 ">
			<div class="m-auto w-50">
				{{$feed}}
			</div>
		
		</div>
		@endforeach

	@endforeach  

	{{-- {{ $friends->email }} --}}
</div>

@yield('extra')


@endsection