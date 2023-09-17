<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function login(Request $request) //دریافت رگوئست ارسالی کاربر در صفحه ورود
    {
        $validated = $request->validate([ //داده ها رو اعتبار سنجی میکنیم
            'phoneNumber' => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required|captcha',
        ]);
        $credentials = $request->only('phoneNumber', 'password'); //فیلد های مورد نظر رو داخل متغیر میریزیم
        if (Auth::attempt($credentials)) { //اگر کاربری با مشخصات داده شده موجود باشد نتیجه صحیح باز میگردد
            $request->session()->regenerate(); //سشن را بازسازی می کنیم
            saveLoginLog($request->phoneNumber);
            return redirect()->intended('/'); //کاربر احراز هویت شده را با داشبورد منتقل می کنیم
        }
        return back()->withErrors([ //کاربر پیدا نشد و هنگام بازگشت به صفحه ورود خطا را نشان میدهیم
            'phoneNumber' => 'کاربری با این مشخصات وجود ندارد',
        ]);
    }
    public function loginView(Request $request) //دریافت رگوئست ارسالی کاربر در صفحه ورود
    {
        return view('login');
    }
}
