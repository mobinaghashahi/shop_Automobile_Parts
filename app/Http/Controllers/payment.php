<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Models\Buy;
use App\Models\Cart;
use App\Models\Product;

use Illuminate\Support\Facades\Auth;

class payment extends Controller
{
    public function pay()
    {
        $totalPrice = totalPriceCart();
        $response = pay($totalPrice);


        $authority = json_decode($response)->data->authority;

        session(['amount' => $totalPrice]);
        session(['authority' => $authority]);

        return redirect()->intended('https://www.zarinpal.com/pg/StartPay/' . $authority);

    }

    public function verify()
    {

        $response = verify();
        $responseValidation = responseCodeChecker($response);

        if ($responseValidation == "ok" || $responseValidation == "differentCost") {

            //ذخیره کردن سبد خرید
            $cart = new Cart();
            $cart->state = 0;
            $cart->totalPrice = session('amount');
            $cart->paymentCode = json_decode($response)->data->ref_id;
            $cart->user_id = Auth::user()->id;
            $cart->save();

            //ذخیره کردن لیست اقلام خریداری شده
            foreach (session('products') as $key => $value) {
                $result = Product::where('id', '=', $key)->get();
                $buy = new Buy();
                $buy->price = $result[0]->price;
                $buy->products_id = $key;
                $buy->cart_id = $cart->id;
                $buy->count = $value;
                $buy->save();
            }
            //پاک کردن سبد خرید
            session()->forget('products');
            return redirect()->intended('/user/orders')->with('msg', 'پرداخت با موفقیت انجام شد.');;
        }
        return redirect()->intended('/cart/showCart')->with('error', 'در پرداخت مشکلی پیش آمده است. مجددا تلاش کنید.');

    }
}
