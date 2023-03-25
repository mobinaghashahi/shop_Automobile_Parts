<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class productDetails extends Controller
{
    public function showDetails($id)
    {
        return view('productDetails',['product' => Product::join('brand', 'brand.id', '=', 'products.brand_id')
            ->join('cartype', 'cartype.id', '=', 'products.cartype_id')
            ->join('category', 'category.id', '=', 'products.category_id')
            ->join('off', 'off.id', '=', 'products.off_id')
            ->where('products.id','=',$id)
            ->select('products.*', 'brand.name as brandName',
                'cartype.name as carTypeName', 'category.name as categoryName'
                , 'off.name as offName')
            ->get()]);
    }
}
