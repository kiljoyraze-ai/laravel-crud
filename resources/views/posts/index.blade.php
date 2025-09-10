@extends('auth.home')
@section('layout')
    <h1>Posts</h1>
    <a href="{{ route('posts.create') }}">create</
    @if ($message = Session::get('success'))
        <div>{{ $message }}</div>
    @end
    <table class="table table-bordered border-info">
        <thead>
            <tr>
                <th>Barang</th>
                <th>Quantity</th>
                <th>Gambar</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post )
                <tr>
                    <td>{{ $post->barang }}</td>
                    <td>{{ $post->quantity }}</td>
                    <td class="text center">
                        @if ($post->image)
                            <img src="{{ asset('storage/images/' . $post->image) }}" alt="image"
                            style="max-width: 150px; max-height: 150px;">
                            
                        @endif
                    </td>
                    <td><a href="{{ route('posts.show' , $post->id) }}">Show</a>
                    <a href="{{ route('posts.edit' , $post->id) }}">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection    
    
    