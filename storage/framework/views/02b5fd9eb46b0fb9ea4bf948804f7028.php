

<?php $__env->startSection('title', 'Edit User'); ?>

<?php $__env->startSection('content'); ?>

<h4>Edit User</h4>

<form action="<?php echo e(route('admin.users.update', $user->id)); ?>"
      method="POST">

    <?php echo csrf_field(); ?>
    <?php echo method_field('PATCH'); ?>

    <?php echo $__env->make('users._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <button type="submit" class="btn btn-success">
        Update
    </button>

</form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\MANDA\resources\views\users\edit.blade.php ENDPATH**/ ?>