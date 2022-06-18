<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Edit News')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="ibox float-e-margins">
    <div class="ibox-content">
        <?php echo Form::open(array('method' => 'put', 'files' => false,'class'=>'form-horizontal')); ?>

	
            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('level_title', trans('Title'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('level_title', $level->level_title, ['id'=>'level_title', 'class'=>'form-control']); ?>

                </div>
            </div>
                            
            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('level_percentage', trans('Percentage'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('level_percentage', $level->level_percentage, ['id'=>'level_percentage', 'class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4">
                    <?php echo Form::label('active', trans('Active'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::checkbox('active', 'YES', ($level->active=='YES' ? true:false)); ?>

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <a class="btn btn-default btn-close" href="<?php echo e(URL::route('admin.level')); ?>"><?php echo e(trans('Cancel')); ?></a>
                    <?php echo Form::submit(trans('Update Changes'), ['class' => 'btn btn-success']); ?>

                </div>
            </div>

        <?php echo Form::close(); ?>

    </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function(){
            //Generate Slug
            $('#slug').slugify('#title');

            //Display CKEDITOR for long description
            CKEDITOR.replace( 'description',
            {
                toolbar : 'Standard', /* this does the magic */
            });
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>