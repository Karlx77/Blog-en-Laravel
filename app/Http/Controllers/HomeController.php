<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Profile;
use App\User;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = Auth::user()->id;
        $profile = DB::table('users')->join('profiles','users.id','=','profiles.user_id')
                                          ->select('users.*','profiles.*')
                                          ->where(['profiles.user_id'=> $user_id])
                                          ->first();
//        $profile = DB::table('users')->join('profiles','users.id','=','profiles.user_id')
//            ->join('posts','users.id','=','posts.user_id')
//            ->select('profiles.*','users.*','posts.*')->where('posts.user_id',$user_id)->first();
//        dd($profile);
        $posts = Post::where('posts.user_id',$user_id)->paginate(1);
        $post = DB::table('users')->join('posts','users.id','=','posts.user_id')
            ->select('posts.*','posts.id as idPost','users.*')->get();
        foreach ($post as $item) {
            $disCtr = DB::select("select count(likes.id) as likes from likes where likes.post_id = $item->idPost;");
        }

        return view('home',compact('profile','posts','disCtr','post'));
    }
}
