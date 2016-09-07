<?php $__env->startSection('title', 'Get QRCode'); ?>

<?php $__env->startSection('content'); ?>
	<form class="w3-form"action="<?php echo e(url('getQRCode')); ?>" method="post">
		<?php echo e(csrf_field()); ?>

		<div class="w3-input-group">
			<label class="w3-label">User ID</label>
			<input type="text" name="id" class="w3-input" placeholder="輸入User ID" required>
		</div>
		<button name="getQR" class="w3-btn w3-theme w3-round">產生QR Code</button>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>