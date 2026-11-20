@extends('layouts.admin')

@section('title', 'Ubah Layanan')

@section('content')
<h1 class="mb-4">Ubah layanan</h1>
<div class="av-panel">
    <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        @include('admin.services._form')
    </form>
</div>
@endsection
