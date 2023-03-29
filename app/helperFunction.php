<?php

use App\Models\Buy;

function calSumPrice($id)
{
    $sum=0;

    $buys = Buy::join('products', 'products.id', '=', 'buy.products_id')
        ->where('cart_id', '=', $id)
        ->select('buy.count as count', 'buy.price as price')
        ->get();

    foreach ($buys as $buy){
        $sum+=$buy->price*$buy->count;
    }
    return $sum;
}

