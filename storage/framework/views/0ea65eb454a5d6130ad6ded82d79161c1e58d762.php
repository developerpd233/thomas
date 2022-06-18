<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Edit Material Group')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="ibox float-e-margins">
    <div class="ibox-content">
        <?php echo Form::open(array('id' => 'material', 'method' => 'put', 'files' => true,'class'=>'form-horizontal')); ?>


            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('group_id', trans('Group'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::selectGroup('group_id', old('group_id', $material->group_id), ['id'=>'group_id', 'class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('sub_group_id', trans('Sub Group'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::selectSubGroup('sub_group_id', old('sub_group_id', $material->sub_group_id), ['id'=>'sub_group_id', 'class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('title', trans('Title'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('title', old('title', $material->title), ['id'=>'title', 'class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('slug', trans('Slug'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
				 <?php if($material->material_type == 'WEBINAR'): ?>
                    <?php echo Form::text('slug', old('slug', $material->slug), ['id'=>'slug', 'class'=>'form-control','readonly' ]); ?>

				  <?php else: ?>
					<?php echo Form::text('slug', old('slug', $material->slug), ['id'=>'slug', 'class'=>'form-control']); ?> 
				  <?php endif; ?>
                </div>
            </div>
        
        
        
            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('material_type', trans('Material Type'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('material_type', old('material_type', $material->material_type), ['class'=>'form-control', 'readonly']); ?>

                </div>
            </div>
            <?php if($material->material_type == 'VIDEO'): ?>
            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('video_url', trans('Video Link'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('video_url_name', old('video_url_name', $material->embed), ['id'=>'video_url_name', 'class'=>'form-control']); ?>

                </div>
            </div>
            <?php endif; ?>
			 <?php if($material->material_type == 'WEBINAR'): ?>
            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('video_url', trans('Webinar Video Link'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('video_url_name', old('video_url_name', $material->embed), ['id'=>'video_url_name', 'class'=>'form-control']); ?>

                </div>
            </div>
            <?php endif; ?>
            <?php if($material->material_type == 'COURSE'): ?>
            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('Url', trans('Course Link'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('course_url', old('title', $material->course_url), ['id'=>'course_url', 'class'=>'form-control']); ?>

                </div>
            </div>
            <?php endif; ?>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('thumbnail_url', trans('Thumbnail'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::file('thumbnail_url'); ?>

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4">
                    <?php echo Form::label('description', trans('Description'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::textarea('description', old('description',$material->description), ['id'=>'description', 'class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('price', trans('Price'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('price', old('price',$material->price), ['id'=>'slug', 'class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4">
                    <?php echo Form::label('enable_payment_button', trans('Enable'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::checkbox('enable_payment_button', 'YES'); ?>

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                        <?php echo Form::submit(trans('Update Changes'), ['class' => 'btn btn-success']); ?>

                        &nbsp;
                    <a class="btn btn-default btn-close" href="<?php echo e(URL::route('admin.material')); ?>"><?php echo e(trans('Back')); ?></a>
                    
                    
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
            $('#description').summernote({
                height: 150
            });
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>