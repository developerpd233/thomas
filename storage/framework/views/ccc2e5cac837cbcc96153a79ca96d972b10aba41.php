<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('forgot_password.page_title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <h4>Note: Please check you span folder for password reset link.</h4>
<div class="featured-boxes">
    <div class="row">
        <div class="col-sm-8 col-md-offset-2">
            
            <div class="featured-box featured-box-primary align-left">
    
                <div class="box-content">
                    <?php if(session('status')): ?>
                        <div class="alert alert-success">
                            <?php echo e(session('status')); ?>

                        </div>
                    <?php endif; ?>

                    <?php echo Form::open(['id' => 'forgot-password', 'url' => '/password/email', 'method' => 'post', 'files' => false, 'class'=>'form-horizontal']); ?>

                        

                            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?> required">
                                
                                <div class="col-md-12">  
                                    <?php echo Form::label('email', trans('forgot_password.email'), ['class' => 'control-label']); ?>

                                    <?php echo Form::email('email', old('email'), ['class'=>'form-control input-lg']); ?>

                                    <?php if($errors->has('email')): ?>
                                        <span class="help-block">
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-lg btn-primary pull-right">
                                        <i class="fa fa-btn fa-envelope"></i> <?php echo e(trans('forgot_password.submit')); ?>

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