@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1 class="text-danger">403 - Akses Ditolak</h1>
    <p>Anda tidak memiliki izin untuk mengakses halaman ini.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Kembali ke Beranda</a>
</div>
@endsection
