<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Manage Page')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $grid->render(); ?>

	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>