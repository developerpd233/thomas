<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Add Page')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="ibox float-e-margins">
    <div class="ibox-content">
        <?php echo Form::open(array('id' => 'manage-page', 'route' => 'admin.page.add', 'method' => 'post', 'files' => true,'class'=>'form-horizontal')); ?>


            <div class="form-group">
                <div class="col-md-4">
                    <?php echo Form::label('language', trans('Language'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::select('language', ['en' => 'English', 'fr' => 'French'], old('language'), ['class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group">
                <div class="col-md-4">
                    
                </div>
                <div class="col-md-6">
                    
                </div>
            </div>

           

            <div class="form-group" id="left-sidebar-block-box" <?php echo ((old('layout') == 'LEFT SIDEBAR'  or old('layout') == 'LEFT & RIGHT SIDEBARS') ? 'style="display:block"': 'style="display:none"'); ?>>
                <div class="col-md-4">
                    <?php echo Form::label('left_sidebar_block_id', trans('Left Sidebard Block'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::selectBlock('left_sidebar_block_id', old('left_sidebar_block_id'), ['class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group" id="right-sidebar-block-box" <?php echo ((old('layout') == 'RIGHT SIDEBAR'  or old('layout') == 'LEFT & RIGHT SIDEBARS') ? 'style="display:block"': 'style="display:none"'); ?>>
                <div class="col-md-4">
                    <?php echo Form::label('right_sidebar_block_id', trans('Right Sidebard Block'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::selectBlock('right_sidebar_block_id', old('right_sidebar_block_id'), ['class'=>'form-control']); ?>

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
                    <?php echo Form::label('content', trans('Content'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-8">
                    <?php echo Form::textarea('content', old('content'), ['id'=>'page-content', 'class'=>'form-control']); ?>

                </div>
            </div>            

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('status', trans('Status'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::select('status', array('' => 'Select Page Status', 'DRAFT' => 'Draft', 'PUBLISHED' => 'Published', 'TRASHED' => 'Trashed'), null, ['class'=>'form-control']); ?>

                </div>
            </div>            
        
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <a class="btn btn-default btn-close" href="<?php echo e(URL::route('admin.page')); ?>"><?php echo e(trans('Cancel')); ?></a>
                    <?php echo Form::submit(trans('Save Changes'), ['class' => 'btn btn-primary']); ?>

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
            $('#slug').slugify('#title', {
                slugFunc: function(str) { return jQuery.fn.buildSlug(str); }
              }
            );

            //Display CKEDITOR for content
            $('#page-content').summernote({
                height: 150,
            });
            })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>