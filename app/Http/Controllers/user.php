<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class user extends Controller
{
    public function showDashboard(){
        return view('user.dashboard');
    }

    public function showProfile(){
        return view('user.profile');
    }
    public function showOrders(){
        return view('user.orders',['orders'=>Cart::where('user_id','=',Auth::user()->id)->get()]);
    }
    public function showOrderDetails($id){
        return view('user.oderDetails',['buys'=>Buy::join('products', 'products.id', '=', 'buy.products_id')
            ->where('cart_id','=',$id)
            ->select('cart_id as cartId','products.name', 'buy.count as count','buy.price as price')
            ->get()]);
    }
}
