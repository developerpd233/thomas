<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('User Commission')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h3>List Of All Subscriber.
    </h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope='col'>SN</th>
            
            <th scope="col" style="width: 15%">User Id</th>
            <th scope="col" style="width: 15%">First Name</th>
            <th scope="col" style="width: 15%">Last Name</th>
            <th scope="col" style="width: 20%">Email</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php $sn = 1?>
        <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <th><?php echo e($sn); ?></th>
                
                <th scope="row"><?php echo e($item->id); ?></th>
                <td><?php echo e($item->first_name); ?></td>
                <td><?php echo e($item->last_name); ?></td>
                <td><?php echo e($item->email); ?></td>
                <td>
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="<?php echo e(route('admin.user.details',array('id'=>$item->id))); ?>"
                               class="btn btn-info btn-xs edit">Commission</a>
                        </div>
                    </div>
                </td>
            </tr>
            <?php $sn++?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
    <?php echo $list->links(); ?>

<?php $__env->stopSection(); ?>
<style>
    .names {
        font-size: 1.7rem;
    }
</style>
<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>