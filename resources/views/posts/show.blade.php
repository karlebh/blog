@extends('layouts.app')

@section('content')



<div class="container">
		<div class="jumbotron">
			
		<div><h2>{{ $post->title }}</h2></div>
		<div><small>Posted by  
		 <strong><a href="{{ route('profile.show', $post->user->slug) }}" >{{ $post->user->name }}</a></strong>
		<span>   {{$post->created_at->diffForHumans()}}</span>

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
		<img src="/storage/{{$post->img}} ">
		@endif


		@can('edit', $post)
		<like

		 :id = "{{ $post->id }}"
		 :liked = "{{ $isLiked ? 'true' : 'false' }}"
		 :count = "{{ $post->likes()->count() }}"></like>
		@endcan


		@can('edit', $post)
		<post-noty :id="{{$post->user_id}}"></post-noty>
		<div class="well">

			<a class="btn btn-primary" href="{{route('posts.edit', $post->slug)}}">Edit Post</a>
			<span></span>
			<span></span>
			<span></span>
			<a class="btn btn-danger" href="{{route('posts.destroy', $post->slug)}}">Delete Post</a>
		</div>
		@endcan	
	</div>


		<div class="container" >
			<span></span>
			<span></span>
			<span></span>
			<form class="form" method="post" action="{{route('comments.store')}}" >
				@csrf
				<div class="form-group">
					<textarea class="form-control area" name="body" row="10" cols="10"></textarea>
				</div>
				<input type="hidden" name="commentable_id" value="{{$post->id}}">
				<input type="hidden" name="parent_id" value="{{$comment->id ?? ''}}">

				<div class="form-group ">
					<input type="submit" name="comment" value="Add Comment" class="btn btn-success">
				</div>
			</form>
		</div>


		@forelse($comments as $comment)
		<div class="card my-4">

			<div class="card-body">
				<div class="card-title">
					By <a href="/profile/{{$comment->user->slug}}">{{ $comment->user->name }} </a>

					 <span></span> {{$comment->created_at->diffForHumans()}}
					 <a href="" class="ml-2 text-lg-center">link</a>
				</div>
				<div class="card-text">
					{{$comment->body}}
					
					 <p> </p>

			<div class="row pl-4">
			 	@can('edit', $comment)
				<a class="pr-3 " href="{{ route('reply.comment', $comment->id) }}">reply</a>

			 	<a class="pr-3" href="{{route('comments.edit', $comment->id)}}">edit</a>
			 	<a  href="{{route('comments.destroy', $comment->id)}}">delete</a>
				<span style="margin-left: 9px">
					
				<like-comment  :id="{{ $comment->id }}" ></like-comment>
				</span>
				<br>
				<br>
				<br>
				<br>
				
			 	@endcan

			 </div> 
			
				</div>
			</div>
		</div>
			<x-comment-reply identify="replies" :replies="$comment->replies" />

		@empty
		<div class="card">
			<div class="card-body ">
				<strong>Be the first to comment on this post!</strong>
			</div>
		</div>
		@endforelse
			
		<div style="margin: auto;width: 50%;">
			{{$comments->links()}}
		</div>
	
	




</div>

@endsection

@section('js')	
	<script>
		

	</script>

@endsection