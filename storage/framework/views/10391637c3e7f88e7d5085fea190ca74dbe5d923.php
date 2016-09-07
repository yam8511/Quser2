<?php $__env->startSection('title', 'Show QRCode'); ?>

<?php $__env->startSection('content'); ?>
	<h1>Your QR Code</h1>
	<img class="w3-round " src="<?php echo e($googleUrl); ?> ">
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>