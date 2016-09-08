<?php $__env->startSection('title', 'Validate'); ?>

<?php $__env->startSection('content'); ?>
	<h2 class="w3-margin w3-center">請選擇一驗證方式</h2>
	<div class="w3-row-padding">
		<div class="w3-col m6" >
			<div class="w3-container w3-center" >
				<a class="w3-round w3-btn w3-blue w3-xxlarge w3-margin" style="width: 100%;" href="<?php echo e(url('uploadQRCode')); ?>"><p>QR Code</p></a>
			</div>
		</div>
		<div class="w3-col m6">
			<div class="w3-container w3-center">
				<a class="w3-round w3-btn w3-yellow w3-xxlarge w3-margin" style="width: 100%;" href="<?php echo e(url('passport')); ?>"><p>OAuth</p></a>
			</div>
		</div>
	</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>