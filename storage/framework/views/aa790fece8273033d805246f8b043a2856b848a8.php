<div class="breadcum">
        <div class="container">
            
            <?php if(Breadcrumbs::renderIfExists()): ?>

                <?php 
                    $breadcrumbs = Breadcrumbs::generate();

                 ?>

                <?php if(count($breadcrumbs)): ?>

                    <ol class="breadcrumb">
                        <?php $__currentLoopData = $breadcrumbs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breadcrumb): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php if($breadcrumb->url && $loop->first): ?>
                                <li>
                                    <a href="<?php echo e($breadcrumb->url); ?>">
                                        <i class="livicon icon3 icon4" data-name="home" data-size="18" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i>
                                        <?php echo e($breadcrumb->title); ?>

                                    </a>
                                </li>
                            <?php elseif($breadcrumb->url && !$loop->last): ?>
                                
                                <li class="hidden-xs">
                                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                                    <a href="<?php echo e($breadcrumb->url); ?>"><?php echo e($breadcrumb->title); ?></a>
                                </li>
                            <?php else: ?>
                                <li class="active hidden-xs">
                                    <i class="livicon icon3" data-name="angle-double-right" data-size="18" data-loop="true" data-c="#01bc8c" data-hc="#01bc8c"></i>
                                    <?php echo e($breadcrumb->title); ?>

                                </li>
                            <?php endif; ?>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ol>

                <?php endif; ?>
            <?php endif; ?>


            <div class="pull-right">
                <i class="livicon icon3" data-name="users" data-size="20" data-loop="true" data-c="#3d3d3d" data-hc="#3d3d3d"></i><?php echo e(trans('navigation.home')); ?>

            </div>

        </div>
    </div>

