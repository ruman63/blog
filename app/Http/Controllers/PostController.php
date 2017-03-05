<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;
use App\Category;
use App\Tag;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;

class PostController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $posts=Post::orderBy('id', 'desc')->paginate(5);
        return view('posts.index')->withPosts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        
        return view('posts.create')->withCategories($categories)->withTags($tags);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //Validate the data
        $this->validate($request, array(
            'title' => 'required|max:255',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            'body' => 'required'
            ));

        //Write to Database
        $post=new Post;

        $post->title=$request->title;
        $post->slug=$request->slug;
        $post->body=$request->body;
        $post->category_id = $request->category_id;

        $post->save();

        $post->tags()->sync($request->tags, false);
        //redirecting to show the post

        Session::flash('success', 'Blog post sent successfully');
        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $post= Post::find($id);
        return view('posts.show')->withPost($post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //pull daata frm db
        $categories = Category::all();
        $options =[];
        foreach($categories as $cat) {
            $options["$cat->id"] = $cat->name;
        }

        $tags= Tag::all();
        $tags2 =[];
        foreach($tags as $tag){
            $tags2["$tag->id"] = $tag->name;
        }
        $post=Post::find($id);

        //return view containing Update form
        return view('posts.edit')->withPost($post)->withCategories($options)->withTags($tags2);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {

        $post=Post::find($id);
        //Validation
       
        $criteria = [
            'title' => 'required|max:255',
            'body' => 'required',
            ];
        if($request->input('slug') != $post->slug){
            $criteria['slug'] = 'required|alpha_dash|min:5|max:255|unique:posts,slug';
        } 
        $this->validate($request, $criteria);
        //Save Data to database
        

        $post->title=$request->title;
        $post->slug=$request->slug;
        $post->category_id=$request->category_id;
        $post->body=$request->body;

        $post->save();
        if(isset($request->tags)){
            $post->tags()->sync($request->tags);
        } else {
            $post->tags()->sync([]);
        }
        //add flash success message
        Session::flash('success', 'Blog post updated successfully');
        //redirect
        return redirect()->route('posts.show', $post->id);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->tags()->detach();
        $post->delete();

        Session::flash('success', 'Blog post was deleted successfully.');

        return redirect()->route('posts.index');
    }
}
