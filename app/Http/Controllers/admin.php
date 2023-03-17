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
        $product->description=$request->description;
        $product->save();

        $destination='prodoucts/'.Product::all()->last()->id;
        if(!is_dir($destination))
            mkdir($destination,0777,true);
        $file=$request->file('file');
        $file->move($destination,'1.png');
        return redirect()->intended('/admin/addProduct')->with('msg','محصول با موفقیت افزوده شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }



    public function showAddBrand(){
        return view('admin.addBrand');
    }
    public function addBrand(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'file' => 'required',
        ]);
        $brand = new Brand();
        $brand->name=$request->name;
        $brand->save();

        $destination='brand/'.Brand::all()->last()->id;
        if(!is_dir($destination))
            mkdir($destination,0777,true);
        $file=$request->file('file');
        $file->move($destination,'1.png');

        return redirect()->intended('/admin/addBrand')->with('msg','برند با موفقیت افزوده شد.');
    }



    public function showAddCarType(){
        return view('admin.addCarType');
    }
    public function addCarType(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'companyName' => 'required',
        ]);
        $carType = new CarType();
        $carType->name=$request->name;
        $carType->companyName=$request->companyName;
        $carType->save();

        return redirect()->intended('/admin/addCarType')->with('msg','ماشین با موفقیت افزوده شد.');
    }



    public function showAddOff(){
        return view('admin.addOff');
    }
    public function addOff(Request $request){
        $validated = $request->validate([
            'name' => 'required',
            'percent'=>'required|integer'
        ]);
        $off = new Off();
        $off->name=$request->name;
        $off->percent=$request->percent;
        $off->save();

        return redirect()->intended('/admin/addOff')->with('msg','تخفیف با موفقیت افزوده شد.');
    }


    public function showAddCategory(){
        return view('admin.addCategory');
    }
    public function addCategory(Request $request){
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $category = new Category();
        $category->name=$request->name;
        $category->save();

        return redirect()->intended('/admin/addCategory')->with('msg','دسته بندی با موفقیت افزوده شد.');
    }
}
