@extends('layouts.app')
@section('title', 'Posts')
@section('content')

  <div class="card mb-2">
    <div class="card-body h-100">
      <h1>Stock Barang | Preview</h1>
      
      <a class="btn btn-primary" href="{{ route('home') }}">Dashboard </a
      @if ($message = Session::get('success'))
          <div>{{ $message }}</div>
      @endif
      <table class="table table-bordered border-info">
          <thead>
              <tr>
                  <th>Barang</th>
                  <th>Quantity</th>
                  <th>Gambar</th>
              </tr>
          </thead>
          <tbody>
              @foreach ($posts as $post )
                  <tr>
                      <td>{{ $post->barang }}</td>
                      <td>{{ $post->quantity }}</td>
                      <td class="text center">
                          @if ($post->image)
                              <img src="{{ asset('storage/' . $post->image) }}" alt="image"
                              style="max-width: 150px; max-height: 150px;">
                          @endif
                      </td>
                  </tr>
              @endforeach
          </tbody>
      </table>
    </div>
  </div>
@endsection
