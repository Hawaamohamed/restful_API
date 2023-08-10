@extends('layouts.app')   
   
@section('content')
   
 

<a href="{{ route('posts') }}" class='btn btn-success pull-right'>All Posts</a>
 
 
 <div class="container">

    <div class="row">
        <div class="offset-md-3 col-6">
 
            <div class="title">
               <h3> Show post</h3>
            </div>
            

            <div class="card">
                @if (!empty($post->image)) 
                  <img src="{{ URL::asset('uploads/posts/'. $post->image) }}" class="card-img-top" alt="{{ $post->title }}"> 
                @endif
                <h1 class="card-title">{{ $post->title }}</h1>
                <p class="card-text">created at:  {{ $post->content }}</p>
                <h5>Tags</h5> 
                <div class="form-group">
                  @foreach ($tags as $tag)
                    <span>{{ $tag->tag }}</span> 
                  @endforeach
               </div>
                <p class="card-text">updated at:  {{ $post->created_at }}</p>
                <p class="card-text"> {{ $post->updated_at }}</p>
  
     
                <h4>Comments</h4>
                @include('posts.comments', ['comments'=>$post->comments, 'post_id'=>$post->id])

                <hr>
                
                <form method="post" action="{{route('comments.store')}}">
                  @csrf
                  <input type="text" name="content" placeholder="Content">
                  <input type="hidden" name="post_id" value="{{$post->id}}"> 
                  <button type="submit" class="btn btn-success">Add Comment</button>
                </form>
            </div>
  
     
      </div>
    </div>
    
 </div>

@endsection