<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@hasSection('title')@yield('title') | PT Avencore Technology @else PT Avencore Technology | Empowering Business Through Technology @endif</title>
    <meta name="description" content="PT Avencore Technology: solusi website, toko online, aplikasi, dan layanan cloud untuk UMKM dan perusahaan.">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@400;500;600&family=Sora:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/avencore.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg av-nav sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('images/logo.png') }}" alt="PT Avencore Technology">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav"
                    aria-controls="mainNav" aria-expanded="false" aria-label="Buka menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Beranda</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">Tentang Kami</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('services.*') ? 'active' : '' }}" href="{{ route('services.index') }}">Layanan Kami</a></li>
                    <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Kontak</a></li>
                    <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                        <a class="btn btn-av-outline btn-sm" href="{{ auth()->check() ? route('admin.dashboard') : route('login') }}">Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="av-footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5">
                    <img src="{{ asset('images/logo.png') }}" alt="PT Avencore Technology" class="mb-3">
                    <p class="mb-0" style="max-width: 44ch;">Empowering Business Through Technology. Kami membantu UMKM dan perusahaan bekerja lebih efisien lewat website, aplikasi, dan layanan cloud.</p>
                </div>
                <div class="col-6 col-lg-3 offset-lg-1">
                    <h6>Halaman</h6>
                    <ul class="list-unstyled mb-0">
                        <li><a href="{{ route('home') }}">Beranda</a></li>
                        <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                        <li><a href="{{ route('services.index') }}">Layanan Kami</a></li>
                        <li><a href="{{ route('contact') }}">Kontak</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-3">
                    <h6>Hubungi kami</h6>
                    <ul class="list-unstyled mb-0">
                        <li>info@avencore.test</li>
                        <li>+62 812-0000-0000</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4" style="border-color: var(--av-line); opacity: 1;">
            <p class="small mb-0">&copy; {{ date('Y') }} PT Avencore Technology. Seluruh hak cipta dilindungi.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
