<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Commission')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>



<?php echo $grid->render(); ?>



	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>