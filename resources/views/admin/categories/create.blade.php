@extends('layouts.admin')

@section('title', 'Tambah Kategori')

@section('content')
<h1 class="mb-4">Tambah kategori</h1>
<div class="av-panel">
    <form action="{{ route('admin.categories.store') }}" method="POST" novalidate>
        @csrf
        @include('admin.categories._form')
    </form>
</div>
@endsection
