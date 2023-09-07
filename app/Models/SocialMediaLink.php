<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaLink extends Model
{
    use HasFactory;

    protected $table = 'social_media_links'; // Nama tabel di database Anda

    protected $fillable = [
        'name_account', // Kolom untuk nama akun media sosial
        'link',         // Kolom untuk tautan/URL media sosial
        'internship_id' // Kolom untuk kunci asing ke tabel internship (jika ada)
    ];

    // Hubungan dengan model lain (jika ada)
    public function internship()
    {
        return $this->belongsTo(Internship::class); // Gantilah "Internship" dengan nama model yang sesuai
    }
}
