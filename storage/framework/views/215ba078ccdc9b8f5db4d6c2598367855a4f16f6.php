<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Error 404 - Page Not Found')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="page-not-found">
        <div class="row">
                <div class="col-md-9">
                        <div class="page-not-found-main">
                                <h2>404 <i class="fa fa-file"></i></h2>
                                <p><?php echo e(trans('errors.error_not_found')); ?></p>
                        </div>
                </div>
                <div class="col-md-3">
                        <h4 class="heading-primary"><?php echo e(trans('errors.useful_links')); ?></h4>
                        <ul class="nav nav-list">
                                <li><a href="<?php echo e(route('home')); ?>"><?php echo e(trans('errors.home')); ?></a></li>
                                <li><a href="<?php echo e(route('contact')); ?>"><?php echo e(trans('errors.contact_us')); ?></a></li>
                        </ul>
                </div>
        </div>
</section>
    
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>