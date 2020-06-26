@extends('layouts.app')

@section('content')
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

				<friending class="pt-4" :userId=" {{ $user->id}} "></friending>
				</div>
	
			</div>
		</div>

	@endforeach
	<div class="m-auto w-25">
		
	{{ $users->links()}}
	</div>

</div>

@endsection