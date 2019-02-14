<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = "tbl_transaksi";
    public $timestamps = false;
    protected $fillable = [
    	'id_transaksi','id_toko','pendapatan','pengeluaran','tgl'
    ];
}
