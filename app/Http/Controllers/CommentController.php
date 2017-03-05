<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Comment;
use App\Post;
use Session;

class CommentController extends Controller
{
    public function __construct(){
        $this->middleware('auth', ['except' => 'store']);      
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $comment= new Comment;
        $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|min:5|max:2000'
            ]);

        $post = Post::find($post_id);

        $comment->name = $request->name;
        $comment->email = $request->email;
        $comment->approved = true;
        $comment->comment = $request->comment;
        $comment->post_id = $post_id;


        $comment->save();

        Session::flash('success', 'Your comment was sent for approval');

        return redirect()->route('blog.single', $post->slug);
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = Comment::find($id);
        return view('comments.edit')->withComment($comment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'comment' => 'required|min:5|max:2000'
            ]);
        $comment = Comment::find($id);

        $comment->comment = $request->comment;
        $comment->save();

        Session::flash('success', 'Comment updated successfully');

        return redirect()->route('posts.show', $comment->post_id);
    }

    public function delete($id){
        $comment = Comment::find($id);
        return view('comments.delete')->withComment($comment);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $post_id = $comment->post_id;
        $comment->delete();
        Session::flash('success', 'Comment deleted successfully');

        return redirect()->route('posts.show', $post_id);
    }
}


