<?php $__env->startSection('page_title'); ?>
    <?php echo e(trans('about')); ?>

<?php $__env->stopSection(); ?>
<?php $baseUrl = URL::to('/');?>
<?php $__env->startSection('content'); ?>

<?php  
\Session::put('locale', 'fr');
if(empty($material_details)){?>
    <div class="row">
        <div class="col-md-12" id="content">
            <div class="row1">
                <h1 id="heading"><?php echo e($pagesData->title); ?></h1>
               <br>
                <div id="contentpara">
				 
                    <p id="para">Webinar Not found!</p>
                </div>
            </div>
        </div>
    </div>
    <br>
<?php }else{ ?>	
<div class="container video-controller">
<div class="row1">
                <h1 id="heading"><?php echo e($pagesData->title); ?></h1>
               <br>
            </div>
        <div class="panel panel-primary">
            <div class="panel-body">
                <?php if($material_details->embed == null) : ?>
                <video class="video" style="width:100%;" controls controlsList="nodownload">
                    <source src="<?php echo e($material_details->video_url); ?>"
                    
                            type="video/mp4">
                </video>
            <?php else:?>
                <?php echo $material_details->embed; ?>

            <?php endif;?>
                <h3 class="text-dark heading-text"><?php echo e($material_details->title); ?></h3>
                <p class="text-dark views-text" style="color: gray;"></p>
                <hr>
                <p class="text-dark show-text" data-toggle="collapse" data-target="#demo" style="cursor:pointer; ">
                    Description </p>
                <div id="demo" class="">
                    <?php echo $material_details->description; ?>

                </div>
            </div>
        </div>
		<div class="automatic-webinar">
                <button
                   class="btn btn-primary registerlink"
                   style="color: black;cursor:grab">Next</button>
        </div>
    </div>
<?php } ?>
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
            document.cookie = "automatic-webinar=1;path=/";
           // window.location = baseURL+"/pages/dnasbook-distributor-payment?id="+getID;
            window.location = baseURL+"/pages/there-is-a-mandatory-training-to-follow?id="+getID;
        })
    })
</script>
<?php echo $__env->make('layouts.frontend.default', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>