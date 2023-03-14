<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class productDetails extends Controller
{
    public function showDetails(Request $request) //دریافت رگوئست ارسالی کاربر در صفحه ورود
    {
        return view('productDetails');
    }
}
