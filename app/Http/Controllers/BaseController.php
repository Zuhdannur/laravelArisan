<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if(!empty($user)){
            return redirect(action('DashboardController@index'));
        }
        else{
            return view('home');
        }
    }
}
