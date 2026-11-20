@extends('layouts.admin')

@section('title', 'Kategori')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <h1 class="mb-0">Kategori</h1>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-av">Tambah kategori</a>
</div>

<div class="av-panel">
    <div class="table-responsive">
        <table class="table av-table mb-0">
            <thead><tr><th>Nama</th><th>Deskripsi</th><th>Jumlah layanan</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                @forelse ($categories as $category)
                    <tr>
                        <td class="fw-semibold">{{ $category->name }}</td>
                        <td class="text-secondary">{{ \Illuminate\Support\Str::limit($category->description, 80) }}</td>
                        <td>{{ $category->services_count }}</td>
                        <td class="text-end text-nowrap">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary">Ubah</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm({{ \Illuminate\Support\Js::from('Hapus kategori ' . $category->name . '? ' . $category->services_count . ' layanan di dalamnya ikut terhapus.') }});">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-secondary">Belum ada kategori. Klik "Tambah kategori" untuk memulai.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $categories->links() }}</div>
</div>
@endsection
