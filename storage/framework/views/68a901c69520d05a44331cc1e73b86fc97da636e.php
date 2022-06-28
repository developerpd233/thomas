<!DOCTYPE html>
<html lang="en">
<head>
	
        <?php echo $__env->make('layouts.frontend.partials.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        
</head>
<body>
    
    
        
        <?php echo $__env->make('layouts.frontend.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                
        <?php echo $__env->make('layouts.frontend.partials.breadcrumbs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                 
                <div class="container">

                        <div class="row">
                                <div class="col-md-12">
                                    
                                    <?php echo $__env->make('layouts.frontend.partials.message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    
                                    <?php echo $__env->yieldContent('content'); ?>

                                </div>
                        </div>

                </div>
                           
        	
         <?php echo $__env->make('layouts.frontend.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
        
</body>
</html>
