<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = "tbl_pegawai";
    public $timestamps = false;
    protected $fillable = [
        'id_pegawai','id_user','id_toko','jabatan','gaji'
    ];

    public function user(){
        return $this->hasOne('\App\User','id','id_user');
    }
}
