<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('app.profile')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-md-4">
        <div style="margin-top: 1em"></div>
        <?php if($user->photo != ''): ?>
            <div class="panel">
                <div class="panel-body">
                    <img src="<?php echo e(asset($user->photo)); ?>" class="img-responsive"/>
                </div>
            </div>
        <?php endif; ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <i class="livicon" data-name="user" data-size="20" data-loop="true" data-c="#fff"
                       data-hc="white"></i>
                    <?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?>

                    (<strong>
                        <?php if($user->is_active == 'YES'): ?>
                            Active
                        <?php else: ?>
                            Not Active
                        <?php endif; ?>
                    </strong>)

                </h3>
            </div>

            <div class="panel-body" style="padding:0px !important;">

                <div class="table-responsive">
                    <table class="table table-striped" id="users">
                        <tr>
                            <td><?php echo e(trans('user.full_name')); ?></td>
                            <td><?php echo e($user->first_name); ?> <?php echo e($user->last_name); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans('register.username')); ?></td>
                            <td><?php echo e($user->username); ?></td>
                        </tr>

                        <tr>
                            <td><?php echo e(trans('register.email')); ?></td>
                            <td><?php echo e($user->email); ?></td>
                        </tr>

                        
                        <tr>
                            <td><?php echo e(trans('user.referring_affiliate')); ?></td>
                            <td>
                                <?php if($user->parent !== null): ?>
                                    <a href="<?php echo e(url('user/'.$user->parent->username)); ?>"><?php echo e($user->parent->first_name); ?> <?php echo e($user->parent->last_name); ?></a>
                                <?php else: ?>
                                    <?php echo e(trans('user.no_referring_affiliate')); ?>

                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans('user.member_since')); ?></td>
                            <td><?php echo e($user->created_at); ?></td>
                        </tr>
                        <tr>
                            <td><?php echo e(trans('user.message')); ?></td>
                            <?php if($user->is_active == "NO"): ?>
                                <td><a href="<?php echo e(url('message/'.$user->username)); ?>" class="btn btn-primary text-white"
                                       disabled="disabled">Send
                                        Message</a></td>
                            <?php else: ?>
                                <td><a href="<?php echo e(url('message/'.$user->username)); ?>" class="btn btn-primary text-white">Send
                                        Message</a></td>
                            <?php endif; ?>
                        </tr>
                        <tr>
                            <?php if($user->is_admin != "YES"): ?>
                                <td><?php echo e(trans('user.message')); ?> to Referring Affiliate</td>
                                <?php if($user->is_active == "NO"): ?>
                                    <td><a href="<?php echo e(url('message/'.$parentuser->username)); ?>"
                                           class="btn btn-primary text-white"
                                           disabled="disabled">Send
                                            Message</a></td>
                                <?php else: ?>
                                    <td><a href="<?php echo e(url('message/'.$parentuser->username)); ?>"
                                           class="btn btn-success text-white">Send
                                            Message</a></td>
                                <?php endif; ?>
                            <?php endif; ?>
                        </tr>
                    </table>
                </div>

            </div>
        </div>

    </div>


    <!--Profile - Right Side -->

    <div class="col-md-8">
        <!--Profile Tabs-->
    
    

    <!--Profile Tabs Container Panel-->
        <div class="panel">
            <div class="panel-body">

                <div class="tab-content">
                    <!--Goals-->
                    <div id="tab-goals" class="tab-pane fade" style="min-height:150px">
                        <div id="goals">

                        <?php echo Form::open(array('id' => 'comment-add', 'url' => $route.'/comment', 'method' => 'post', 'files' => false,'class'=>'form-horizontal')); ?>

                        <!--Comment Textarea-->
                        <?php echo Form::textarea('comments', old('comments'), ['id'=>'comments', 'class'=>'form-control']); ?>

                        <!--Post Comment Button Container-->
                            <div style="padding-top:15px; background-color:#f0f0f0; border:1px solid #ddd; margin-bottom:20px; padding-bottom:15px">
                                <div class="text-center">
                                    <?php echo Form::submit( trans('user.post_comments'), ['class' => 'btn btn-primary']); ?>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php echo Form::close(); ?>


                        </div>
                    </div>
                    <!--//goals-->
                    <!--Activity / Comments-->
                    <div id="tab-activity" class="tab-pane fade in active" style="min-height:150px">
                        <div class="activity">
                            <?php 
                                $counter = 1;
                             ?>
                            <?php if(count($errors)>0): ?>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <p class="alert alert-danger"><?php echo e($error); ?></p>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php echo Form::open(array('id' => 'goal-add', 'url' => $route.'/goal', 'method' => 'post', 'files' => false,'class'=>'form-horizontal')); ?>

                            <?php echo e(csrf_field()); ?>

                            <?php $__currentLoopData = $goals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $goal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="form-group">
                                    <?php echo Form::label($goal->goal_question, trans('Q'.$counter.' - '.$goal->goal_question), ['class' => 'control-label']); ?>

                                    <?php echo Form::textarea("userGoal[$goal->id]", old("userGoal[$goal->id]", (isset($userGoals[$goal->id]))? $userGoals[$goal->id] : ''), ['id'=>'goal-'.$goal->id, 'class'=>'form-control', 'rows' => '3 ']); ?>


                                </div>
                                <?php 
                                    $counter++;
                                 ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <div style="padding-top:15px; background-color:#f0f0f0; border:1px solid #ddd; margin-bottom:20px; padding-bottom:15px">
                                <div class="text-center">
                                    <?php echo Form::submit(trans('user.save_changes'), ['class' => 'btn btn-primary']); ?>

                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <?php echo Form::close(); ?>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('scripts'); ?>
    <script>
        $(document).ready(function () {

            CKEDITOR.replace('comments',
                {
                    toolbar: 'Standard', /* this does the magic */
                });
            CKEDITOR.instances.comments.updateElement();
        })
    </script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>