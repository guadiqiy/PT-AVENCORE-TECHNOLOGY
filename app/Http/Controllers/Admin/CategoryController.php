<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('services')->orderBy('name')->paginate(10);

        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->rules(), $this->messages());
        $data['slug'] = Category::uniqueSlug($data['name']);

        Category::create($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate($this->rules($category->id), $this->messages());
        $data['slug'] = Category::uniqueSlug($data['name'], $category->id);

        $category->update($data);

        return redirect()->route('admin.categories.index')
            ->with('success', 'Perubahan kategori berhasil disimpan.');
    }

    public function destroy(Category $category)
    {
        // layanan di dalam kategori ikut terhapus (cascade), jadi gambarnya dibersihkan dulu
        foreach ($category->services as $service) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
        }

        $category->delete();

        return redirect()->route('admin.categories.index')
            ->with('success', 'Kategori beserta layanannya berhasil dihapus.');
    }

    private function rules(?int $ignoreId = null): array
    {
        return [
            'name' => [
                'required', 'string', 'max:100',
                Rule::unique('categories', 'name')->ignore($ignoreId),
            ],
            'description' => ['nullable', 'string', 'max:500'],
        ];
    }

    private function messages(): array
    {
        return [
            'name.required'      => 'Nama kategori wajib diisi.',
            'name.max'           => 'Nama kategori maksimal 100 karakter.',
            'name.unique'        => 'Nama kategori sudah dipakai.',
            'description.max'    => 'Deskripsi maksimal 500 karakter.',
        ];
    }
}
