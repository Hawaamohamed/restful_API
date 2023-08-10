<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\Comment;
use Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
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
        $posts = Post::where('user_id', Auth::id())->latest()->paginate();
        return view('posts.index')->with('posts', $posts);
    }

    public function postsTrashed()
    {
       
        $posts = Post::onlyTrashed()->where('user_id', Auth::id())->latest()->paginate();
        return view('posts.trashed')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $tags = Tag::all();
        if($tags->count() == 0){
          return view('tags.create');
        }else{ 
        return view('posts.create')->with('tags', $tags);
       }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'tags' => 'required',
            'image' => 'required|image',
          
        ]);

        $image = $request->image;
        $newimage = time().$image->getClientOriginalName();
        $image->move('uploads/posts', $newimage);

        $post = Post::create([

            'title' => $request->title,
            'content' => $request->content,
            'image' => $newimage,
            'slug' => str_slug($request->title),
            'user_id' => Auth::id(),

        ]); 
        $post->tag()->attach($request->tags);
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
      
        $post = Post::where('slug', $slug)->where('user_id', Auth::id())->first();
        $tags = Tag::all();
        if($post === null)
        {
            return redirect()->back();
        }

        return view('posts.show')->with('post', $post)->with('tags', $tags);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id()); 
        if($post === null)
        {
            return redirect()->back();
        }

        $tags = Tag::all();
        return view('posts.edit')->with('post', $post)->with('tags', $tags);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);
        $this->validate($request, [
            'title' => 'required',
            'content' => 'required', 
          
        ]);
 //dd($request->all());
        if($request->has('image')){
            $image = $request->image;
            $newimage = time().$image->getClientOriginalName();
            $image->move('uploads/posts', $newimage);
            $post->image = $newimage;
        }
        $post->title = $request->title;
        $post->content = $request->content;

        $post->tag()->sync($request->tags); //sync check if the tags checked are the same or changed and updated it
        $post->save();
        
        return redirect()->back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->where('user_id', Auth::id());
        $post->delete();
        return redirect()->back();
         
    }
    public function hard_delete($id)
    {
        
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->forceDelete();
        return redirect()->back();
    }
    public function restore($id)
    {
        
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();
        return redirect()->back();
          
    }
}
