<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Events\PostProcessed;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function index() {
        $posts = Post::all();
        return view('post.index',compact('posts'));
    }
    public function store(Request $request) {
        $post = new Post();
        $post->title = $request->title;
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $getFileStoreName = time().".".$extension;
            Image::make($image)->resize(300,300)->save($image->move('images',$getFileStoreName));
            $post->image = $getFileStoreName;
        }
        $edata = ['title'=>$request->title,'date'=>date('d m y')];
        event(new PostProcessed($edata));
        $post->save();
        return redirect()->back()->with('insertMsg','Insert post');
    }
    public function edit($id) {
        // return $id;
        $post = Post::findOrFail($id);
        return view('post.edit',['post'=>$post]);
    }
    public function update(Request $request,$id) {
        $post = Post::find($id);
        if($request->hasFile('image')) {
            $image = $request->file('image');
            $extension = $image->getClientOriginalExtension();
            $getFileStoreName = time().".".$extension;
            Image::make($image)->resize(300,300)->save($image->move('images/',$getFileStoreName));
        }
        $post->title = $request->title;
        if($request->hasFile('image')) {
            if(File::exists('images/'.$post->image)) {
                File::delete('images/'.$post->image);
            }
            $post->image = $getFileStoreName;
        }
        $post->save();
        return redirect()->route('post.index');
    }
    public function delete($id) {
        $post = Post::findOrFail($id);
        if(File::exists('images/'.$post->image)) {
            File::delete('images/'.$post->image);
        }
        $post->delete();
        return redirect()->back()->with('msgDelete','Post is delete');
    }
}
