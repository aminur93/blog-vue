<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Image;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('user','category')->latest()->get();
        
        return response()->json([
            'posts' => $posts
        ],200);
    }
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required|min:2|max:50',
            'description'=>'required|min:2|max:1000'
        ]);
        
        $strpos = strpos($request->photo,';');
        $sub = substr($request->photo,0,$strpos);
        $ex = explode('/',$sub)[1];
        $name = time().".".$ex;
        $img = Image::make($request->photo)->resize(200, 200);
        $upload_path = public_path()."/uploads/";
        $img->save($upload_path.$name);
        
        
        $post = new Post();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->cat_id = $request->category;
        $post->user_id = Auth::user()->id;
        $post->photo = $name;
        
        $post->save();
        
        return ['msg' => 'post added successfully'];
    }
    
    public function edit($id)
    {
        $post = Post::findOrFail($id);
    
        return response()->json([
            'post' => $post
        ],200);
    }
    
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        
        $this->validate($request,[
            'title'=>'required|min:2|max:50',
            'description'=>'required|min:2|max:1000'
        ]);
    
        
        if ($request->photo != $post->photo)
        {
            $strpos = strpos($request->photo,';');
            $sub = substr($request->photo,0,$strpos);
            $ex = explode('/',$sub)[1];
            $name = time().".".$ex;
            $img = Image::make($request->photo)->resize(870, 350);
            $upload_path = public_path()."/uploads/";
            $image = $upload_path. $post->photo;
            $img->save($upload_path.$name);
            
            if (file_exists($image))
            {
                @unlink($image);
            }
        }else{
            $name = $post->photo;
        }
        
        $post->title = $request->title;
        $post->description = $request->description;
        $post->cat_id = $request->cat_id;
        $post->user_id = Auth::user()->id;
        $post->photo = $name;
        
        $post->save();
    
        return ['msg' => 'post added successfully'];
    }
    
    public function destroy($id)
    {
        $post = Post::find($id);
        $image_path = public_path()."/uploads/";
        $image = $image_path. $post->photo;
        if(file_exists($image)){
            @unlink($image);
        }
        $post->delete();
        
        
        return ['msg' => 'post delete successfully'];
    }
}
