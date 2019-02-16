<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    protected $table = "tbl_detail_transaksi";
    protected $fillable = [
        'id_detail','id_transaksi','id_toko','nama_barang','jumlah'
    ];
    public $timestamps = false;
}
