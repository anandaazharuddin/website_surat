@extends('layouts.app')

@section('title', 'Surat Menyurat Perum Jasa Tirta 1')

@section('main')
    <section class="section">
        <div class="image-container">
            <img src="{{ asset('img/jasatirta4.jpg') }}" alt="Deskripsi Foto" class="responsive-img">
        </div>
        </div>
    </section>

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">

    <!-- Custom CSS -->
    <style>
        .image-container {
            text-align: center; /* Agar gambar berada di tengah */
            margin-bottom: 20px;
        }

        .responsive-img {
            max-width: 1000%; /* Membatasi lebar maksimal */
            height: auto; /* Menjaga proporsi */
            max-height: 560px; /* Batasi tinggi maksimal */
            border-radius: 10px; /* Opsional: memberikan efek sudut melengkung */
        }

        .section {
            position: relative;
            background-size: cover;
            background-position: center center;
            background-attachment: fixed;
            padding: 30px 0;
        }

        .section-content {
            position: relative;
            text-align: center;
            color: white;
            z-index: 2;
        }

    </style>
@endpush
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
