<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SuratUser;
use Illuminate\Support\Facades\Auth;

class SuratUserController extends Controller
{
    public function suratMasuk()
    {
        $userId = Auth::id();
        $suratMasuk = SuratUser::where('penerima_id', $userId)->with('surat')->get();

        return view('surat.masuk', compact('suratMasuk'));
    }

    public function suratKeluar()
    {
        $userId = Auth::id();
        $suratKeluar = SuratUser::select(
            'surat_users.id as surat_user_id',
            'surat_users.surat_id',
            'surat_users.pengirim_id',
            'surat_users.penerima_id',
            'surats.perihal',
            'surats.isi_surat'
        )
        ->join('surats', 'surat_users.surat_id', '=', 'surats.id') 
        ->where('surat_users.pengirim_id', $userId)
        ->get();
    
        return view('surat.keluar', compact('suratKeluar'));
    }
    
}
