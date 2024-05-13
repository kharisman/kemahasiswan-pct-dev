<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 

class pctKuisSoal extends Model
{
    use HasFactory;
    protected $table = 'pct_kuis_soal';
    public function opsi (){
        return $this->hasMany(pctKuisOpsi::class, 'soal_id');
    }
}
