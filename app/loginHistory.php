<?php

use App\Models\LoginHistory;
use App\Models\User;
use Hekmatinasser\Verta\Verta;

function saveLoginLog($phoneNumber): void
{
    $user=User::where('phoneNumber','=',$phoneNumber)->select('id')->get();
    $loginHistory=new LoginHistory();
    $loginHistory->ip = $_SERVER['REMOTE_ADDR'];
    $loginHistory->date = Verta::now();
    $loginHistory->user_id = $user[0]->id;
    $loginHistory->save();

    return;
}
