<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('login.page_title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="featured-boxes">
        <div class="row">
            <div class="col-sm-8 col-md-offset-2">

                <div class="featured-box featured-box-primary align-left">

                    <div class="box-content">

                        <?php echo Form::open(['id' => 'login', 'url' => '/login', 'method' => 'post', 'files' => false, 'class'=>'form-horizontal contact']); ?>



                        <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?> required">

                            <div class="col-md-12">
                                <?php echo Form::label('email', trans('login.email'), ['class' => 'control-label']); ?>

                                <?php echo Form::email('email', old('email'), ['class'=>'form-control input-lg', 'tabindex'=>'1']); ?>


                                <?php if($errors->has('email')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('email')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?> required">

                            <div class="col-md-12">
                                <?php echo Form::label('password', trans('login.password'), ['class' => 'control-label']); ?>

                                <a class="pull-right"
                                   href="<?php echo e(url('/password/reset')); ?>"><?php echo e(trans('login.forgot_password')); ?></a>

                                <?php echo Form::password('password', ['class'=>'form-control input-lg' , 'tabindex'=>'2']); ?>


                                <?php if($errors->has('password')): ?>
                                    <span class="help-block">
                                            <strong><?php echo e($errors->first('password')); ?></strong>
                                        </span>
                                <?php endif; ?>
                            </div>
                        </div>


                        <div class="form-group">

                            <div class="col-md-6 pull-left">
                                <?php echo Form::checkbox('remember',null); ?> <?php echo e(trans('login.remember_me')); ?>

                            </div>

                            <div class="col-md-6 pull-right">
                                <button type="submit" class="btn btn-lg btn-primary pull-right" tabindex="3">
                                    <i class="fa fa-btn fa-sign-in"></i> <?php echo e(trans('login.submit')); ?>

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