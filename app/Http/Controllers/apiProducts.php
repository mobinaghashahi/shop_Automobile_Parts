<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use function PHPUnit\Framework\assertJson;

class apiProducts extends Controller
{
    public function getAllProducts()
    {
        $post_data = array();
        $products=Product::all()->sortByDesc("updated_at");
        foreach ($products as $product) {
            $post_data[] = ['product_id' => $product->id,
                'page_url' => "https://yadakasli.ir/productDetails/" . $product->id,
                'price'=>$product->price,
                'availability'=>$product->availability,
                'old_price'=>$product->old_price];
        }
        //var_dump($post_data);
        $post_data = json_encode($post_data,JSON_UNESCAPED_SLASHES);
        return $post_data;
    }
}
