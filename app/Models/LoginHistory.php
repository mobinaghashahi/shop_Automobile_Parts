<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginHistory extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $fillable=['user_id','ip','date','state'];
    protected $table='loginhistory';
}
