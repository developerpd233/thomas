<?php
$user1 = Auth::user();
$user = $user1->id;
$parentuser = DB::table('users')->where('id',$user1->parent_id)->first();
if($parentuser == null)
{
    $parentuser = DB::table('users')->where('id', $user1->id)->first();
}else{
    $parentuser = DB::table('users')->where('id',$user1->parent_id)->first();
}
?>
<!--<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu">
            <li class="nav-header">
                <div class="dropdown profile-element"> <span>
                        <img alt="image" class="img-circle" src="<?php echo e(asset('/backend/images/profile_48x48.png')); ?>" />
                         </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo e(Auth::user()->name); ?></strong>
                         </span> <span class="text-muted text-xs block">DNAsbook Admin <b class="caret"></b></span> </span> </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="<?php echo e(url('/admin/manage-profile')); ?>"><i class="glyphicon glyphicon-user"></i> <?php echo e(trans('backend.profile')); ?></a></li>
                        
                        <li class="divider"></li>
                        <li><a href="<?php echo e(url('/logout')); ?>"><i class="glyphicon glyphicon-off"></i> <?php echo e(trans('backend.logout')); ?></a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
        </ul>
        
        <ul class="nav metismenu" id="side-menu">
            
            <?php echo $__env->make('layouts.backend.partials.sidebar-navigation-items', array('items' => $MainNav->roots()), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        </ul>

    </div>
</nav>
-->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo e(Auth::user()->photo); ?>" class="img-circle"
                     alt="User Image">
            </div>
            <div class="pull-left info" style="background-color: transparent;">
                <p><?php echo e(Auth::user()->last_name .' '.Auth::user()->first_name); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <?php echo $__env->make('layouts.backend.partials.sidebar-navigation-items', array('items' => $MainNav->roots()), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            
            <li class="">
                <a class="treeview" data-toggle="dropdown" href="" aria-expanded="false">
                    MESSAGE
                    <span class="fa arrow"></span> </a>
                <ul class="treeview-menu" style="display: none;">
                    <li>
                        <a href="<?php echo e(route('group.group')); ?>">
                            MESSAGE ALL
                        </a>

                    </li>
                    <li>
                        <a href="<?php echo e(url('message/'.$parentuser->username)); ?>">
                            MESSSAGE TO REFERRING AFFILIATE
                        </a>
                    </li>
                    <li>
                        <a href="/user/tree">
                            MESSSAGE INDIVIDUAL
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a class="treeview" data-toggle="dropdown" href="" aria-expanded="false">
                    COMPANY
                    <span class="fa arrow"></span> </a>
                <ul class="treeview-menu" style="display: none;">
                    <li>
                        <a href="\company\edit\<?php echo e($user); ?>">
                            Company Profile
                        </a>
                    </li>
                    <li>
                        <a href="/testo">
                            Testomonial
                        </a>
                    </li>
                    <li>
                        <a href="/photo">
                            Photo
                        </a>
                    </li>
                </ul>
            </li>
            <li class="">
                <a class="treeview" data-toggle="dropdown" href="" aria-expanded="false">
                    OFFLINE PAYMENT
                    <span class="fa arrow"></span> </a>
                <ul class="treeview-menu" style="display: none;">
                    <li>
                        <a href="/offline_pay">
                            PAYMENT
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo e(route('offline_pay.verify')); ?>">
                            VERIFY
                        </a>
                    </li>
                </ul>
            </li>

            
            <li><a href="<?php echo e(url('/logout')); ?>"><i class="fa fa-link"></i> <span>Logout</span></a></li>
        </ul>
    </section>
</aside>
