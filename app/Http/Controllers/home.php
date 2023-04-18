<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class home extends Controller
{
    public function showHome()
    {
        return view('home.home',['products'=>Product::orderBy('id', 'DESC')->get(),
            'categorys'=>Category::all(),
            'categoryExist'=>Product::select('category_id')->groupBy('category_id')->get()->toArray()]);
    }

    public function aboutUs(){
        return view('home.aboutUs');
    }

    public function contact(){
        return view('home.contact');
    }
}
