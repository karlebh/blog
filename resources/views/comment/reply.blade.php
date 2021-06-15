@extends('layouts.app')

@section('content')

		<div class="container">
			<div class="card my-3">
				<div class="card-body">
				<div class="card-title">
					By <a href="/profile/{{$comment->user->username}}">{{ $comment->user->username }} </a>

					 <span></span> {{$comment->created_at->diffForHumans()}}

					 on <a href="{{ route('posts.show', $comment->commentable->slug) }}">{{$comment->commentable->title}}</a>
				</div>
				<div class="card-body text-secondary">
					<p>{{$comment->body}}</p>
					</div>
					<br>
				</div>
			</div>


			<form class="form" method="post" action="{{route('reply.store')}}" >
				@csrf
				{{-- textarea --}}
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
				
				{{-- image --}}
{{-- 			    <div class="form-group col-md-6 my-4 py-3">
			    <input 
				    type="file" 
				    name="img" 
				    class="form-control @error('img') is-invalid @enderror" 
				    value="{{ old('img') }}" 
				    accept="image/*"
			    >

		     @error('img')
	            <span class="invalid-feedback" role="alert">
	              <strong>{{ $message }}</strong>
	            </span>
		     @enderror
   			</div> --}}


				</div>

				<input type="hidden" name="parent_id" value="{{ $comment->id }}" >
				<input type="hidden" name="commentable_id" value="{{ $comment->commentable->id }}" >

				<div class="form-group ">
					<input type="submit" name="comment" value="Add Reply" class="btn btn-success">
				</div>
			
			</form>
		</div>



@endsection