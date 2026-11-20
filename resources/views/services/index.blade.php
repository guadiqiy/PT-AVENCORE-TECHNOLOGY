@extends('layouts.app')

@section('title', 'Layanan Kami')

@section('content')
<section class="av-page-head">
    <div class="container">
        <h1>Layanan Kami</h1>
        <p>Dari website sampai aplikasi bisnis. Pilih yang paling sesuai dengan kebutuhan usaha Anda.</p>
    </div>
</section>

<section class="av-section">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('services.index', array_filter(['q' => $keyword])) }}"
                   class="av-pill {{ $activeCategory ? '' : 'active' }}">Semua</a>
                @foreach ($categories as $category)
                    <a href="{{ route('services.index', array_filter(['kategori' => $category->slug, 'q' => $keyword])) }}"
                       class="av-pill {{ $activeCategory === $category->slug ? 'active' : '' }}">{{ $category->name }}</a>
                @endforeach
            </div>
            <form method="GET" action="{{ route('services.index') }}" class="d-flex gap-2" role="search">
                @if ($activeCategory)
                    <input type="hidden" name="kategori" value="{{ $activeCategory }}">
                @endif
                <input type="search" name="q" value="{{ $keyword }}" class="form-control" placeholder="Cari layanan" aria-label="Cari layanan">
                <button class="btn btn-av" type="submit">Cari</button>
            </form>
        </div>

        <div class="row g-4">
            @forelse ($services as $service)
                <div class="col-md-6 col-lg-4">
                    @include('services._card', ['service' => $service])
                </div>
            @empty
                <div class="col-12">
                    <p class="text-secondary mb-2">Tidak ada layanan yang cocok dengan pencarian Anda.</p>
                    <a href="{{ route('services.index') }}" class="fw-semibold">Tampilkan semua layanan</a>
                </div>
            @endforelse
        </div>

        <div class="mt-4">
            {{ $services->links() }}
        </div>
    </div>
</section>
@endsection
