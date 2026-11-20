@extends('layouts.admin')

@section('title', 'Layanan')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <h1 class="mb-0">Layanan</h1>
    <a href="{{ route('admin.services.create') }}" class="btn btn-av">Tambah layanan</a>
</div>

<div class="av-panel">
    <div class="table-responsive">
        <table class="table av-table mb-0">
            <thead>
                <tr><th>Gambar</th><th>Nama</th><th>Kategori</th><th>Harga</th><th class="text-end">Aksi</th></tr>
            </thead>
            <tbody>
                @forelse ($services as $service)
                    <tr>
                        <td>
                            @if ($service->image_url)
                                <img class="thumb" src="{{ $service->image_url }}" alt="{{ $service->name }}">
                            @else
                                <span class="text-secondary small">Belum ada</span>
                            @endif
                        </td>
                        <td class="fw-semibold">{{ $service->name }}</td>
                        <td>{{ $service->category->name }}</td>
                        <td>{{ $service->price_label }}</td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('services.show', $service->slug) }}" class="btn btn-sm btn-outline-secondary" target="_blank" rel="noopener">Lihat</a>
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-outline-primary">Ubah</a>
                            <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm({{ \Illuminate\Support\Js::from('Hapus layanan ' . $service->name . '?') }});">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="text-secondary">Belum ada layanan. Klik "Tambah layanan" untuk memulai.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $services->links() }}</div>
</div>
@endsection
