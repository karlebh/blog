@extends('layouts.app')

@section('content')

		<div class="container">
			<form class="form" method="post" action="{{route('reply.store')}}" >
				@csrf
			<div class="card my-3">
				<div class="card-body">
				<div class="card-title">
					By <a href="/profile/{{$comment->user->slug}}">{{ $comment->user->name }} </a>

					 <span></span> {{$comment->created_at->diffForHumans()}}

					 on <a href="{{ route('posts.show', $comment->commentable->slug) }}">{{$comment->commentable->title}}</a>
				</div>
				<div class="card-text">


					<p>{{$comment->body}}</p>
					</div>
					<br>
				</div>
			</div>
				<div class="form-group">
					<textarea class="form-control" name="body" row="10" cols="10">
					</textarea>
				</div>

				<input type="hidden" name="parent_id" value="{{ $comment->id }}" >
				<input type="hidden" name="commentable_id" value="{{ $comment->commentable->id }}" >

				<div class="form-group ">
					<input type="submit" name="comment" value="Add Reply" class="btn btn-success">
				</div>
			</form>
		</div>



@endsection