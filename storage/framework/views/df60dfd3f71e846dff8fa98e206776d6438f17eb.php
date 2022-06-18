<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('page_title.verify')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

    <div class="panel-body">
        <div class="ibox-content">
        <div class="alert alert-info" role="alert">
            <b class="text-danger">Important</b>: <?php echo e(trans('app.offline_payment_verify_message')); ?>

        </div>
            <!--form action="<?php echo e(route('offline_pay.search')); ?>" enctype="multipart/form-data" id="manage-faq" method="" class="form-horizontal">
                <?php echo e(csrf_field()); ?>

                <fieldset>
                    
                    <div class="form-group container">
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="exampleInputEmail1">Payment receipt number</label>
                            </div>
                            <div class="col-lg-4">
                                <input type="text" name="bank_slip_no" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="" placeholder="Payment Receipt No" required>
                            </div>
                        </div>
                    </div>
                </fieldset>
                <button type="submit" class="btn btn-success btn-md" style="margin-left: 45%">Verify</button>
                <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token">
            </form-->
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.user_backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>