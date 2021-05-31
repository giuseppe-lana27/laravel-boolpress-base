<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;
use App\Tag;


class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // prendo i dati dal db
        $posts = Post::where('published', 1)->orderBy('date', 'asc')->limit(5)->get();
        $tags = Tag::all();
        // restituisco la pagina home
        return view('guest.index', compact('posts', 'tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    
    public function show($slug)
    {
        // prendo i dati dal db
        $post = Post::where('slug', $slug)->first();
        $tags = Tag::all();
        
        if ( $post == null ) {
            abort(404);
        }
        // restituisco la pagina del post
        return view('guest.show', compact('post', 'tags'));
    }
    public function filterTag($slug)
    {
        $tags = Tag::all();

        $tag = Tag::where('slug', $slug)->first();
        if ( $tag == null ) {
            abort(404);
        }

        $posts = $tag->posts()->where('published', 1)->get();

        // restituisco la pagina home
        return view('guest.index', compact('posts', 'tags'));
    }
    public function addComment(Request $request, Post $post)
    {
        $request->validate([
            'nome' => 'nullable|string|max:100',
            'content' => 'required|string'
        ]);

        $newComment = new Comment();
        $newComment->name = $request->name;
        $newComment->content = $request->content;
        $newComment->post_id = $post->id;
        $newComment->save();

        return back();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
