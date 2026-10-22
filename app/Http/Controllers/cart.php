<?php

namespace App\Http\Controllers;

use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Session;
use App\Models\Product;
use Illuminate\Support\Arr;


class cart extends Controller
{
    public function decreaseCount(Request $request)
    {
        return $this->updateCount($request);
    }

    public function increaseCount(Request $request)
    {
        return $this->updateCount($request);
    }

    private function updateCount(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|integer|exists:products,id',
            'count' => 'required|integer|min:1',
        ], [
            'id.required' => 'محصول مشخص نشده است.',
            'id.integer' => 'محصول معتبر نیست.',
            'id.exists' => 'این محصول دیگر در دسترس نیست.',
            'count.required' => 'تعداد محصول مشخص نشده است.',
            'count.integer' => 'تعداد محصول باید عدد صحیح باشد.',
            'count.min' => 'حداقل تعداد محصول ۱ است.',
        ]);

        $product = Product::findOrFail($validated['id']);
        $cartProducts = $request->session()->get('products', []);
        if (!array_key_exists($product->id, $cartProducts)) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'id' => 'این محصول در سبد خرید شما نیست.',
            ]);
        }

        $maximum = $product->availability === 'instock'
            ? max(0, (int) $product->count - callCountSellProducts($product->id))
            : 0;
        if ((int) $validated['count'] > $maximum) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'count' => $maximum > 0
                    ? 'موجودی کافی نیست. حداکثر تعداد مجاز: '.$maximum
                    : 'این محصول در حال حاضر موجود نیست.',
            ]);
        }

        $quantity = (int) $validated['count'];
        $cartProducts[$product->id] = $quantity;
        $request->session()->put('products', $cartProducts);

        if ($request->expectsJson()) {
            $totalPrice = Product::whereIn('id', array_keys($cartProducts))->get()
                ->sum(function ($item) use ($cartProducts) {
                    return $item->price * $cartProducts[$item->id];
                });
            $lineTotal = $product->price * $quantity;

            return response()->json([
                'productId' => (int) $product->id,
                'quantity' => $quantity,
                'maxQuantity' => $maximum,
                'lineTotal' => $lineTotal,
                'lineTotalFormatted' => number_format($lineTotal),
                'totalPrice' => $totalPrice,
                'totalPriceFormatted' => number_format($totalPrice),
            ]);
        }

        return redirect('/cart/showCart');
    }


    public function addToCart(Request $request)
    {
        $lastCount = session('products.' . $request->id);
        $validated = $request->validate([
            'count' => 'integer|required|min:1|max:' . stock($request->id) - $lastCount,
            'id' => 'required|integer',
        ]);

        if (stock($request->id) < $request->count || !isInStock($request->id)) {
            return back()->withErrors([
                'outOfRange' => 'موجودی کافی نیست.',
            ]);
        }

        if (session()->has('products.' . $request->id)) {
            session(['products.' . $request->id => $request->count + $lastCount]);
        } else {
            session(['products.' . $request->id => $request->count]);
        }

        return redirect()->intended('/productDetails/' . $request->id)->with('msg', 'محصول با موفقیت به سبد خرید افزوده شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }

    public function showCart()
    {
        $totalPrice = 0;
        $products = array();
        foreach (session('products') as $key => $value) {
            $result = Product::where('id', '=', $key)->get();
            $totalPrice += $result[0]->price * $value;
            $m = $result->toArray();
            $products = Arr::add($products, $key, $m);
        }
        return view('showCart', ['products' => $products, 'totalPrice' => $totalPrice]);
    }

    public function deleteOfCart($id)
    {
        session()->forget('products.' . $id);
        return redirect()->intended('/cart/showCart')->with('msg', 'محصول با موفقیت از سبد خرید حدف شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }

    public function addUserInformation()
    {
        $totalPrice = 0;
        $products = array();
        foreach (session('products') as $key => $value) {
            $result = Product::where('id', '=', $key)->get();
            $totalPrice += $result[0]->price * $value;
            $m = $result->toArray();
            $products = Arr::add($products, $key, $m);
        }
        return view('addUserInformation',['provices'=>Province::all(),'currentLocation'=>User::join('city', 'city.id', '=', 'users.city_id')
            ->join('province_cities', 'province_cities.id', '=', 'city.province_id')
            ->where('users.id','=',Auth::user()->id)
            ->select('city.name as cityName','province_cities.name as provinceCity','province_cities.id as provinceId','city.id as cityId')
            ->get(),'totalPrice' => $totalPrice]);
    }

    public function finalApproval()
    {
        $postPrice = postPrice();
        $totalPrice = 0;
        $products = array();
        foreach (session('products') as $key => $value) {
            $result = Product::where('id', '=', $key)->get();
            $totalPrice += $result[0]->price * $value;
            $m = $result->toArray();
            $products = Arr::add($products, $key, $m);
        }
        return view('finalApproval', ['currentLocation' => User::join('city', 'city.id', '=', 'users.city_id')
            ->join('province_cities', 'province_cities.id', '=', 'city.province_id')
            ->where('users.id', '=', Auth::user()->id)
            ->select('city.name as cityName', 'province_cities.name as provinceCity', 'province_cities.id as provinceId', 'city.id as cityId')
            ->get(), 'sendPrice' => $postPrice, 'totalPrice' => $totalPrice]);
    }
}
