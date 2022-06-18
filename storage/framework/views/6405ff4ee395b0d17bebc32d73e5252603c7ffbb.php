<!-- Head section Start -->
<?php
//dump(env('SITE'))
//?>
<header class="nav-header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Icon Section Start -->
    <div class="icon-section">
        <div class="container">
            <ul class="list-inline">
                <li class="ix-center">
                    <a href= "https://www.facebook.com/DNAsbookDigitalMarketing"> <i class="livicon" data-name="facebook" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                    </a>
                </li>
                <li>
                    <a href=<?php echo Session::get('telegram_url');?>> <i class="fab fa-telegram-plane" style="font-size:20px; color:#fff;"></i>
                    </a>
                </li>
                <li class="ix-center">
                    <a href=<?php echo Session::get('twitter_url')?>> <i class="livicon" data-name="twitter" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                    </a>
                </li>
                <li class="ix-center">
                    <a href=<?php echo Session::get('instagram_url');?>> <i class="livicon" data-name="instagram" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                    </a>
                </li>
                <li class="ix-center">
                    <a href=<?php echo Session::get('youtube_url')?>> <i class="livicon" data-name="youtube" data-size="18" data-loop="true" data-c="#fff" data-hc="#757b87"></i>
                    </a>
                </li>
                <li class="pull-right">
                    <ul class="list-inline icon-position">
                    <!--<li>
                                <a href="mailto:"><i class="livicon" data-name="mail" data-size="18" data-loop="true" data-c="#fff" data-hc="#fff"></i></a>
                                <label class="hidden-xs"><a href="mailto:" class="text-white">info@joshadmin.com</a></label>
                            </li>
                            <li>
                                <a href="tel:"><i class="livicon" data-name="phone" data-size="18" data-loop="true" data-c="#fff" data-hc="#fff"></i></a>
                                <label class="hidden-xs"><a href="tel:"class="text-white">(703) 717-4200</a></label>
                            </li>-->
                        <li><a href="#"><i class="livicon" data-name="login" data-size="18" data-loop="true" data-c="#fff" data-hc="#fff"></i></a><label class=""><a href="<?php echo e(url('/locale/en')); ?>" class="text-white"><?php echo e(trans('English')); ?></a></label></li>
                        <li><a href="#"><i class="livicon" data-name="login" data-size="18" data-loop="true" data-c="#fff" data-hc="#fff"></i></a><label class=""><a href="<?php echo e(url('/locale/fr')); ?>" class="text-white"><?php echo e(trans('French')); ?></a></label></li>
                        <?php if(Auth::guest()): ?>
                            <li><a href="#"><i class="livicon" data-name="login" data-size="18" data-loop="true" data-c="#fff" data-hc="#fff"></i></a><label class=""><a href="<?php echo e(url('/login')); ?>" class="text-white"><?php echo e(trans('frontend.login')); ?></a></label></li>
                        <?php if(env('SITE') == 'ENG'): ?>
                            <li><a href="#"><i class="livicon" data-name="register" data-size="18" data-loop="true" data-c="#fff" data-hc="#fff"></i></a><label class=""><a href="<?php echo e(url('/register/2')); ?>" class="text-white registerBlock"><?php echo e(trans('frontend.register')); ?></a></label></li>
                            <?php else: ?>
                                <li><a href="#" ><i class="livicon" data-name="register" data-size="18" data-loop="true" data-c="#fff" data-hc="#fff"></i></a><label class=""><a href="<?php echo e(url('/register/345')); ?>" class="text-white registerBlock"><?php echo e(trans('frontend.register')); ?></a></label></li>
                            <?php endif; ?>
                        <?php else: ?>
                            <li>
                                <a href="<?php echo e(route('user.dashboard')); ?>" class="text-white"><i class="glyphicon glyphicon-user"></i> <?php echo e(trans('frontend.dashboard')); ?></a>
                            </li>


                            <li>




                                <!-- Drop Menus -->
                                <ul class="nav" id="account-nav">
                                    <li class="dropdown">

                                        <a class="dropdown-toggle disabled text-white" data-toggle="dropdown" href="#">
                                            Hello, <?php echo e(Auth::user()->first_name); ?> <b class="caret"></b>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="<?php echo e(url('user/'.Auth::user()->username)); ?>"><i class="glyphicon glyphicon-user"></i><?php echo e(trans('navigation.profile')); ?></a></li>
                                            <li><a href="<?php echo e(route('user.account')); ?>"><i class="glyphicon glyphicon-cog"></i><?php echo e(trans('navigation.account_settings')); ?></a></li>
                                            <li>
                                                <a href="<?php echo e(url('/logout')); ?>"  class="top-menu-bgcolor">
                                                    <i class="glyphicon glyphicon-off"></i> <?php echo e(trans('navigation.logout')); ?>

                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <!-- End Drop Menus -->


                            </li>



                        <!--<li>
                                    <a href="<?php echo e(url('/logout')); ?>"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();" class="text-white">
                                        <i class="glyphicon glyphicon-off"></i> <?php echo e(trans('frontend.logout')); ?>

                                </a>

                                <form id="logout-form" action="<?php echo e(url('/logout')); ?>" method="POST" style="display: none;">
                                        <?php echo e(csrf_field()); ?>

                                </form>
                            </li>-->
                        <?php endif; ?>

                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- //Icon Section End -->
    <!-- Nav bar Section Start -->
<?php echo $__env->make('layouts.frontend.partials.navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!-- //Nav bar Section End -->
</header>
<!-- //Head section End -->