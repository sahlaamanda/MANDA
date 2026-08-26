@extends('layouts.app')

@section('title', 'POS')

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

    .card{
        border:none;
        border-radius:20px;
        box-shadow:0 10px 25px rgba(128,0,32,.08);
    }

    .form-control, .form-select{
        border-radius:12px;
        border:2px solid #F4C2D7;
    }

    .form-control:focus, .form-select:focus{
        border-color:#A52A4D;
        box-shadow:0 0 0 .2rem rgba(128,0,32,.15);
    }

    .form-label{
        color:#800020;
        font-weight:600;
    }

    .btn-outline-maroon{
        background:white;
        color:#800020;
        border:2px solid #F4C2D7;
        border-radius:12px;
    }

    .btn-outline-maroon:hover{
        background:#FFF0F5;
        color:#800020;
        border-color:#A52A4D;
    }

    .btn-maroon{
        background:#800020;
        color:white;
        border:none;
        border-radius:12px;
    }

    .btn-maroon:hover{
        background:#A52A4D;
        color:white;
    }

    .btn-outline-maroon-danger{
        background:white;
        color:#800020;
        border:2px solid #800020;
        border-radius:12px;
    }

    .btn-outline-maroon-danger:hover{
        background:#800020;
        color:white;
    }

    .btn-hapus{
        background:#800020;
        color:white;
        border:none;
        border-radius:10px;
    }

    .btn-hapus:hover{
        background:#A52A4D;
        color:white;
    }

    .table thead{
        background:#800020;
        color:white;
    }

    .table thead th{
        border:none;
    }

    .table tbody tr:hover{
        background:#FFF0F5;
    }

    #productSearchResult{
        border:2px solid #F4C2D7 !important;
        border-radius:12px !important;
    }
</style>

<div class="container mt-4">

    {{-- SUCCESS ALERT --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- ERROR ALERT --}}
    @if(session('errors'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('errors') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif


    {{-- TITLE --}}
    <div class="page-title">
        <h2 class="mb-1">🛒 {{ $mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan' }}</h2>
        <small>Kelola transaksi penjualan</small>
    </div>


    <div class="row">


        {{-- ==================== PRODUK ==================== --}}
        <div class="col-md-6">

            <div class="card">

                <div class="card-body" style="max-height:70vh; overflow:auto">


                    {{-- LIVE SEARCH INPUT --}}
                    <div class="position-relative mb-3">
                        <label class="form-label">🔍 Cari Produk</label>
                        <input type="text"
                               id="searchProductInput"
                               class="form-control"
                               placeholder="Ketik nama produk..."
                               autocomplete="off"
                               {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                        {{-- DROPDOWN HASIL PENCARIAN --}}
                        <div id="productSearchResult" style="position: absolute; top: 100%; left: 0; right: 0; z-index: 1050; background: #fff; border: 1px solid #ced4da; border-radius: 6px; max-height: 250px; overflow-y: auto; display: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        </div>
                    </div>



                    {{-- FORM TERSEMBUNYI UNTUK ADD TO CART --}}
                    <form id="addToCartForm" action="{{ route('admin.itempenjualan.store') }}" method="POST" style="display: none;">
                        @csrf
                        <input type="hidden" name="product_id" id="formProductId">
                        <input type="hidden" name="quantity" value="1">
                    </form>



                    {{-- LIST PRODUK DEFAULT --}}
                    <div id="defaultProductList">
                        @foreach($products as $product)

                            <form method="POST"
                                  action="{{ route('admin.itempenjualan.store') }}"
                                  class="row mb-2">

                                @csrf

                                <input type="hidden"
                                       name="product_id"
                                       value="{{ $product->id }}">

                                {{-- NAMA PRODUK --}}
                                <div class="col-7">

                                    <button type="submit"
                                            class="btn btn-outline-maroon w-100 text-start p-2
                                            {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">

                                        <div>
                                            <div class="fw-semibold">
                                                {{ $product->nama }}
                                            </div>

                                            <small class="text-muted">
                                                Rp {{ number_format($product->harga_jual) }}
                                            </small>
                                        </div>

                                    </button>

                                </div>

                                {{-- QTY --}}
                                <div class="col-3">

                                    <input type="number"
                                           name="quantity"
                                           value="1"
                                           min="1"
                                           class="form-control"
                                           {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                                </div>

                                {{-- TAMBAH --}}
                                <div class="col-2">

                                    <button type="submit"
                                            class="btn btn-maroon w-100
                                            {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                                        +
                                    </button>

                                </div>

                            </form>

                        @endforeach
                    </div>


                </div>

            </div>

        </div>





        {{-- ==================== KERANJANG ==================== --}}
        <div class="col-md-6">

            <div class="card">


                <table class="table table-bordered mb-0">

                    <thead>

                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th width="90">Qty</th>
                            <th>Subtotal</th>
                            <th width="80">Aksi</th>
                        </tr>

                    </thead>



                    <tbody>


                    @forelse($sale->itemPenjualan as $item)

                        <tr>


                            <td>
                                {{ $item->produk->nama }}
                            </td>


                            <td>
                                Rp {{ number_format($item->harga_satuan) }}
                            </td>



                            {{-- UPDATE QTY --}}
                            <td>

                                <form method="POST"
                                      action="{{ route('admin.itempenjualan.update', $item->id) }}">

                                    @csrf
                                    @method('PUT')


                                    <input type="number"
                                           name="quantity"
                                           value="{{ $item->kuantitas }}"
                                           min="1"
                                           class="form-control form-control-sm"
                                           onchange="this.form.submit()"
                                           {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>

                                </form>

                            </td>



                            <td>
                                Rp {{ number_format($item->subtotal) }}
                            </td>



                            {{-- HAPUS ITEM --}}
                            <td>

                                @can('delete', $item)

                                <form method="POST"
                                      action="{{ route('admin.itempenjualan.destroy', $item->id) }}"
                                      onsubmit="return confirm('Hapus item ini?')">

                                    @csrf
                                    @method('DELETE')


                                    <button class="btn btn-hapus btn-sm"
                                            {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                        Hapus
                                    </button>


                                </form>

                                @endcan

                            </td>


                        </tr>


                    @empty


                        <tr>

                            <td colspan="5"
                                class="text-center text-muted">

                                Keranjang kosong

                            </td>

                        </tr>


                    @endforelse


                    </tbody>


                </table>





                {{-- FOOTER --}}
                <div class="card-footer">


                    <h5 class="mb-2" style="color:#800020;">

                        Total:
                        Rp {{ number_format($sale->total_pembayaran) }}

                    </h5>





                    {{-- CHECKOUT --}}
                    <form method="POST"
                          action="{{ route('admin.penjualan.update', $sale->id) }}"
                          onsubmit="return confirm('Yakin ingin checkout?')">

                        @csrf
                        @method('PUT')



                        <select name="payment_method"
                                class="form-select mb-2"
                                required
                                {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>


                            <option value=""
                                    disabled
                                    selected>

                                Pilih Pembayaran

                            </option>


                            <option value="CASH">

                                Cash

                            </option>


                            <option value="QRIS">

                                QRIS

                            </option>


                        </select>





                        <button type="submit"
                                class="btn btn-maroon w-100
                                {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">

                            Checkout

                        </button>


                    </form>






                    {{-- BATAL TRANSAKSI --}}
                    @can('delete', $sale)

                    <form action="{{ route('admin.penjualan.destroy', $sale->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin membatalkan transaksi?')"
                          class="mt-2">


                        @csrf
                        @method('DELETE')



                        <button class="btn btn-outline-maroon-danger w-100
                                {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">

                            Batal Transaksi

                        </button>


                    </form>


                    @endcan



                </div>



            </div>


        </div>



    </div>


</div>


{{-- JAVASCRIPT LIVE SEARCH PRODUK --}}
<script>
    const productsList = @json($products);

    const searchInput = document.getElementById('searchProductInput');
    const searchResult = document.getElementById('productSearchResult');
    const defaultList = document.getElementById('defaultProductList');
    const formProductId = document.getElementById('formProductId');
    const addToCartForm = document.getElementById('addToCartForm');

    if (searchInput) {
        searchInput.addEventListener('input', function() {
            const keyword = this.value.toLowerCase().trim();
            searchResult.innerHTML = '';

            if (keyword.length === 0) {
                searchResult.style.display = 'none';
                defaultList.style.display = 'block';
                return;
            }

            defaultList.style.display = 'none';
            const filtered = productsList.filter(p => p.nama.toLowerCase().includes(keyword));

            if (filtered.length > 0) {
                filtered.forEach(p => {
                    const item = document.createElement('div');
                    item.style.padding = '10px 15px';
                    item.style.cursor = 'pointer';
                    item.style.borderBottom = '1px solid #f1f1f1';
                    item.innerHTML = `
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <strong>${p.nama}</strong><br>
                                <small class="text-muted">Stok: ${p.stok ?? '-'}</small>
                            </div>
                            <span class="fw-bold" style="color:#800020;">Rp ${Number(p.harga_jual).toLocaleString('id-ID')}</span>
                        </div>
                    `;

                    item.addEventListener('mouseenter', () => item.style.background = '#FFF0F5');
                    item.addEventListener('mouseleave', () => item.style.background = '#fff');

                    item.addEventListener('click', function() {
                        formProductId.value = p.id;
                        addToCartForm.submit();
                    });

                    searchResult.appendChild(item);
                });
                searchResult.style.display = 'block';
            } else {
                searchResult.innerHTML = `<div class="p-3 text-muted text-center">Produk tidak ditemukan</div>`;
                searchResult.style.display = 'block';
            }
        });

        document.addEventListener('click', function(e) {
            if (!searchInput.contains(e.target) && !searchResult.contains(e.target)) {
                searchResult.style.display = 'none';
                if (searchInput.value.trim() === '') {
                    defaultList.style.display = 'block';
                }
            }
        });
    }
</script>

@endsection