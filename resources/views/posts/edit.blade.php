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

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
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
        
       @if ($post->image)
          <div class="mb-3">
                <label class="form-label">Image</label>
                <div class="border rounded p-3 bg-light">
                    <div class="d-flex align-items-center gap-3">
                        <img    src="{{ asset('storage/' . $post->image) }}"
                                alt="Current Image"
                                class="img-thumbnail"
                                style="width: 100px; height: 100px; object-fit: cover;">
                        <div class="flex-grow-1">
                        </div>
                    </div>
                </div>
            </div>
        @endif

         <label for="image" class="form-label">
            {{ $post->image ? 'Replace Image' : 'Featured Image' }}
        </label>
        <input  type="file"
                id="image"
                name="image"
                class="form-control @error('image') is-invalid @enderror"
                accept="image/jpeg,image/jpg,image/png,image/webp">
        

        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
@endsection