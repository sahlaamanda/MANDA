@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')

<style>
    body{
        background:#FFF8FA;
    }

    .page-title{
        background:linear-gradient(135deg,#800020,#A52A4D);
        color:white;
        padding:18px 25px;
        border-radius:20px;
        margin-bottom:25px;
        box-shadow:0 10px 25px rgba(128,0,32,.15);
    }

    .card-custom{
        background:white;
        border:none;
        border-radius:20px;
        padding:25px;
        box-shadow:0 10px 25px rgba(128,0,32,.08);
    }
</style>

<div class="container mt-4">

    <div class="page-title">
        <h2 class="mb-1">📦 Tambah Produk</h2>
        <small>Tambahkan produk baru ke daftar toko</small>
    </div>

    <div class="card-custom">

        <form
            action="{{ route('admin.produk.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @include('produk._form')

        </form>

    </div>

</div>

@endsection