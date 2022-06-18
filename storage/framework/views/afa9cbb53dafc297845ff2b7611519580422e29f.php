<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Users')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $grid->render(); ?>

<?php $__env->stopSection(); ?>
<script type="text/javascript">
    function confirmmodel() {
        confirm("Are you sure want to ban this account");
        document.getElementById('ban').innerText = 'Unban';
    }
</script>
<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>