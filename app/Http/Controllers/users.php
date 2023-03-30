<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class users extends Controller
{
    public function showDashboard(){
        return view('user.dashboard');
    }

    public function showProfile(){
        return view('user.profile');
    }
    public function editProfile(Request $request){
        $validated = $request->validate([ //داده ها را اعتبار سنجی می کنیم
            'phoneNumber' => ['required',
            'regex:/[0]{1}[0-9]{10}/','min:11','max:11'
                ,Rule::unique('users')->ignore(Auth::user()->id)],
            'nameAndFamily' => 'required|max:255',
            'postCode' => 'max:10|min:10',
        ]);

        $user = User::findOrFail(Auth::user()->id);

        //اگر کاربر اقدام به تغییر پسوورد کرد
        if(!empty($request->oldPassword)&& Hash::check($request->oldPassword, Auth::user()->password))
        {
            $validatedPassword = $request->validate([
                'newPassword' => 'required|max:255|min:6|required_with:passwordConfirmation|same:passwordConfirmation',
            ]);
            $user->password = Hash::make($request->newPassword);
        }

        $user->nameAndFamily = $request->nameAndFamily;
        $user->phoneNumber = $request->phoneNumber;
        $user->address = $request->address;
        $user->postCode = $request->postCode;
        $user->save();

        return redirect()->intended('/user/profile' . $request->id)->with('msg', 'مشخصات شما با موفقیت ویرایش شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم

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
