@extends('layout')

@section('content')
    <h1>Show Item</h1>
    <h3>{{ $post->barang }}</h3>
    <p>{{ $post->quantity }}</p>
    <img src="{{ asset('storage/images/' . $post->image) }}" alt="image" style="max-width: 250px; max-height: 250px;">
    <a href="{{ route('posts.index') }}">Back to Dashboard</a>
@endsection