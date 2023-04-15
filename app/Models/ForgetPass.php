<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgetPass extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $fillable=['code','date','user_id'];
    protected $table='forgetpassword';
}
