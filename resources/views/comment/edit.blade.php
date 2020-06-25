@extends('layouts.app')

@section('content')

		<div class="container">
			<form class="form" method="post" action="{{route('comments.update', $comment->id)}}" >
				@csrf
				@method('PATCH')
				<div class="form-group">
					<textarea class="form-control" name="body" row="10" cols="10">
						{{$comment->body}}
					</textarea>

					 @error('body')
			          <span class="invalid-feedback" role="alert">
			              <strong>{{ $message }}</strong>
			          </span>
				      @enderror
				</div>

				<div class="form-group ">
					<input type="submit" name="comment" value="Update Comment" class="btn btn-success">
				</div>
			</form>
		</div>



@endsection