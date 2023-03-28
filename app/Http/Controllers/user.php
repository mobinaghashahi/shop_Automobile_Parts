<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class user extends Controller
{
    public function showDashboard(){
        return view('user.dashboard');
    }

    public function showProfile(){
        return view('user.profile');
    }
    public function showOrders(){
        return view('user.orders');
    }
}
