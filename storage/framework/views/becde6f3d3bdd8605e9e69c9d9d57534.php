

<?php $__env->startSection('title', 'Detail Penjualan'); ?>

<?php $__env->startSection('content'); ?>

<?php
    $subtotalPenjualan = $sale->itemPenjualan->sum('subtotal');
    $diskonPenjualan = $subtotalPenjualan - $sale->total_pembayaran;
?>

<div class="container">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Detail Penjualan</h2>
        
        
        <?php if($sale->status === 'COMPLETED'): ?>
            <a href="<?php echo e(route('admin.penjualan.struk', $sale->id)); ?>" target="_blank" class="btn btn-success">
                🖨️ Cetak Struk
            </a>
        <?php endif; ?>
    </div>

    
    <div class="card mb-4">
        <div class="card-body">

            <p><strong>Tanggal:</strong> <?php echo e($sale->created_at->format('d-m-Y H:i:s')); ?></p>
            <p><strong>Kasir:</strong> <?php echo e($sale->user->name); ?></p>
            <p><strong>Metode Pembayaran:</strong> <?php echo e($sale->metode_pembayaran); ?></p>
            <p><strong>Status:</strong> <?php echo e($sale->status); ?></p>
            <p><strong>Subtotal:</strong> Rp.<?php echo e(number_format($subtotalPenjualan,0,',','.')); ?></p>
            <p><strong>Diskon (15%):</strong> - Rp.<?php echo e(number_format($diskonPenjualan,0,',','.')); ?></p>
            <p><strong>Total:</strong> Rp.<?php echo e(number_format($sale->total_pembayaran,0,',','.')); ?></p>

            <?php if($sale->metode_pembayaran === 'CASH'): ?>
                <p><strong>Uang Bayar:</strong> Rp.<?php echo e(number_format((int) ($sale->jumlah_bayar ?? 0),0,',','.')); ?></p>
                <p><strong>Kembalian:</strong> Rp.<?php echo e(number_format((int) ($sale->kembalian ?? 0),0,',','.')); ?></p>
            <?php endif; ?>

        </div>
    </div>

    
    <div class="card">
        <div class="card-body">

            <h5 class="mb-3">Item Produk</h5>

            <div class="table-responsive">
                <table class="table table-bordered">

                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php $__currentLoopData = $sale->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($loop->iteration); ?></td>
                            <td><?php echo e($item->produk->nama); ?></td>
                            <td>Rp.<?php echo e(number_format($item->harga_satuan,0,',','.')); ?></td>
                            <td><?php echo e($item->kuantitas); ?></td>
                            <td>Rp.<?php echo e(number_format($item->subtotal,0,',','.')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>

                </table>
            </div>

        </div>
    </div>

    <div class="mt-3">
        <a href="<?php echo e(route('admin.penjualan.index')); ?>" class="btn btn-secondary">
            Kembali
        </a>
    </div>

</div>

<?php $__env->stopSection(); ?> 
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\MANDA\resources\views/penjualan/show.blade.php ENDPATH**/ ?>