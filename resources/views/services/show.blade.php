@extends('layouts.app')

@section('title', $service->name)

@section('content')
<section class="av-page-head">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-2">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Layanan Kami</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>
            </ol>
        </nav>
        <h1>{{ $service->name }}</h1>
        <p>{{ $service->summary }}</p>
    </div>
</section>

<section class="av-section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <div class="av-detail-img mb-4">
                    @if ($service->image_url)
                        <img src="{{ $service->image_url }}" alt="{{ $service->name }}">
                    @else
                        <img src="{{ asset('images/logo-icon.png') }}" alt="" class="ph">
                    @endif
                </div>
                <div class="av-prose">
                    {!! nl2br(e($service->description)) !!}
                </div>
            </div>
            <div class="col-lg-5">
                <div class="av-aside">
                    <span class="av-tag">{{ $service->category->name }}</span>
                    <p class="h4 mt-3 mb-1" style="font-family: var(--av-font-head); color: var(--av-navy);">{{ $service->price_label }}</p>
                    <p class="text-secondary small">Harga final menyesuaikan kebutuhan dan ruang lingkup pekerjaan.</p>
                    <div class="d-grid gap-2">
                        <a class="btn btn-av" href="{{ route('contact') }}">Tanya layanan ini</a>
                        <a class="btn btn-av-outline" href="{{ route('services.index') }}">Kembali ke daftar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@if ($related->isNotEmpty())
<section class="av-section alt">
    <div class="container">
        <h2 class="mb-4">Layanan lain di {{ $service->category->name }}</h2>
        <div class="row g-4">
            @foreach ($related as $item)
                <div class="col-md-6 col-lg-4">
                    @include('services._card', ['service' => $item])
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif
@endsection
