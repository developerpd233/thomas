<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('User Payments Details')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <h4>Receipt Photo</h4>
                <img src="<?php echo e($data->receipt_photo); ?>"
                     alt="" width="400" height="400">
            </div>
            <div class="col-lg-6">
                <h4>
                    <mark>Information of Payment</mark>
                </h4>
                <div class="row">
                    <div class="col-lg-4">
                        <h4><b>Name of Subscriber:</b></h4>
                        <h4><b>Country</b></h4>
                        <h4><b>Payment Type</b></h4>
                        <h4><b>Account No</b></h4>
                        <h4><b>Amount Paid</b></h4>
                    </div>
                    <div class="col-lg-4">
                        <h4><?php echo e($data->name_of_subscriber); ?></h4>
                        <h4><?php echo e($data->country); ?></h4>
                        <h4><?php echo e($data->payment_type); ?></h4>
                        <h4><?php echo e($data->account_no); ?></h4>
                        <h4><?php echo Session::get('curr') ?><?php echo e($data->amount_paid); ?></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>