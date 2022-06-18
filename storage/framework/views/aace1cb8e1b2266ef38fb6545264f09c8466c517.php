<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('News')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    
    <div class="col-md-12">
    	
        <?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $newsItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <h3><?php echo e($newsItem->title); ?></h3>

            <?php 
                //$string = strip_tags($newsItem->description);
                $string = $newsItem->description;
                if (strlen($string) > 500) {

                    // truncate string
                    $stringCut = substr($string, 0, 500);
                    $endPoint = strrpos($stringCut, ' ');

                    // if the string doesn't contain any space then it will cut without word basis.
                    $string = $endPoint? substr($stringCut, 0, $endPoint):substr($stringCut, 0);
                    $string .= '... <a href="'.route('news.details', array('id' => $newsItem->id)).'" style="font-weight:bold; font-size:17px;">read more</a>';
                }
             ?>

        	<p><?php echo $string; ?></p>
            <br /><br />
            <hr />
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>