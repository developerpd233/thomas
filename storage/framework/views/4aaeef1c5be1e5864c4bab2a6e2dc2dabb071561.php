<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('about')); ?>

<?php $__env->stopSection(); ?>
<?php $baseUrl = URL::to('/');?>
<?php
$data = \Illuminate\Support\Facades\DB::table('videolink')->where('lang', \Illuminate\Support\Facades\App::getLocale())->first();
?>
<?php $__env->startSection('content'); ?>
    <?php if(!session()->get('canWatch')): ?>
        <div class="row1">
            
            <br>
            <div>
                <p><?php echo $pagesData->content; ?></p>
            </div>
        </div>
    <?php endif; ?>
    <?php if(env('SITE') == 'ENG'): ?>
        <div class="row">
            <?php if(!session()->get('canWatch') && env('SITE') == 'ENG'): ?>
                <h1 class="text-center text-primary"><?php echo e(trans('register.video_page_token')); ?></h1>
                <form action="/token" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label><?php echo e(trans('register.video_page_label')); ?></label>
                            </div>

                            <div class="col-lg-6">
                                <input type="hidden" name="id" value="<?php echo e($_GET['id']); ?>">
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

            <?php if(!session()->get('canWatch')): ?>
                <h1 class="text-center text-primary"><?php echo e(trans('register.video_page_code')); ?></h1>
                <form action="/videocode" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label><?php echo e(trans('register.enter_code_label')); ?></label>
                            </div>

                            <div class="col-lg-6">
                                <input type="hidden" name="id" value="<?php echo e($_GET['id']); ?>">
                                <input type="text" class="form-control" name="videocode"
                                       placeholder="<?php echo e(trans('register.enter_code_label')); ?>">
                            </div>

                        </div>
                        <div class="text-center">
                            <input type="submit" class=" btn btn-primary" value="<?php echo e(trans('register.enter_code')); ?>">
                        </div>
                    </div>
                </form>
            <?php endif; ?>

            <?php if(!session()->get('canWatch') && env('SITE') == 'ENG'): ?>
                <h1 class="text-center text-primary"><?php echo e(trans('register.video_page_BTC_token')); ?></h1>
                <form action="/token" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label><?php echo e(trans('register.video_page_BTC_token')); ?></label>
                            </div>

                            <div class="col-lg-6">
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

            <div class="col-md-12" id="content">
                <?php if(session()->get('canWatch')): ?>
                    <div class="row1">
                        <h1 id="heading"><?php echo e($pagesData->title); ?></h1>
                        <br>
                        <div id="contentpara">
                            <p id="para"><?php echo e(trans('register.video_page_instruction')); ?></p>
                        </div>
                    </div>
                    <div class="videosPage">
                        <div>
                            <div style='position:relative;height:0;padding-bottom:56.25%'>
                                <?php echo $data->link; ?>

                            </div>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" id="myCheck">
                                <p class="text-danger"><?php echo e(trans("backend.checkbox_note")); ?></p></label>
                        </div>
                        <div class="distributor">
                            <?php if(env("SITE") == "ENG"): ?>
                                <button
                                    class="btn  btn-primary registerlink"
                                    style="color: black;cursor:grab ">Next
                                </button>
                            <?php else: ?>
                                <button
                                    class="btn  btn-primary registerlink"
                                    style="color: black;cursor:grab ">Next
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <br>
    <?php else: ?>
        <div class="row">
            <?php if(!session()->get('canWatch')): ?>
                <h1 class="text-center text-primary"><?php echo e(trans('register.video_page_code')); ?></h1>
                <form action="/videocode" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-lg-2">
                                <label><?php echo e(trans('register.enter_code_label')); ?></label>
                            </div>

                            <div class="col-lg-6">
                                <input type="hidden" name="id" value="<?php echo e($_GET['id']); ?>">
                                <input type="text" class="form-control" name="videocode"
                                       placeholder="<?php echo e(trans('register.enter_code_label')); ?>">
                            </div>

                        </div>
                        <div class="text-center">
                            <input type="submit" class=" btn btn-primary" value="<?php echo e(trans('register.enter_code')); ?>">
                        </div>
                    </div>
                </form>
            <?php endif; ?>
            <?php if(session()->get('canWatch')): ?>

                <div class="col-md-12" id="content">
                    <div class="row1">
                        <h1 id="heading"><?php echo e($pagesData->title); ?></h1>
                        <br>
                        <div id="contentpara">
                            <p id="para"><?php echo e(trans('register.video_page_instruction')); ?></p>
                        </div>
                    </div>
                    <div class="videosPage">
                        <div>
                            <?php if(env("SITE") == "ENG"): ?>
                                
                                <?php $lang = App::getLocale();?>
                                <?php if($lang == 'en'): ?>
                                    <div style='position:relative;height:0;padding-bottom:56.25%'>
                                        <iframe class='sproutvideo-player'
                                                src='https://videos.sproutvideo.com/embed/7c9ddab3191ceaccf4/a01c4bcd20484085?playerTheme=dark&amp;playerColor=2f3437'
                                                style='position:absolute;width:100%;height:100%;left:0;top:0'
                                                frameborder='0'
                                                allowfullscreen></iframe>
                                    </div>
                                <?php else: ?>
                                    <div style='position:relative;height:0;padding-bottom:56.25%'>
                                        <iframe class='sproutvideo-player'
                                                src='https://videos.sproutvideo.com/embed/489ddab31a1ce6c2c0/2ba3aa34a14cf04a?playerTheme=dark&amp;playerColor=2f3437'
                                                style='position:absolute;width:100%;height:100%;left:0;top:0'
                                                frameborder='0'
                                                allowfullscreen></iframe>
                                    </div>
                                <?php endif; ?>

                            <?php else: ?>
                                
                                <?php $lang = App::getLocale();?>
                                <?php if($lang == 'en'): ?>
                                    <div style='position:relative;height:0;padding-bottom:56.25%'>
                                        <iframe class='sproutvideo-player'
                                                src='https://videos.sproutvideo.com/embed/7c9ddab3191ceaccf4/a01c4bcd20484085?playerTheme=dark&amp;playerColor=2f3437'
                                                style='position:absolute;width:100%;height:100%;left:0;top:0'
                                                frameborder='0'
                                                allowfullscreen></iframe>
                                    </div>
                                <?php else: ?>
                                    <div style='position:relative;height:0;padding-bottom:56.25%'>
                                        <iframe class='sproutvideo-player'
                                                src='https://videos.sproutvideo.com/embed/1c9ddab31a1de4c894/6287c5da6616e386?playerTheme=dark&amp;playerColor=2f3437'
                                                style='position:absolute;width:100%;height:100%;left:0;top:0'
                                                frameborder='0'
                                                allowfullscreen></iframe>
                                    </div>

                                <?php endif; ?>

                            <?php endif; ?>
                        </div>
                        <div class="checkbox">
                            <label><input type="checkbox" id="myCheck">
                                <p class="text-danger"><?php echo e(trans("backend.checkbox_note")); ?></p></label>
                        </div>
                        <div class="distributor">
                            <?php if(env("SITE") == "ENG"): ?>
                                <button
                                    class="btn  btn-primary registerlink"
                                    style="color: black;cursor:grab ">Next
                                </button>
                            <?php else: ?>
                                <button
                                    class="btn  btn-primary registerlink"
                                    style="color: black;cursor:grab ">Next
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <br>
    <?php endif; ?>

    <style>
        body > div.container > div > div > div > div > div a {
            color: blue;
        }

        #content > a {
            background: blue;
            color: white;
        }

        #heading {
            color: black;
            font-size: 2.3rem;
            text-align: center;
        }

        #para {
            font-size: 1.5rem;
        }
    </style>
    <script
        src="https://code.jquery.com/jquery-3.4.1.js"
        integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
        crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $(".registerBlock").removeAttr("href");
            $(".checkbox").css({"margin-left": "75%", 'font-size': '1.6rem'});
            $("#contentpara p").addClass("text-center text-danger").css({
                "font-size": "25px", "padding-bottom": "10px"
            });
            //disable next button if not checked else enable button
            $(".registerlink").attr("disabled", "disabled");
            $('#myCheck').click(function () {
                if ($(this).is(':checked')) {
                    $(".registerlink").removeAttr("disabled");
                } else {
                    $(".registerlink").attr("disabled", "disabled");
                }
            });
        });
    </script>

    <script>
        $(document).ready(function () {
            $(".distributor button").click(function () {
                var baseURL = "<?php echo $baseUrl ?>";
                var getID = "<?php echo $_GET['id'] ?>";
                document.cookie = "videos=1;path=/";
                window.location = baseURL + "/register/" + getID;
            })
        })
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>