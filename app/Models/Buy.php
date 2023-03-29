<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buy extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $fillable=['state','user_id','products_id'];
    protected $table='buy';
}
