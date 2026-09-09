

<?php $__env->startSection('title', 'Tentang Aplikasi'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .about-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(128, 0, 32, .08);
        border: 1px solid #F4E4EB;
        overflow: hidden;
    }
    .about-header {
        background: linear-gradient(135deg, #6A0019, #800020);
        color: white;
        padding: 30px;
    }
    .feature-box {
        padding: 16px;
        border-radius: 12px;
        background: #FFF8FA;
        border: 1px solid #F4E4EB;
        height: 100%;
    }
</style>

<div class="container mt-4" style="max-width: 800px;">
    <div class="about-card mb-4">
        <div class="about-header text-center">
            <h3 class="fw-bold mb-1">Point of Sale (POS) </h3>
            <p class="mb-0 opacity-75">Sistem Manajemen Penjualan Toko / Kasir</p>
        </div>
        <div class="p-4">
            <h5 class="fw-bold text-danger mb-3">Tentang Sistem</h5>
            <p class="text-muted leading-relaxed">
                Aplikasi POS ini dirancang untuk memudahkan proses pengelolaan stok produk, kategori barang, hingga pencatatan transaksi penjualan secara efisien. Sistem ini juga dilengkapi dengan cetak struk dan manajemen akses untuk Admin serta Kasir.
            </p>

            <h5 class="fw-bold text-danger mt-4 mb-3">Fitur Utama</h5>
            <div class="row g-3">
                <div class="col-md-6">
                    <div class="feature-box">
                        <h6 class="fw-bold text-dark"><i class="bi bi-cart-check text-danger me-2"></i>Transaksi Kasir</h6>
                        <small class="text-muted">Pencatatan transaksi cepat lengkap dengan kalkulasi kembalian dan cetak struk.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-box">
                        <h6 class="fw-bold text-dark"><i class="bi bi-box-seam text-danger me-2"></i>Manajemen Produk</h6>
                        <small class="text-muted">Kelola data barang, harga, jenis/kategori, dan pantau ketersediaan stok.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-box">
                        <h6 class="fw-bold text-dark"><i class="bi bi-people text-danger me-2"></i>Multi Role Access</h6>
                        <small class="text-muted">Pembagian hak akses yang aman antara Admin dan Kasir.</small>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-box">
                        <h6 class="fw-bold text-dark"><i class="bi bi-receipt text-danger me-2"></i>Riwayat & Struk</h6>
                        <small class="text-muted">Menyimpan riwayat transaksi dan mencetak bukti pembayaran dengan mudah.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\MANDA\resources\views/tentang/about.blade.php ENDPATH**/ ?>