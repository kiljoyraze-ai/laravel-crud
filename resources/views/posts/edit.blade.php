@extends('layouts.app')
@section('title', 'Edit')
@section('content')
    <h1>Edit Post</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error )
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Barang </label>
            <input class="form-control" type="text" name="barang" value="{{ $post->barang }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Quantity </label>
            <input class="form-control"type="text" name="quantity" value="{{ $post->quantity }}">
        </div>
        
        <div class="mb-3">
        @if ($post->image)
            <img src="{{ asset('storage/images/' . $post->image) }}" alt="">
        @endif
        </div>
        

        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
@endsection