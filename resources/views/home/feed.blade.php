@extends('layouts.app')

@section('content')



<div class="container">
@php
print_r($friendss)

@endphp
{{-- @foreach ($friendss->posts as $friend)
	{{ $friend }}
@endforeach --}}


</div>

@yield('extra')


@endsection