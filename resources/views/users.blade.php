@extends('layouts.app')

@section('content')

	<div style="min-width: 60rem;">
		<form  
			style="margin-left: 6.5rem;" 
			class="form p-3 w-25" 
			method="get" 
			action="{{ route('searchUser') }}"
		>                         
		    <div class="input-group">
		      <input 
			      type="text" 
			      name="" 
			      class="form-control" 
			      placeholder="Search User"
		      >
		      <div class="input-group-append">
		        <input 
			        class="btn btn-success" 
			        type="submit" 
			        value="Go"
		        >
		      </div>
		    </div>
	    </form>
	</div>
<div class="container">
	
		

	@foreach($users as $user)
		
		<div>
			<div class="bg-white p-4 mb-4 ">
				<div class="m-auto w-50">
					
				<a	href="{{ route('profile.show', $user->slug) }}">
					<strong>
						
					{{$user->username}}
					</strong>
				</a> 
				<span>
					<small>
						registered
					</small>
					<strong>
						{{$user->created_at->diffForHumans()}}
					</strong>
				</span>

				@if(auth()->user()->id != $user->id)
					<friending class="pt-4" :userId=" {{ $user->id}} "></friending>
				@endif

					</div>
			</div>
		</div>
	@endforeach

	<div class="m-auto w-25">
		
	{{ $users->links()}}
	</div>

</div>

@endsection