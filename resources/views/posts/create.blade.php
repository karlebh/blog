@extends('layouts.app')

@section('content')

<div class="container">
  
@if(count($categories) > 0)
<form method="post" action="{!! route('posts.store') !!}" enctype="multipart/form-data" >

  @csrf
    
     <div class="form-group col-md-6">
      <label for="category">Category</label>
      <select 
          name="category_id" 
          class="form-control @error('category_id') is-invalid @enderror" 
          value="{{ old('category_id') }}"
      >
      @foreach($categories as $category)
        <option value="{{$category->id}}">
         {{$category->name}}
        </option>

      @endforeach
      </select>

       @error('category_id')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror

    </div>


    <div class="form-group col-md-6">
      <label for="title">Title</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" name="title" placeholder="Enter a title">

       @error('title')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
    </div>
    
    <div class="form-group col-md-6">
      <label for="desc">Description</label>
     <textarea rows="10" class="form-control @error('desc') is-invalid @enderror" value="{{ old('desc') }}" name="desc" placeholder="Enter a Description"></textarea>

      @error('desc')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
    </div>

    <div class="form-group col-md-6 mb-3">
     <label for="desc">image (Optional)</label>

     <input 
          type="file" 
          name="img" 
          class="form-control @error('img') is-invalid @enderror" 
          value="{{ old('img') }}" 
          accept="image/*"
     >

      @error('img')
         <span 
               class="invalid-feedback" 
               role="alert"
          >
             <strong>{{ $message }}</strong>
         </span>
     @enderror
    </div>

    <div class="form-group col-md-6">
     <input type="submit" class="btn btn-success" value="Submit Post">
    </div>
</form>
@else 

<div>
  <a href="{{ route('category.create') }}">Click Here to create a category</a>
</div>

@endif
</div>

<!-- <create-post /> -->

@endsection