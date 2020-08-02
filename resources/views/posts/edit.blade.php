@extends('layouts.app')

@section('content')
<div class="container">
  
  <form method="post" action="{{ route('posts.update', $post->slug) }}" enctype="multipart/form-data" >

  @csrf
  @method('PUT')
    
     <div class="form-group col-md-6">
      <input type="hidden" name="category_id" value="{{$post->category_id}}">
    </div>


    <div class="form-group col-md-6">
      <label for="title">Title</label>
      <input
       type="text" class="form-control @error('title') is-invalid @enderror" 
       name="title" value="{{ $post->title }}" placeholder="Enter a title">

       @error('title')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
    </div>
    
    <div class="form-group col-md-6">
      <label for="desc">Description</label>
     <textarea 
      rows="10" class="form-control @error('desc') is-invalid @enderror" 
      name="desc" placeholder="Enter a Description">
        {{ $post->desc }}
      </textarea>

      @error('desc')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
    </div>

    <div class="form-group col-md-6">
      <label for="desc">image</label>
     <input type="file" name="img" class="form-control @error('img') is-invalid @enderror" 
     value="{{ $post->img }}" accept="image/*">

      @error('img')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror
    </div>

    <div class="form-group col-md-6">
     <input type="submit" class="btn btn-success" value="Update Post">
    </div>




</form>
</div>

@endsection