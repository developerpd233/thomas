<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('app.account')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="panel-body">
        <ul class="nav nav-tabs" style="margin-bottom: 15px;">
            <li class="<?php echo e($activeTab == 'subscription' ? '' : 'active'); ?>"><a href="#account" data-toggle="tab"><?php echo e(trans('user.account_info')); ?></a></li>
            <li><a href="#contact" data-toggle="tab"><?php echo e(trans('user.contact_info')); ?></a></li>
            <li><a href="#social" data-toggle="tab"><?php echo e(trans('user.social')); ?></a></li>
            <li class="<?php echo e($activeTab == 'subscription' ? 'active' : ''); ?>"><a href="#subscription" data-toggle="tab"><?php echo e(trans('user.subscription')); ?></a></li>
            
        </ul>

        <form action="<?php echo e(route('user.account')); ?>" enctype="multipart/form-data" id="manage-faq" method="POST"
              class="form-horizontal">
        <?php echo e(csrf_field()); ?>

        <!--<form action="/account/save" id="profileForm" autocomplete="off" enctype="multipart/form-data" method="post" accept-charset="utf-8">-->
            <input type="hidden" value="<?php echo e(csrf_token()); ?>" name="_token">
            <div id="myTabContent" class="tab-content"> <!--class="tab-content"-->

                <!-- Tab Account info -->
                <div class="tab-pane fade <?php echo e($activeTab == 'subscription' ? '' : 'active in'); ?>" id="account">

                    <!--Profile Info-->
                    <div class="col-lg-4 col-md-4 col-sm-4 col-md-offset-0">
                        <div class="panel">
                            <div class="panel-body">
                                <div class="form-group">
                                    <?php echo Form::label('first_name', trans('register.first_name'), ['class' => 'control-label']); ?>

                                    <?php echo Form::text('first_name', old('first_name', $user->first_name), ['id'=>'first_name', 'class'=>'form-control', 'placeholder'=>"First Name"]); ?>

                                </div>

                                <div class="form-group">
                                    <?php echo Form::label('last_name', trans('register.last_name'), ['class' => 'control-label']); ?>

                                    <?php echo Form::text('last_name', old('last_name', $user->last_name), ['id'=>'last_name', 'class'=>'form-control', 'placeholder'=>"Last Name"]); ?>


                                </div>

                                <div class="form-group">
                                    <?php echo Form::label('username', trans('register.username'), ['class' => 'control-label']); ?>

                                    <?php echo Form::text('username', old('username', $user->username), ['id'=>'username', 'class'=>'form-control', 'placeholder'=>"Username", 'disabled'=>"disabled"]); ?>


                                </div>

                                <div class="form-group">
                                    <?php echo Form::label('email', trans('register.email'), ['class' => 'control-label']); ?>

                                    <?php echo Form::text('email', old('email', $user->email), ['id'=>'email', 'class'=>'form-control', 'placeholder'=>"Email", 'disabled'=>"disabled"]); ?>


                                </div>
                                <div>
                                    <?php echo Form::label('Sex', trans('Sex'), ['class' => 'control-label']); ?>

                                    <select name="sex" class="form-control validate-address valid" aria-invalid="false">
                                        <option value="Male" selected="selected">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                            </div>
                        </div>

                    </div>

                    <!--Profile Photo-->
                    <div class="col-lg-4 col-md-4 col-sm-4 text-center">

                        <!-- First Basic Table strats here-->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><i class="livicon" data-name="upload-alt" data-size="20"
                                                           data-loop="true" data-c="#fff"
                                                           data-hc="white"></i><?php echo e(trans('user.upload_profile_photo')); ?>

                                </h3>
                            </div>
                            <div class="panel-body" style="padding:0px !important;">

                                <div style="width:150px; margin: 0 auto;padding-top:2px">
                                    <img src="<?php echo e(asset($user->photo)); ?>" id="avatarProfileImage" width="150px"
                                         class="img-responsive">
                                </div>

                                <div class="clearfix"></div>

                                <div class="col-md-12" style="padding:30px;text-align:center;">
                                    <div action="/account/upload" class="dropzone" id="myDropzone">
                                        <div class="fallback">
                                            <input name="photo" type="file"/>
                                            <br/><br/><?php echo e(trans('user.note')); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Coach info, if they have one -->
                <!--<div class="col-lg-4 col-md-4 col-sm-4 text-center">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="livicon" data-name="user" data-size="20" data-loop="true" data-c="#fff" data-hc="white"></i>Coach</h3>
                        </div>
                        <div class="panel-body" style="padding:0px !important;">

                            <div style="width:150px;margin: 0 auto;padding-top:2px">
                                <img src="<?php echo e(asset($user->photo)); ?>" id="avatarProfileImage" width="150px" class="img-responsive">
                            </div>

                            <div class="clearfix"></div>

                            <div class="col-md-12" style="padding:30px;text-align:center;">
                                <div class="fallback">
                                    Suzanne Jonas
                                    <br/>
                                    suzannej@awolacademy.com
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->

                </div>

                <!-- Tab Contact Info -->
                <div class="tab-pane fade" id="contact">
                    <div class="form-group">
                        <p>
                            <?php echo Form::checkbox('prevent_users_to_see_email', 'YES', ($user->prevent_users_to_see_email=='YES' ? true:false)); ?>

                            <?php echo e(trans('user.prevent_users_to_see_email')); ?>

                        </p>
                    </div>

                    <div class="form-group">
                        <p>
                            <?php echo Form::checkbox('prevent_users_to_see_phone', 'YES', ($user->prevent_users_to_see_phone=='YES' ? true:false)); ?>

                            <?php echo e(trans('user.prevent_users_to_see_phone')); ?>

                        </p>
                    </div>

                    <div class="form-group">
                        <?php echo Form::label('phone', trans('register.phone'), ['class' => 'control-label']); ?>

                        <?php echo Form::text('phone', old('phone', $user->phone), ['class'=>'form-control', 'placeholder'=>"Phone Number"]); ?>

                    </div>

                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <?php echo Form::label('address1', trans('user.address_1'), ['class' => 'control-label']); ?>

                            <?php echo Form::text('address1', old('address1', $user->address1), ['class'=>'form-control', 'placeholder'=>"Address 1"]); ?>


                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-12">
                        <div class="form-group">
                            <?php echo Form::label('address2', trans('user.address_2'), ['class' => 'control-label']); ?>

                            <?php echo Form::text('address2', old('address2', $user->address2), ['class'=>'form-control', 'placeholder'=>"Address 2"]); ?>


                        </div>
                    </div>

                    <div class="clearfix"></div>


                    <div class="form-group">
                        <?php echo Form::label('city', trans('register.city'), ['class' => 'control-label']); ?>

                        <?php echo Form::text('city', old('city', $user->city), ['class'=>'form-control', 'placeholder'=>"City"]); ?>


                    </div>

                    <div class="form-group">
                        <?php echo Form::label('state', trans('register.state'), ['class' => 'control-label']); ?>

                        <?php echo Form::text('state', old('state', $user->state), ['class'=>'form-control', 'placeholder'=>"State"]); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('zip', trans('user.zip'), ['class' => 'control-label']); ?>

                        <?php echo Form::text('zip', old('zip', $user->zip), ['class'=>'form-control', 'placeholder'=>"Postal / Zip"]); ?>


                    </div>

                </div>
                <!-- Tab Social -->
                <div class="tab-pane fade" id="social">
                    <div class="form-group">
                        <label for="skype"><?php echo e(trans('user.system_comments')); ?></label>
                        <p>
                            <?php echo Form::checkbox('prevent_users_to_comments_messages', 'YES', ($user->prevent_users_to_comments_messages=='YES' ? true:false)); ?>

                            <?php echo e(trans('user.disable_personal_message')); ?>

                        </p>
                    </div>

                    <div class="form-group">
                        <?php echo Form::label('subscribe_link', trans('user.subscribe_link'), ['class' => 'control-label']); ?>

                        <?php echo Form::text('subscribe_link', route('register', ['id' => $user->id]), ['class'=>'form-control', 'readonly'=>"readonly"]); ?>


                    </div>
                    <div class="form-group">
                        <?php echo Form::label('facebook_url', trans('user.facebook_url'), ['class' => 'control-label']); ?>

                        <p class="sub"><?php echo e(trans('user.this_url')); ?>

                            <strong><?php echo e(trans('user.optional')); ?></strong> <?php echo e(trans('user.will_appear_in_funnels')); ?></p>
                        <?php echo Form::text('facebook_url', old('facebook_url', $user->facebook_url), ['class'=>'form-control', 'placeholder'=>"https://www.facebook.com/username"]); ?>



                    </div>

                    <div class="form-group">
                        <?php echo Form::label('twitter_url', trans('user.twitter_url'), ['class' => 'control-label']); ?>

                        <p class="sub"><?php echo e(trans('user.this_url')); ?>

                            <strong><?php echo e(trans('user.optional')); ?></strong> <?php echo e(trans('user.will_appear_in_funnels')); ?></p>
                        <?php echo Form::text('twitter_url', old('twitter_url', $user->twitter_url), ['class'=>'form-control', 'placeholder'=>"https://www.twitter.com/username"]); ?>

                    </div>
                    <div class="form-group">
                        <?php echo Form::label('instagram_url', trans('Instagram URL'), ['class' => 'control-label']); ?>

                        <p class="sub"><?php echo e(trans('user.this_url')); ?>

                            <strong><?php echo e(trans('user.optional')); ?></strong> <?php echo e(trans('user.will_appear_in_funnels')); ?></p>
                        <?php echo Form::text('instagram_url', old('instagram_url', $user->instagram_url), ['class'=>'form-control', 'placeholder'=>"https://www.instagram.com/username"]); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('snapchat_url', trans('user.snap_chat_url'), ['class' => 'control-label']); ?>

                        <p class="sub"><?php echo e(trans('user.this_url')); ?>

                            <strong><?php echo e(trans('user.optional')); ?></strong> <?php echo e(trans('user.will_appear_in_funnels')); ?></p>
                        <?php echo Form::text('snapchat_url', old('snapchat_url', $user->snapchat_url), ['class'=>'form-control', 'placeholder'=>"https://www.snapchat.com/username"]); ?>

                    </div>

                    <div class="form-group">
                        <?php echo Form::label('skype_id', trans('Skype ID'), ['class' => 'control-label']); ?>

                        <?php echo Form::text('skype_id', old('skype_id', $user->skype_id), ['class'=>'form-control', 'placeholder'=>"Skype ID"]); ?>

                    </div>

                    <div class="form-group">
                        <label for="hangouts"><?php echo e(trans('user.google_hangout_id')); ?></label>
                        <?php echo Form::label('google_hangout_id', trans('user.google_hangout_id'), ['class' => 'control-label']); ?>

                        <?php echo Form::text('google_hangout_id', old('google_hangout_id', $user->google_hangout_id), ['class'=>'form-control', 'placeholder'=>"Google Hangout ID"]); ?>


                    </div>

                    <div class="form-group">
                        <?php echo Form::label('bio', trans('user.bio'), ['class' => 'control-label']); ?>

                        <?php echo Form::text('bio', old('bio', $user->bio), ['class'=>'form-control', 'placeholder'=>"Bio"]); ?>

                    </div>

                </div>

                      
                <h4 class="mt-3">IMPORTANT:</h4>
                <p class=""><?php echo e(__('subscription.Warning')); ?></p>

                <p class=""><?php echo e(__('subscription.Warning-1')); ?></p>

                <div class="tab-pane <?php echo e($activeTab == 'subscription' ? 'active in' : ''); ?>" id="subscription">
                    <div class="container">
                   
                        <a class="btn btn-danger btn-sm" href="<?php echo e(route('user.ban')); ?>" style="color:#fff";>Cancel Subscription</a><br><br>
                    
                    </div>
                </div>
              

                <!-- Rest Tabs will be paste here-->
                </div>
                <!-- Rest Tabs will be paste here-->


            </div>


            <div class="clearfix"></div>

            <div class="action-wrap action-wrap-footer action-wrap-centered">
                <?php echo Form::submit(trans('user.submit'), ['class' => 'btn btn-primary']); ?>

            </div>

        <?php echo Form::close(); ?>

    </div>

    <script type="text/javascript">
    function confirmmodel() {
        confirm("Are you sure want to ban this account");
        document.getElementById('ban').innerText = 'Unban';
    }
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>