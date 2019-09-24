<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function all_blog()
    {
        $blogposts = Post::with('user','category')->latest()->get();
    
        return response()->json([
            'blogposts' => $blogposts
        ],200);
    }
    
    public function show($id)
    {
        $singleblogpost = Post::with('user','category')->where('id',$id)->first();
        
        return response()->json([
            'singleblogpost' => $singleblogpost
        ],200);
    }
    
    public function blog_category()
    {
        $user_categories = Category::latest()->get();
        
        return response()->json([
            'usercategories' => $user_categories
        ],200);
    }
    
    public function postByCat($id)
    {
        $blogposts = Post::with('user','category')->where('cat_id',$id)->latest()->get();
    
        return response()->json([
            'blogposts' => $blogposts
        ],200);
    }
    
    public function search()
    {
        $search = \Request::get('v');
        if ($search != null){
            $blogposts = Post::with('user','category')
                ->where('title','LIKE',"%$search%")
                ->orWhere('description','LIKE',"%$search%")
                ->get();
            return response()->json([
                'blogposts' => $blogposts
            ],200);
        }else{
            return $this->all_blog();
        }
        
    }
    
    public function latestpost()
    {
        $latestposts = Post::with('user','category')->latest()->get();
    
        return response()->json([
            'latestpost' => $latestposts
        ],200);
    }
}
