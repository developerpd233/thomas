<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Manage Profile')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="ibox float-e-margins">
    <div class="ibox-content">
        <?php echo Form::open(array('method' => 'put', 'files' => true, 'class'=>'form-horizontal')); ?>


            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('email', trans('Email'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo $user->email; ?>

                </div>
            </div>
           
            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('first_name', trans('First Name'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('first_name',$user->first_name, ['class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('last_name', trans('Last Name'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('last_name',$user->last_name, ['class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('address1', trans('Address1'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('address1',$user->address1, ['class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4">
                    <?php echo Form::label('address2', trans('Address2'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('address2',$user->address2, ['class'=>'form-control']); ?>

                </div>
            </div>
        
            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('city', trans('City'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('city',$user->city, ['class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('state', trans('State'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('state', $user->state, ['class'=>'form-control', 'maxlength'=>'50']); ?>

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4">
                    <?php echo Form::label('zip', trans('ZIP'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('zip',$user->zip, ['class'=>'form-control', 'maxlength'=> 5]); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('phone', trans('Phone'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('phone',$user->phone, ['class'=>'form-control', 'maxlength'=> 10]); ?>

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                        <a class="btn btn-default btn-close" href="<?php echo e(URL::route('admin.user')); ?>"><?php echo e(trans('Cancel')); ?></a>
                        <?php echo Form::submit(trans('Update Changes'), ['class' => 'btn btn-primary']); ?>


                </div>
            </div>

        <?php echo Form::close(); ?>

    </div>    
</div>

<!-- Password Update Form -->
<div class="ibox float-e-margins">
    <div class="ibox-content">
        <?php echo Form::open(array('method' => 'put', 'route'=>'admin.manage-profile.update-password', 'files' => true, 'class'=>'form-horizontal')); ?>


        <h2>Change Password</h2>
            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('old_password', trans('Old Password'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::password('old_password', ['class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('password', trans('New Password'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::password('password', ['class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('password_confirmation', trans('New Password Confirmation'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::password('password_confirmation', ['class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                        <a class="btn btn-default btn-close" href="<?php echo e(URL::route('admin.user')); ?>"><?php echo e(trans('Cancel')); ?></a>
                        <?php echo Form::submit(trans('Update Changes'), ['class' => 'btn btn-primary']); ?>


                </div>
            </div>

        <?php echo Form::close(); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>