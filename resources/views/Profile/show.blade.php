@extends('layouts.app')
@section('content')

<div class="container">

	<div class="jumbotron">

	<div>
		<p>
			<b>
			Account Information
			</b>
		</p>

		<div>
			<div>
				<span>
					<i class="fa fa-info mr-1" aria-hidden="true"></i>
					<span>{{$user->name}} </span>	
				</span>
				
				<span class="ml-2">
					<i class="fa fa-user mr-1" aria-hidden="true"></i>
					<span> {{ $user->username }} </span>
				</span>
			</div>

			<div>
				<span>
					@if ($user->profile && $user->gender == 0)
					<i class="fa fa-female mr-1" aria-hidden="true"></i>
					<span>Female</span>
					@endif
					<i class="fa fa-male mr-1" aria-hidden="true"></i>
					<span>Male</span>
				</span>
				
				@if($data->location)
					<span style="margin-left: 1.75rem">
						<i class="fa fa-map-marker ml-2" aria-hidden="true"></i>
						<span> {{$data->location ?? ""}} </span>
					</span>
				@endif
			</div>
			
			<div>
				<span>
					@if($data->about)
						<i class="fa fa-check" aria-hidden="true"></i>
						<span> {{$data->about ?? ""}} </span>
					@endif
				</span>
			</div>
			
		</div>
		<span>

		</span>
	</div>

	<div class="py-5 ">
		@if ($data->picture)	
			<img 
				src="/storage/{{$user->profile->picture}}" 
				alt="Profile Picture" 
				width="200" 
				height="200"
				style="
					object-fit: contain;
					margin-left: 30px;
					" 
			/>
		@endif
	</div>


		


	@if(auth()->user() && auth()->user()->id !== $user->id)
	<p><friending :userId=" {{ $user->id}} "></friending></p>
	
	@endif
	<p><notify :id=" {{ $user->id }} "></notify></p>
	
	<div>



	@if(auth()->user() && auth()->user()->id === $user->id)
	<details class="w-75 border-0" style="outline: none; border-color: inherit;">

		<summary>
			Update profile
		</summary>
		<br>
			<form 
				action="{{ route('profile.update') }}" 
				method="post" 
				enctype="multipart/form-data" 
			>
			@csrf
				<div class="form-group">

					<label for="Picture">Picture (Optional)</label>
						
					<input 
			         type="file" 
			         name="picture" 
			         class="form-control @error('picture') is-invalid @enderror" 
			         value="{{$data->picture ?? ''}}" 
			         accept="image/*"
 					>
 					@error('picture')
	              <span 
	              		class="invalid-feedback" 
	              		role="alert"
	              	>
	                  <strong>{{ $message }}</strong>
	              </span>
	       		@enderror
					
				</div>

				<div class="form-group">

					<label for="location">Location (Optional)</label>
					<input 
						type="text"
						class="form-control @error('location') is-invalid @enderror"
						value="{{$data->location ?? ''}}" 
						name="location" 
						placeholder="Location?" 
					/>
					@error('location')
	             	<span 
	              		class="invalid-feedback" 
	              		role="alert"
	              	>
	                  <strong>{{ $message }}</strong>
	              </span>
	       		@enderror

				</div>

				<div class="form-group">

					<label for="about">about (Optional)</label>
					<input 
						type="text"
						class="form-control @error('about') is-invalid @enderror"
						value="{{$data->about ?? ''}}" 
						name="about" 
						placeholder="Write about yourself" 
					/>

					@error('about')
	              <span 
	              		class="invalid-feedback" 
	              		role="alert"
	              	>
	                  <strong>{{ $message }}</strong>
	              </span>
	       		@enderror
					
				</div>	
						{{$data->DOB}}

				<div class="form-group">

					<label for="DOB">Date of Birth (Optional)</label>
					<input 
						type="date"
						class="form-control @error('DOB') is-invalid @enderror"
						value="{{$data->DOB ?? ''}}" 
						name="DOB" 
						placeholder="Write about yourself" 
					/>
					@error('DOB')
	              <span 
	              		class="invalid-feedback" 
	              		role="alert"
	              	>
	                  <strong>{{ $message }}</strong>
	              </span>
	       		@enderror
					
				</div>

				<input 
					type="submit"
					value="Update Profile"
					class="btn btn-success" 
				>


			</form>
	</details>
	@endif

	</div>

</div>

		
	
	@section('js')

	@endsection



@endsection