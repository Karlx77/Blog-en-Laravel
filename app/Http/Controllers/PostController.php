<?php

namespace App\Http\Controllers;

use App\Comment;
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
        $posts = DB::table('users')->join('posts','users.id','=','posts.user_id')
                                         ->join('profiles','profiles.user_id','=','users.id')
                                          ->select('posts.*','posts.id as idPost','users.*','profiles.*')->get();
        foreach ($posts as $post) {
            $disCtr = DB::select("select count(likes.id) as likes from likes where likes.post_id = $post->idPost;");
            $comment = DB::select("select count(c.id) as comments from comments c where c.post_id = $post->idPost;");
        }
<<<<<<< HEAD
        return view('posts.view',compact('posts','disCtr'));

//           dd($var);
=======
//           $var = $disCtr;
//           dd($var);
        return view('posts.view',compact('posts','disCtr','comment'));
>>>>>>> f765e78e8fcd7e89b55155e697c00d22b63c5b5b
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
        return view('categories.categoriesPosts',compact('categories','posts'));
    }

     public function dislike($id){
        $logged_user = Auth::user()->id;
        $dlike_user = Like::where([
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
            return redirect('/view/');
        }
        else{
            return redirect('/view/');
        }
    }
    public function verMasComentarios($id){
        $posts = DB::table('users')->join('posts','users.id','=','posts.user_id')
            ->select('posts.*','posts.id as idPost','users.*')->where('posts.id',$id)->get();
        $profile = DB::table('users')->join('profiles','users.id','=','profiles.user_id')
            ->join('posts','users.id','=','posts.user_id')
            ->select('profiles.*','users.*')->where('posts.id',$id)->get();
        foreach ($posts as $post) {
            $disCtr = Like::where('post_id',$post->idPost)->count();
        }

        $comments = DB::table('comments')->join('users','comments.user_id','=','users.id')
                    ->join('posts','comments.post_id','=','posts.id')
                    ->join('profiles','users.id','=','profiles.user_id')
                    ->select('comments.*','users.*','profiles.*')
                    ->where('posts.id',$id)->orderBy('comments.id','desc')->get();
        return view('posts.verMasComentarios',compact('posts','disCtr','profile','comments'));
    }

    public function comentar($id,Request $request){
            $user_id = Auth::user()->id;
            $comentario = new Comment();
            $comentario->user_id = $user_id;
            $comentario->post_id = $id;
            $comentario->comments = $request->input('comentario');
            $comentario->save();

            return redirect(route('verMasComentarios',$id));
    }
}
