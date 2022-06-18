<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('About')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-md-12">
            <?php $__currentLoopData = $about_us; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $about): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div>
                    <h1 id="heading"><?php echo e($about->title); ?></h1>
                    <p id="para"><?php echo $about->description?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </div>

    </div>
<?php $__env->stopSection(); ?>
<style>
    #heading {
        color: black;
        font-size: 2.3rem;
        text-align: center;
    }

    #para {
        font-size: 1.5rem;
    }

    div.row div.col-md-12 {
        margin-bottom: 1.2em;
    }
</style>
<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>