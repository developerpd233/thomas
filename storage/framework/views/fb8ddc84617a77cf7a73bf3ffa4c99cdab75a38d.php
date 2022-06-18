<?php $__env->startSection('message'); ?>
  
    <?php if(Session::has('success')): ?> 
    <div class="alert alert-success"> 
        <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;<?php echo Session::get('success'); ?> 
    </div> 
    <?php endif; ?>

    <?php if(Session::has('error')): ?> 
    <div class="alert alert-danger"> 
        <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;<?php echo Session::get('error'); ?> 
    </div> 
    <?php endif; ?>
    
    <?php if(Session::has('info')): ?> 
    <div class="alert alert-info"> 
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;<?php echo Session::get('info'); ?>  
    </div> 
    <?php endif; ?>
    
    <?php if(Session::has('warning')): ?> 
    <div class="alert alert-warning"> 
        <span class="glyphicon glyphicon-alert" aria-hidden="true"></span>&nbsp;&nbsp;&nbsp;<?php echo Session::get('warning'); ?> 
    </div> 
    <?php endif; ?>


    <?php if(count($errors)>0): ?>
            <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
            </div>
    <?php endif; ?>


<?php echo $__env->yieldSection(); ?>