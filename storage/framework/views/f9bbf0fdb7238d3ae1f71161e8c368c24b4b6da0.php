<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('user_academy.my_academy')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php $__currentLoopData = $sub_material_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_material_detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($sub_material_detail->title != '' && $sub_material_detail->title != null ): ?>
            <div class="col-sm-6 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <div class="caption">
                        <?php if($sub_material_detail->price > 0.00): ?>
                            <h4 class="pull-right text-success"><?php echo e($sub_material_detail->price); ?></h4>
                        <?php endif; ?>
                        <h4>
                            <a href="<?php echo url('user-academy/viewGroup/' . $sub_material_detail->group_id); ?>"><?php echo e($sub_material_detail->title); ?></a>
                        </h4>
                        <hr>
                    </div>
                    <a href="<?php echo url('user-academy/viewGroup/' . $sub_material_detail->group_id); ?>">
                        <img src="<?php echo e($sub_material_detail->group_thumbnail_url); ?>"
                             style="width: 300px; height: 300px; margin-top: 0"/>
                    </a>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>
<style>
    .thumbnail {
        margin: 20px 20px 0 0;
        height: 425px;
    }

    .thumbnail:hover {
        -webkit-box-shadow: 10px 6px 67px -14px rgba(0, 0, 0, 0.56);
        -moz-box-shadow: 10px 6px 67px -14px rgba(0, 0, 0, 0.56);
        box-shadow: 10px 6px 67px -14px rgba(0, 0, 0, 0.56);
    }
</style>
<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>