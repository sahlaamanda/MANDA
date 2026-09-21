

<?php $__env->startSection('title', 'POS'); ?>

<?php $__env->startSection('content'); ?>

<?php
    $subtotalPenjualan = $sale->itemPenjualan->sum('subtotal');
    $diskonPenjualan = $subtotalPenjualan - $sale->total_pembayaran;
?>

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

    #cashPaymentBox{
        display:none;
        background:#FFF0F5;
        border:2px solid #F4C2D7;
        border-radius:12px;
        padding:12px;
        margin-bottom:10px;
    }

    #kembalianText{
        font-weight:700;
        color:#800020;
    }

    #kembalianText.text-danger{
        color:#dc3545 !important;
    }

    #qrisPaymentBox{
        display:none;
        background:#FFF0F5;
        border:2px solid #F4C2D7;
        border-radius:12px;
        padding:16px;
        margin-bottom:10px;
        text-align:center;
    }

    #qrisPaymentBox img{
        max-width:220px;
        width:100%;
        border-radius:12px;
        border:2px solid #F4C2D7;
        background:#fff;
        padding:8px;
    }

    #qrisPaymentBox .qris-total{
        font-weight:700;
        color:#800020;
        margin-top:8px;
    }
</style>

<div class="container mt-4">

    
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    
    <?php if(session('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?php echo e(session('errors')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>


    
    <div class="page-title">
        <h2 class="mb-1">🛒 <?php echo e($mode === 'edit' ? 'Edit Penjualan' : 'Tambah Penjualan'); ?></h2>
        <small>Kelola transaksi penjualan</small>
    </div>


    <div class="row">


        
        <div class="col-md-6">

            <div class="card">

                <div class="card-body" style="max-height:70vh; overflow:auto">


                    
                    <div class="position-relative mb-3">
                        <label class="form-label">🔍 Cari Produk</label>
                        <input type="text"
                               id="searchProductInput"
                               class="form-control"
                               placeholder="Ketik nama produk..."
                               autocomplete="off"
                               <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>>

                        
                        <div id="productSearchResult" style="position: absolute; top: 100%; left: 0; right: 0; z-index: 1050; background: #fff; border: 1px solid #ced4da; border-radius: 6px; max-height: 250px; overflow-y: auto; display: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
                        </div>
                    </div>



                    
                    <form id="addToCartForm" action="<?php echo e(route('admin.itempenjualan.store')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id" id="formProductId">
                        <input type="hidden" name="quantity" value="1">
                    </form>



                    
                    <div id="defaultProductList">
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <form method="POST"
                                  action="<?php echo e(route('admin.itempenjualan.store')); ?>"
                                  class="row mb-2">

                                <?php echo csrf_field(); ?>

                                <input type="hidden"
                                       name="product_id"
                                       value="<?php echo e($product->id); ?>">

                                
                                <div class="col-7">

                                    <button type="submit"
                                            class="btn btn-outline-maroon w-100 text-start p-2
                                            <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>">

                                        <div>
                                            <div class="fw-semibold">
                                                <?php echo e($product->nama); ?>

                                            </div>

                                            <small class="text-muted">
                                                Rp <?php echo e(number_format($product->harga_jual)); ?>

                                            </small>
                                        </div>

                                    </button>

                                </div>

                                
                                <div class="col-3">

                                    <input type="number"
                                           name="quantity"
                                           value="1"
                                           min="1"
                                           class="form-control"
                                           <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>>

                                </div>

                                
                                <div class="col-2">

                                    <button type="submit"
                                            class="btn btn-maroon w-100
                                            <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>">
                                        +
                                    </button>

                                </div>

                            </form>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>


                </div>

            </div>

        </div>





        
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


                    <?php $__empty_1 = true; $__currentLoopData = $sale->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>


                            <td>
                                <?php echo e($item->produk->nama); ?>

                            </td>


                            <td>
                                Rp <?php echo e(number_format($item->harga_satuan)); ?>

                            </td>



                            
                            <td>

                                <form method="POST"
                                      action="<?php echo e(route('admin.itempenjualan.update', $item->id)); ?>">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>


                                    <input type="number"
                                           name="quantity"
                                           value="<?php echo e($item->kuantitas); ?>"
                                           min="1"
                                           class="form-control form-control-sm"
                                           onchange="this.form.submit()"
                                           <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>>

                                </form>

                            </td>



                            <td>
                                Rp <?php echo e(number_format($item->subtotal)); ?>

                            </td>



                            
                            <td>

                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $item)): ?>

                                <form method="POST"
                                      action="<?php echo e(route('admin.itempenjualan.destroy', $item->id)); ?>"
                                      onsubmit="return confirm('Hapus item ini?')">

                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>


                                    <button class="btn btn-hapus btn-sm"
                                            <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>>
                                        Hapus
                                    </button>


                                </form>

                                <?php endif; ?>

                            </td>


                        </tr>


                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>


                        <tr>

                            <td colspan="5"
                                class="text-center text-muted">

                                Keranjang kosong

                            </td>

                        </tr>


                    <?php endif; ?>


                    </tbody>


                </table>





                
                <div class="card-footer">

                    <div class="d-flex justify-content-between">
                        <span>Subtotal:</span>
                        <span>Rp <?php echo e(number_format($subtotalPenjualan, 0, ',', '.')); ?></span>
                    </div>
                    <div class="d-flex justify-content-between text-danger">
                        <span>Diskon (15%):</span>
                        <span>- Rp <?php echo e(number_format($diskonPenjualan, 0, ',', '.')); ?></span>
                    </div>
                    <h5 class="d-flex justify-content-between mt-2 mb-2" style="color:#800020;">
                        <span>Total:</span>
                        <span>Rp <?php echo e(number_format($sale->total_pembayaran, 0, ',', '.')); ?></span>
                    </h5>





                    
                    <form method="POST"
                          action="<?php echo e(route('admin.penjualan.update', $sale->id)); ?>"
                          id="checkoutForm"
                          onsubmit="return validateCashPayment()">

                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>



                        <select name="payment_method"
                                id="paymentMethod"
                                class="form-select mb-2"
                                required
                                <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>>


                            <option value=""
                                    disabled
                                    <?php echo e(old('payment_method') ? '' : 'selected'); ?>>

                                Pilih Pembayaran

                            </option>


                            <option value="CASH" <?php echo e(old('payment_method') === 'CASH' ? 'selected' : ''); ?>>

                                Cash

                            </option>


                            <option value="QRIS" <?php echo e(old('payment_method') === 'QRIS' ? 'selected' : ''); ?>>

                                QRIS

                            </option>


                        </select>


                        
                        <div id="cashPaymentBox">

                            <label class="form-label mb-1">Jumlah Bayar</label>
                            <input type="number"
                                   name="jumlah_bayar"
                                   id="jumlahBayar"
                                   class="form-control mb-2"
                                   min="0"
                                   placeholder="Masukkan nominal uang tunai"
                                   <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>>

                            <div class="d-flex justify-content-between">
                                <span>Kembalian:</span>
                                <span id="kembalianText">Rp 0</span>
                            </div>

                        </div>


                        
                        <div id="qrisPaymentBox">

                            <img src="<?php echo e(asset('images/qris.png')); ?>" alt="QRIS">

                            <div class="qris-total">
                                Rp <?php echo e(number_format($sale->total_pembayaran, 0, ',', '.')); ?>

                            </div>

                            <small class="text-muted d-block mt-1">
                                Scan kode di atas menggunakan aplikasi e-wallet/mobile banking
                            </small>

                        </div>


                        <button type="submit"
                                class="btn btn-maroon w-100
                                <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>">

                            Checkout

                        </button>


                    </form>






                    
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $sale)): ?>

                    <form action="<?php echo e(route('admin.penjualan.destroy', $sale->id)); ?>"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin membatalkan transaksi?')"
                          class="mt-2">


                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>



                        <button class="btn btn-outline-maroon-danger w-100
                                <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>">

                            Batal Transaksi

                        </button>


                    </form>


                    <?php endif; ?>



                </div>



            </div>


        </div>



    </div>


</div>



<script>
    const productsList = <?php echo json_encode($products, 15, 512) ?>;
    const totalPembayaran = <?php echo e($sale->total_pembayaran); ?>;

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

    // ===== TOGGLE KOTAK PEMBAYARAN SESUAI METODE =====
    const paymentMethod = document.getElementById('paymentMethod');
    const cashPaymentBox = document.getElementById('cashPaymentBox');
    const jumlahBayar = document.getElementById('jumlahBayar');
    const kembalianText = document.getElementById('kembalianText');
    const qrisPaymentBox = document.getElementById('qrisPaymentBox');

    function togglePaymentBox() {
        if (paymentMethod.value === 'CASH') {

            cashPaymentBox.style.display = 'block';
            jumlahBayar.setAttribute('required', 'required');

            qrisPaymentBox.style.display = 'none';

        } else if (paymentMethod.value === 'QRIS') {

            qrisPaymentBox.style.display = 'block';

            cashPaymentBox.style.display = 'none';
            jumlahBayar.removeAttribute('required');
            jumlahBayar.value = '';
            kembalianText.textContent = 'Rp 0';
            kembalianText.classList.remove('text-danger');

        } else {

            cashPaymentBox.style.display = 'none';
            qrisPaymentBox.style.display = 'none';
            jumlahBayar.removeAttribute('required');

        }
    }

    function hitungKembalian() {
        const bayar = parseFloat(jumlahBayar.value) || 0;
        const kembalian = bayar - totalPembayaran;

        if (kembalian < 0) {
            kembalianText.textContent = 'Kurang Rp ' + Math.abs(kembalian).toLocaleString('id-ID');
            kembalianText.classList.add('text-danger');
        } else {
            kembalianText.textContent = 'Rp ' + kembalian.toLocaleString('id-ID');
            kembalianText.classList.remove('text-danger');
        }
    }

    function validateCashPayment() {
        if (paymentMethod.value === 'CASH') {
            const bayar = parseFloat(jumlahBayar.value) || 0;
            if (bayar < totalPembayaran) {
                alert('Jumlah bayar tidak boleh kurang dari total pembayaran.');
                return false;
            }
        }
        return confirm('Yakin ingin checkout?');
    }

    if (paymentMethod) {
        paymentMethod.addEventListener('change', togglePaymentBox);
        jumlahBayar.addEventListener('input', hitungKembalian);
        togglePaymentBox(); // jalankan sekali saat load, untuk kasus old('payment_method')
    }
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\MANDA\resources\views/penjualan/pos.blade.php ENDPATH**/ ?>