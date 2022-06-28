<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('register.page_title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <div class="featured-boxes" id="content">
        <div class="row">
            <div class="col-sm-12 pull-left">

                <div class="featured-box featured-box-primary">
                    <br>
                    <div class="box-content">
                        
                        <?php if(!is_null($parentid)): ?>

                            <?php echo Form::open(['id' => 'register', 'method' => 'post', 'files' => false, 'class'=>'form-horizontal']); ?>


                            <?php echo Form::hidden('parent_id', old('parent_id', $parentid)); ?>


                            <div class="form-group<?php echo e(($errors->has('first_name') or $errors->has('last_name')) ? ' has-error' : ''); ?> required">
                                <?php echo Form::label('first_name', trans('register.name'), ['class' => 'col-md-3 control-label']); ?>

                                <div class="col-md-3">
                                    <?php echo Form::text('first_name', old('first_name'), ['placeholder'=> trans('register.first_name'),'class'=>'form-control validate-name', 'maxlength'=>'47']); ?>

                                    <?php if($errors->has('first_name')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('first_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo Form::text('last_name', old('last_name'), ['placeholder'=>trans('register.last_name'), 'class'=>'form-control validate-name', 'maxlength'=>'47']); ?>

                                    <?php if($errors->has('last_name')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('last_name')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('address1') ? ' has-error' : ''); ?> required">
                                <?php echo Form::label('address1', trans('register.address1'), ['class' => 'col-md-3 control-label']); ?>

                                <div class="col-md-6">
                                    <?php echo Form::text('address1', old('address1'), ['class'=>'form-control validate-address', 'maxlength'=>'47']); ?>

                                    <?php if($errors->has('address1')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('address1')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group<?php echo e($errors->has('country') ? ' has-error' : ''); ?>">
                                <?php echo Form::label('country', trans('country'), ['class' => 'col-md-3 control-label']); ?>

                                <div class="col-md-6">
                                    <?php echo Form::text('country', old('country'), ['class'=>'form-control validate-address', 'maxlength'=>'47']); ?>

                                    <?php if($errors->has('country')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('country')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('sex') ? ' has-error' : ''); ?> required">
                                <?php echo Form::label('Sex', trans('sex'), ['class' => 'col-md-3 control-label']); ?>

                                <div class="col-md-3">
                                    
                                    <select name="sex" class="form-control validate-address" aria-invalid="false">
                                        <option value="Male" selected="selected">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <?php if($errors->has('sex')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('sex')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                

                                

                            </div>

                            <div class="form-group<?php echo e($errors->has('phone') ? ' has-error' : ''); ?> required">
                                <?php echo Form::label('phone', trans('register.phone'), ['class' => 'col-md-3 control-label']); ?>

                                <div class="col-md-6">
                                    <?php echo Form::text('phone', old('phone'), ['class'=>'form-control validate-phone', 'maxlength'=>'10']); ?>

                                    <?php if($errors->has('phone')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-3">
                                    <?php echo e(trans('register.example')); ?>: 1234441112
                                </div>
                            </div>
                            <div class="form-group<?php echo e($errors->has('username') ? ' has-error' : ''); ?> required">
                                <?php echo Form::label('username', trans('register.username'), ['class' => 'col-md-3 control-label']); ?>

                                <div class="col-md-6">
                                    <?php echo Form::text('username', old('username'), ['class'=>'form-control', 'maxlength'=>'64']); ?>

                                    <?php if($errors->has('username')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('username')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group<?php echo e($errors->has('email') ? ' has-error' : ''); ?> required">
                                <?php echo Form::label('email', trans('register.email'), ['class' => 'col-md-3 control-label']); ?>

                                <div class="col-md-6">
                                    <?php echo Form::email('email', old('email'), ['class'=>'form-control', 'maxlength'=>'64']); ?>

                                    <?php if($errors->has('email')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('password') ? ' has-error' : ''); ?> required">
                                <?php echo Form::label('password', trans('register.password'), ['class' => 'col-md-3 control-label']); ?>

                                <div class="col-md-6">
                                    <?php echo Form::password('password', ['class'=>'form-control']); ?>

                                    <?php if($errors->has('password')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group<?php echo e($errors->has('password_confirmation') ? ' has-error' : ''); ?> required">
                                <?php echo Form::label('password_confirmation', trans('register.password_confirmation'), ['class' => 'col-md-3 control-label']); ?>

                                <div class="col-md-6">
                                    <?php echo Form::password('password_confirmation', ['class'=>'form-control']); ?>

                                    <?php if($errors->has('password_confirmation')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('password_confirmation')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <a href="<?php echo e(url('/terms-of-use')); ?>"
                                       target="_blank"><?php echo e(trans('register.download_terms')); ?></a>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-3">
                                    <?php echo Form::checkbox('agree', 'YES'); ?><?= trans('register.agree')?>
                                </div>

                            </div>
                            <div class="col-md-offset-4 col-md-4" style="padding-bottom: 15px">
                                <div class="col-md-12 pull-right">
                                    <div class="g-recaptcha"
                                         data-sitekey="6Ld0aaoUAAAAAIBLykzBDEYrNyfaYA_j9PMzzXrV"></div>
                                </div>
                            </div>
                            <br><br>
                            <br><br>
                            <br><br>
                            
                            <div class="form-group<?php echo e($errors->has('country') ? ' has-error' : ''); ?> required">
                                <?php echo Form::label('codes', trans('Codes'), ['class' => 'col-md-3 control-label']); ?>

                                <div class="col-md-6">
                                    <?php echo Form::text('codes', old('codes'), ['class'=>'form-control']); ?>

                                    <?php if($errors->has('codes')): ?>
                                        <span class="help-block">
                                        <strong><?php echo e($errors->first('codes')); ?></strong>
                                    </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <br>
                            <div style="margin-left: 30%">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-lg btn-primary">
                                        <i class="fa fa-btn fa-user-plus"></i> <?php echo e(trans('register.submit')); ?>

                                    </button>
                                </div>
                            </div>
                            <?php echo Form::close(); ?>

                            <br>
                        <?php else: ?>
                            <h1><?php echo e(trans('register.no_referal')); ?></h1>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <br>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>