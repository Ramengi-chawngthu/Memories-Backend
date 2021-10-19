<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;
use App\Models\User;


class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return "We don't accept anything here";
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

        $this->validate($request, [ //inputs are not empty or null
            'title' => 'required',
            'body' => 'required',
        ]);



        $posts = new Posts;
        $posts->title = $request->input('title'); //retrieving user inputs
        $posts->body = $request->input('body');  //retrieving user inputs
        $posts->image = $request->input('image'); //retrieving user inputs
        $posts->user_id = $request->input('user_id'); //retrieving user inputs
        $username = User::find($request->input('user_id'));
        $posts->username = $username['name'];
        $posts->likes = 0;
        $posts->save(); //storing values as an object
        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($current)
    {
        if (!$current)
            $current = 0;

        return Posts::orderBy('id', 'desc')->skip($current)->take(12)->get();
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

    public function getPost($postId)
    {
        return Posts::findOrFail($postId);
    }
}
