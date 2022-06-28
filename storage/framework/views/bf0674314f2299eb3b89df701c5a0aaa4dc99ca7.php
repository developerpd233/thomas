<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<!-- Scripts -->
<script>
    window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>
</script>

<title><?php echo e(getenv('APP_NAME')); ?> :: <?php echo $__env->yieldContent('page_title'); ?></title>
<meta name="keywords" content="<?php echo $__env->yieldContent('meta_keywords'); ?>">
<meta name="description" content="<?php echo $__env->yieldContent('meta_description'); ?>">
<meta name="author" content="Tariq Ali Khan">

<!-- JQuery -->
<script src="<?php echo e(asset('/jquery/jquery-2.1.4.min.js')); ?>"></script>
<script src="<?php echo e(asset('/jquery/jquery-migrate-1.0.0.min.js')); ?>"></script>

<!-- jQery UI -->
<script src="<?php echo e(asset('/jquery-ui-1.12.1/jquery-ui.js')); ?>"></script>

<!-- Bootstrap Core -->
<script src="<?php echo e(asset('/bootstrap-3.3.6/js/bootstrap.min.js')); ?>"></script>
<link href="<?php echo e(asset('/bootstrap-3.3.6/css/bootstrap.min.css')); ?>" rel="stylesheet">
<link rel="shortcut icon" href="images/Logo.jpeg"/>
<!-- Font Awesome -->
<link href="<?php echo e(asset('/font-awesome-4.6.3/css/font-awesome.css')); ?>" rel="stylesheet">
<!-- Admin LTE Theme -->
 <!-- jQuery 2.2.3 -->
  <!--<script type="text/javascript" src="<?php echo e(URL::asset('backend/admin-lte/plugins/jQuery/jquery-2.2.3.min.js')); ?>"></script>-->


  <!-- Bootstrap 3.3.6 -->
  <!--<script type="text/javascript" src="<?php echo e(URL::asset('backend/admin-lte/bootstrap/js/bootstrap.min.js')); ?>"></script>-->
  <!-- AdminLTE App -->
  <script type="text/javascript" src="<?php echo e(URL::asset('backend/admin-lte/dist/js/app.min.js')); ?>"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
  <!-- CKEditor -->
  <!--<script type="text/javascript" src="<?php echo e(URL::asset('js/ckeditor/ckeditor.js')); ?>"></script>-->

  <!-- Favicon  -->
  <link rel="shortcut icon" type="image/png" href="<?php echo e(URL::asset('backend/admin-lte/images/favicon.ico')); ?>"/>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('backend/admin-lte/bootstrap/css/bootstrap.css')); ?>" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" />
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('backend/admin-lte/ionicons/css/ionicons.min.css')); ?>" />
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('backend/admin-lte/dist/css/AdminLTE.css')); ?>" />
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->
  <link rel="stylesheet" href="<?php echo e(URL::asset('backend/admin-lte/dist/css/skins/skin-blue.css')); ?>" />
<!-- Admin LTE Theme -->

<!-- Bootstrap iCheck -->
<link href="<?php echo e(asset('/backend/admin-lte/plugins/iCheck/all.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset('/backend/admin-lte/plugins/iCheck/icheck.min.js')); ?>"></script>

<!-- Bootstrap Datepicker -->
<script src="<?php echo e(asset('/plugins/moment/moment.js')); ?>" type='text/javascript'></script>
<link href="<?php echo e(asset('/backend/admin-lte/plugins/datepicker/datepicker3.css')); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo e(asset('/backend/admin-lte/plugins/datepicker/bootstrap-datepicker.js')); ?>" type='text/javascript'></script>


<!--JQuery Validation-->
<link href="<?php echo e(asset('/plugins/validation/css/style.css')); ?>" media="all" type="text/css" rel="stylesheet"/>
<script type="text/javascript" src="<?php echo e(asset('/plugins/validation/js/jquery.validate.js')); ?>"></script>
<script type="text/javascript" src="<?php echo e(asset('/plugins/validation/js/jquery.metadata.js')); ?>"></script>

<!-- JQery Alphanum -->
<script src="<?php echo e(asset('/plugins/alphanum/jquery.alphanum.js')); ?>"></script>

<!--JQuery BlockUi-->
<script type="text/javascript" src="<?php echo e(asset('/plugins/jquery.blockUI.js')); ?>"></script>

<!-- Bootstrap Daterangepicker -->
<link href="<?php echo e(asset('/backend/admin-lte/plugins/daterangepicker/daterangepicker.css')); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo e(asset('/backend/admin-lte/plugins/daterangepicker/daterangepicker.js')); ?>" type='text/javascript'></script>

<!-- JQuery Grid -->
<link href="<?php echo e(asset('/plugins/grid/css/grid.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset('/plugins/grid/js/jquery.query-2.1.7.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/grid/js/jquery.grid.js')); ?>"></script>

<!-- Bootstrap Chosen -->
<link href="<?php echo e(asset('/plugins/chosen/chosen.css')); ?>" rel="stylesheet" type="text/css"/>
<script src="<?php echo e(asset('/plugins/chosen/chosen.jquery.js')); ?>" type='text/javascript'></script>

<!--JQuery PNotify-->
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/plugins/pnotify/pnotify.custom.min.css')); ?>" media="all" />
<script src="<?php echo e(asset('/plugins/pnotify/pnotify.custom.min.js')); ?>"></script>

<!-- JQery Sweat Alert -->
<script src="<?php echo e(asset('/plugins/sweetalert/dist/sweetalert.min.js')); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo e(asset('/plugins/sweetalert/dist/sweetalert.css')); ?>">

<!--JQuery Chained-->
<script src="<?php echo e(asset('/plugins/chained/jquery.chained.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/chained/jquery.chained.remote.js')); ?>"></script>

<!--JQuery Slugify-->
<script src="<?php echo e(asset('/plugins/speakingurl/speakingurl.min.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/slugify/dist/slugify.min.js')); ?>"></script>

<!--CKEditor-->
<script src="<?php echo e(asset('/plugins/ckeditor/ckeditor.js')); ?>"></script>
<script src="<?php echo e(asset('/plugins/ckeditor/config.js')); ?>"></script>

<!-- Tree Style & Script -->
<link href="<?php echo e(asset('/backend/css/tree.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset('/backend/js/tree.js')); ?>"></script>


<!--jQuery File Upload-->
<link href="<?php echo e(asset('/plugins/file-upload/css/jquery.fileupload.css')); ?>" rel="stylesheet">
<!-- The jQuery UI widget factory -->
<script src="<?php echo e(asset('/plugins/file-upload/js/vendor/jquery.ui.widget.js')); ?>"></script>
<!-- The basic File Upload plugin -->
<script src="<?php echo e(asset('/plugins/file-upload/js/jquery.fileupload.js')); ?>"></script>
<!-- The File Upload processing plugin -->
<script src="<?php echo e(asset('/plugins/file-upload/js/jquery.fileupload-process.js')); ?>"></script>
<!-- The File Upload validation plugin -->
<script src="<?php echo e(asset('/plugins/file-upload/js/jquery.fileupload-validate.js')); ?>"></script>
<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?php echo e(asset('/plugins/file-upload/js/jquery.iframe-transport.js')); ?>"></script>

<!-- JQuery Common -->
<script src="<?php echo e(asset('/plugins/common.js')); ?>"></script>

<!-- Style & Script -->
<link href="<?php echo e(asset('/backend/css/style.css')); ?>" rel="stylesheet">
<script src="<?php echo e(asset('/backend/js/script.js')); ?>"></script>

<!--DATATABLES -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.23/datatables.min.js"></script>


<style>
div.ibox {
  padding: 1.5em 1em;
}
</style>
<?php echo $__env->yieldPushContent('scripts'); ?>

<!--
Route Name: <?php echo Route::getCurrentRoute()->getName(); ?>

URL: <?php echo Request::url(); ?>

-->
