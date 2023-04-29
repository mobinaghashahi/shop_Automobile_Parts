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

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://api.zarinpal.com/pg/v4/payment/request.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
  "merchant_id": "91553fab-dac6-4b9f-85b4-2813c98e5bad",
  "amount": "' . $totalPrice . '",
  "callback_url": "https://yadakasli.ir/payment/verify",
  "description": "Transaction description.",
  "currency": "IRT",
  "metadata": {
  }
}',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

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
