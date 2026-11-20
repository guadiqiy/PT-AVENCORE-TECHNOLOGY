@php($editing = isset($service))

<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Nama layanan</label>
        <input type="text" id="name" name="name" value="{{ old('name', $editing ? $service->name : '') }}"
               class="form-control @error('name') is-invalid @enderror" maxlength="150">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="category_id" class="form-label">Kategori</label>
        <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
            <option value="">Pilih kategori</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}"
                    @selected((string) old('category_id', $editing ? $service->category_id : '') === (string) $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
        @if ($categories->isEmpty())
            <div class="form-text text-danger">Belum ada kategori. <a href="{{ route('admin.categories.create') }}">Tambah kategori dulu</a>.</div>
        @endif
    </div>

    <div class="col-12">
        <label for="summary" class="form-label">Ringkasan</label>
        <input type="text" id="summary" name="summary" value="{{ old('summary', $editing ? $service->summary : '') }}"
               class="form-control @error('summary') is-invalid @enderror" maxlength="255">
        <div class="form-text">Satu kalimat singkat yang tampil di kartu layanan.</div>
        @error('summary')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-12">
        <label for="description" class="form-label">Deskripsi lengkap</label>
        <textarea id="description" name="description" rows="7"
                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $editing ? $service->description : '') }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="price" class="form-label">Harga mulai dari (Rp)</label>
        <input type="number" id="price" name="price" min="0" step="1" value="{{ old('price', $editing ? $service->price : 0) }}"
               class="form-control @error('price') is-invalid @enderror">
        <div class="form-text">Isi 0 jika harga dibahas lewat konsultasi.</div>
        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="col-md-6">
        <label for="image" class="form-label">Gambar layanan</label>
        <input type="file" id="image" name="image" accept="image/png,image/jpeg,image/webp"
               class="form-control @error('image') is-invalid @enderror">
        <div class="form-text">Format jpg, png, atau webp. Maksimal 2 MB.</div>
        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
        @if ($editing && $service->image_url)
            <div class="mt-2">
                <img src="{{ $service->image_url }}" alt="Gambar saat ini" style="max-height: 90px; border-radius: 8px;">
                <div class="form-text">Gambar saat ini. Pilih file baru untuk menggantinya.</div>
            </div>
        @endif
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-av">Simpan</button>
    <a href="{{ route('admin.services.index') }}" class="btn btn-av-outline">Batal</a>
</div>
