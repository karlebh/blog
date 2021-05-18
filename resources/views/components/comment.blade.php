<div class="container">
	
	@forelse($comments as $comment)
	<div 
		class="
			card p-0
			@if($comment->replies()->exists()) mb-1 @else mb-5 @endif
			"
	>

		<div class="card-body">
			<div class="card-title">
				By
				<a href="/profile/{{$comment->user->slug}}">
					{{ $comment->user->name }}
				</a>

				 <span></span> {{$comment->created_at->diffForHumans()}}
				 <a href="" style="font-size: 20px;" class="ml-2 text-success">#</a>
			</div>
			<div class="card-text">
				{{$comment->body}}

			{{-- @if($comment->img)
				<img 
					src="/storage/{{$comment->img}} " 
					class="w-25 h-25" 
					style="object-fit: scale-down;"
				>
			@endif --}}
		
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
	@if($comment->replies()->exists())
		<details 
			class="mb-5"
			@if($comment->replies()->count() <= 7)
				open
			@endif

		>
			<summary class="bg-white px-4 py-3 border-light">Replies</summary>
			<x-comment-reply 
				identify="replies" 
				:replies="$comment->replies" 
			/>
		</details>
	@endif


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
