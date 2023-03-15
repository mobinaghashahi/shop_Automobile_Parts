<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Off extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $fillable=['name','percent'];
    protected $table='off';
}
