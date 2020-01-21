<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class PostController extends Controller
{
    public function post(){
        $category =  Category::all();
        return view('posts.post', compact('category'));
    }

    public function addPost(Request $request){
        $this->validate($request,[
            'post_title'=>'required',
            'post_body'=>'required',
            'category_id'=>'required',
            'post_image'=>'required',
        ]);

        $post = new Post();
        $post->user_id =Auth::user()->id;
        $post->post_title = $request->input('post_title');
        $post->post_body = $request->input('post_body');
        $post->category_id = $request->input('category_id');
        if (Input::hasFile('post_image')){
            $file = Input::file('post_image');
            $file->move(public_path(). '/posts/', $file->getClientOriginalName());
            $url = URL::to("/") . '/posts/'. $file->getClientOriginalName();
        }
        $post->post_image = $url;
        $post->save();
        return redirect('/home')->with('response','Post Published Successfully');
    }

    public function view($post_id){
        $post = Post::where('id','=', $post_id)->get();
        return view('posts.view',compact('post'));
    }

    public function edit($post_id){
        return $post_id;
    }
}
