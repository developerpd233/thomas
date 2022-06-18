<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Manage Dashboard Video Link')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


    <form method="POST" action="<?php echo e(route('admin.dashboard_video.edit',['id'=>$link->id])); ?>" accept-charset="UTF-8"
          id="manage-faq" class="form-horizontal">
        <?php echo csrf_field(); ?>


        <div class="form-group">
            <div class="col-md-4">
                <label for="link" class="control-label">Link</label>
            </div>
            <div class="col-md-6">
                <input id="link" class="form-control" name="link" type="text" value="<?php echo e($link->link); ?>">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-4">
                <label for="lang" class="control-label">Language</label>
            </div>
            <div class="col-md-6">
                <select class="form-control" id="lang" name="lang">
                    <?php if($link->lang == 'en'): ?>
                    <option value="en" selected="selected">English</option>
                        <?php elseif($link->lang == 'fr'): ?>
                    <option value="fr" selected>French</option>
                        <?php endif; ?>
                </select>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                <a class="btn btn-default btn-close" href="">Cancel</a>
                <input class="btn btn-success" type="submit" value="Update">
            </div>
        </div>

    </form>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>