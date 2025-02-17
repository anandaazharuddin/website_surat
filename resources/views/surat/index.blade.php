@extends('layouts.app')

@section('main')
<div class="container mt-4">
    <h2>📄 Buat Surat</h2>
    <div class="d-flex justify-content-center align-items-center mb-4">
        <a href="{{ route('surat.create') }}" class="btn btn-success ms-3">
            <i class="fas fa-plus"></i> Buat Surat
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success mt-3">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
    @endif

    {{-- <!-- Tab Navigasi -->
    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="masuk-tab" data-bs-toggle="tab" data-bs-target="#masuk" type="button" role="tab">📥 Surat Masuk</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="keluar-tab" data-bs-toggle="tab" data-bs-target="#keluar" type="button" role="tab">📤 Surat Keluar</button>
        </li>
    </ul>

    <div class="tab-content mt-3" id="myTabContent">
        <!-- Surat Masuk -->
        <div class="tab-pane fade show active" id="masuk" role="tabpanel">
            <div class="row">
                @forelse($suratMasuk as $surat)
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $surat->perihal }}</h5>
                            <p class="card-text"><strong>Pengirim:</strong> {{ $surat->pengirim->name ?? '-' }}</p>
                            <p class="card-text"><strong>Pemeriksa:</strong> {{ $surat->pemeriksa->name ?? '-' }}</p>
                            <p class="text-muted">
                                <small>📅 {{ $surat->created_at->diffForHumans() }}</small>
                            </p>
                            <a href="{{ route('surat.show', $surat->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Tidak ada surat masuk.
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Surat Keluar -->
        <div class="tab-pane fade" id="keluar" role="tabpanel">
            <div class="row">
                @forelse($suratKeluar as $surat)
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 mb-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $surat->perihal }}</h5>
                            <p class="card-text"><strong>Kepada:</strong> {{ $surat->penerima->name ?? '-' }}</p>
                            <p class="card-text"><strong>Pemeriksa:</strong> {{ $surat->pemeriksa->name ?? '-' }}</p>
                            <p class="text-muted">
                                <small>📅 {{ $surat->created_at->diffForHumans() }}</small>
                            </p>
                            <a href="{{ route('surat.show', $surat->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <form action="{{ route('surat.destroy', $surat->id) }}" method="POST" onsubmit="return confirm('Hapus surat ini?')" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Tidak ada surat keluar.
                    </div>
                </div>
                @endforelse
            </div>
        </div> --}}
    </div>
</div>

<!-- Bootstrap JavaScript untuk Tab -->
<script>
    var firstTabEl = document.querySelector("#myTab button:first-child");
    var firstTab = new bootstrap.Tab(firstTabEl);
    firstTab.show();
</script>

@endsection
