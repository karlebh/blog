@extends('layouts.app')

@section('content')

<div class="container" >
	<div class="px-5 py-3" style="background-color: {{$category->color}}; color:white;">
		<h4>
			Welcome to {{$category->name}}!
		</h4>

		<p>{{$category->desc}}</p>
	</div>

<br><br>
		
<form method="post" action="{!! route('posts.store') !!}" enctype="multipart/form-data" >

  @csrf

	<input type="hidden" name="category_id" value="{{$category->id}}">


    <div class="form-group col-md-6">
      <label for="title">Title</label>
      <input 
        type="text" 
        class="form-control @error('title') is-invalid @enderror" 
        value="{{ old('title') }}" 
        name="title" 
        placeholder="Enter a title"
      >

      @error('title')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="float-right w-25 pr-5">
      <h3 style="color: #41B883;">
        {{$category->views_count}} Views
      </h3>

      <h2 style="color: #41B883;">
        {{$category->posts_count}} Posts
      </h2>
    </div>
    
    <div class="form-group col-md-6">
      <label for="desc">Description</label>
      <textarea 
        class="form-control @error('desc') is-invalid @enderror" 
        value="{{ old('desc') }}" 
        name="desc" 
        placeholder="Enter a Description"
      ></textarea>

      @error('desc')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group col-md-6">
      <label for="desc">image</label>
      <input 
        type="file" 
        name="img" 
        class="form-control @error('img') is-invalid @enderror" 
        value="{{ old('img') }}" 
        accept="image/*"
      >

      @error('img')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
      @enderror
    </div>

    <div class="form-group col-md-6">
      <input 
        type="submit" 
        class="btn btn-success" 
        value="Submit Post"
      >
    </div>
</form>
</div>


@forelse($category->posts as $post)

	<div class="text-center">
		<h3><a href="{{ route('posts.show', $post->slug) }}">{{$post->title}}</a></h3>

		<p>{{Str::limit($post->desc, 40)}}</p>
	</div>

@empty

  <h3 class="text-center">No posts yet!</h3>

@endforelse

@endsection

@section('js')

<script>
</script>

@endsection