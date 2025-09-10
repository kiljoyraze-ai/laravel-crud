@extends('layout')

@section('content')
    <h1>Create Post</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error )
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
        <label>Barang: </label>
        <input type="text" name="barang" value="{{ old('barang') }}">
        <label>Quantity: </label>
        <input type="text" name="quantity" value="{{ old('quantity') }}">
        <label >Image: </label>
        <input type="file" name="image" accept="image/jpeg,image/jpg,image/png,image/webp"
            class="form-control @error('image') is-invalid @enderror">

        <button type="submit">Submit</button>
    </form>
@endsection