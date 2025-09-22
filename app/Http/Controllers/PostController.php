<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public static function middleware(): array
    {
        return [
            new Middleware('guest', except: ['home', 'logout']), 
            new Middleware('auth', only: ['home', 'logout']),
        ];
    }
    public function index()
    {
        $posts = Post::all();
        return view('posts.index' , compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create'); //code ini mengarahkan ke halaman create
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'barang'   => 'required',
            'quantity' => 'required',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]); // kode ini untuk memvalidasi inputan dari form

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images', 'public'); //kode ini untuk menyimpan file gambar ke dalam folder 'images' di dalam storage/app/public
        }

        Post::create($validated);

        return redirect()->route('home')->with('success', 'Barang berhasil ditambahkan.'); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        
        $validateData = $request->validate([
        'barang' => 'required',
        'quantity' => 'required',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240', //validasi gambar, logikanya jika ada gambar maka harus sesuai validasi
        ]);
    
       if ($request->hasFile('image')) {
            // hapus gambar lama kalau ada
         if ($post->image) {
             Storage::disk('public')->delete('images/' . $post->image);
         }
            // simpan gambar baru
         $validateData['image'] = $request->file('image')->store('images', 'public');
       }
        // ketika gambar null maka gambar tidak diupdate
        $post->update($validateData);
        return redirect()->route('home')->with('success', 'Barang berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try{
            if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        return redirect()->route('home')->with('success', 'Barang berhasil dihapus.');
        }catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occured .' . $e->getMessage()]);
        }
    }
}
