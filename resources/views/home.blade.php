@extends('layouts.app')

@section('content')
<section class="av-hero av-hero--tech">
    <div class="hero-bg" aria-hidden="true">
        <div class="hero-bg__glow"></div>
        <div class="hero-bg__glow hero-bg__glow--b"></div>
        <canvas id="heroCanvas"></canvas>
        <div class="hero-bg__beam"></div>
    </div>
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <h1 class="av-rise av-rise-1">Website dan sistem digital untuk usaha yang siap berkembang.</h1>
                <p class="lead av-rise av-rise-2">PT Avencore Technology membantu UMKM dan perusahaan membuat website, toko online, dan aplikasi yang mudah dipakai sehari-hari.</p>
                <div class="d-flex flex-wrap gap-2 av-rise av-rise-3">
                    <a href="{{ route('services.index') }}" class="btn btn-av">Lihat layanan</a>
                    <a href="{{ route('contact') }}" class="btn btn-av-outline">Hubungi kami</a>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="av-orbit av-rise av-rise-4">
                    <img src="{{ asset('images/logo-icon.png') }}" alt="Lambang PT Avencore Technology">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="av-section alt">
    <div class="container">
        <h2 class="mb-2">Bidang yang kami kerjakan</h2>
        <p class="sub mb-4">Pilih kelompok layanan sesuai kebutuhan usaha Anda.</p>
        <div class="row g-4">
            @forelse ($categories as $category)
                <div class="col-md-4">
                    <div class="av-cat">
                        <h3>{{ $category->name }}</h3>
                        <p>{{ $category->description }}</p>
                        <a href="{{ route('services.index', ['kategori' => $category->slug]) }}" class="fw-semibold text-decoration-none">
                            {{ $category->services_count }} layanan tersedia
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-secondary">Belum ada kategori. Tambahkan lewat dashboard admin.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="av-section">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
            <div>
                <h2 class="mb-2">Layanan terbaru</h2>
                <p class="sub mb-0">Klik salah satu layanan untuk melihat penjelasan lengkapnya.</p>
            </div>
            <a href="{{ route('services.index') }}" class="btn btn-av-outline">Semua layanan</a>
        </div>
        <div class="row g-4">
            @forelse ($services as $service)
                <div class="col-md-6 col-lg-4">
                    @include('services._card', ['service' => $service])
                </div>
            @empty
                <p class="text-secondary">Belum ada layanan. Tambahkan lewat dashboard admin.</p>
            @endforelse
        </div>
    </div>
</section>

<section class="av-section alt">
    <div class="container text-center">
        <h2 class="mb-2">Belum yakin layanan mana yang cocok?</h2>
        <p class="sub mx-auto mb-4">Ceritakan kebutuhan usaha Anda. Kami bantu pilihkan solusi yang sesuai dengan anggaran.</p>
        <a href="{{ route('contact') }}" class="btn btn-av">Mulai konsultasi</a>
    </div>
</section>

<script src="{{ asset('js/hero-background.js') }}" defer></script>
@endsection
