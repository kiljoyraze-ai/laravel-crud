@extends('layouts.app')
@section('title', 'Create')
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

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label class="form-label">Barang </label>
        <input class="form-control" type="text" name="barang" value="{{ old('barang') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Quantity </label>
            <input class="form-control" type="text" name="quantity" value="{{ old('quantity') }}">
        </div>
        <div class="mb-3">
            <label class="form-label">Image </label>
            <input class="form-control" type="file" name="image" accept="image/jpeg,image/jpg,image/png,image/webp"
            class="form-control @error('image') is-invalid @enderror">
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
@endsection