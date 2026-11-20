@php($editing = isset($category))

<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Nama kategori</label>
        <input type="text" id="name" name="name" value="{{ old('name', $editing ? $category->name : '') }}"
               class="form-control @error('name') is-invalid @enderror" maxlength="100">
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea id="description" name="description" rows="3" maxlength="500"
                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $editing ? $category->description : '') }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>

<div class="mt-4 d-flex gap-2">
    <button type="submit" class="btn btn-av">Simpan</button>
    <a href="{{ route('admin.categories.index') }}" class="btn btn-av-outline">Batal</a>
</div>
