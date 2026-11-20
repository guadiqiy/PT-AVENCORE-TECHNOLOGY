@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<h1 class="mb-4">Dashboard</h1>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="av-stat">
            <div class="num">{{ $serviceCount }}</div>
            <div class="lbl">Layanan</div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="av-stat">
            <div class="num">{{ $categoryCount }}</div>
            <div class="lbl">Kategori</div>
        </div>
    </div>
</div>

<div class="av-panel">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="h5 mb-0">Layanan terbaru</h2>
        <a href="{{ route('admin.services.create') }}" class="btn btn-av btn-sm">Tambah layanan</a>
    </div>
    <div class="table-responsive">
        <table class="table av-table mb-0">
            <thead><tr><th>Nama</th><th>Kategori</th><th>Harga</th></tr></thead>
            <tbody>
                @forelse ($latest as $service)
                    <tr>
                        <td>{{ $service->name }}</td>
                        <td>{{ $service->category->name }}</td>
                        <td>{{ $service->price_label }}</td>
                    </tr>
                @empty
                    <tr><td colspan="3" class="text-secondary">Belum ada layanan. Mulai dengan menambahkan layanan pertama.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
