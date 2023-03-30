<?php

use App\Models\Buy;
use App\Models\Product;

function calSumPrice($id)
{
    $sum = 0;

    $buys = Buy::join('products', 'products.id', '=', 'buy.products_id')
        ->where('cart_id', '=', $id)
        ->select('buy.count as count', 'buy.price as price')
        ->get();

    foreach ($buys as $buy) {
        $sum += $buy->price * $buy->count;
    }
    return $sum;
}

function callCountSellProducts($id)
{
    $count=0;
    $sells = Buy::where('products_id', '=', $id)->get();
    foreach ($sells as $sell){
        $count+=$sell->count;
    }
    return $count;
}

function stock($id){
    $product=Product::where('id','=',$id)->get()[0];
    return $product->count-callCountSellProducts($id);
}
