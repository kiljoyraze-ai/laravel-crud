@extends('layouts.app')
@section('title', 'Show')
@section('content')
    <h1>Show Item</h1>
    <h3>{{ $post->barang }}</h3>
    <p>{{ $post->quantity }}</p>
    <img src="{{ asset('storage/' . $post->image) }}" 
        alt="image" 
        class="img-thumbnail" 
        style="width: 200px; height: 200px; object-fit: cover;">
    <a href="{{ route('home') }}">Back to Dashboard</a>
@endsection