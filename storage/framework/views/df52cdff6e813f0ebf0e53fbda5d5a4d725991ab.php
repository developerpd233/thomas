<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="panel panel-default">
        <div class="panel-heading"><?php echo e(trans('Dashboard')); ?></div>
        <div class="panel-body">
            You are logged in! admin-dashboard by-ashish bhandari
        </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>