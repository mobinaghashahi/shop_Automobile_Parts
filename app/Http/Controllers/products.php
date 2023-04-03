<?php

namespace App\Http\Controllers;

use App\Models\CarType;
use App\Models\Product;
use Illuminate\Http\Request;

class products extends Controller
{
    public function showDetails($id)
    {
        return view('productDetails', ['product' => Product::join('brand', 'brand.id', '=', 'products.brand_id')
            ->join('cartype', 'cartype.id', '=', 'products.cartype_id')
            ->join('category', 'category.id', '=', 'products.category_id')
            ->join('off', 'off.id', '=', 'products.off_id')
            ->where('products.id', '=', $id)
            ->select('products.*', 'brand.name as brandName',
                'cartype.name as carTypeName', 'category.name as categoryName'
                , 'off.name as offName')
            ->get()]);
    }

    public function showProductsByBrand($id)
    {
        return view('showBrandProducts', ['products' => Product::where('brand_id', '=', $id)->get()]);
    }

    public function showProductsByCarTypeCategorys($id)
    {

        //this is for fix groupBy error!!!!!
        \DB::statement("SET SQL_MODE=''");

        return view('showCarTypeCategorys', ['products' => Product::join('cartype', 'cartype.id', '=', 'products.carType_id')
            ->join('category', 'category.id', '=', 'products.category_id')
            ->where('carType_id', '=', $id)
            ->select('category.id as category_id','carType.id as carType_id', 'category.name')
            ->groupBy('category_id')
            ->get(), 'car' => CarType::where('id', '=', $id)->get()]);
    }

    public function showCarTypeProducts($carType_id,$category_id)
    {
        return view('showCarTypeProducts',['products'=>Product::where('carType_id','=',$carType_id)
            ->where('category_id','=',$category_id)
            ->get()]);
    }

}
