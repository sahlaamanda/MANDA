

<?php $__env->startSection('title', 'kosmetik'); ?>

<?php $__env->startSection('content'); ?>

<style>

body{
    background:linear-gradient(135deg,#FFF7FA,#FFE4EC);
    font-family:'Poppins',sans-serif;
}

/* CARD */
.login-card{
    border:none;
    border-radius:25px;
    overflow:hidden;
    box-shadow:0 20px 45px rgba(128,0,32,.15);
}


/* HEADER */
.login-header{
    background:linear-gradient(135deg,#6A0019,#A52A4D);
    color:white;
    text-align:center;
    padding:30px;
}


.logo{
    width:80px;
    height:80px;
    background:white;
    color:#800020;
    border-radius:50%;
    margin:auto;
    display:flex;
    justify-content:center;
    align-items:center;
    font-size:40px;
    margin-bottom:15px;
}


/* BODY */
.login-body{
    background:white;
    padding:35px;
}


/* LABEL */
.form-label{
    color:#800020;
    font-weight:600;
}


/* INPUT */
.form-control{
    border-radius:12px;
    border:2px solid #F4C2D7;
    padding:12px;
}


.form-control:focus{
    border-color:#800020;
    box-shadow:0 0 10px rgba(128,0,32,.15);
}


/* BUTTON */
.btn-login{
    background:linear-gradient(135deg,#800020,#A52A4D);
    border:none;
    color:white;
    border-radius:12px;
    padding:12px;
    font-weight:600;
    transition:.3s;
}


.btn-login:hover{
    background:linear-gradient(135deg,#A52A4D,#800020);
    color:white;
    transform:translateY(-2px);

}


/* FOOTER */
.footer-text{
    text-align:center;
    color:#888;
    margin-top:20px;
    font-size:14px;
}

</style>

<div class="container">
    <div class="row justify-content-center align-items-center vh-100">
        <div class="col-md-5 col-lg-4">
            <div class="card login-card">
                <div class="login-header">
                    <div class="logo">
                        🛍️
                    </div>


                    <h3 class="fw-bold mb-1">
                        kosmetik
                    </h3>


                    <small>
                        Selamat Datang
                    </small>

                </div>

                <div class="login-body">
                    <form action="<?php echo e(route('auth')); ?>" method="POST">

                        <?php echo csrf_field(); ?>

                        

                        <div class="mb-3">


                            <label for="email" class="form-label">
                                Email
                            </label>


                            <input

                                type="email"
                                name="email"
                                id="email"
                                value="<?php echo e(old('email')); ?>"
                                class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"

                                placeholder="Masukkan email"
                                autofocus

                            >


                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                        </div>


                        

                        <div class="mb-4">

                            <label for="password" class="form-label">
                                Password
                            </label>


                            <input

                                type="password"
                                name="password"
                                id="password"
                                class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"

                                placeholder="Masukkan password"

                            >

                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <div class="invalid-feedback">
                                    <?php echo e($message); ?>

                                </div>

                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>


                        </div>

                        

                        <div class="d-grid">

                            <button type="submit"
                                    class="btn btn-login">
                                🔐 Login
                            </button>

                        </div>
                    </form>

                    <div class="footer-text">
                         POS Sahla © <?php echo e(date('Y')); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\MANDA\resources\views/login.blade.php ENDPATH**/ ?>