<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="<?php echo e(route('user.dashboard')); ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>DNAsbook</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>DNAsbook Digital</b></span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="<?php echo e(route('user.dashboard')); ?>" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Welcome to <?php echo e(getenv('APP_NAME')); ?></span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->


                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="<?php echo e(Auth::user()->photo); ?>" class="user-image"
                             alt="User Image">
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs"><?php echo e(Auth::user()->last_name .' '.Auth::user()->first_name); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->

                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#"></a>
                            </div>

                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo e(url('/admin/manage-profile')); ?>"
                                   class="btn btn-default btn-flat"><?php echo e(trans('backend.profile')); ?></a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo e(url('/logout')); ?>"
                                   class="btn btn-default btn-flat"><?php echo e(trans('backend.logout')); ?></a>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>