<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Surat;

class SuratSeeder extends Seeder
{
    public function run()
    {
        Surat::create([
            'kepada' => 'John Doe',
            'tembusan' => 'HR Department',
            'pengirim' => 'Admin',
            'pemeriksa' => 'Manager',
            'perihal' => 'Pengajuan Cuti',
            'isi_surat' => 'Dengan ini saya mengajukan cuti selama 3 hari.'
        ]);

        Surat::create([
            'kepada' => 'Jane Smith',
            'tembusan' => 'Finance',
            'pengirim' => 'Sekretaris',
            'pemeriksa' => 'Direktur',
            'perihal' => 'Laporan Keuangan',
            'isi_surat' => 'Laporan keuangan telah selesai dibuat.'
        ]);
    }
}
