<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('message.inbox')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('layouts.frontend.partials.message.message-heading', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $grid->render(); ?>



    <?php echo $__env->make('layouts.frontend.partials.message.groupmessage-compose', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>