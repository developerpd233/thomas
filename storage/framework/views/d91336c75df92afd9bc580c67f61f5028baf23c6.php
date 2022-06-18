<?php $baseUrl = URL::to('/');?>
<?php if(env('SITE') == 'ENG'): ?>
        <div class="row">
            <?php if( env('SITE') == 'ENG'): ?>
                <h1 class="text-center text-primary"><?php echo e(trans('register.video_page_token')); ?></h1>
                <form action="/token" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label><?php echo e(trans('register.video_page_label')); ?></label>
                            </div>

                            <div class="col-lg-6">
                                <input type="hidden" name="id" value="<?php echo e($_GET['id']); ?>">
                                <input type="hidden" name="type" value="webinar">
                                <input type="text" class="form-control" name="token"
                                       placeholder="<?php echo e(trans('register.video_page_label')); ?>">
                            </div>

                        </div>
                        <div class="text-center">
                            <input type="submit" class=" btn btn-primary" value="<?php echo e(trans('register.enter_code')); ?>">
                        </div>
                    </div>
                </form>
            <?php endif; ?>

                <h1 class="text-center text-primary"><?php echo e(trans('register.video_page_code')); ?></h1>
                <form action="/videocode" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label><?php echo e(trans('register.enter_code_label')); ?></label>
                            </div>

                            <div class="col-lg-6">
                                <input type="hidden" name="id" value="<?php echo e($_GET['id']); ?>">
                                <input type="hidden" name="type" value="webinar">
                                <input type="text" class="form-control" name="videocode"
                                       placeholder="<?php echo e(trans('register.enter_code_label')); ?>">
                            </div>

                        </div>
                        <div class="text-center">
                            <input type="submit" class=" btn btn-primary" value="<?php echo e(trans('register.enter_code')); ?>">
                        </div>
                    </div>
                </form>
           
            <?php if(env('SITE') == 'ENG'): ?>
                <h1 class="text-center text-primary"><?php echo e(trans('register.video_page_BTC_token')); ?></h1>
                <form action="/token" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label><?php echo e(trans('register.video_page_BTC_token')); ?></label>
                            </div>

                            <div class="col-lg-6">
                                <input type="hidden" name="type" value="webinar">
                                <input type="hidden" name="id" value="<?php echo e($_GET['id']); ?>">
                                <input type="text" class="form-control" name="token"
                                       placeholder="<?php echo e(trans('register.video_page_BTC_token')); ?>">
                            </div> 
                        </div>
                        <div class="text-center">
                            <input type="submit" class=" btn btn-primary" value="<?php echo e(trans('register.enter_code')); ?>">
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </div>
        <br>
    <?php else: ?>
        <div class="row">
                <h1 class="text-center text-primary"><?php echo e(trans('register.video_page_code')); ?></h1>
                <form action="/videocode" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label><?php echo e(trans('register.enter_code_label')); ?></label>
                            </div>

                            <div class="col-lg-6">
                                <input type="hidden" name="id" value="<?php echo e($_GET['id']); ?>">
                                <input type="hidden" name="type" value="webinar">
                                <input type="text" class="form-control" name="videocode"
                                       placeholder="<?php echo e(trans('register.enter_code_label')); ?>">
                            </div>

                        </div>
                        <div class="text-center">
                            <input type="submit" class=" btn btn-primary" value="<?php echo e(trans('register.enter_code')); ?>">
                        </div>
                    </div>
                </form>
        </div>
        <br>
    <?php endif; ?>
