<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Cities;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Province;
use App\Models\SlideShow;
use App\Models\User;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Arr;

class home extends Controller
{
    public function showHome()
    {
        //this is for fix groupBy error!!!!!
        \DB::statement("SET SQL_MODE=''");
        return view('home.home', ['products' => Product::orderBy('id', 'DESC')->groupBy('name')->get(),
            'categorys' => Category::all(),
            'categoryExist' => Product::select('category_id')->groupBy('category_id')->get()->toArray(),
            'slideShows' => SlideShow::all()]);
    }

    public function aboutUs()
    {
        return view('home.aboutUs');
    }

    public function showContact()
    {
        return view('home.contact');
    }

    public function sendMessage(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'title' => 'required',
            'email' => 'required|email',
            'phoneNumber' => 'required|regex:/[0]{1}[0-9]{10}/|min:11|max:11',
            'description' => 'required'
        ]);
        $contact = new Contact();
        $contact->name = $request->name;
        $contact->title = $request->title;
        $contact->email = $request->email;
        $contact->phoneNumber = $request->phoneNumber;
        $contact->description = $request->description;
        $contact->date = Verta::now();
        $contact->save();
        return redirect()->intended('/contact')->with('msg', 'با تشکر از پیام شما.');
    }


    public function cities($id)
    {

        $currentLocation = User::join('city', 'city.id', '=', 'users.city_id')
            ->join('province_cities', 'province_cities.id', '=', 'city.province_id')
            ->where('users.id', '=', Auth::user()->id)
            ->select('city.name as cityName', 'province_cities.name as provinceCity', 'province_cities.id as provinceId', 'city.id as cityId')
            ->get();
        $citys = Cities::where('province_id', '=', $id)->get();

        $options = '';
        if($currentLocation->count()!=0&&$id==$currentLocation[0]->provinceId)
            $options .= "<option value='" . $currentLocation[0]->cityId . "'>" . $currentLocation[0]->cityName . "</option>";
        if($id==0)
            $options .= "<option value='0'>ابتدا استان مورد نظر خود را انتخاب نمایید</option>";
        foreach ($citys as $city)
            $options .= "<option value='" . $city->id . "'>" . $city->name . "</option>";
        return $options;
    }

}
