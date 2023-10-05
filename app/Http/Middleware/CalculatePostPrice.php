<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
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
        $validated = $request->validate([ //داده ها را اعتبار سنجی می کنیم
            'phoneNumber' => ['required',
                'regex:/[0]{1}[0-9]{10}/','min:11','max:11'
                ,Rule::unique('users')->ignore(Auth::user()->id)],
            'nameAndFamily' => 'required|max:255',
            'postCode' => 'required|max:10|min:10',
            'address' => 'required',
            'city'=>'required|integer|min:1|max:1881'
        ]);

        $user = User::findOrFail(Auth::user()->id);


        $user->nameAndFamily = $request->nameAndFamily;
        $user->phoneNumber = $request->phoneNumber;
        $user->address = $request->address;
        $user->postCode = $request->postCode;
        $user->city_id = $request->city;
        $user->save();

        return $next($request);
    }
}
