<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('user_academy.my_academy')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php $__currentLoopData = $material; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $materialItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($materialItem->thumbnail_url != '' && $materialItem->thumbnail_url != null ): ?>
            <div class="col-sm-6 col-lg-4 col-md-4">
                <div class="thumbnail">
                    <div class="caption">
                        <?php if($materialItem->price > 0.00): ?>
                            <h4 class="pull-right text-success">$<?php echo e($materialItem->price); ?></h4>
                        <?php endif; ?>
                        <h4>
                            <a href="<?php echo url('user-academy/view/' . $materialItem->id); ?>"><?php echo e($materialItem->title); ?></a>
                        </h4>
                        <hr>
                    </div>
                    <a href="<?php echo url('user-academy/view/' . $materialItem->id); ?>">
                        <img src="<?php echo e($materialItem->thumbnail_url); ?>"
                             style="width: 700px; height: 300px"/>
                    </a>
                    <div class="caption">
                        <p class="description"><?php echo str_limit($materialItem->description , $limit = 150 , $end = '... <a href="' . url('user-academy/view/' . $materialItem->id) . '">read more</a>' ); ?></p>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="clearfix"></div>
    <div class="text-center">
        <?php echo e($material->links()); ?>

    </div>
    <br>
<?php $__env->stopSection(); ?>
<style>
    ul.pagination li.active span {
        background-color: #006600 !important;
    }
    .thumbnail {
        margin: 20px 20px 0 0;
        height: 500px;
    }

    .thumbnail:hover {
        -webkit-box-shadow: 10px 6px 67px -14px rgba(0, 0, 0, 0.56);
        -moz-box-shadow: 10px 6px 67px -14px rgba(0, 0, 0, 0.56);
        box-shadow: 10px 6px 67px -14px rgba(0, 0, 0, 0.56);
    }
</style>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>