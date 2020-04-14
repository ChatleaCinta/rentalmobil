<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $table = "mobil";
    protected $primaryKey = "id";
    protected $fillable = ['merk', 'plat_no', 'foto', 'ket'];
    public $timestamps = false;

    public function Mobil(){
    return $this->HasMany('App/Mobil','id');
}

}
