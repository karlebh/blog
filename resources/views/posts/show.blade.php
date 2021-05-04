@extends('layouts.app')

@section('content')



<div class="container">
	<div class="jumbotron">
		
	<div>
		<h2>
			{{ $post->title }}
			<a href="{{ $post->path }}" style="font-size: 25px;" class="ml-2 text-success">#</a> 
		</h2>
	 	
	</div>
	<div>
		<small>Posted  
		 <strong>
		 	by 
			 <a 
			 	href="{{ route('profile.show', $post->user->username) }}" 
			 >
			 	{{ $post->user->username }}
			</a>
		 </strong>

		<span> {{ $post->created_at->diffForHumans() }}</span> 

		<strong>
			<span>in</span>
			<a href="{{ route('category.show', $post->category->slug) }}">{{ $post->category->name }}</a>
		</strong>
		

		</small>
	<span class="float-right">
		<follow-post postid="{{$post->id}}" follows="{{$follows}}" ></follow-post></span>
	</div>
	
	<br>
	<div>{{ $post->desc }}</div>
	
	<br />
	<br />
	<br />
	
	@if($post->img)
	
	<img src="/storage/{{$post->img}} " class="w-25 h-25 mb-3" style="object-fit: scale-down;">
	
	@endif
	
	<br />
	
	@can('view', $post)

	<like

		 :id = "{{ $post->id }}"
		 :liked = "{{ $isLiked ? 'true' : 'false' }}"
		 :count = "{{ $post->likes()->count() }}"
	 >
	 	
	 </like>

	@endcan	

	@can('edit', $post)

	<post-noty :id="{{$post->user_id}}"></post-noty>
	<div class="well">

		<a href="{{route('posts.edit', $post->slug)}}">Edit Post</a>
		<span></span>
		<span></span>
		<form class="d-inline"	action="{{route('posts.destroy', $post->slug )}}" method="POST">
			@csrf
			@method('DELETE')
			<button type="submit"  class="btn btn-link">
				Delete
			</button>

	@endcan
	
		</form>

		<br><br>
		
		<span style="color: #41B883;" class="mr-3">{{$post->views_count}} views</span> 

		<span style="color: #41B883;">{{$post->comments_count}} comments</span>

	</div>
</div>

	<details open class="container mb-3" >
		<summary
			class="bg-white px-4 py-3 mb-4 border-light" 
		>Toggle comment box</summary>

	<div>
		<span class="mb-3"></span>
		
		<form 
			class="form" 
			method="post" 
			enctype="multipart/form-data" 
			action="{{route('comments.store')}}"
		>
			@csrf

			<div class="form-group">
				<textarea 
					class="form-control @error('body') is-invalid @enderror"
					name="body" 
					row="10" 
					cols="10"
				></textarea>

				@error('body')
		          <span class="invalid-feedback" role="alert">
		             <strong>{{ $message }}</strong>
		          </span>
			    @enderror
			</div>

			<input type="hidden" name="commentable_id" value="{{$post->id}}">
			<input type="hidden" name="parent_id" value="{{$comment->id ?? ''}}">

			{{-- <div class="form-group col-md-6 my-4 py-3">
			    <input 
				    type="file" 
				    name="img" 
				    class="form-control @error('img') is-invalid @enderror" 
				    accept="image/*"
			    >

		     @error('img')
	            <span class="invalid-feedback" role="alert">
	              <strong>{{ $message }}</strong>
	            </span>
		     @enderror
   			</div> --}}

			<div class="form-group ">
				<input type="submit" name="comment" value="Add Comment" class="btn btn-success">
			</div>
		</form>
	</div>
	</details>
	

	<x-comment :comments="$comments"></x-comment>




</div>

@endsection

@section('js')	
	<script>
		

	</script>

@endsection