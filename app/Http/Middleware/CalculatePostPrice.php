<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use function PHPUnit\Framework\isNull;

class CalculatePostPrice
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->city_id!=null)
            return $next($request);
        return redirect()->intended('/user/profile')->with('msg', 'برای تکمیل فرایند ابتدا آدرس خود را تکمیل نمیاید!');
    }
}
