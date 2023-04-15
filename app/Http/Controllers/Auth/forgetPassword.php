<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ForgetPass;
use Illuminate\Http\Request;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class forgetPassword extends Controller
{
    public function forgetPasswordShow()
    {
        return view("forgetPassword");
    }

    public function forgetPasswordSendSms(Request $request)
    {
        $validated = $request->validate([
            'phoneNumber' => 'required|regex:/[0]{1}[0-9]{10}/|min:11|max:11',
        ]);
        $user = User::where('phoneNumber', '=', $request->phoneNumber)->get();

        //در صورت وجود نداشتن کاربر
        if ($user->count() == 0) {
            return back()->withErrors([ //کاربر پیدا نشد و هنگام بازگشت به صفحه ورود خطا را نشان میدهیم
                'phoneNumber' => 'کاربری با این مشخصات وجود ندارد',
            ]);
        }

        $code = generateCode();

        $forgetPass = new ForgetPass();
        $forgetPass->code = $code;
        $forgetPass->user_id = $user[0]->id;
        $forgetPass->date = Verta::now();
        $forgetPass->save();

        sendSmsForgetPassword($request->phoneNumber,$code);

        $encryptPhoneNumber = Crypt::encrypt($request->phoneNumber);

        return redirect()->intended('/enterForgetPasswordCode/' . $encryptPhoneNumber)->with('msg', 'کد بازیابی ارسال شد.');
    }

    public function showEnterForgetPasswordCode($phoneNumber)
    {
        return view('enterForgetPasswordCode', ['encryptPhoneNumber' => $phoneNumber]);
    }

    public function enterForgetPasswordCode(Request $request)
    {

        $phoneNumber = Crypt::decrypt($request->phoneNumber);

        $forgetPass = ForgetPass::join('users', 'users.id', '=', 'forgetpassword.user_id')
            ->where('users.phoneNumber', '=', $phoneNumber)
            ->select('forgetpassword.*', 'users.id as userId')
            ->orderBy('id', 'DESC')
            ->first();

        //اگر زمان کد از 5 دقیقه گذشته بود و یا با 4 اشتباه وارد کردن کد روبرو بودیم به صفحه ارسال مجدد کد بر میگردد
        if (diffrentMin($forgetPass->date) > 5 || $forgetPass->countTry > 4) {
            return redirect()->intended('/forgetPassword')->withErrors([ //کاربر پیدا نشد و هنگام بازگشت به صفحه ورود خطا را نشان میدهیم
                'expired' => 'تاریخ انقضای کد گذشته است. مجددا تلاش کنید.',
            ]);
        }

        //صحیح وارد کردن کد بازیابی
        if ($request->code == $forgetPass->code) {
            session(['userKey' => $forgetPass->userId]);
            return redirect()->intended('/changeForgetPassword');
        } //اشتباه وارد کردن کد بازیابی
        else {
            //اضاف کردن شمارش تلاش اشتباه
            $forgetPass->countTry = $forgetPass->countTry + 1;
            $forgetPass->save();

            return back()->withErrors([ //کاربر پیدا نشد و هنگام بازگشت به صفحه ورود خطا را نشان میدهیم
                'expired' => 'کد اشتباه است. مجددا تلاش کنید.',
            ]);
        }
    }

    public function changeForgetPassword(){
        return view("changeForgetPassword");
    }

    public function validateChangeForgetPassword(Request $request){
        $validated = $request->validate([
            'password' => 'required|max:255|min:6|required_with:password_confirmation|same:password_confirmation',
        ]);

        $user=User::where('id','=',session('userKey'))->first();
        $user->password=Hash::make($request->password);
        $user->save();

        session()->forget('userKey');
        return redirect()->intended('/login')->with('msg', 'رمز عبور با موفقیت تغییر کرد.');
    }
}
