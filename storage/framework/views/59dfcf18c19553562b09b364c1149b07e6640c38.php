<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('about')); ?>

<?php $__env->stopSection(); ?>
<?php $baseUrl = URL::to('/');?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12" id="content">
            <div class="row1">
                <h1 id="heading"><?php echo e($pagesData->title); ?></h1>
                <br>
                <div id="contentpara">
				 
                    <p id="para"><?php echo $pagesData->content; ?></p>
                </div>
            </div>
        </div>
    </div>
    <br>
<?php $__env->stopSection(); ?>
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


<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>