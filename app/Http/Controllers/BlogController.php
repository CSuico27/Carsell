<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::with('user')
        ->where('user_id', auth()->id())
        ->get();
        return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string']
        ]);

        Blog::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => auth()->id()
        ]);

        return redirect()->route('blogs.index')->with('success', 'Successfully Create a New Blog.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::with('user')->findOrFail($id);
        return view('blog.show', compact('blog'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::with('user')->findOrFail($id);
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'string',
            'description' => 'string'
        ]);

        $blog = Blog::findOrFail($id);

        $blog->update([
            'title' => $request->input('title'),
            'description' => $request->input('description')
        ]);

        return redirect()->route('blogs.index')->with('success', 'Successfully updated blog details.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::findOrFail($id);

        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Successfully deleted blog post.');
    }
}
