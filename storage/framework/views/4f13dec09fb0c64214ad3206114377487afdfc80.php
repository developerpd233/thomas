<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('News Details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <div style="margin-bottom: 2em;" class="col-md-12">

            <h1><?php echo e($news->title); ?></h1>
            <p><?php echo $news->description;; ?></p>

        </div>


    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>