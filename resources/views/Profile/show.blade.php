@extends('layouts.app')
@section('content')

<div class="container">

	<div class="jumbotron">

	This is {{ $user->username }}'s profile!

	</div>
	@if(Auth::user() != $user && Auth::user())
	<p><friending :userId=" {{ $user->id}} "></friending></p>
	
	@endif
	<p><notify :id=" {{ $user->id }} "></notify></p>

</div>
	


@endsection