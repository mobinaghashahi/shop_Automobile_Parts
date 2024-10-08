<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $fillable=['paymentCode','state','totalPrice'];
    protected $table='cart';
}
