<?php
namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class User {

    public static function get_toko($user_id) {
        $user = DB::table('tbl_usaha')->where('id_user', $user_id)->first();
        return $user;
    }

    public static function get_idToko($user_id) {
        $user = DB::table('tbl_usaha')->select('id_usaha')->where('id_user', $user_id)->get();
        $id_usaha = '';
        foreach ($user as $item){
            $id_usaha = $item->id_usaha;
        }
        return $id_usaha;
    }

    public static function get_profil_pegawai($user_id)
    {
        $user = DB::table('tbl_pegawai')->where('id_user', $user_id)->first();
        return $user;
    }


    public static function get_barang($toko_id){
        $barang = DB::table('tbl_barang')->where('id_toko',$toko_id)->get();
        return $barang;
    }

    public static function getRole($user_id){
        $user = DB::table('users')->select('type')->where('id',$user_id)->first();
        return $user;
    }
}