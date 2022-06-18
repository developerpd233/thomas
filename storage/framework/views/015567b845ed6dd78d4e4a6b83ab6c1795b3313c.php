<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Add Material')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="ibox float-e-margins">
        <div class="ibox-content">
            <?php echo Form::open(array('id' => 'material', 'route' => 'admin.material.add', 'method' => 'post', 'files' => true,'class'=>'form-horizontal')); ?>


            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('group_id', trans('Group'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::selectGroup('group_id', old('group_id'), ['id'=>'group_id', 'class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('sub_group_id', trans('Sub Group'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::selectSubGroup('sub_group_id', old('sub_group_id'), ['id'=>'sub_group_id', 'class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('title', trans('Title'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('title', old('title'), ['id'=>'title', 'class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('slug', trans('Slug'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('slug', old('slug'), ['id'=>'slug', 'class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('material_type', trans('Material Type'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::select('material_type', ['VIDEO' => 'Video', 'COURSE' => 'Course','WEBINAR'=> 'Webinar'], old('material_type'), ['class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required" id="material-video">
                <div class="col-md-4">
                    <?php echo Form::label('video_url', trans('Video Link'), ['class' => 'control-label']); ?>

                </div>

                <div class="col-md-6">
                    <?php echo Form::text('video_url_name', old('video_url_name'), ['id'=>'video_url_name', 'class'=>'form-control']); ?>


                </div>

            </div>


            <div class="form-group required" id="thumbnail">
                <div class="col-md-4">
                    <?php echo Form::label('thumbnail_url', trans('Thumbnail'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::file('thumbnail_url'); ?>

                </div>
            </div>


            <div class="form-group required" id="material-course" style="display:none;">
                <div class="col-md-4">
                    <?php echo Form::label('url', trans('Material Page Url'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('url', old('url'), ['id'=>'url', 'class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required" id="material-course" style="display:none;">
                <div class="col-md-4">
                    <?php echo Form::label('thumbnail', trans(' Thumbnail'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::file('thumbnail'); ?>

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4">
                    <?php echo Form::label('description', trans('Description'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::textarea('description', old('description'), ['id'=>'description', 'class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('price', trans('Price'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::text('price', old('price'), ['id'=>'slug', 'class'=>'form-control']); ?>

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
                    <a class="btn btn-default btn-close"
                       href="<?php echo e(URL::route('admin.material')); ?>"><?php echo e(trans('Cancel')); ?></a>
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
            //Generate Slug
            $('#slug').slugify('#title');

            //Display CKEDITOR for content
            $('#description').summernote({
                height: 150,
            });
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>