<?php

namespace App\Http\Controllers;

use App\Models\CarType;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class products extends Controller
{
    public function showDetails($id)
    {
        //بدست آوردن آی دی ماشین محصول برای استفاده کردن در محصولات مرتبط
        $product = Product::where('products.id', '=', $id)
            ->select('carType_id')
            ->get();

        return view('productDetails', ['product' => Product::join('brand', 'brand.id', '=', 'products.brand_id')
            ->join('cartype', 'cartype.id', '=', 'products.cartype_id')
            ->join('category', 'category.id', '=', 'products.category_id')
            ->join('off', 'off.id', '=', 'products.off_id')
            ->where('products.id', '=', $id)
            ->select('products.*', 'brand.name as brandName',
                'cartype.name as carTypeName', 'category.name as categoryName'
                , 'off.name as offName')
            ->get(), 'products' => Product::where('carType_id', '=', $product[0]->carType_id)->get()]);
    }

    public function showProductsByBrand($id)
    {
        $products = Product::where('brand_id', '=', $id)->paginate(12);


        //بدست آوردن تعداد صفحات موجود از این برند
        $countOfPage = $products->lastPage();

        return view('showBrandProducts', ['products' => $products,
            'pages' => $countOfPage,
            'currentPage' => $products->currentPage(),
            'brand_id' => $id]);
    }

    public function showProductsByCarTypeCategorys($id)
    {

        //this is for fix groupBy error!!!!!
        \DB::statement("SET SQL_MODE=''");

        return view('showCarTypeCategorys', ['products' => Product::join('cartype', 'cartype.id', '=', 'products.carType_id')
            ->join('category', 'category.id', '=', 'products.category_id')
            ->where('carType_id', '=', $id)
            ->select('category.id as category_id', 'cartype.id as carType_id', 'category.name')
            ->groupBy('category_id')
            ->get(), 'car' => CarType::where('id', '=', $id)->get()]);
    }

    public function showCarTypeProducts($carType_id, $category_id)
    {
        $products = Product::where('carType_id', '=', $carType_id)
            ->where('category_id', '=', $category_id)
            ->paginate(12);

        //بدست آوردن تعداد صفحات موجود از این برند
        $countOfPage = $products->lastPage();

        return view('showCarTypeProducts', ['products' => $products,
            'pages' => $countOfPage,
            'currentPage' => $products->currentPage(),
            'carType_id' => $carType_id,
            'category_id'=>$category_id]);
    }

    public function showResults(Request $request)
    {
        $validated = $request->validate([
            'text' => 'string',
        ]);
        $whereNameItems = array();
        $whereDescriptionItems = array();
        $allResult = array();

        $texts = explode(' ', $request->get('text'));

        foreach ($texts as $text) {
            $whereNameItems[] = ['name', 'like', '%' . $text . '%'];
            $whereDescriptionItems[] = ['description', 'like', '%' . $text . '%'];
        }

        $resultsOnNameProduct = Product::where($whereNameItems)->get();
        $resultsOnDescriptionProduct = Product::where($whereDescriptionItems)->get();
        foreach ($resultsOnNameProduct as $item) {
            if (!$resultsOnDescriptionProduct->contains('id', $item->id)) {
                $resultsOnDescriptionProduct->push($item);
            }
        }

        return view('home.showSearchResults', ['products' => $resultsOnDescriptionProduct]);
    }

}
