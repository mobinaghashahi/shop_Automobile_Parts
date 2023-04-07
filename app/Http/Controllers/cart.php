<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Driver\Session;
use App\Models\Product;
use Illuminate\Support\Arr;


class cart extends Controller
{
    public function  addToCart(Request $request){
        $validated = $request->validate([
            'count' => 'integer|required|min:1',
            'id' => 'required|integer',
        ]);

        if(session()->has('products.'.$request->id)) {
            $lastCount=session('products.'.$request->id);
            session(['products.'.$request->id=>$request->count+$lastCount]);
        }
        else{
            session(['products.'.$request->id=>$request->count]);
        }

        return redirect()->intended('/productDetails/' . $request->id)->with('msg', 'محصول با موفقیت به سبد خرید افزوده شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }

    public function showCart(){
        $products=array();
        foreach (session('products') as $key => $value){
            $result=Product::where('id','=',$key)->get();
            $m=$result->toArray();
            $products=Arr::add($products,$key,$m);
        }
        return view('showCart',['products'=>$products]);
    }
    public function deleteOfCart($id){
        session()->forget('products.'.$id);
        return redirect()->intended('/cart/showCart')->with('msg', 'محصول با موفقیت از سبد خرید حدف شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }
}
