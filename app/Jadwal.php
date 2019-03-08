<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected  $table = "tbl_jadwal";
    protected $fillable = [
        'id_jadwal','id_toko','title','start','end','allDay','className','description'
    ];
    public $timestamps = false;
}
