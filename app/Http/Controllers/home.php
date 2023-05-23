<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\SlideShow;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
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
            'slideShows'=>SlideShow::all()]);
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

    public function showResults(Request $request)
    {
        $validated = $request->validate([
            'text' => 'string',
        ]);
        $whereNameItems=array();
        $whereDescriptionItems=array();
        $allResult=array();

        $texts = explode(' ', $request->get('text'));

        foreach ($texts as $text){
            $whereNameItems[] = ['name', 'like', '%' . $text . '%'];
            $whereDescriptionItems[] = ['description', 'like', '%' . $text . '%'];
        }

        $resultsNameProduct=Product::where($whereNameItems)->get();
        $resultsDescriptionProduct=Product::where($whereDescriptionItems)->get();
        foreach ($resultsNameProduct as $item) {
            if(!$resultsDescriptionProduct->contains('id',$item->id)){
                $resultsDescriptionProduct->push($item);
            }
        }

        return view('home.showSearchResults',['products'=>$resultsDescriptionProduct]);
    }
}
