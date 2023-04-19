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
use App\Models\User;
use App\Models\Visit;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;

class admin extends Controller
{
    public function showDashboard()
    {

        return view('admin.dashboard', ['orders' => Cart::join('users', 'users.id', '=', 'cart.user_id')
            ->where('cart.state', '=', 0)
            ->select('cart.*', 'users.nameAndFamily as name')
            ->get(),
            'visitedMonthAgo' => visitedMonthAgo(),
            'webBrowsersVisit' => webBrowsersVisit(),
        ]);
    }

    public function sendProduct($id)
    {
        $buy = Cart::findOrFail($id);
        $buy->state = 1;
        $buy->save();
        return redirect()->intended('/admin')->with('msg', 'محصول با موفقیت تایید شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }

    public function printForSendProduct($id)
    {
        return view('admin.printForSendProduct', ['cart' => Cart::join('users', 'users.id', '=', 'cart.user_id')
            ->where('cart.id', '=', $id)->get()]);
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

        $product = new Product();
        $product->name = $request->name;
        $product->count = $request->count;
        $product->price = $request->price;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->carType_id = $request->carType_id;
        $product->off_id = $request->off_id;
        $product->description = $request->description;
        $product->save();

        $destination = 'products/' . Product::all()->last()->id;
        if (!is_dir($destination))
            mkdir($destination, 0777, true);
        if (!empty($request->file('file'))) {
            $file = $request->file('file');
            $file->move($destination, '1.png');
        }
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
            'count' => 'required|integer',
            'price' => 'required|integer',
            'file' => 'mimes:png'
        ]);
        $product = Product::findOrFail($request->id);
        $product->name = $request->name;
        $product->count = $request->count;
        $product->price = $request->price;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->carType_id = $request->carType_id;
        $product->off_id = $request->off_id;
        $product->description = $request->description;
        $product->save();

        if (!empty($request->file)) {
            $destination = 'products/' . $request->id;
            if (!is_dir($destination))
                mkdir($destination, 0777, true);
            if (!empty($request->file('file'))) {
                $file = $request->file('file');
                $file->move($destination, '1.png');
            }
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
        return view('admin.addBrand');
    }

    public function addBrand(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'file' => 'required',
        ]);
        $brand = new Brand();
        $brand->name = $request->name;
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
        return view('admin.editBrand', ['brand' => Brand::where('id', '=', $id)->get()]);
    }

    public function editBrand(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'file' => 'mimes:png'
        ]);
        $brand = Brand::findOrFail($request->id);
        $brand->name = $request->name;
        $brand->save();

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
        return view('admin.addOff');
    }

    public function addOff(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'percent' => 'required|integer|min:0|max:100'
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
        return view('admin.editOff', ['off' => Off::where('id', '=', $id)->get()]);
    }

    public function editOff(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'percent' => 'required|integer|min:0|max:100'
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
        $category->name = $request->name;
        $category->save();

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
        $message->state=1;
        $message->save();
        return redirect()->intended('/admin/showMessages')->with('msg', 'پیام مشاهده شد.'); //کاربر را به صفحه مورد نظر هدایت میکنیم
    }
}
