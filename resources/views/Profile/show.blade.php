@extends('layouts.app')
@section('content')

<div class="container">

	<div class="jumbotron">

	<div>
		<p>
			Account Information
		</p>

		<ul>
			<li>
				{{$user->name}}
			</li>

			<li>
				{{ $user->username }} <i>(Username)</i>
			</li>
			<li>
				@if ($user->gender == 0)
					Female
				@endif
				Male
			</li>
			<li>
				{{$data->location}} <i>(Location) </i>
			</li>

			<li>
				{{$data->about}} <i>(About) </i>
			</li>
		</ul>
		<span>

		</span>
	</div>
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
			         value="{{$data->picture}}" 
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
						value="{{$data->location}}" 
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
						value="{{$data->about}}" 
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

				<div class="form-group">

					<label for="DOB">Date of Birth (Optional)</label>
					<input 
						type="date"
						class="form-control @error('DOB') is-invalid @enderror"
						value="{{$data->DOB}}" 
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