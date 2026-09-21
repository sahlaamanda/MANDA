

<?php $__env->startSection('title', 'Dashboard Kasir'); ?>

<?php $__env->startSection('content'); ?>

<style>

body{
    background:#FFF8FA;
}

.kasir-card{
    background:white;
    border-radius:25px;
    padding:40px;
    box-shadow:0 10px 30px rgba(128,0,32,.1);
}

.btn-maroon{
    background:#800020;
    color:white;
    border-radius:12px;
    padding:12px 25px;
    border:none;
}

.btn-maroon:hover{
    background:#A52A4D;
    color:white;
}

</style>


<div class="container mt-4">

    <div class="kasir-card text-center">

        <h2 class="fw-bold">
            🛒 Dashboard Kasir
        </h2>

        <p class="text-muted">
            Selamat datang di halaman kasir POS Sahla
        </p>


        <a href="<?php echo e(route('admin.penjualan.create')); ?>"
           class="btn btn-maroon mt-3">

            ➕ Buat Transaksi

        </a>


    </div>

</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\MANDA\resources\views\kasir\dashboard.blade.php ENDPATH**/ ?>