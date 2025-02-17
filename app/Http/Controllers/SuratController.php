<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\User;
use App\Models\SuratUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;


class SuratController extends Controller
{
    
        public function index()
        {
            $userId = auth()->id();

            // Surat Masuk (diterima oleh user)
            $suratMasuk = Surat::where('kepada', $userId)->orderBy('created_at', 'desc')->get();
        
            // Surat Keluar (dikirim oleh user)
            $suratKeluar = Surat::where('pengirim', $userId)->orderBy('created_at', 'desc')->get();
        
            return view('surat.index', compact('suratMasuk', 'suratKeluar'));
        }
        

        public function suratMasuk()
        {
            $userId = auth()->id();
        
            // Ambil surat yang diterima oleh user login
            $suratMasuk = SuratUser::where('penerima', $userId)
                                    ->with('surat', 'pengirimUser')
                                    ->orderBy('created_at', 'desc')
                                    ->get();
        
            return view('surat.masuk', compact('suratMasuk'));
        }
        
        public function suratKeluar()
        {
            $userId = auth()->id();
        
            // Ambil surat yang dikirim oleh user login
            $suratKeluar = SuratUser::where('pengirim', $userId)
                                    ->with('surat', 'penerimaUser')
                                    ->orderBy('created_at', 'desc')
                                    ->get();
        
            return view('surat.keluar', compact('suratKeluar'));
        }
        


    public function create()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('surat.create', compact('users'));
    }

    public function store(Request $request)
{
    $request->validate([
        'kepada' => 'required|exists:users,id',
        'perihal' => 'required|string|max:255',
        'isi_surat' => 'required|string',
        'pemeriksa' => 'required|exists:users,id',
        'tembusan' => 'nullable|array',
        'file_attachment' => 'nullable|file|mimes:pdf,docx,jpg,png|max:2048',
    ]);

    // Simpan lampiran jika ada
    $lampiranPath = null;
    if ($request->hasFile('file_attachment')) {
        $lampiranPath = $request->file('file_attachment')->store('lampiran', 'public');
    }

    // Simpan data surat    
    $surat = Surat::create([
        'kepada' => intval($request->kepada),
        'pengirim' => Auth::id(),
        'pemeriksa' => intval($request->pemeriksa),
        'tembusan' => json_encode($request->tembusan ?? []),
        'perihal' => $request->perihal,
        'isi_surat' => $request->isi_surat,
        'file_attachment' => $lampiranPath,
        'status' => $request->input('action') == 'kirim' ? 'terkirim' : 'draft'
    ]);

    // Simpan data ke surat_users
    SuratUser::create([
        'surat_id' => $surat->id,
        'pengirim_id' => Auth::id(),
        'penerima_id' => $request->kepada,
        'status' => 'dikirim'
    ]);

    return redirect()->route('surat.index')->with('success', 'Surat berhasil dikirim!');
}


    public function show(Surat $surat)
    {
        $surat->load(['penerima', 'pengirim', 'pemeriksa']);
        $pengirim = User::select('id', 'name')
        ->where('id', $surat->pengirim)
        ->first();
        $pemeriksa = User::select('id', 'name')
        ->where('id', $surat->pemeriksa)
        ->first();
    
        // Ubah tembusan dari JSON ke array
        $tembusanIds = json_decode($surat->tembusan, true);
        $tembusanNames = User::whereIn('id', $tembusanIds)->pluck('name')->toArray();
        
        return view('surat.show', compact('surat', 'tembusanNames', 'pengirim', 'pemeriksa'));
    }
    

    public function update(Request $request, Surat $surat)
    {
        $request->validate([
            'kepada' => 'required|exists:users,id',
            'pemeriksa' => 'required|exists:users,id',
            'tembusan' => 'nullable|array',
            'perihal' => 'required|string|max:255',
            'isi_surat' => 'required|string',
            'file_attachment' => 'nullable|file|mimes:pdf,docx,jpg,png|max:2048',
        ]);

        if ($request->hasFile('file_attachment')) {
            Storage::delete('public/' . $surat->file_attachment);
            $lampiranPath = $request->file('file_attachment')->store('lampiran', 'public');
            $surat->file_attachment = $lampiranPath;
        }

        $surat->update([
            'kepada' => intval($request->kepada),
            'pemeriksa' => intval($request->pemeriksa),
            'tembusan' => json_encode($request->tembusan ?? []),
            'perihal' => $request->perihal,
            'isi_surat' => $request->isi_surat,
        ]);

        return redirect()->route('surat.index')->with('success', 'Surat berhasil diperbarui!');
    }

    public function destroy(Surat $surat)
    {
        Storage::delete('public/' . $surat->file_attachment);
        $surat->delete();
        return redirect()->route('surat.index')->with('success', 'Surat berhasil dihapus!');
    }
  
public function downloadWord($id)
{
    $surat = Surat::findOrFail($id);
    $kepada = User::where('id', $surat->kepada)->first();
    $pengirim = User::select('name')->where('id',$surat->pengirim)->first();
    $tembusan = User::select('name')->where('id',$surat->tembusan)->first();
    $pemeriksa = User::select('name')->where('id',$surat->pemeriksa)->first();

    // Membuat dokumen Word baru
    $phpWord = new PhpWord();
    $section = $phpWord->addSection();

    // Kop Surat
    $section->addImage(public_path('img/jasatirta1.png'), [
        'width' => 100,
        'height' => 100,
        'alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER
    ]);
    $section->addText('PERUM JASA TIRTA 1', ['bold' => true, 'size' => 14], ['alignment' => 'center']);
    $section->addText('Jl. Surabaya Dalam, Sumbersari, Kec. Lowokwaru, Kota Malang, Jawa Timur 65115', ['size' => 10], ['alignment' => 'center']);
    $section->addTextBreak();

    // Judul Surat
    $section->addText('SURAT RESMI', ['bold' => true, 'size' => 12, 'underline' => 'single'], ['alignment' => 'center']);
    $section->addText("Tanggal Dibuat: " . \Carbon\Carbon::parse($surat->tanggal_dibuat)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') . " WIB", ['size' => 10], ['alignment' => 'center']);
    $section->addTextBreak();

    // Detail Surat
    $section->addText("Kepada: " . $kepada->name, ['bold' => true]);
    $section->addText("Pengirim: " . $pengirim->name);
    $section->addText("Tembusan: " . $tembusan);
    $section->addText("Pemeriksa: " . $pemeriksa->name);
    $section->addText("Perihal: " . $surat->perihal);
    $section->addTextBreak();

    // Isi Surat
    $section->addText(strip_tags($surat->isi_surat), ['size' => 11]);

    // Tambahkan lampiran jika ada
    if (!empty($surat->file_attachment)) {
        $section->addTextBreak();
        $section->addText("Lampiran:", ['bold' => true]);
        $section->addText("- " . asset('storage/lampiran/' . basename($surat->file_attachment)));

    }

    // Tanda Tangan
    $section->addTextBreak(2);
    $section->addText("Hormat kami,", ['size' => 11], ['alignment' => 'right']);
    $section->addTextBreak(3);
    $section->addText($surat->pengirim, ['bold' => true], ['alignment' => 'right']);

    // Simpan ke file
    $fileName = 'Surat_' . $surat->id . '.docx';
    $path = storage_path('app/public/' . $fileName);
    $writer = IOFactory::createWriter($phpWord, 'Word2007');
    $writer->save($path);

    return response()->download($path)->deleteFileAfterSend(true);
}

}
