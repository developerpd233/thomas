<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Edit User')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="ibox float-e-margins">
    <div class="ibox-content">
        <?php echo Form::open(array('method' => 'put', 'files' => true,'class'=>'form-horizontal')); ?>


            <div class="form-group">
                <div class="col-md-4">
                    <?php echo Form::label('id', trans('ID'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo $user->id; ?>

                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-4">
                    <?php echo Form::label('created_at', trans('Joined Date'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo $user->created_at; ?>

                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-4">
                    <?php echo Form::label('first_name', trans('First Name'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo $user->first_name; ?>

                </div>
            </div>
        
            <div class="form-group">
                <div class="col-md-4">
                    <?php echo Form::label('last_name', trans('Last Name'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo $user->last_name; ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('is_active', trans('Active'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::select('is_active', array('YES' => 'Yes', 'NO' => 'No'), $user->is_active, ['class'=>'form-control']); ?>

                    <input type="hidden" name="isActiveByComission" value="YES" >
                </div>
            </div>
                            
            
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <a class="btn btn-default btn-close" href="<?php echo e(URL::route('admin.user')); ?>"><?php echo e(trans('Back')); ?></a>
                    <?php echo Form::submit(trans('Update Changes'), ['class' => 'btn btn-success']); ?>

                </div>
            </div>

        <?php echo Form::close(); ?>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>