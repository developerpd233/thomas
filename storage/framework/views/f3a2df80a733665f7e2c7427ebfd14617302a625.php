<?php $__env->startSection('profile'); ?>
    <div class="jumbotron" style="background-image: url('<?php echo e($company_data->photo_url); ?>')">
        <div class="container">
            <p class="text-white"><?php echo e($company_data->name); ?></p>
            <p class="text-blue"><?php echo e($company_data->company_moto); ?></p>
        </div>
    </div>
    <div class="desc">
        <h1 class="text-dark text-description"><?php echo e($company_data->company_description_title); ?></h1>
        <hr>
        <div class="paragraph-content container">
            <p class="text-dark desc-paragraph"><span>
                    <?php echo $company_data->description; ?>

           </span></p>
        </div>

    </div>
    <!--gallery-->
    <div class="company-gallery">
        <div class="gal-color">
            <h1 class="text-description text-testo"><?php echo e($company_data->company_image_title); ?></h1>
            <hr>
            
            <div class="row">
                <div class="row">
                    <?php $__currentLoopData = $company_photo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-3 col-md-6 col-xs-6">
                            <a class="thumbnail" href="<?php echo e($item->pic_url); ?>">
                                <img class="img-thumbnail"
                                     src="<?php echo e($item->photo_url); ?>"
                                     alt="Another alt text">
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        
        
        <!--end of gallery-->
            <div class="testo">
                <div class="container">
                    <h1 class="text-description text-testo">Testomonials</h1>
                    <hr>
                    <h5 style="font-weight: bold" class="text-center">See, what other say about us</h5>
                    <br>
                    <?php $__currentLoopData = $testo_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="row" style="font-size: 1.3em; padding: 1em 0;">

                            <div class="text-dark text-center">
                                <?php echo e($testo->testomonial); ?> <span class="for-name">- by: <?php echo e($testo->name); ?></span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="contact-section container">
                <h1 class="text-dark text-contact">Contact Us</h1>
                <hr>
                <div class="contact-box">
                    <div class="row info" style="background-color: #F9F9F9">
                        <div class="email col-lg-4">
                            <h3>Email</h3>
                            <p style="text-align: center"><?php echo e($company_data->email); ?></p>
                        </div>
                        <div class="contact col-lg-4">
                            <h3>Contact info</h3>
                            <p style="text-align: center"> <?php echo e($company_data->contact); ?> </p>
                        </div>
                        <div class="address col-lg-4">
                            <h3>Address</h3>
                            <p style="text-align: center"><?php echo e($company_data->address); ?> </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <h4 style="color: black">Follow us</h4>
                <div class="row">
                    <a href="<?php echo e($user->twitter_url); ?>" class="btn btn-social-icon btn-twitter btn-lg"
                       style="font-size: 200%;">
                        <span class="fa fa-twitter"></span>
                    </a>
                    <a href="<?php echo e($user->facebook_url); ?>" class="btn btn-social-icon btn-facebook btn-lg"
                       style="font-size: 200%;">
                        <span class="fa fa-facebook"></span>
                    </a>
                    <a href="<?php echo e($user->instagram_url); ?>" class="btn btn-social-icon btn-instagram btn-lg"
                       style="font-size: 200%;">
                        <span class="fa fa-instagram"></span>
                    </a>
                    <a href="<?php echo e($user->snapchat_url); ?>" class="btn"><span class='fab fa-snapchat'
                                                                        style="font-size: 200%"></span></a>
                </div>
            </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.company_profile.default_new', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>