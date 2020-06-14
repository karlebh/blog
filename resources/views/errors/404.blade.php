@extends('layouts.app')

@section('content')

<div class="container">
	<h5>
		Page {{-- {{Request::url()}} --}} you requested does not exists.

		Go to <a href="/">Homepage</a>?
	</h5>
</div>

@endsection