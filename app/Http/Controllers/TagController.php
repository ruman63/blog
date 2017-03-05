<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Tag;
use Session;

class TagController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags=Tag::all();
        return view('tags.index')->withTags($tags);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['name' => 'required|max:255']);

        $tag = new Tag;
        $tag->name = $request->name;
        $tag->save();

        Session::flash('success', 'New tag was added successfully');

        return redirect()->route('tags.index');
    }
    

    public function show($id) {
        $tag=Tag::find($id);
        return view('tags.show')->withTag($tag);
    }

    //Show Edit Form
    public function edit($id) {

        $tag=Tag::find($id);
        return view('tags.edit')->withTag($tag);
    }
    

    //Update to Model
    public function update(Request $request, $id) {

        $this->validate($request, [
            'name' => 'required|max:255'
            ]);

        $tag=Tag::find($id);
        $tag->name=$request->name;
        $tag->save();

        Session::flash('success', 'Tag updated successfully');

        return redirect()->route('tags.index');

    }


    public function destroy($id){
        $tag = Tag::find($id);
        $tag->posts()->detach();
        $tag->delete();

        Session::flash('success', 'New tag was Deleted successfully');

        return redirect()->route('tags.index');
    }
}
