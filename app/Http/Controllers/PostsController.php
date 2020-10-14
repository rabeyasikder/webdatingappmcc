<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function create(){
        return view('posts.create');
    }
    public function store(){
        $data = request()->validate(
            [
                'another' =>'',
                'caption' =>'required',
                'image'=> ['required', 'image']
            ]
        );


       $imagePath= request('image')->store('uploads','public');
       $image = Image::make(public_path("storage/{$imagePath}"))->fit(250,250);

       $image->save();
        auth()->user()->posts()->create(
            [
                'caption' => $data['caption'],
                'image' => $imagePath
            ]
        );

        return redirect('/profile/' . auth()->user()->id);
       // dd(request()->all());


        //oNe option to data post/save
//        $post = new \App\Post();
//        $post->caption = $data['caption'];
//        $post->save();
        //oNe option to data post/save

        //another easyest way to save/post data

       // \App\Post::create($data);


    }

    public function show(\App\Post $post){
        //dd($post);
        return view('posts.show',compact('post'));
    }


}
