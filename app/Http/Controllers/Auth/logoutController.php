<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class logoutController extends Controller
{
    public function logout(Request $request)
    {
        Auth::logout(); //باطل کردن احراز هویت فعلی

        $request->session()->invalidate(); //نامعتبر سازی سشن های فعلی

        $request->session()->regenerateToken(); //تولید مجدد توکن

        return redirect('/login'); //ریدایرکت کاربر به صفحه اصلی
    }
}
