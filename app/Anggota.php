<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = "tbl_anggota";
    protected $fillable = [
        'id_anggota','nama_anggota','alamat'
    ];
    public $primaryKey = "id_anggota";

    public function arisan(){
        return $this->hasOne('\App\Arisan','id_anggota','id_anggota');
    }
}
