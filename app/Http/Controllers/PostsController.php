<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param CreatePostRequest $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all(); // use Posts model to get data
//        dd($posts[0] -> image);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {

        $image = $request -> image -> store('posts'); // store('posts') saved path: posts/....jpg

        // to save like this on db, in Posts model, we have to create protected $fillable and pass variables
        Post::create([
            'title' => $request -> title,
            'description' => $request -> description,
            'content' => $request -> content,
            'image' => $image,
            'published_at' => $request->published_at
        ]);

        session() -> flash('success', '"' . $request -> title . '"' . ' created successfully!');

        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return void
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data =  $request->only(['title', 'description', 'content', 'published_at']);
        // check if new image
        if ($request->hasFile('image')) {
            // upload it
            $image = $request->image->store('posts');

            // delete old one
            $post->deleteImage();

            $data['image'] = $image;
        }

        // updated attributes
        $post->update($data);

        // flash message
        session()->flash('success', 'Post updated successfully!');

        // redirect user
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return void
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();

        if ($post->trashed()) {
            $post->deleteImage();
            $post->forceDelete();
        } else {
            $post->delete();
        }

        session() -> flash('success', '"' . $post -> title . '"' . ' deleted successfully!');

        return redirect(route('posts.index'));
    }

    public function trashed() {
        $trashed = Post::onlyTrashed()->get();
        return view('posts.index')->with('posts', $trashed);
    }

    public function restore($id) {
        $post = Post::withTrashed()->where('id', $id)->first();

        $post->restore();

        session()->flash('success', 'Post restored successfully!');

        return redirect()->back();
    }
}
