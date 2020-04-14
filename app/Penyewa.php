<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penyewa extends Model
{
    protected $table = "penyewa";
    protected $primaryKey = "id";
    protected $fillable = ['nama', 'alamat', 'telp', 'no_ktp', 'foto'];
    public $timestamps = false;

    public function Pelanggan(){
    return $this->HasMany('App/Pelanggan','id');
}

}
