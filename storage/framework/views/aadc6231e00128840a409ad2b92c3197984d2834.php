

<?php $__env->startSection('page_title'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <br>
    <div class="alert alert-success" role="alert">
        <a href="#" class="alert-link">
        <?php if($blockAlert == '3'): ?>
            <?php echo e(__('app.not_active3')); ?>

            </a> &nbsp;&nbsp;&nbsp;
            <a style="color : #fff" type="button" class="btn btn-success"
           href="<?php echo e(route('online-payment.activate')); ?>"> <?php echo e(__('app.click_here')); ?></a>
        <?php elseif($blockAlert == '2'): ?>
            <?php echo e(__('app.not_active2')); ?>

            </a> &nbsp;&nbsp;&nbsp;
            <a style="color : #fff" type="button" class="btn btn-success"
           href="<?php echo e(route('online-payment.activate')); ?>"> <?php echo e(__('app.click_here')); ?></a>
        <?php else: ?>
            <?php echo e(__('app.not_active')); ?>

            </a> &nbsp;&nbsp;&nbsp;
            <a style="color : #fff" type="button" class="btn btn-success"
           href="<?php echo e(route('online-payment.activate')); ?>"> <?php echo e(__('app.click_here')); ?></a>
        <?php endif; ?>
        <!--<?php echo e(__('app.not_active')); ?> >
        </a> &nbsp;&nbsp;&nbsp;
        <a style="color : #fff" type="button" class="btn btn-success"
           href="<?php echo e(route('online-payment.activate')); ?>"> <?php echo e(__('app.click_here')); ?></a-->
    </div>
    <div class="alert alert-info" role="alert">
        <b class="text-danger">Important</b>: <?php echo e(trans('app.this_is_how')); ?>

    <a href="pages/how-to-pay-in-opportunity-4" style="font-weight:bold;color:blue"> <?php echo e(trans('app.click_here')); ?></a>
    </div>
    <br>
    <br>
    <br>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>