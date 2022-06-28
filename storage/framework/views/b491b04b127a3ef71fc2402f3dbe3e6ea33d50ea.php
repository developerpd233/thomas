<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('Home')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="main-wrapper">
        <!-- added by a21 -->
        <div class="main-content">

            <div class="hero-wrapper-one">
                <div class="video-content">
                    <video class="visible-desktop" id="hero-vid" poster="" autoplay
                           loop muted style="width: 100%">
                        <source type="video/mp4"
                                src="<?php echo e(asset('uploads/Pexels_Videos_1570920.mp4')); ?>">
                    </video>
                </div>
                <div class="hero-content">
                    <div class="hero-subheading"><?php echo e(__('home_page.subheading')); ?></div>
                    <div class="hero-heading"><?php echo e(__('home_page.heading')); ?></div>
                    <div class="btn hero-button">
                        <?php if(env('SITE') == 'ENG'): ?>
                        <a href="<?php echo e(url('register/2')); ?>" class="btn-black"><?php echo e(__('home_page.SignUp')); ?></a>
                            <?php else: ?>
                            <a href="<?php echo e(url('register/345')); ?>" class="btn-black"><?php echo e(__('home_page.SignUp')); ?></a>
                            <?php endif; ?>
                    </div>
                </div>
            </div>

            <section class="about-us section-light">
                <div class="about-us-content">
                    <div class="text col-md-6">
                        <div class="about-heading-pra" style="">
                            <hr class="hr-1">
                            <p class="heading-2"
                               style="font-size: 42px; font-weight: 400; line-height: 50.4px;  margin-bottom: 20px; text-align: center;
                           font-family: 'Raleway', sans-serif;">
                                <?php echo e(__('home_page.AboutUs')); ?>

                            </p>
                            <p class="about-us-description" style="font-family: 'Open Sans', sans-serif;">
                                <?php echo __('home_page.AboutUsDescription'); ?>

                            </p>
                            <p style="text-align: center; margin-top: 20px;">
                                <a href="https://www.youtube.com/watch?v=OLSqdQCzCgo&t=2s" target="_blank"
                                   class=" btn-black"><?php echo e(__('home_page.Watch')); ?></a>
                            </p>

                        </div>
                    </div>

                    <div class=" col-md-6">
                        <img class="img img-responsive" id="big-logo-img" style=""
                             src="<?php echo e(URL::asset('images/Logo.jpeg')); ?>"/>
                    </div>
                </div>
            </section>


            <section class="services section-transparent">

                <div class="hero-wrapper-two">

                    <div class="heading-2">
                        <hr class="hr-2"/>
                        <div style="text-transform: uppercase"
                             class="heading-2-top text-center"><?php echo e(__('home_page.HowWeCan')); ?></div>
                        <div class="heading-2-bottom text-center"><?php echo e(__('home_page.HelpYou')); ?></div>

                    </div>

                    <div class="card-container">
                        <div class="row">
                            <div class="col-md-6 left-side">
                                <h3 class="enterp-with" style=""><?php echo e(__('home_page.EntrepreneurshipWith')); ?>

                                    <br>
                                    DNAsbook Digital Marketing </h3>
                            </div>
                            <div class="col-md-6 right-side">
                                <p style="font-family: 'Open Sans', sans-serif; font-size: 15px; line-height: 1.5em ">
                                    <?php echo e(__('home_page.HowWeCanHelpYouDescription')); ?>

                                </p>
                                <div class="btn">
                                    <?php if(env('SITE') == 'ENG'): ?>
                                    <a href="<?php echo e(url('register/2')); ?>"
                                       class="btn-lt-blue"><?php echo e(__('home_page.SignUpNow')); ?>!</a>
                                        <?php else: ?>
                                        <a href="<?php echo e(url('register/345')); ?>"
                                           class="btn-lt-blue"><?php echo e(__('home_page.SignUpNow')); ?>!</a>
                                        <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </section>

        </div>
        <!-- end of addition -->
    </div>

    <div class="pre-footer" style="background-color: #57BBBF; padding: 0px 0;">
    </div>

    <script>
        // added by a21
        $(document).ready(function () {
            $(window).scroll(function (event) {
                var x = ($(this).scrollTop() - 50) / 10;
                var y = ($(this).scrollTop() - 770) / 10;
                var z = ($(this).scrollTop() - 50) / 10;


                $('.hero-wrapper-one').css('background-position', '0% ' + parseInt(-x) + 'px');
                $('.hero-wrapper-two').css('background-position', '0% ' + parseInt(-y) + 'px');
                $('#hero-vid').css('top', parseInt(-z) + 'px');
            });
        });

    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.frontend.home_page', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>