<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class User {

    public static function get_toko($user_id) {
        $user = DB::table('tbl_usaha')->where('id_user', $user_id)->first();
        return $user;
    }

    public static function get_barang($toko_id){
        $barang = DB::table('tbl_barang')->where('id_toko',$toko_id)->get();
        return $barang;
    }
}