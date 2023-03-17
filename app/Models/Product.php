<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $fillable=['name','description','count','price','brand_id','category_id','carType_id'
    ,'off_id'];
    protected $table='products';
}
