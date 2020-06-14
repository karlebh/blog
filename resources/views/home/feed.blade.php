@extends('layouts.app')

@section('content')



<div class="container-fluid">
<div class="row">
	<div  class="col-4" >Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ullam aperiam, tenetur illum optio deleniti eveniet, officiis cumque vero culpa sint tempore dicta necessitatibus quaerat libero dolore labore earum qui perferendis.</div>
	<div class="col-8" >Lorem ipsum dolor sit amet, consectetur adipisicing elit. Facere nihil dicta, officia nemo quae esse, fugiat, commodi ipsam voluptatem optio asperiores sequi debitis blanditiis expedita minima. Sunt illo, in natus?</div>
</div>

<div class="row">
<div class="col-2">
	<div class="card pb-5">
		
	<div class="card-body bg-white">
		<a href="">links</a>
		<a href="">links</a>
		<a href="">links</a>
	</div>

	</div>
</div>
@section('feed')
<div class="col-10">
		@forelse($friends as $friend)
			@forelse($friend->posts as $post)
			<div class="card mb-4">
				<div class="card-body">
					<p>
						<a href="{{ route('posts.show', $post->slug) }}">
							{{$post->title}}

						</a> by <a href="{{ route('profile.show', $post->user->slug) }}">
						{{$post->user->name}}</a> in 
						<a href="{{ route('category.show', $post->category->slug) }}">{{$post->category->name}}</a>
						<span></span>
						<span></span>
						<span></span>
						{{$post->created_at->diffForHumans()}}
					</p>
					<p>{{$post->desc}}</p>
					<p>Viewed {{$post->views_count}} times</p>
				</div>
			</div>
			@empty
			@endforelse	

		@empty

			<p>No friends yet!</p>
		
		@endforelse

	@if(sizeof($friends) == 0)
	<p>No post from friends</p>
	@endif
</div>
@endsection
</div>
</div>

@yield('extra')


@endsection