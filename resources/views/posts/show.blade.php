@extends('layouts.app')
@section('title', 'Show')
@section('content')
<div class="d-flex flex-column" style="min-height: 300px; position: relative;">

    <h1>Lihat Barang</h1>

    <!-- Label Nama Barang -->
    <label for="barang">Nama Barang:</label>
    <h3 id="barang">{{ $post->barang }}</h3>

    <!-- Label Quantity -->
    <label for="quantity">Quantity:</label>
    <h3 id="quantity">{{ $post->quantity }}<h3/>

    <!-- Label Barang (untuk gambar) -->
    <label for="gambar">Barang:</label>
    <img id="gambar"
        src="{{ asset('storage/' . $post->image) }}"
        alt="image"
        class="img-thumbnail"
        style="width: 200px; height: 200px; object-fit: cover;"
    >

    <div class="mt-auto text-end">
        <a href="{{ route('home') }}" class="btn btn-danger btn-sm">Back to Dashboard</a>
    </div>
    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
      @csrf
      @method('DELETE')
      <div style="margin-top: 10px; display: flex; align-items: center; gap: 10px;">
        <button type="submit" class="btn btn-danger btn-sm">Hapus Barang</button>
    </form>
     <div style="margin-top: 10px; display: flex; align-items: center; gap: 10px;"></div>
        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning btn-sm">Ubah Barang</a>
    </div>
</div>
@endsection
