<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class admin extends Controller
{
    public function showDashboard(){
        return view('admin.dashboard');
    }
    public function showAddProduct(){
        return view('admin.addProduct');
    }
}
