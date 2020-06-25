@extends('layouts.app')

@section('content')



<div class="container">
	@foreach($followedPosts as $post)
		{{$post}}
	@endforeach
 @foreach ($friendss as $friend)
	{{ $friend }}
@endforeach 


</div>

@yield('extra')


@endsection