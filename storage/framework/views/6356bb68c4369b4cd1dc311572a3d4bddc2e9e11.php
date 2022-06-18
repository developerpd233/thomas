<?php $__env->startSection('page_title'); ?>
<?php echo e(trans('about')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <?php if(session()->has('conformationsStatus')): ?>
        <br>
        <div class="alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
            <strong><?php echo session()->get('conformationsStatus'); ?></strong>
            <?php echo session()->forget('conformationsStatus'); ?>

        </div>
    <?php endif; ?>
    <div class="col-md-12" id="content">
        <div class="row1">

            <h1 id="heading" class="text-center">Submit tokens</h1>
            <br>
            <center>
                <form action="/bitcoin-payment-token" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label>Bitcoin Token Code</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="videocode" placeholder="Bitcoin Token Code" required>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="submit" class=" btn btn-primary" value="Submit Code">
                        </div>
                    </div>
                </form>
            </center>
            <br>
            
            <div>
                <form action="/paypal-payment-token" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label>Paypal Token Code</label>
                            </div>
                            <div class="col-lg-6">
                                <input type="text" class="form-control" name="videocode" placeholder="Paypal Token Code" required>
                            </div>
                        </div>
                        <div class="text-center">
                            <input type="submit" class=" btn btn-primary" value="Submit Code">
                        </div>
                    </div>
                </form>
            </div>
            
        </div>
    </div>
</div>
<br>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>