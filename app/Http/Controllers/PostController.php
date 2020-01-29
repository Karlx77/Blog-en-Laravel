<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use DemeterChain\C;
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
        $posts = Post::where('id','=', $post_id)->get();
        $categories = Category::orderBy('category','asc')->get();
        return view('posts.view',compact('posts','categories'));
    }

    public function edit($post_id){
        $category = Category::all();
        $posts = Post::findOrFail($post_id);
        $categories = Category::findOrFail($posts->category_id);

        return view('posts.update',compact('category','posts','categories'));
    }

    public function editPost(Request $request, $post_id){
        $this->validate($request,[
            'post_title'=>'required',
            'post_body'=>'required',
            'category_id'=>'required',
            'post_image'=>'required',
        ]);

        $post = Post::findOrFail($post_id);
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
        return redirect('/home')->with('response','Post Edited Successfully');

    }

    public function deletePost($id){
        $posts = Post::findOrFail($id);
        $posts->delete();

        return redirect('/home')->with('response','Post Deleted Successfully');

    }

}
