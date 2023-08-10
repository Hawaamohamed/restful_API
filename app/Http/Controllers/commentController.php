<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Tag;
use Auth;
use App\Comment;

class commentController extends Controller
{
    
    public function index()
    {
         return view('posts.comments');
    }

    public function create()
    {
         
    }

    
    public function store(Request $request)
    {
        
        $this->validate($request, [ 
            'content' => 'required',
            'user_id' => 'required',
            'image' => 'required|image',
          
        ]);

        $input = $request->all(); 
        $comment = Comment::create([ 
            'content' => $request->content, 
            'post_id' => $request->post_id,
            'user_id' => Auth::id(), 
        ]);  
        return back();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
