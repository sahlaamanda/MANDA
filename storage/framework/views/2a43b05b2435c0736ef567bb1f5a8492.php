

<?php $__env->startSection('title', 'Cutie Cosmetics'); ?>

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
                       Cutie Cosmetics
                    </h3>
                    <small>
                        Selamat Datang
                    </small>

                </div>

                <div class="login-body">
                    <?php if($errors->has('login')): ?>
                        <?php
                            $loginSeconds = (int) ($errors->get('login_seconds')[0] ?? 30);
                        ?>
                        <div class="alert alert-danger" role="alert" id="loginLockAlert" data-seconds="<?php echo e($loginSeconds); ?>">
                            <span id="loginLockMessage">Anda gagal login 3 kali. Silakan tunggu <strong id="loginCountdown"><?php echo e($loginSeconds); ?></strong> detik sebelum mencoba lagi.</span>
                        </div>
                    <?php endif; ?>

                    <form action="<?php echo e(route('auth')); ?>" method="POST" autocomplete="off">

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
                                autocomplete="off"

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
                                autocomplete="new-password"
                               
                                placeholder="Masukkan password"

                            >

                            <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>

                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        

                        <div class="d-grid">

                                <button type="submit"
                                    id="loginButton"
                                    class="btn btn-login"
                                    <?php if($errors->has('login')): ?> disabled <?php endif; ?>>
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

<?php if($errors->has('login')): ?>
    <script>
        const loginLockAlert = document.getElementById('loginLockAlert');
        const loginCountdown = document.getElementById('loginCountdown');
        const loginButton = document.getElementById('loginButton');
        let remainingSeconds = Number(loginLockAlert.dataset.seconds);

        const countdownTimer = setInterval(() => {
            remainingSeconds -= 1;
            loginCountdown.textContent = Math.max(remainingSeconds, 0);

            if (remainingSeconds <= 0) {
                clearInterval(countdownTimer);
                loginLockAlert.classList.remove('alert-danger');
                loginLockAlert.classList.add('alert-success');
                loginLockAlert.textContent = 'Waktu tunggu selesai. Silakan coba login kembali.';
                loginButton.disabled = false;
            }
        }, 1000);
    </script>
<?php endif; ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\MANDA\resources\views/login.blade.php ENDPATH**/ ?>