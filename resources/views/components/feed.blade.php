<div class="container">

	<h4 class="text-center text-success">Posts I am following!</h4>
    
    

	@forelse($feed as $post)
	  	<div class="p-3 bg-white mb-3">

			<a href="/posts/{{$post->slug}}">
				{{$post->title}}
			</a> <br />
			<small>
				Posted  
				 	<strong>
				 	by 
					<a href="{{ route('profile.show', $post->user->slug) }}">
					 	{{ $post->user->name }}
					</a>
				 	</strong>

					<span> {{ $post->created_at->diffForHumans() }}</span> 

					<strong>
						<span>in</span>
						<a href="{{ route('category.show', $post->category->slug) }}" >
							{{ $post->category->name }}
						</a>
					</strong>
			</small>
		

			<p>
				{{Str::limit($post->desc, 300)}}
			</p>
		<p style="color: #41B883;">
			{{-- Views Counter --}}
			@if($post->views_count > 0)
			<span class="ml-2"><small><b>
				{{$post->views_count}} views
			</small></b></span> @endif
			
			{{-- Comments Counter --}}
			@if($post->comments->count() > 0)
			<span class="ml-2"><small><b>
				{{$post->comments_count}} comments
			</small></b></span> @endif
			
			<!-- Likes Counter -->

			@if($post->likes()->count() > 0)
			<span class="ml-2"><small><b>
				{{$post->likes()->count()}} likes
			</small></b></span> @endif
		</p>
	  	</div>

	
  	@empty
  		<div class="p-3 bg-white">
			<p>
				You are not following any post yet!

				<a href="/">follow a post here</a>
			</p>
	  	</div>
	@endforelse

	<div class="m-auto w-25">
		{{$feed->links()}}
	</div>

</div>