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

        //This variable contains all the categories that have a parent id of 0 (The Main Categories)
        $levels = Category::where(['parent_id'=> 0])->get();
        
        return view('admin.categories.add_category')->with(compact('levels'));
    }

    public function editCategory(Request $request, $id = null){

        if ($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            Category::where(['id'=> $id])->update(['name'=> $data['category_name'],
                'description'=>$data['description'],
                'url'=> $data['url']]);

            return redirect('/admin/view-categories')->with('flash_message_success', "Category updated successfully");
        }

        $categoryDetails = Category::where(['id' => $id])->first();

        return view('admin.categories.edit_category')->with(compact('categoryDetails'));
    }

    public function deleteCategory($id = null){
        if (!empty($id)){
            Category::where(['id'=> $id])->delete();//find the id and then delete it from the table
            return redirect()->back()->with('flash_message_success', "Category deleted!");
        }
    }

    public function viewCategories(Request $request){
        /*if ($request->isMethod('get')){
            $data = $request->all();
        }*/
        $categories = Category::get();
        return view('admin.categories.view_categories')->with(compact('categories'));
    }


}
