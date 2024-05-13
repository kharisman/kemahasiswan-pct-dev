<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pctKuis extends Model
{
    use HasFactory;

    protected $table = 'pct_kuis';

    public function soal (){
        return $this->hasMany(pctKuisSoal::class, 'kuis_id');
    }
}
