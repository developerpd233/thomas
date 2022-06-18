<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('User Payment - Detail')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="ibox float-e-margins">
    <div class="ibox-content">
         <table class="table table-bordered table-striped">
            <tbody>

                <tr>
                    <td width="30%"><?php echo e(trans('ID')); ?></td>
                    <td width="70%"><?php echo $payment->id; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('Payment Date')); ?></td>
                    <td><?php echo $payment->created_at; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('User ID')); ?></td>
                    <td><?php echo $payment->user_id; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('User Name')); ?></td>
                    <td><?php echo $payment->user->last_name; ?> <?php echo $payment->user->first_name; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('Payment Mode')); ?></td>
                    <td><?php echo $payment->payment_mode; ?></td>
                </tr>
                <?php if($payment->payment_mode == "OFFLINE"): ?>
                <tr>
                    <td><?php echo e(trans('Bank Slip #')); ?></td>
                    <td><?php echo $payment->bank_slip_no; ?></td>
                </tr>
                <tr>
                    <td><?php echo e(trans('Bank Name')); ?></td>
                    <td><?php echo $payment->bank->bank_name; ?></td>
                </tr>
                <tr>
                    <td><?php echo e(trans('Account Title')); ?></td>
                    <td><?php echo $payment->bank->account_title; ?></td>
                </tr>
                <tr>
                    <td><?php echo e(trans('Account #')); ?></td>
                    <td><?php echo $payment->bank->account_no; ?></td>
                </tr>
                <?php endif; ?>
                <tr>
                    <td><?php echo e(trans('Payment Type')); ?></td>
                    <td><?php echo $payment->payment_type; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('Payment For')); ?></td>
                    <td><?php echo $payment->paid_for; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('Amount')); ?></td>
                    <td><?php echo $payment->amount_paid; ?></td>
                </tr>
                
                               
            </tbody>
        </table>

        <?php if($payment->paid_for != "SUBSCRIPTION"): ?>
        <div class="row">
            <table class="table table-striped table-bordered" >
                <thead>
                    <tr>
                        <th><input type='checkbox' name='' value='' class="check-all" data-for=".order-item-id" /></th>
                        <th><?php echo e(trans('Group')); ?></th>
                        <th><?php echo e(trans('Level')); ?></th>
                        <th><?php echo e(trans('Video / Material')); ?></th>
                        <th><?php echo e(trans('Start Date')); ?></th>
                        <th><?php echo e(trans('End Date')); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($payment->paymentDetails->count() > 0): ?>
                        <?php $__currentLoopData = $payment->paymentDetails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                              
                            <tr>
                                <td></td>
                                <td><?php echo e($item->materialGroup['title']); ?></td>
                                <td><?php echo e($item->material['title']); ?></td>
                                <td><?php echo e($item->start_date); ?></td>
                                <td><?php echo e($item->end_date); ?></td>
                                <td>F<?php echo e(Helper::moneyFormat($item->amount)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <a href="<?php echo e(route('payment-history')); ?>" class="btn btn-default btn-close"><i class="fa fa-arrow-left" aria-hidden="true"></i> <?php echo e(trans('Back')); ?></a>
            </div>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>