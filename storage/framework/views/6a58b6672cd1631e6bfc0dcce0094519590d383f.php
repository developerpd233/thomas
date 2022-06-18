<?php $__env->startSection('content'); ?>
<p>
Name: <?php echo e($name); ?>

</p>

<p>
email: <?php echo e($email); ?>

</p>

<p>
Country: <?php echo e($country); ?>

</p>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('emails.template', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>