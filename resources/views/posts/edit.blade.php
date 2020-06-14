@extends('layouts.app')

@section('content')

<div class="container">
<form method="post" action="{!! route('posts.update', $post->id) !!}" enctype="multipart/form-data" >

  @method('PUT')
  @csrf

    <div class="form-group col-md-6">
      <label for="title">Title</label>
      <input type="text" class="form-control" name="title"  value="{{$post->title}}" placeholder="Enter a title">
    </div>


    <div class="form-group col-md-6">
      <label for="desc">Description</label>
     <textarea class="form-control" name="desc" placeholder="Enter a Description">{{$post->desc}}</textarea>
    </div>

    <div class="form-group col-md-6">
      <label for="desc">image</label>
     <input type="file" name="img" class="form-control" accept="image/*" value="/storage/{{$post->img}}">
    </div>
    <br />
    <br />

    <div class="form-group col-md-6">
     <input type="submit" class="btn btn-success" value="Submit Post">
    </div>




</form>
</div>

@endsection