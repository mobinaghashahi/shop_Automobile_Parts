<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $fillable=['differentPrice','products_id','color_id'];
    protected $table='productcolor';
}
