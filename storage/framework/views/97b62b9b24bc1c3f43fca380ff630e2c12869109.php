

<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Edit Sub Material Group')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="ibox float-e-margins">
    <div class="ibox-content">
        <?php echo Form::open(array('method' => 'put', 'files' => true,'class'=>'form-horizontal', 'enctype'=>'multipart/form-data')); ?>

	
            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('group_id', trans(' Material Group'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::selectGroup('group_id', old('group_id', $SubmaterialGroup->group_id), ['id'=>'group_id', 'class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('title', trans('Sub Material Group'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('title', old('title', $SubmaterialGroup->title), ['id'=>'title', 'class'=>'form-control']); ?>

                </div>
            </div>
                                                                
            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('slug', trans('Slug'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('slug', old('slug', $SubmaterialGroup->slug), ['id'=>'slug', 'class'=>'form-control']); ?>                    
                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('price', trans('Price'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('price', old('price', $SubmaterialGroup->price), ['id'=>'price', 'class'=>'form-control']); ?>                    
                </div>
            </div>
            <div class="form-group required" id="thumbnail">
                <div class="col-md-4">
                    <?php echo Form::label('group_thumbnail_url', trans('Thumbnail'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::file('group_thumbnail_url'); ?>

                </div>
            </div>
            <div class="form-group">
                <div class="col-md-4">
                    <?php echo Form::label('enable_payment_button', trans('Enable'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::checkbox('enable_payment_button', 'YES', ($SubmaterialGroup->enable_payment_button=='YES' ? true:false)); ?>

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <a class="btn btn-default btn-close" href="<?php echo e(URL::route('admin.sub-material-group')); ?>"><?php echo e(trans('Cancel')); ?></a>
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