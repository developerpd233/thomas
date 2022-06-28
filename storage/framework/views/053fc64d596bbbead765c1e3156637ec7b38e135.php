<!DOCTYPE html>
<html lang="en">
<head>

    <?php echo $__env->make('layouts.backend.partials.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <?php echo $__env->make('layouts.backend.partials.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('layouts.backend.partials.sidebar-navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="content-wrapper">
    <?php echo $__env->make('layouts.backend.partials.breadcrumbs', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- Main content -->
        <section class="content">

        <?php echo $__env->make('layouts.backend.partials.message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

        <!-- Actual Page Content-->
            <div id="content">

                <div class="row">
                    <div class="col-md-12">
                        <div class="box box-info">
                            <p class="clearfix"></p>

                            <?php echo $__env->yieldContent('content'); ?>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <?php echo $__env->make('layouts.backend.partials.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</div><!-- ./wrapper -->

<!-- ./wrapper -->

</body>
</html>
