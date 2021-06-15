@extends('layouts.app')

@section('content')
<div class="container">

	<form method="post" action="{{ route('category.store') }}" class="mx-auto">

		@csrf

		<div class="form-group col-md-6">
			<label for="name">Name</label>
			<input type="text" 
			class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" placeholder="Enter a Catgeory">
			@error('name')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>


		<div class="form-group col-md-6">
			<label for="desc">Description</label>
			<textarea 
			class="form-control @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc') }}" placeholder="Enter a short description"></textarea>
			@error('desc')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>


		<div class="form-group col-md-6">
			<label for="color">Color in any format</label>
			<input 
			type="color" 
			class="form-control @error('color') is-invalid @enderror" 
			value="{{ old('color') }}" 
			name="color" 
			placeholder="Enter a unique color"
			>
			@error('color')
			<span class="invalid-feedback" role="alert">
				<strong>{{ $message }}</strong>
			</span>
			@enderror
		</div>


		<div class="form-group col-md-6">
			<input type="submit" class="btn btn-success" value="Submit Post">
		</div>




	</form>

</div>
@endsection