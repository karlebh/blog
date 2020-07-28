

@extends('layouts.app')

@section('content')


<x-feed :feed="$friendsPosts">

	<x-slot name="title">
		Freinds Posts
	</x-slot>

	<x-slot name="empty">
		
		<p>Your friends are not making any post yet.</p>
			
			<br>

		<p>Go <a href="/users">here</a> to make more friends</p>
	</x-slot>
</x-feed>

@endsection

