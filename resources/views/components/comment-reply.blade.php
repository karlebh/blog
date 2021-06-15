<div id="{{$identify}}">
    @foreach ($replies as $comment)

	<div class="card my-4 ml-5" style="background: #f5fffa">

		<div class="card-body">
			<div class="card-title">
				By <a href="/profile/{{$comment->user->username}}">{{ $comment->user->username }} </a>

				 <span></span> {{$comment->created_at->diffForHumans()}}
				 <a href="" style="font-size: 20px;" class="ml-2 text-success">#</a>
			</div>
			<div class="card-text">
				{{$comment->body}}
				
				 <p> </p>

		 <div class="row pl-4">

	 	@can('view', $comment)

		<a 
			class="pl-3 pr-3 "
			href="{{ route('reply.comment', $comment->id) }}"
		>reply</a>

		@endcan

		@can('edit', $comment)

	 	<a 
		 	class="pr-3" 
		 	href="{{route('comments.edit', $comment->id)}}"

	 	>edit</a>

	 	<form 
		 	class="d-inline mt-n2" 
		 	action="{{route('comments.destroy', $comment->id)}}" 
		 	method="POST"
	 	>
			@csrf
			@method('DELETE')

		<button 
			type="submit"  
			class="btn btn-link"
		>delete</button>

		</form>
		<span style="margin-left: 9px">
			
		</span>
		
	 	@endcan

</div> 
	
		
			</div>
		</div>
	</div>

	@endforeach
</div>
