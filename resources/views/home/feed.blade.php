@extends('layouts.app')

@section('content')


<x-feed :feed="auth()->user()->content()->paginate()"></x-feed>


<div class="container">

</div>

@yield('extra')


@endsection