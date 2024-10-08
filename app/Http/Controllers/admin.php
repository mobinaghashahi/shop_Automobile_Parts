<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Buy;
use App\Models\CarType;
use App\Models\Category;
use App\Models\Cart;
use App\Models\Contact;
use App\Models\Off;
use App\Models\Product;
use App\Models\SlideShow;
use App\Models\User;
use App\Models\Visit;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Hash;

class admin extends Controller
{
    public function showDashboard()
    {

        return view('admin.dashboard', ['orders' => Cart::join('users', 'users.id', '=', 'cart.user_id')
            ->where('cart.state', '=', 0)
            ->select('cart.*', 'users.nameAndFamily as name')
            ->get(),
            'registeredOrders' => Cart::join('users', 'users.id', '=', 'cart.user_id')
                ->where('cart.state', '=', 1)
                ->select('cart.*', 'users.nameAndFamily as name')
                ->limit(10)
                ->get(),
            'canceledOrders'=>Cart::join('users', 'users.id', '=', 'cart.user_id')
                ->where('cart.state', '=', 2)
                ->select('cart.*', 'users.nameAndFamily as name')
                ->limit(10)
                ->get(),
            'visitedMonthAgo' => visitedMonthAgo(),
            'webBrowsersVisit' => webBrowsersVisit(),
        ]);
    }

    public function sendProduct(Request $request)
    {
        $validated = $request->validate([
            'postCode' => 'required',
            'idProduct' => 'required|integer',
        ]);
        $buy = Cart::findOrFail($request->idProduct);
        $buy->state = 1;
        $buy->sendPostCode = $request->postCode;
        $buy->save();
        return redirect()->intended('/admin')->with('msg', 'محصول با موفقیت تایید شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }

    public function undoSendProduct($id)
    {
        $buy = Cart::findOrFail($id);
        $buy->state = 0;
        $buy->sendPostCode = '';
        $buy->save();
        return redirect()->intended('/admin')->with('msg', 'محصول با موفقیت از ارسال شده ها حذف شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }

    public function listOrders($id)
    {
        return view('admin.listOrders', ['listOrders' => Buy::join('cart', 'buy.cart_id', '=', 'cart.id')
            ->join('products', 'products.id', '=', 'buy.products_id')
            ->where('cart.id', '=', $id)->select('buy.count', 'buy.price', 'products.name')->get()]);
    }

    public function printForSendProduct($id)
    {

        return view('admin.printForSendProduct', ['cart' => Cart::join('users', 'users.id', '=', 'cart.user_id')
            ->join('city', 'city.id', '=', 'users.city_id')
            ->join('province_cities', 'province_cities.id', '=', 'city.province_id')
            ->where('cart.id', '=', $id)
            ->select('city.name as cityName','province_cities.name as provinceCity','users.address as address','users.postCode as postCode', 'users.address as address'
                ,'users.nameAndFamily as nameAndFamily', 'users.phoneNumber as phoneNumber')
            ->get()]);
    }


    public function showAddProduct()
    {
        return view('admin.addProduct', ['brand' => Brand::get(),
            'carType' => CarType::all(),
            'off' => Off::all(),
            'category' => Category::all()]);
    }

    public function addProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'count' => 'required|integer',
            'price' => 'required|integer',
            'file' => 'mimes:png'
        ]);

        $all = $request->all();

        //پیدا کردن تعداد ماشین هایی که این محصول را شامل میشوند
        $pattern = '/^carType_id_\d+$/';
        $user_array = preg_grep($pattern, array_keys($all));

        foreach ($user_array as $key)
            $carTypes[$key] = $all[$key];
        $carTypes = array_unique($carTypes);

        $index = 1;
        foreach ($carTypes as $carType) {
            //ساختن نام عکس براساس پارامتر ساعت و هش که بتوان آن را در هر بار تولید منحصر به فرد کرد و از مشکلات کش جلوگیری کرد.
            $imageName=md5(time()).'.png';
            $product = new Product();
            $product->name = $request->name;
            $product->count = $request->count;
            $product->price = $request->price;
            //قیمت قدیم کالایی که تازه‌وارد میشود با قیمت فعلی یکسان در نظر گرفته شده است.
            $product->old_price = $request->price;
            $product->brand_id = $request->brand_id;
            $product->category_id = $request->category_id;
            $product->carType_id = $carType;
            $product->off_id = $request->off_id;
            $product->description = $request->description;
            $product->imageName = $imageName;
            $product->availability = $request->availability;
            $product->save();

            $destination = 'products/' . Product::all()->last()->id;
            if (!is_dir($destination))
                mkdir($destination, 0777, true);
            if (!empty($request->file('file')) && $index == 1) {
                $file = $request->file('file');
                $file->move($destination, $imageName);
                $firstProductSaveId = Product::all()->last()->id;
            } else if ($index != 1) {
                copy('products/' . $firstProductSaveId . '/'.$imageName, $destination . '/1.png');
            }
            $index++;
        }

        /*
                //این مکان نیاز به توجه جدی دارد و افتضاح ترین بخش کد من است، این صرفا بخاطر اضافه کردن یک ویژگی جدید است که بسیار احمقانه نوشته شده است.
                for ($i = 1; $i <= $request->countCarTypeFild; $i++) {
                    $carType_id="carType_id_".$i;
                    $product = new Product();
                    $product->name = $request->name;
                    $product->count = $request->count;
                    $product->price = $request->price;
                    $product->brand_id = $request->brand_id;
                    $product->category_id = $request->category_id;
                    $product->carType_id = $request->$carType_id;
                    $product->off_id = $request->off_id;
                    $product->description = $request->description;
                    $product->save();

                    $destination = 'products/' . Product::all()->last()->id;
                    if (!is_dir($destination))
                        mkdir($destination, 0777, true);
                    if (!empty($request->file('file'))&&$i==1) {
                        $file = $request->file('file');
                        $file->move($destination, '1.png');
                        $firstProductSaveId=Product::all()->last()->id;
                    }else{
                        copy('products/'.$firstProductSaveId.'/1.png',$destination.'/1.png');
                    }
                }*/
        return redirect()->intended('/admin/addProduct')->with('msg', 'محصول با موفقیت افزوده شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }

    public function showEditProductPanel()
    {
        return view('admin.editProductPanel', ['products' => Product::join('brand', 'brand.id', '=', 'products.brand_id')
            ->join('cartype', 'cartype.id', '=', 'products.cartype_id')
            ->join('category', 'category.id', '=', 'products.category_id')
            ->join('off', 'off.id', '=', 'products.off_id')
            ->select('products.*', 'brand.name as brandName',
                'cartype.name as carTypeName', 'category.name as categoryName'
                , 'off.name as offName')
            ->get()]);
    }

    public function showEditProduct($id)
    {
        return view('admin.editProduct', ['currentlyProduct' => Product::join('brand', 'brand.id', '=', 'products.brand_id')
            ->join('cartype', 'cartype.id', '=', 'products.cartype_id')
            ->join('category', 'category.id', '=', 'products.category_id')
            ->join('off', 'off.id', '=', 'products.off_id')->where('products.id', '=', $id)
            ->select('products.*', 'brand.name as brandName',
                'cartype.name as carTypeName', 'category.name as categoryName'
                , 'off.name as offName')
            ->get(),
            'brand' => Brand::all(),
            'carType' => CarType::all(),
            'off' => Off::all(),
            'category' => Category::all()]);
    }

    public function editProduct(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'availability' => 'required',
            'count' => 'required|integer',
            'price' => 'required|integer',
            'file' => 'mimes:png'
        ]);
        $product = Product::findOrFail($request->id);

        //ساختن نام عکس براساس پارامتر ساعت و هش که بتوان آن را در هر بار تولید منحصر به فرد کرد و از مشکلات کش جلوگیری کرد.
        $imageName=md5(time()).'.png';

        //فقط ادمین میتواند تغییر دهد.
        if(!empty(Auth::user()->userType)&&Auth::user()->hasRole(['admin'])) {
            $product->name = $request->name;
            $product->count = $request->count;
            //قیمت قدیم محصول برابر میشود با قیمتی که قبلا بوده است.
            $product->old_price = $product->price;
            $product->price = $request->price;
            $product->brand_id = $request->brand_id;
            $product->category_id = $request->category_id;
            $product->carType_id = $request->carType_id;
            $product->off_id = $request->off_id;
            $product->description = $request->description;
            $product->availability = $request->availability;
            $product->save();
        }
        if (!empty($request->file)) {
            $destination = 'products/' . $request->id;
            if (!is_dir($destination))
                mkdir($destination, 0777, true);
            if (!empty($request->file('file'))) {
                $file = $request->file('file');
                $file->move($destination, $imageName);
            }
            $product->imageName = $imageName;
            $product->save();
        }
        return redirect()->intended('/admin/editProduct/' . $request->id)->with('msg', 'محصول با موفقیت ویرایش شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }

    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        $imagePath = 'products/' . $id;
        $mask = $imagePath . "/*";
        if (is_dir($imagePath)) {
            //برای حذف یک دایرکتوری در php باید اول تمام فایل های موجود در آن دایرکتوری را حذف کرد و بعد آن دایرکتوری را حذف کرد
            array_map("unlink", glob($mask));
            rmdir($imagePath);
        }
        return redirect()->intended('/admin/editProductPanel')->with('msg', 'محصول با موفقیت حذف شد.');
    }


    public function showAddBrand()
    {
        return view('admin.addBrand',['offs'=>Off::all()]);
    }

    public function addBrand(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'file' => 'required',
            'off_id' => 'required|integer',
        ]);
        $brand = new Brand();
        $brand->name = $request->name;
        $brand->off_id = $request->off_id;
        $brand->save();

        $destination = 'brand/' . Brand::all()->last()->id;
        if (!is_dir($destination))
            mkdir($destination, 0777, true);
        $file = $request->file('file');
        $file->move($destination, '1.png');

        return redirect()->intended('/admin/addBrand')->with('msg', 'برند با موفقیت افزوده شد.');
    }

    public function showEditBrandPanel()
    {
        return view('admin.editBrandPanel', ['brands' => Brand::all()]);
    }

    public function showEditBrand($id)
    {
        return view('admin.editBrand', ['brand' => Brand::join('off','brand.off_id','=','off.id')
            ->select('brand.name as brandName','brand.id as id','off.name as offName','off.id as offID')
            ->where('brand.id', '=', $id)->get(),
            'offs'=>Off::all()]);
    }

    public function editBrand(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'file' => 'mimes:png',
            'off_id' => 'required|integer'
        ]);
        $brand = Brand::findOrFail($request->id);
        if(!empty(Auth::user()->userType)&&Auth::user()->hasRole(['admin'])) {
            $brand->name = $request->name;
            $brand->off_id = $request->off_id;
            $brand->save();
        }
        if (!empty($request->file)) {
            $destination = 'brand/' . $request->id;
            if (!is_dir($destination))
                mkdir($destination, 0777, true);

            $file = $request->file('file');
            $file->move($destination, '1.png');
        }
        return redirect()->intended('/admin/editBrand/' . $request->id)->with('msg', 'برند با موفقیت ویرایش شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }

    public function deleteBrand($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();
        $imagePath = 'brand/' . $id;
        $mask = $imagePath . "/*";
        if (is_dir($imagePath)) {
            //برای حذف یک دایرکتوری در php باید اول تمام فایل های موجود در آن دایرکتوری را حذف کرد و بعد آن دایرکتوری را حذف کرد
            array_map("unlink", glob($mask));
            rmdir($imagePath);
        }
        return redirect()->intended('/admin/editBrandPanel')->with('msg', 'برند با موفقیت حذف شد.');
    }


    public function showAddCarType()
    {
        return view('admin.addCarType');
    }

    public function addCarType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'companyName' => 'required',
        ]);
        $carType = new CarType();
        $carType->name = $request->name;
        $carType->companyName = $request->companyName;
        $carType->save();

        return redirect()->intended('/admin/addCarType')->with('msg', 'ماشین با موفقیت افزوده شد.');
    }

    public function showEditCarTypePanel()
    {
        return view('admin.editCarTypePanel', ['carTypes' => CarType::all()]);
    }

    public function deleteCarType($id)
    {
        $carType = CarType::findOrFail($id);
        $carType->delete();
        return redirect()->intended('/admin/editCarTypePanel')->with('msg', 'ماشین با موفقیت حذف شد.');
    }

    public function showEditCarType($id)
    {
        return view('admin.editCarType', ['carType' => CarType::where('id', '=', $id)->get()]);
    }

    public function editCarType(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'companyName' => 'required'
        ]);
        $carType = CarType::findOrFail($request->id);
        $carType->name = $request->name;
        $carType->companyName = $request->companyName;
        $carType->save();
        return redirect()->intended('/admin/editCarType/' . $request->id)->with('msg', 'نوع ماشین با موفقیت ویرایش شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }


    public function showAddOff()
    {
        return view('admin.addOff',['brand' => Brand::all()]);
    }

    public function addOff(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'percent' => 'required|integer|min:0|max:100',
        ]);
        $off = new Off();
        $off->name = $request->name;
        $off->percent = $request->percent;
        $off->save();

        return redirect()->intended('/admin/addOff')->with('msg', 'تخفیف با موفقیت افزوده شد.');
    }

    public function showEditOffPanel()
    {
        return view('admin.editOffPanel', ['offs' => Off::all()]);
    }

    public function deleteOff($id)
    {
        $off = Off::findOrFail($id);
        $off->delete();
        return redirect()->intended('/admin/editOffPanel')->with('msg', 'تخفیف با موفقیت حذف شد.');
    }

    public function showEditOff($id)
    {
        return view('admin.editOff', ['off' => Off::where('off.id', '=', $id)
            ->select('off.id as offID','off.name as offName','off.percent as offPercent')
            ->get(),'brand'=>Brand::all()]);
    }

    public function editOff(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'percent' => 'required|integer|min:0|max:100',
        ]);
        $off = Off::findOrFail($request->id);
        $off->name = $request->name;
        $off->percent = $request->percent;
        $off->save();
        return redirect()->intended('/admin/editOff/' . $request->id)->with('msg', 'تخفیف با موفقیت ویرایش شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }


    public function showAddCategory()
    {
        return view('admin.addCategory');
    }

    public function addCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'file' => 'mimes:png|required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        $destination = 'category/' . Category::all()->last()->id;
        if (!is_dir($destination))
            mkdir($destination, 0777, true);
        if (!empty($request->file('file'))) {
            $file = $request->file('file');
            $file->move($destination, '1.png');
        }

        return redirect()->intended('/admin/addCategory')->with('msg', 'دسته بندی با موفقیت افزوده شد.');
    }

    public function showEditCategoryPanel()
    {
        return view('admin.editCategoryPanel', ['categorys' => Category::all()]);
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        $imagePath = 'category/' . $id;
        $mask = $imagePath . "/*";
        if (is_dir($imagePath)) {
            //برای حذف یک دایرکتوری در php باید اول تمام فایل های موجود در آن دایرکتوری را حذف کرد و بعد آن دایرکتوری را حذف کرد
            array_map("unlink", glob($mask));
            rmdir($imagePath);
        }
        return redirect()->intended('/admin/editCategoryPanel')->with('msg', 'دسته بندی با موفقیت حذف شد.');
    }

    public function showEditCategory($id)
    {
        return view('admin.editCategory', ['category' => Category::where('id', '=', $id)->get()]);
    }

    public function editCategory(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'file' => 'mimes:png',
        ]);
        $category = Category::findOrFail($request->id);
        if(!empty(Auth::user()->userType)&&Auth::user()->hasRole(['admin'])) {
            $category->name = $request->name;
            $category->save();
        }

        $destination = 'category/' . $request->id;
        if (!is_dir($destination))
            mkdir($destination, 0777, true);
        if (!empty($request->file('file'))) {
            $file = $request->file('file');
            $file->move($destination, '1.png');
        }
        return redirect()->intended('/admin/editCategory/' . $request->id)->with('msg', 'دسته بندی با موفقیت ویرایش شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }

    public function showMessages()
    {
        return view('admin.showMessages', ['messages' => Contact::orderBy('id', 'DESC')->get()]);
    }

    public function seenMessage($id)
    {
        $message = Contact::findOrFail($id);
        $message->state = 1;
        $message->save();
        return redirect()->intended('/admin/showMessages')->with('msg', 'پیام مشاهده شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }

    public function listCarTypeForJquary($id)
    {
        return view('admin/listCarTypeForJquary', ['id' => $id, 'carType' => CarType::all()]);
    }

    public function showAddSlideShow()
    {
        return view('admin/addSlideShow');
    }

    public function addSlideShow(Request $request)
    {

        $validated = $request->validate([
            'file' => 'required',
        ]);
        $file = $request->file('file');
        $format = explode('.', $request->file('file')->getClientOriginalName());
        $imageName = substr(md5($request->file('file')->getClientOriginalName() . rand(1, 5000000000)), 0, 5) . '.' . $format[1];
        $slideShow = new SlideShow();
        $slideShow->name = $imageName;
        $slideShow->save();
        $destination = 'slideshow';
        if (!is_dir($destination))
            mkdir($destination, 0777, true);
        if (!empty($request->file('file'))) {
            $file = $request->file('file');
            $file->move($destination, $imageName);
        }
        return redirect()->intended('/admin/addSlideShow')->with('msg', 'اسلاید با موفقیت افزوده شد.');
    }

    public function showEditSlideShowPanel()
    {
        return view('admin/editSlideShowPanel', ['slideShows' => SlideShow::all()]);
    }

    public function showEditSlideShow($id)
    {
        return view('admin/editSlideShow', ['slideShow' => SlideShow::findOrFail($id)]);
    }

    public function deleteSlideShow($id)
    {
        $slideShow = SlideShow::findOrFail($id);
        $sileShowName = $slideShow->name;
        $slideShow->delete();
        $imagePath = 'slideshow';
        $mask = $imagePath . "/" . $sileShowName;
        if (is_dir($imagePath)) {
            //حذف یک فایل در php به این صورت انجام میشود.
            array_map("unlink", glob($mask));
        }
        return redirect()->intended('/admin/editSlideShowPanel')->with('msg', 'اسلاید با موفقیت حذف شد.');
    }

    public function editSlideShow(Request $request)
    {
        $validated = $request->validate([
            'file' => 'required',
        ]);
        $slideShow = SlideShow::findOrFail($request->id);
        $slideShowOldName = $slideShow->name;
        $format = explode('.', $request->file('file')->getClientOriginalName());
        $sileShowName = $imageName = substr(md5($request->file('file')->getClientOriginalName() . rand(1, 5000000000)), 0, 5) . '.' . $format[1];
        $slideShow->name = $sileShowName;
        $slideShow->save();
        $imagePath = 'slideshow';
        $mask = $imagePath . "/" . $slideShowOldName;
        if (is_dir($imagePath)) {
            //حذف یک فایل در php به این صورت انجام میشود.
            array_map("unlink", glob($mask));
        }
        if (!empty($request->file('file'))) {
            $file = $request->file('file');
            $file->move($imagePath, $sileShowName);
        }
        return redirect()->intended('/admin/editSlideShow/' . $slideShow->id)->with('msg', 'اسلاید با موفقیت ویرایش شد.');
    }

    public function editAllProductPricePanel()
    {
        return view("admin/editAllProductPrice",['brands'=>Brand::all()]);
    }

    public function editAllProductPrice(Request $request)
    {
        $validated = $request->validate([
            'price' => 'required',
            'brand' => 'required|integer',
            'reduceOrIncrease' => 'in:increase,reduce',
            'percentOrToman' => 'in:percent,toman',
        ]);

        //انتخاب تمامی برند ها
        if($request->brand==0)
            $products = Product::all();
        //انتخاب یک برند خاص
        else
            $products= Product::where('brand_id','=',$request->brand)->get();


        foreach ($products as $product) {
            if ($request->percentOrToman == 'toman') {

                if ($request->reduceOrIncrease == 'reduce'){
                    $product->old_price = $product->price;
                    $product->price = $product->price - (int)$request->price;
                }
                else
                {
                    $product->old_price = $product->price;
                    $product->price = $product->price + (int)$request->price;
                }

                //اگر قیمت محصولی منفی یا صفر شد مجاز به انجام چنین ویرایش قیمتی نیست.
                if ($product->price <= 0) {
                    $errors = new MessageBag([
                        'badRequest' => ['شما مجاز به انجام این عملیات نیستید.'],
                    ]);
                    return redirect()->intended('/admin/editAllProductPrice')->with('errors', $errors);
                }

            }
            else if ($request->percentOrToman == 'percent') {

                if ($request->reduceOrIncrease == 'reduce')
                {
                    $product->old_price = $product->price;
                    $product->price = $product->price - (($product->price*(int)$request->price)/100);
                }
                else
                {
                    $product->old_price = $product->price;
                    $product->price = $product->price + (($product->price*(int)$request->price)/100);
                }


                //اگر قیمت محصولی منفی یا صفر شد مجاز به انجام چنین ویرایش قیمتی نیست.
                if ($product->price <= 0) {
                    $errors = new MessageBag([
                        'badRequest' => ['شما مجاز به انجام این عملیات نیستید. قیمت برخی از کالاها منفی خواهد شد.'],
                    ]);
                    return redirect()->intended('/admin/editAllProductPrice')->with('errors', $errors);
                }
            }
        }




        foreach ($products as $product) {
            $product->save();
        }
        return redirect()->intended('/admin/editAllProductPrice')->with('msg', 'تغییر با موفقیت انجام شد.');
    }

    public function undoCancelOrders($id){
        $buy = Cart::findOrFail($id);
        $buy->state = 0;
        $buy->sendPostCode = '';
        $buy->save();
        return redirect()->intended('/admin')->with('msg', 'سفارش با موفقیت از لیست لغو شده ها حذف شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }

    public function cancelOrder($id){
        $buy = Cart::findOrFail($id);
        $buy->state = 2;
        $buy->sendPostCode = '';
        $buy->save();
        return redirect()->intended('/admin')->with('msg', 'سفارش با موفقیت لغو شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }
}
