<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Arisan extends Model
{
    protected $table = "tbl_arisan";
    protected $fillable = [
        'id_arisan','id_anggota','status','status_bayar'
    ];
    public $primaryKey = "id_arisan";
}
