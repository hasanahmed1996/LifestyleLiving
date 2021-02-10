<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function addProduct(Request $request){
        return view('admin.products.addProduct');
    }
}
