<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       try  {
            $validateData = $request->validate([
                'barang' => 'required',
                'quantity' => 'required',
                'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            ]);

            $image = $request->file('image');
            $imageName = $image->hashName();
            $imagePath = $image->storeAs('/images', $imageName , 'public');

            Post::create([
                'barang' => $request->input('barang'),
                'quantity' => $request->input('quantity'),
                'image' => $imageName,
            ]);

            return redirect()->route('posts.index')->with('suucess', 'Post created successfully.');
       }catch (\Exception $e){
            return back()->withErrors(['error' => 'An error occured: '. $e->getMessage()]);
       }
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
        try  {
            $validateData = $request->validate([
            'barang' => 'required',
            'quantity' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
            ]);
        
            $imagePath = $post->image;
            if ($request-> hasFile('image')) {
                if ($imagePath) {
                    Storage::disk('public')->delete('images/' . $imagePath);
                }
                $image = $request->file('image');
                $imageName = $image->hashName();
                $imagePath = $image->storeAs('/images', $imageName, 'public');
            }

            Post::update([
                'barang' => $validateData['barang'],
                'quantity' => $validateData['quantity'],
                'image' => $imagePath,
            ]);

        return redirect()->route('posts.index')->with('succes', 'Post updateed successfully.');

        }
        catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occurred: ' . $e->getMessage() ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        try{
            if ($post->$image) {
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
        }catch (\Exception $e) {
            return back()->withErrors(['error' => 'An error occured .' . $e->getMessage()]);
        }
    }
}
