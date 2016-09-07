<?php $__env->startSection('title', 'Upload QRCode'); ?>

<?php $__env->startSection('content'); ?>
	<form enctype="multipart/form-data" action="<?php echo e(url('uploadQRCode')); ?>" method="post" class="w3-form" >
		<?php echo e(csrf_field()); ?>

		<div class="w3-input-group">
			<label class="w3-label">Upload Your QR</label>
			<input type="file" name="qrImg" class="w3-input w3-border w3-light-grey" required>
		</div>
		<button class="w3-btn w3-theme">Upload</button>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>