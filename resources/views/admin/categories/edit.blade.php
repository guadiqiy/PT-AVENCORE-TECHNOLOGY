@extends('layouts.admin')

@section('title', 'Ubah Kategori')

@section('content')
<h1 class="mb-4">Ubah kategori</h1>
<div class="av-panel">
    <form action="{{ route('admin.categories.update', $category) }}" method="POST" novalidate>
        @csrf
        @method('PUT')
        @include('admin.categories._form')
    </form>
</div>
@endsection
