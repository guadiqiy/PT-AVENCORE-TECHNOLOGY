@extends('layouts.app')

@section('title', 'Kontak')

@section('content')
<section class="av-page-head">
    <div class="container">
        <h1>Kontak</h1>
        <p>Ceritakan kebutuhan usaha Anda. Kami akan membalas secepatnya pada jam kerja.</p>
    </div>
</section>

<section class="av-section">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <dl class="mb-0">
                    <div class="av-contact-item"><dt>Email</dt><dd>info@avencore.test</dd></div>
                    <div class="av-contact-item"><dt>Telepon</dt><dd>+62 813-7366-6466</dd></div>
                    <div class="av-contact-item"><dt>Alamat</dt><dd>Jl. Zaenal Abidin No. 1, Indonesia</dd></div>
                    <div class="av-contact-item"><dt>Jam kerja</dt><dd>Senin sampai Jumat, 08.00 sampai 17.00</dd></div>
                </dl>
            </div>
            <div class="col-lg-5">
                <div class="av-aside">
                    <h2 class="h5">Chat langsung</h2>
                    <p class="text-secondary">Cara tercepat untuk bertanya soal layanan dan harga.</p>
                    <a class="btn btn-av" href="https://wa.me/6281373666466" target="_blank" rel="noopener">Chat lewat WhatsApp</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
