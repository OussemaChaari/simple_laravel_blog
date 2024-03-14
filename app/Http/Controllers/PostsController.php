<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::get();
        return view('blog.index')->with('posts',$posts); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|min:6',
        'description' => 'required',
        'image' => 'required|image|mimes:jpg,png|max:5048'
    ]);

    $slug = Str::slug($request->title, '-');
    $newImageName = uniqid() . '-' . $slug . '.' . $request->image->extension();
    $request->image->move(public_path('uploads'), $newImageName);

    Post::create([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'slug' => $slug,
        'image_path' => $newImageName,
        'user_id' => auth()->user()->id,
    ]);

    return redirect('/blog');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('blog.show')->with('post',Post::where('slug',$slug)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        return view('blog.edit')->with('post',Post::where('slug',$slug)->first());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
{
    $request->validate([
        'title' => 'required|min:6',
        'description' => 'required',
        'image' => 'nullable|image|mimes:jpg,png|max:5048' // Image est facultative lors de la mise à jour
    ]);

    $post = Post::where('slug', $slug)->firstOrFail();

    // Vérifier si le titre a été modifié
    if ($request->input('title') !== $post->title) {
        $slug = Str::slug($request->input('title'), '-');
    }

    // Si une nouvelle image est téléchargée, la traiter
    if ($request->hasFile('image')) {
        $newImageName = uniqid() . '-' . $slug . '.' . $request->image->extension();
        $request->image->move(public_path('uploads'), $newImageName);
    } else {
        // Sinon, garder l'image existante
        $newImageName = $post->image_path;
    }

    // Mettre à jour l'article avec le nouveau slug et le chemin de l'image
    $post->update([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'slug' => $slug,
        'image_path' => $newImageName,
        'user_id' => auth()->user()->id,
    ]);

    return redirect('/blog/' . $slug)->with('message', 'Blog post updated');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);  
        $post->delete();
        return redirect('/blog')->with('message', 'Blog post deleted successfully.');
    }
}