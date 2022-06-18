<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('New Code')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <?php echo Form::open(array('id' => 'add-code', 'route' => 'admin.code.add', 'method' => 'post', 'files' => false,'class'=>'form-horizontal')); ?>


            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('code', trans('Code'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('code', old('code'), ['id'=>'code', 'class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <a class="btn btn-default btn-close" href="<?php echo e(URL::route('admin.code')); ?>"><?php echo e(trans('Cancel')); ?></a>
                    <?php echo Form::submit(trans('Save Changes'), ['class' => 'btn btn-primary']); ?>

                </div>
            </div>

            <?php echo Form::close(); ?>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
		$(document).ready(function () {
        
        });
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>