<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Toko;
use App\Barang;
use Carbon\Carbon;
use App\Transaksi;
use App\DetailTransaksi;
use Illuminate\Support\Facades\Auth;

class ApiPegawaiController extends Controller
{
    public function get_token(Request $request)
    {
            $getValue = User::where('email', $request->email)->get();
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
            $data['message'] = $request->email;
        }
        return $data;
        
        
    }

    public function get_profile(Request $request)
    {
        $data['data'] = User::where('remember_token',$request->token)->first();
        $data['toko'] = Toko::where('id_user',$data['data']->id)->first();
        $data['barang'] = Barang::where('id_toko',$data['toko']->id_usaha)->get();
        $data['pendapatan'] = Transaksi::where([['id_toko',$data['toko']->id_usaha],['tgl',$date = Carbon::today()->toDateString()]])->get();
        $id_transaksi = 0;
        foreach ($data['pendapatan'] as $value) {
            $id_transaksi = $value->id_transaksi;
        }
        if($data['data'] != ''){$data['message'] = "success";}
        else{$data['message'] ="failuer";}
        return $data;
    }

    public function get_detail_transaksi(Request $request) {
        $data['data'] = DetailTransaksi::where('id_transaksi',$request->id_transaksi)->get();
        foreach ($data['data'] as $key =>$value) {
            $search = Barang::where('id_barang',$value['nama_barang'])->first();
            if($search != ""){
                $data['data'][$key]['nama_barang'] = $search['nama_barang'];
            }else{
               
            }
        }
        if(count($data['data']) > 0){
            $data['message'] = "success";
        } 
        else{
            $data['message'] = "success";
        }
        return response()->json($data);
    }
}
