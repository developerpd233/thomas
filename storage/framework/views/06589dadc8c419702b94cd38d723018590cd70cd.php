<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('about')); ?>

<?php $__env->stopSection(); ?>
<?php $baseUrl = URL::to('/');?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php if(session()->has('PaymentSuccess')): ?>
            <br>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <strong><?php echo session()->get('PaymentSuccess'); ?></strong>
                <?php echo session()->forget('PaymentSuccess'); ?>

            </div>
        <?php endif; ?>        
        <div class="col-md-12" id="content">
            <div class="row1">
                <h1 id="heading"><?php echo e($pagesData->title); ?></h1>
                <br>
                <div id="contentpara">
				 
                    <p id="para"><?php echo $pagesData->content; ?></p>
                </div>
            </div>
        </div>
		<div class="automatic-webinar">
                <button
                   class="btn btn-primary registerlink"
                   style="color: black;cursor:grab">Next</button>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
<script>
    $(document).ready(function () {
        $(".automatic-webinar button").click(function () {
            var baseURL = "<?php echo $baseUrl ?>";
            var getID = "<?php echo $_GET['id'] ?>";
            document.cookie = "distributorPage=1;path=/";
			<?php if(App::getLocale() == 'en'): ?>
                window.location = baseURL+"/pages/webinars-payments?id="+getID;
            <?php else: ?>
                window.location = baseURL+"/pages/paiements-pour-les-webinars?id="+getID;
            <?php endif; ?>
        })
    })
</script>

<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>