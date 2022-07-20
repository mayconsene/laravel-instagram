<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $posts = Post::all();
       
        return view('posts.index', compact('posts', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $path = $request->photo->store('public/images');

        Post::create(
            [
                'image' => Storage::url($path),
                'description' => $request->description,
                'user_id' => $user->id
            ]
            );

            return redirect('/dashboard');
    }

    /**
     * Like the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function like(Post $post)
    {
        $user = auth()->user();

        //Buscar likes dados pelo usuário neste post
        $numOfLikes = Like::where('user_id', $user->id)
        ->where('post_id', $post->id)
        ->count();

        //Se tiver like do usuário neste post
        if($numOfLikes > 0){
            Like::where('user_id', $user->id)
            ->where('post_id', $post->id)
            ->delete();

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Like removido com sucesso',
                    'like' => false
                ]
                );
        }
        Like::create([
            'post_id' => $post->id,
            'user_id' => $user->id
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'Like criado com sucesso',
                'like' => true
                

            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
