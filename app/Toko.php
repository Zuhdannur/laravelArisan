<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table= "tbl_usaha";
    public $timestamps = false;
    protected $fillable = [
        'id_usaha','id_user','nama_toko','deskripsi','alamat','jenis_usaha','invitation_code'
    ];
}
