<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('reset_password.page_title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="featured-boxes">
    <div class="row">
        <div class="col-sm-8 col-md-offset-2">
            
            <div class="featured-box featured-box-primary">
                <div class="box-content">

                    <?php echo Form::open(['id' => 'reset-password', 'url' => '/password/reset', 'method' => 'post', 'files' => false, 'class'=>'form-horizontal']); ?>


                        <input type="hidden" name="token" value="<?php echo e($token); ?>">

                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?> required">
                            <?php echo Form::label('email', trans('reset_password.email'), ['class' => 'col-md-4 control-label']); ?>

                            <div class="col-md-8">
                                <?php echo Form::email('email', old('email'), ['class'=>'form-control']); ?>

                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?> required">
                            <?php echo Form::label('password', trans('reset_password.password'), ['class' => 'col-md-4 control-label']); ?>

                            <div class="col-md-8">
                                <?php echo Form::password('password', ['class'=>'form-control']); ?>

                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?> required">
                            <?php echo Form::label('password_confirmation', trans('reset_password.password_confirmation'), ['class' => 'col-md-4 control-label']); ?>

                            <div class="col-md-8">
                                <?php echo Form::password('password_confirmation', ['class'=>'form-control']); ?>

                                <?php if($errors->has('password_confirmation')): ?>
                                    <span class="help-block">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-lg btn-primary pull-right">
                                    <i class="fa fa-btn"></i> <?php echo e(trans('reset_password.submit')); ?>

                                </button>
                            </div>
                        </div>

                    <?php echo Form::close(); ?>


                </div>
            </div>
            
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>