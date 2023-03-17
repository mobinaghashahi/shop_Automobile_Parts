<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\CarType;
use App\Models\Category;
use App\Models\Off;
use App\Models\Product;
use Illuminate\Http\Request;

class admin extends Controller
{
    public function showDashboard(){
        return view('admin.dashboard');
    }


    public function showAddProduct(){
        return view('admin.addProduct',['brand'=>Brand::get(),
            'carType'=>CarType::all(),
        'off'=>Off::all(),
            'category'=>Category::all()]);
    }
    public function addProduct(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'count' => 'required|integer',
            'price' => 'required|integer',
            'file' => 'mimes:png'
        ]);

        $product = new Product();
        $product->name=$request->name;
        $product->count=$request->count;
        $product->price=$request->price;
        $product->brand_id=$request->brand_id;
        $product->category_id=$request->category_id;
        $product->carType_id=$request->carType_id;
        $product->off_id=$request->off_id;
        $product->save();

        $destination='prodoucts/'.Product::all()->last()->id;
        if(!is_dir($destination))
            mkdir($destination,0777,true);
        $file=$request->file('file');
        $file->move($destination,'1.png');
        return redirect()->intended('/admin/addProduct')->with('msg','محصول با موقیت افزوده شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }
}
