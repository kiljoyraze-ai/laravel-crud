@extends('layout')

@section('content')
    <h1>Edit Post</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as$error )
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.update') }}" method="POST">
        @csrf
        @method('PUT')
        <label>Barang: </label>
        <input type="text" name="barang" value="{{ $post->barang }}">
        <label>Quantity: </label>
        <input type="text" name="quantity" value="{{ $post->quantity }}">
        
        @if ($post->image)
            <img src="{{ asset('storage/images/' . $post->image) }}" alt="">
        @endif
        

        <button type="submit">Submit</button>
    </form>
@endsection