<?php $__env->startSection('content'); ?>

<p>
Dear <?php echo e($name); ?>,
</p>

<p>
    <?php echo e(trans('password.reset_password_link')); ?>

 
    If you are having trouble clicking the "<a href="<?php echo e(url('password/reset/'.$token)); ?>">Reset Password</a>" link above, copy and paste the URL below into your web browser.<br/>
    <?php echo e(url('password/reset/'.$token)); ?> <br/><br/>

    Thank you for using <?php echo e(Config::get('settings.sitename')); ?>.
    
</p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('emails.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>