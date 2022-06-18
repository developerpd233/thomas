
<nav class="navbar navbar-default">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse">
            <span><a href="#"> <i class="livicon" data-name="responsive-menu" data-size="25" data-loop="true"
                                  data-c="#757b87" data-hc="#ccc"></i>
            </a></span>
        </button>
        <a class="navbar-brand" href="#"><img width="120" height="50" src="<?php echo e(asset('/frontend/images/logo1.png')); ?>"
                                              class="logo_position">
        </a>
    </div>
    <div class="collapse navbar-collapse" id="collapse">
        <ul class="nav navbar-nav navbar-right" id="mainNav">
            <?php if(isset($MainNav)): ?>
                <?php echo $__env->make('layouts.frontend.partials.navigation-items', array('items' => $MainNav->roots()), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>

        </ul>
    </div>
</nav>
<style>
    .icon-section{
       margin-bottom: 4px;
    }

</style>