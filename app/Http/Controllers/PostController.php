<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(User $user){

        $posts = Post::where("user_id", $user->id)->paginate(10);

        return view('dashboard', ["user" => $user, "posts" => $posts]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $this->validate($request, [
            'title' => ['required', 'max:80'],
            'description' => ['required', 'max:500'], 
            'image' => ['required']
        ]);

        $request->user()->posts()->create(
            [
                'title' => $request->title,
                'description' => $request->description,
                'image' => $request->image,
                'user_id' => auth()->user()->id
            ]
        );

        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post){
        
        return view('posts.show', ["post" => $post, "user" => $user]);
    }
}