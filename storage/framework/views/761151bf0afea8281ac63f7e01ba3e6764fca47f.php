<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Offline Payments History')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <br>
        <table class="table table-hover">
            <thead>
            <tr>
                <th>Order No.</th>
                <th scope="col">Date</th>
                <th scope="col">Name of Subs</th>
                <th scope="col">Country</th>
                
                <th scope="col">Amount Paid</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $count = 1?>
            <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <th><?php echo e($count++); ?></th>
                    <th><?php echo e($item->created_at); ?></th>
                    <td><?php echo e($item->name_of_subscriber); ?></td>
                    <td><?php echo e($item->country); ?></td>
                    
                    <td><?php echo e($item->amount_paid); ?></td>
                    <td><a class="btn btn-success btn-sm" href="offline_pay/details/<?php echo e($item->id); ?>" role="button">View
                            Details</a>
                        <a onclick="return deleteevent()" class="btn btn-danger btn-sm"
                           href="offline_pay/delete/<?php echo e($item->id); ?>"
                           role="button">Delete</a>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php echo $data->links(); ?>

    </div>
<?php $__env->stopSection(); ?>
<script>
    function deleteevent() {
        if (confirm("Are you sure want to delete")) {
            return true;
        } else {
            return false;
        }
    }
</script>

<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>