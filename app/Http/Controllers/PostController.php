<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $post = request()->validate([
            'user_id' => 'required',
            'aircraft_id' => 'nullable',
            'engine_id' => 'nullable',
            'aircraft_position' => 'required_with:engine_id',
            'type' => 'required',
            'body' => 'nullable',
            'date' => 'required|date',
            ]); 
            
        Post::Create($post);

        return back()->with('success','Post added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
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
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if ($request->action == "delete") return $this->destroy($post);
        
        request()->validate([
            'user_id' => 'required',
            'aircraft_id' => 'nullable',
            'engine_id' => 'nullable',
            'aircraft_position' => 'required_with:engine_id',
            'type' => 'required',
            'body' => 'nullable',
            'date' => 'required|date',
            ]); 

        $post->user_id = $request->user_id;
        $post->body = $request->body;
        $post->date = $request->date;
        
        $post->save();

        return back()->with('success','Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return back()->with('success','Post deleted successfully');
    }
}
