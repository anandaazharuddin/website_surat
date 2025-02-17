@extends('layouts.app')

@section('main')
<div class="container">
    <div style="text-align: center;">
        <img src="{{ asset('img/jasatirta2.png') }}" alt="Logo" style="max-width: 200px;">
        <h3>PERUSAHAAN UMUM (PERUM) JASA TIRTA 1</h3>
        <p>Jl. Surabaya Dalam, Sumbersari, Kec. Lowokwaru, Kota Malang, Jawa Timur 65115 | Kontak: (0341) 551971</p>
        <hr>
    </div>
    
    <h4 style="text-align: center; text-decoration: underline;">SURAT RESMI</h4>
    <p style="text-align: center;">
        Tanggal Dibuat: {{ \Carbon\Carbon::parse($surat->tanggal_dibuat)->setTimezone('Asia/Jakarta')->translatedFormat('d F Y, H:i') }} WIB
    </p>
    <br>
    <p><strong>Kepada:</strong> {{ $surat->penerima->name }}</p>
    <p><strong>Pengirim:</strong> {{ $pengirim->name }}</p>
    <p><strong>Tembusan:</strong> {{ implode(', ', $tembusanNames) }}</p>
    <p><strong>Pemeriksa:</strong> {{ $pemeriksa->name}}</p>
    <hr>
    <p>{!! $surat->isi_surat !!}</p>
    <br>

    <div style="text-align: right;">
        <p>Hormat kami,</p>
        <br><br>
        <p><strong>{{ $pengirim->name }}</strong></p>
    </div>

    {{-- Menampilkan Lampiran Jika Ada --}}
    @if ($surat->lampiran && is_array($surat->lampiran) && count($surat->lampiran) > 0)
    <h4>Lampiran:</h4>
    <ul>
        @foreach ($surat->lampiran as $lampiran)
            <li>
                {{-- Pastikan path yang benar untuk lampiran yang disimpan di folder storage/public/lampiran --}}
                <a href="{{ asset('storage/lampiran/' . basename($lampiran)) }}" target="_blank">{{ basename($lampiran) }}</a>
            </li>
        @endforeach
    </ul>
@elseif ($surat->lampiran)
    {{-- Jika hanya ada satu lampiran --}}
    <h4>Lampiran:</h4>
    <a href="{{ asset('storage/lampiran/' . basename($surat->lampiran)) }}" target="_blank">{{ basename($surat->lampiran) }}</a>
@endif



    <a href="{{ route('surat.download', $surat->id) }}" class="btn btn-primary">Download Word</a>

</div>
@endsection
