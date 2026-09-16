

<?php $__env->startSection('title', 'Tambah User'); ?>

<?php $__env->startSection('content'); ?>

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
        <h2 class="mb-1">👤 Tambah User</h2>
        <small>Tambahkan pengguna baru ke sistem</small>
    </div>

    <div class="card-custom">

        <form action="<?php echo e(route('admin.users.store')); ?>"
              method="POST">

            <?php echo csrf_field(); ?>

            <?php echo $__env->make('users._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        </form>

    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\MANDA\resources\views/users/create.blade.php ENDPATH**/ ?>