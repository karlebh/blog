@extends('layouts.app')

@section('content')

<div class="container">
	
	<ul>
		@forelse($categories as $category)
			<li>
				<a href="/category/{{$category->slug}}">{{$category->name}}</a>
			</li>
		@empty 
			<p>No category yet. Create one <a href="/category/create">here</a></p>



		@endforelse


	</ul>

		<br>
		<br>
		<br>
		<br>


	<p>
		<a href="{{route('category.create')}}">Create new unique category!</a>
	</p>

</div>


@endsection