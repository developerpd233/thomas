<?php $__env->startSection('page_title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <br>
    <br>
    <br>
    <div class="alert alert-danger" role="alert">
        <span class="alert-link">
            <h3><b><i><?php echo e(__('app.ban')); ?></i></b></h3>
        </span>
    </div>
    <br>
    <br>
    <br>
<?php $__env->stopSection(); ?>

<!--

<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Help')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
 <h1>Your account has been banned by admin</h1>
    <h3 style="padding-bottom: 23px">The reason of banning account may me due to non-payment of monthly fee</h3>
<?php $__env->stopSection(); ?>
-->
<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>