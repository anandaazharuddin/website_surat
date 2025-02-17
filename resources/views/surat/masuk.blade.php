@extends('layouts.app')

@section('main')
<div class="container mt-4">
    <h2 class="mb-3">📥 Surat Masuk</h2>

    @if ($suratMasuk->isEmpty())
        <div class="alert alert-info">Tidak ada surat masuk.</div>
    @else
        <div class="row">
            @foreach ($suratMasuk as $suratUser)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $suratUser->perihal }}</h5>
                        <p class="card-text"><strong>Dari:</strong> {{ $suratUser->pengirimUser->name }}</p>
                        <p class="card-text"><strong>Isi:</strong> {{ Str::limit($suratUser->isi_surat, 100) }}</p>
                        <p class="text-muted">
                            <small>📅 {{ $suratUser->created_at->diffForHumans() }}</small>
                        </p>
                        <a href="{{ route('surat.show', $suratUser->surat_id) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-eye"></i> Baca
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
