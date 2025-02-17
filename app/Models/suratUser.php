<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratUser extends Model
{
    use HasFactory;

    protected $table = 'surat_users'; // Sesuai dengan tabel di migrasi

    protected $fillable = [
        'surat_id', 
        'pengirim_id', 
        'penerima_id', 
        'status'
    ];

    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surat_id' .'id');
    }

    public function pengirimUser()
    {
        return $this->belongsTo(User::class, 'pengirim_id', 'id'); // Sesuai dengan nama kolom di database
    }

    public function penerimaUser()
    {
        return $this->belongsTo(User::class, 'penerima_id', 'id'); // Sesuai dengan nama kolom di database
    }
}
