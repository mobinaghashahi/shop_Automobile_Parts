<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cities extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $fillable=['name','province_id'];
    protected $table='city';
}
