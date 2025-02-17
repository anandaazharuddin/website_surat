@extends('layouts.app')

@section('main')
<div class="container mt-4">
    <h2 class="mb-3">📤 Surat Keluar</h2>
    
    @if ($suratKeluar->isEmpty())
        <div class="alert alert-info">Tidak ada surat keluar.</div>
    @else
        <div class="row">
            @foreach ($suratKeluar as $index => $suratUser)
            <div class="col-md-6">
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        @if (isset($suratUser->perihal) && isset($suratUser->isi_surat))
                            <h5 class="card-title">📌 {{ $suratUser->perihal }}</h5>
                            <h6 class="text-muted">Kepada: {{ $suratUser->penerimaUser->name ?? 'Tidak Diketahui' }}</h6>
                            <p class="card-text">{{ Str::limit($suratUser->isi_surat, 100) }}</p>
                            <a href="{{ route('surat.show', $suratUser->surat_id) }}" class="btn btn-primary btn-sm">BACA</a>
                            
                            <!-- Tombol Hapus -->
                            <form action="{{ route('surat.destroy', $suratUser->surat_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus surat ini?');">
                                    HAPUS
                                </button>
                            </form>
                        @else
                            <p class="text-danger">Data surat tidak ditemukan.</p>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
