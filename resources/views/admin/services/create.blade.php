@extends('layouts.admin')

@section('title', 'Tambah Layanan')

@section('content')
<h1 class="mb-4">Tambah layanan</h1>
<div class="av-panel">
    <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @include('admin.services._form')
    </form>
</div>
@endsection
