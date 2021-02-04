<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    //
    public function addCategory(Request $request){
        if ($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $category = new Category();
            $category->name = $data['category_name'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->save();
            return redirect('/admin/view-categories')->with('flash_message_success', 'Category successfully created');
        }

        return view('admin.categories.add_category');
    }

    public function viewCategories(Request $request){
        /*if ($request->isMethod('get')){
            $data = $request->all();
        }*/
        $categories = Category::get();
        return view('admin.categories.view_categories')->with(compact('categories'));
    }
}
