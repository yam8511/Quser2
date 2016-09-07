<?php $__env->startSection('title', 'Oauth Validate'); ?>

<?php $__env->startSection('content'); ?>
	<form action="<?php echo e(url('passport')); ?>" method="post" class="w3-form" >
		<?php echo e(csrf_field()); ?>

		<div class="w3-input-group">
			<label class="w3-label">驗證碼</label>
			<input type="text" name="secret" class="w3-input w3-border" placeholder="輸入驗證碼" required>
		</div>
		<button class="w3-btn w3-theme">驗證</button>
	</form>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>