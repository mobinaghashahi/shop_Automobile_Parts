<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $primaryKey='id';
    protected $fillable=['name','title','email','phoneNumber','description','date'];
    protected $table='contact';
}
