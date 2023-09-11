<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class siteMap extends Controller
{
    public function productsSiteMap(){
        return response()->view('siteMap.productsSiteMap', [
            'products' => Product::all(),
        ])->header('Content-Type', 'text/xml');
    }
}
