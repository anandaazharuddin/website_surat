<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;

    protected $fillable = [
        'kepada', 
        'pengirim',
        'pemeriksa',
        'tembusan',
        'perihal',
        'isi_surat',
        'file_attachment',
        'status'
    ];

    protected $casts = [
        'tembusan' => 'array'
    ];

     // Relasi ke Model User sebagai Penerima Surat
     public function penerima()
     {
         return $this->belongsTo(User::class, 'kepada');
     }
 
     // Relasi ke Model User sebagai Pengirim Surat
     public function pengirim()
     {
         return $this->belongsTo(User::class, 'pengirim');
         return $this->hasMany(SuratUser::class, 'surat_id');
     }
 
     // Relasi ke Model User sebagai Pemeriksa Surat
     public function pemeriksa()
     {
         return $this->belongsTo(User::class, 'pemeriksa');

     }
}
