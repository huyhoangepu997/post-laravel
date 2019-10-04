<?php

namespace App\Http\Controllers;

use App\Http\Requests\Posts\CreatePostRequest;
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
            'image' => $image
        ]);

        session() -> flash('success', '"' . $request -> title . '"' . ' updated successfully!');

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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return void
     */
    public function destroy(Post $post)
    {
        $post -> delete();

        session() -> flash('success', '"' . $post -> title . '"' . ' deleted successfully!');

        return redirect(route('posts.index'));
    }
}
