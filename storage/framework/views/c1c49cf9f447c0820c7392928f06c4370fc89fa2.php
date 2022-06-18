<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('User Detail')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
http://itsolutionstuff.com/post/laravel-5-category-treeview-hierarchical-structure-example-with-demoexample.html
<div class="ibox float-e-margins">
    <div class="ibox-content">
         <table class="table table-bordered table-striped">
            <tbody>

                <tr>
                    <td width="30%"><?php echo e(trans('ID')); ?></td>
                    <td width="70%"><?php echo $user->id; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('Joined Date')); ?></td>
                    <td><?php echo $user->created_at; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('First Name')); ?></td>
                    <td><?php echo $user->first_name; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('Last Name')); ?></td>
                    <td><?php echo $user->last_name; ?></td>
                </tr>
                <tr>
                        <td><?php echo e(trans('Sex')); ?></td>
                        <td><?php echo $user->sex; ?></td>
                    </tr>
                <tr>
                    <td><?php echo e(trans('Email')); ?></td>
                    <td><?php echo $user->email; ?></td>
                </tr>
                <tr>
                    <td><?php echo e(trans('Country')); ?></td>
                    <td><?php echo $user->country; ?></td>
                </tr>
                <tr>
                    <td><?php echo e(trans('Phone')); ?></td>
                    <td><?php echo $user->phone; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('Address')); ?></td>
                    <td><?php echo $user->address; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('Disable System Comments')); ?></td>
                    <td><?php echo $user->disable_system_comments; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('Facebook URL')); ?></td>
                    <td><?php echo $user->facebook_url; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('Twitter URL')); ?></td>
                    <td><?php echo $user->twitter_url; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('Instagram URL')); ?></td>
                    <td><?php echo $user->instagram_url; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('Snapchat URL')); ?></td>
                    <td><?php echo $user->snapchat_url; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('Google Hangout ID')); ?></td>
                    <td><?php echo $user->google_hangout_id; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('Bio Graphy')); ?></td>
                    <td><?php echo $user->bio; ?></td>
                </tr>

                <tr>
                    <td><?php echo e(trans('Parent User')); ?></td>
                    <td>
                        <?php if($user->parent): ?>
                            <?php echo $user->parent->first_name; ?> <?php echo $user->parent->last_name; ?>

                        <?php else: ?>
                            <?php echo 'No Parent'; ?>

                        <?php endif; ?>
                    </td>
                </tr>


            </tbody>
        </table>
        
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <a href="<?php echo e(route('admin.user')); ?>" class="btn btn-default btn-close"><i class="fa fa-arrow-left" aria-hidden="true"></i> <?php echo e(trans('Back')); ?></a>
            </div>
        </div>

    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.backend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>