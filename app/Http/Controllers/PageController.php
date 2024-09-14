<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Make sure this import is present
use Illuminate\Support\Facades\Validator; // Ensure this import is correct
use Illuminate\Support\Facades\File;
class PageController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('id', 'DESC')->get();
        return view('welcome', ['posts' => $posts]);
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $validated = Validator::make($request->all(), [
            'name' => 'required',
            'title' => 'required',
            'summary' => 'required',
            'image' => 'nullable|sometimes|image:gif,jpeg,jpg,png'
        ]);

        if ($validated->passes()) {
            $post = new Post(); // Corrected here
            $post->name = $request->name;
            $post->title = $request->title;
            $post->summary = $request->summary;

            // Handle image upload
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $newFileName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/posts'), $newFileName);
                $post->image = $newFileName;
            }

            $post->save();

            $request->session()->flash('success', 'Post created successfully');
            return redirect()->route('posts.welcome');
        } else {
            return redirect()->route('posts.create')->withErrors($validated)->withInput();
        }
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.edit', compact('post'));
    }
//update
public function update($id, Request $request)
{
    $validated = Validator::make($request->all(), [
        'name' => 'required',
        'title' => 'required',
        'summary' => 'required',
        'image' => 'nullable|sometimes|image:gif,jpeg,jpg,png'
    ]);

    if ($validated->passes()) {
        $post = Post::findOrFail($id); // Use findOrFail for better error handling
        $post->name = $request->name;
        $post->title = $request->title;
        $post->summary = $request->summary;

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image'); // Define $image
            $oldimg = $post->image; // Save old image name
            $newFileName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/posts'), $newFileName);
            $post->image = $newFileName;

            // Delete old image if it exists
            if ($oldimg && File::exists(public_path('uploads/posts/' . $oldimg))) {
                File::delete(public_path('uploads/posts/' . $oldimg));
            }
        }

        $post->save();

        $request->session()->flash('success', 'Post updated successfully');
        return redirect()->route('posts.welcome');
    } else {
        return redirect()->route('posts.edit', $id)->withErrors($validated->errors())->withInput();
    }
}

//destroy

public function destroy($id)
{
    $post = Post::findOrFail($id);
    // Delete the image if it exists
    if ($post->image && File::exists(public_path('uploads/posts/' . $post->image))) {
        File::delete(public_path('uploads/posts/' . $post->image));
    }
    $post->delete();

    return redirect()->route('posts.welcome')->with('success', 'Post deleted successfully');
}

}
