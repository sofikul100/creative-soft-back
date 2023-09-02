<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class LocalizationController extends Controller
{
    //------change language------
    public function lang_change($locale){
        Session::put("locale",$locale);
        return redirect()->back();
    }
}
