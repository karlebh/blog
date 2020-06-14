<div id="{{$identify}}">
    @foreach ($replies as $comment)

	<div class="card my-4 ml-5" style="background: #f5fffa">

		<div class="card-body">
			<div class="card-title">
				By <a href="/profile/{{$comment->user->slug}}">{{ $comment->user->name }} </a>

				 <span></span> {{$comment->created_at->diffForHumans()}}
			</div>
			<div class="card-text">
				{{$comment->body}}
				
				 <p> </p>

		<div class="row pl-4">
		 	@can('edit', $comment)

		 	<a class="pr-3" href="{{route('comments.edit', $comment->id)}}">edit</a>
		 	<a  href="{{route('comments.destroy', $comment->id)}}">delete</a>
			<sapn style="margin-left: 9px">
				
			<like-comment  :id="{{ $comment->id}}" ></like-comment>
			</sapn>
		 	@endcan

		 </div> 
		
			</div>
		</div>
	</div>

	@endforeach
</div>