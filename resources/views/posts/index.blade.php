@extends('layout')

@section('content')
    <h1>Posts</h1>
    <a href="{{ route('posts.create') }}">create</a>

    @if ($message = Session::get('success'))
        <div>{{ $message }}</div>
    @endif

    <table>
        <thead>
            <tr>
                <th>barang</th>
                <th>quantity</th>
                <th>images</th>
                <th>action</th>
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
                            @else
                            No Image
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