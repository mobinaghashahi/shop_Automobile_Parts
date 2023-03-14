<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class registerController extends Controller
{
    public function register(Request $request) //رگوئست ارسالی کاربر از صفحه ثبت نام رو دریافت می کنیم
    {
        $validated = $request->validate([ //داده ها را اعتبار سنجی می کنیم
            'phoneNumber' => 'required|unique:users|max:255',
            'nameAndFamily' => 'required|max:255',
            'password' => 'required|max:255|min:6',
        ]);
        $user = new User(); //یک شی جدید از روی مدل یوزر میسازیم
        $user->password = Hash::make($request->password); //پسورد را ابتدا با روش بی کریپت هش میکنیم
        $user->phoneNumber = $request->phoneNumber; //ایمیل ارسالی را دریافت می کنیم
        $user->nameAndFamily = $request->nameAndFamily; //ایمیل ارسالی را دریافت می کنیم
        $user->save(); //اطلاعات را پایگاه داده ثبت می کنیم
        return redirect()->intended('/'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }
}
