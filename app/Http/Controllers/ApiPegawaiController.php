<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ApiPegawaiController extends Controller
{
    public function get_token(Request $request)
    {
        if(contains($request->email,'%40')){
            $email = str_replace('%40', '@', $request->email);
            $getValue = User::where('email', $email)->get();
        if (count($getValue) > 0) {
            foreach ($getValue as $item) {
                if (hash::check($request->password, $item->password)) {
                    $getValue->makeVisible(['remember_token']);
                    $data['token'] = $item->remember_token;
                    $data['message'] = 'success';
                    return response()->json($data);
                } else {
                    $data['message'] = 'wrong password';
                }
            }
        } else {
            $data['message'] = 'Account Not Found';
        }
        return $data;
        }
        else{
            return $data['message'] = 'Koplok';
        }
        
    }

    public function get_profile(Request $request)
    {
        $data['data'] = User::where('remember_token',$request->token)->first();
        if($data['data'] != ''){$data['message'] = "success";}
        else{$data['message'] ="failuer";}
        return $data;
    }

}
