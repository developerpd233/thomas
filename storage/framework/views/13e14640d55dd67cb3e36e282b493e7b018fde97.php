<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Manage Dashboard Video Link')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <div class="panel panel-default" style="padding-top: 2rem">
        
        <div class="panel-body">
            <table class="table table-sm">
                <thead>

                <tr>
                    <th scope="col"></th>
                    <th scope="col" style="width: 39%;"></th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php $__currentLoopData = $link; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if ($item->lang == 'en'){
                        $english = "English";
                    }else{
                        $english = "French";
                    } ?>
                    <tr>
                        <td> Edit <?php echo e($english); ?> Video Link here</td>
                        <td> <?php echo e($item->lang); ?></td>
                        <td>
                            <div class="row">
                                <div class="col-lg-3">
                                    <form action="dashboardVideo/edit/<?php echo e($item->id); ?>">
                                        <button type="submit" class="btn btn-info">Edit</button>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>