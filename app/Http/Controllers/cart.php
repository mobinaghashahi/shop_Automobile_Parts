<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MongoDB\Driver\Session;
use App\Models\Product;
use Illuminate\Support\Arr;


class cart extends Controller
{
    public function decreaseCount(Request $request){
        $validated = $request->validate([
            'count' => 'integer|required|min:1|max:'.stock($request->id),
            'id' => 'required|integer',
        ]);
        session(['products.'.$request->id=>$request->count]);
        return redirect()->intended('/cart/showCart'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }
    public function increaseCount(Request $request){
        $validated = $request->validate([
            'count' => 'integer|required|min:1|max:'.stock($request->id),
            'id' => 'required|integer',
        ]);
        session(['products.'.$request->id=>$request->count]);
        return redirect()->intended('/cart/showCart'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }

    public function  addToCart(Request $request){
        $lastCount=session('products.'.$request->id);
        $validated = $request->validate([
            'count' => 'integer|required|min:1|max:'.stock($request->id)-$lastCount,
            'id' => 'required|integer',
        ]);

        if(stock($request->id)<$request->count)
        {
            return back()->withErrors([
                'outOfRange' => 'موجودی کافی نیست.',
            ]);
        }

        if(session()->has('products.'.$request->id)) {
            session(['products.'.$request->id=>$request->count+$lastCount]);
        }
        else{
            session(['products.'.$request->id=>$request->count]);
        }

        return redirect()->intended('/productDetails/' . $request->id)->with('msg', 'محصول با موفقیت به سبد خرید افزوده شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }

    public function showCart(){
        $totalPrice=0;
        $postPrice=postPrice();
        $products=array();
        foreach (session('products') as $key => $value){
            $result=Product::where('id','=',$key)->get();
            $totalPrice+=$result[0]->price*$value;
            $m=$result->toArray();
            $products=Arr::add($products,$key,$m);
        }
        return view('showCart',['products'=>$products,'totalPrice'=>$totalPrice,'sendPrice'=>$postPrice]);
    }
    public function deleteOfCart($id){
        session()->forget('products.'.$id);
        return redirect()->intended('/cart/showCart')->with('msg', 'محصول با موفقیت از سبد خرید حدف شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }
}
