@extends('layouts.app')

@section('content')




<div class="container">
	 @foreach ($friends as $friend)
	
		<div class="bg-white p-4 mb-4 ">
			<div class="m-auto w-50">
				{{$friend}}
			</div>
		
		</div>

	@endforeach  
</div>

@yield('extra')


@endsection