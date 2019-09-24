<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();
        return response()->json([
            'categories' => $categories
        ],200);
    }
    
    public function store(Request $request)
    {
        $this->validate($request,[
            'cat_name'=>'required|min:2|max:50'
        ]);
        
        $category = new Category();
        
        $category->cat_name = $request->cat_name;
        $category->save();
        return ['msg'=> 'Category Added Successfully'];
    }
    
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return response()->json([
            'category'=>$category
        ],200);
    }
    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'cat_name'=>'required|min:2|max:50'
        ]);
        
        $category = Category::findOrFail($id);
        
        $category->cat_name = $request->cat_name;
        $category->save();
        
    }
    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        
    }
    
    public function delete_cat($id)
    {
        $all_id = explode(',',$id);
        
        foreach ($all_id as $ids){
            $category = Category::findOrFail($ids);
            $category->delete();
        }
        
        return ['msg' => 'category deleted'];
    }
}
