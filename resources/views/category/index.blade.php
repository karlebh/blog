@extends('layouts.app')

@section('content')

<div class="container">
	
	<ul class="m-auto w-75">
		@forelse($categories as $category)
			<li>
				<a href="/category/{{$category->slug}}">{{$category->name}}</a>
			</li>
		@empty 
			<p>No category yet. Create one <a href="/category/create">here</a></p>



		@endforelse


	</ul>


	<div class="m-auto w-25 ml-5">
		{{ $categories->links() }}
	</div>

		<br>
		<br>
		<br>
		<br>


	<p class="text-center">
		<a href="{{route('category.create')}}">Create new unique category!</a>
	</p>

</div>


@endsection