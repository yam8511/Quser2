<?php $__env->startSection('title', 'Show QRCode'); ?>

<?php $__env->startSection('content'); ?>
<div class="w3-container w3-center">
	<h1>Your QR Code</h1>
	<p><a class="w3-btn w3-theme w3-round" href="<?php echo e(url('/resetQrcode')); ?>" onclick="event.preventDefault(); document.getElementById('resetQR-form').submit();">重設QRCode</a></p>

	<img class="w3-round" src="<?php echo e($googleUrl); ?> ">
    <form id="resetQR-form" action="<?php echo e(url('/resetQrcode')); ?>" method="POST" style="display: none;">
    <?php echo e(csrf_field()); ?>

    </form>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>