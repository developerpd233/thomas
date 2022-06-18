<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Edit Page')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="ibox float-e-margins">
    <div class="ibox-content">
        <?php echo Form::open(array('id' => 'manage-page', 'method' => 'put', 'files' => true,'class'=>'form-horizontal')); ?>


            <div class="form-group">
                <div class="col-md-4">
                    <?php echo Form::label('language', trans('Language'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::select('language', ['en' => 'English', 'fr' => 'French'], $page->language, ['class'=>'form-control']); ?>

                </div>
            </div>

            <?php if($page->slug !== 'home'): ?>
            <div class="form-group">
                <div class="col-md-4">
                    
                </div>
                <div class="col-md-6">
                    
                </div>
            </div>
            <?php endif; ?>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('layout', trans('Layout'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::select('layout', array('' => 'Select Layout', 'NO SIDEBAR' => 'No Sidebar', 'LEFT SIDEBAR' => 'Left Sidebar', 'RIGHT SIDEBAR' => 'Right Sidebar', 'LEFT & RIGHT SIDEBARS' => 'Left & Right Sidebars '), $page->layout, ['class'=>'form-control', 'onchange'=>'javascript:jQuery.fn.changeLeftRightSidebars(this.value);']); ?>

                </div>
            </div>

            <div class="form-group" id="left-sidebar-block-box" <?php echo (($page->layout == 'LEFT SIDEBAR'  or $page->layout == 'LEFT & RIGHT SIDEBARS') ? 'style="display:block"': 'style="display:none"'); ?>>
                <div class="col-md-4">
                    <?php echo Form::label('left_sidebar_block_id', trans('Left Sidebard Block ID'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::selectBlock('left_sidebar_block_id', $page->left_sidebar_block_id, ['class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group" id="right-sidebar-block-box" <?php echo (($page->layout == 'RIGHT SIDEBAR'  or $page->layout == 'LEFT & RIGHT SIDEBARS') ? 'style="display:block"': 'style="display:none"'); ?>>
                <div class="col-md-4">
                    <?php echo Form::label('right_sidebar_block_id', trans('Right Sidebard Block ID'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::selectBlock('right_sidebar_block_id', $page->right_sidebar_block_id, ['class'=>'form-control']); ?>

                </div>
            </div>
        
            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('title', trans('Title'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php if($page->slug == 'home'): ?>
                        <?php echo Form::text('title', $page->title, ['id'=>'title', 'class'=>'form-control', 'readonly' => 'readonly']); ?>

                    <?php else: ?>
                        <?php echo Form::text('title', $page->title, ['id'=>'title', 'class'=>'form-control']); ?>

                    <?php endif; ?>
                    
                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('slug', trans('Slug'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php if($page->slug == 'home'): ?>
                        <?php echo Form::text('slug', $page->slug, ['id'=>'slug', 'class'=>'form-control', 'readonly' => 'readonly']); ?>

                    <?php else: ?>
                        <?php echo Form::text('slug', $page->slug, ['id'=>'slug', 'class'=>'form-control',]); ?>

                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('content', trans('Content'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-8">
                    <?php echo Form::textarea('content', $page->content, ['id'=>'page-content', 'class'=>'form-control']); ?>

                </div>
            </div>

            <div class="form-group required">
                <div class="col-md-4">
                    <?php echo Form::label('status', trans('Status'), ['class' => 'control-label']); ?>

                </div>
                <div class="col-md-6">
                    <?php echo Form::select('status', array('' => 'Select Page Status', 'DRAFT' => 'Draft', 'PUBLISHED' => 'Published', 'TRASHED' => 'Trashed'), $page->status, ['class'=>'form-control']); ?>

                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <a class="btn btn-default btn-close" href="<?php echo e(URL::route('admin.page')); ?>"><?php echo e(trans('Cancel')); ?></a>
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
            $('#slug').slugify('#title', {
                slugFunc: function(str) { return jQuery.fn.buildSlug(str); }
              }
            );

            //Display CKEDITOR for content
            CKEDITOR.replace( 'page-content',
            {
                toolbar : 'Standard', /* this does the magic */
            });
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>