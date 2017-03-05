<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Comment;



class BlogController extends Controller
{
    
	public function getIndex() {
		$posts = Post::orderBy('id','desc')->paginate(10);
		return view('blog.index')->withPosts($posts); 
	}

    public function getSingle($slug){
    	//fetch fro database
    	$post=Post::where('slug', '=', $slug)->first();
        //retur view
    	return view('blog.single')->withPost($post);
    }
}
