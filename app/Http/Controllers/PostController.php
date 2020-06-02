<?php

namespace App\Http\Controllers;

use App\Dislike;
use App\Like;
use App\Post;
use App\Category;
use DemeterChain\C;
use http\Client\Curl\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\URL;

class PostController extends Controller
{
    public function post(){
//        $category =  Category::all();
        return view('posts.post');
    }

    public function addPost(Request $request){
        $this->validate($request,[
            'post_title'=>'required',
            'post_body'=>'required',
//            'category_id'=>'required',
            'post_image'=>'required',
        ]);

        $post = new Post();
        $post->user_id =Auth::user()->id;
        $post->post_title = $request->input('post_title');
        $post->post_body = $request->input('post_body');
        if (Input::hasFile('post_image')){
            $file = Input::file('post_image');
            $file->move(public_path(). '/posts/', $file->getClientOriginalName());
            $url = URL::to("/") . '/posts/'. $file->getClientOriginalName();
        }
        $post->post_image = $url;
        $post->save();
        return redirect('/home')->with('response','Post Published Successfully');
    }

    public function view(){
//        $post_id=
        $posts = DB::table('users')->join('posts','users.id','=','posts.user_id')
                                          ->select('posts.*','users.*')->get();
//        $likePost = Post::findOrFail($post_id);
//        $likeCtr = Like::where([
//            'post_id'=> $likePost->id
//        ])->count();
//        $disCtr = Like::where([
//            'post_id' => $likePost->id
//        ])->count();
//        $categories = Category::orderBy('category','asc')->get();
        return view('posts.view',compact('posts'));
    }

    public function edit($post_id){
//        $category = Category::all();
        $posts = Post::findOrFail($post_id);

        return view('posts.update',compact('posts'));
    }

    public function editPost(Request $request, $post_id){
        $this->validate($request,[
            'post_title'=>'required',
            'post_body'=>'required',
//            'category_id'=>'required',
            'post_image'=>'required',
        ]);

        $post = Post::findOrFail($post_id);
        $post->user_id =Auth::user()->id;
        $post->post_title = $request->input('post_title');
        $post->post_body = $request->input('post_body');
//        $post->category_id = $request->input('category_id');
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

    public function category($id){
        $categories=Category::all();
        $posts = DB::table('posts')->join('categories','posts.category_id','=','categories.id')
        ->select('posts.*','categories.*')
        ->where(['categories.id'=>$id])
        ->get();
////        return $posts;
////        exit();
        return view('categories.categoriesPosts',compact('categories','posts'));
    }

     public function dislike($id){
        $logged_user = Auth::user()->id;
        $dlike_user = Like()::where([
            'user_id' => $logged_user,
            'post_id' => $id
        ])->first();

        if (empty($dlike_user -> user_id)){
            $user_id = Auth::user()->id;
            $email = Auth::user()->email;
            $post_id=$id;
            $dislike = new Like();
            $dislike->user_id = $user_id;
            $dislike->email = $email;
            $dislike->post_id = $post_id;
            $dislike->save();
            return redirect('/view/',$id);
        }
        else{
            return redirect('/view/',$id);
        }
    }
}
