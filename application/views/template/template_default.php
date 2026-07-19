<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
<meta charset="utf-8" />
<title><?php echo SITE_TITLE;?></title>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta content="width=device-width, initial-scale=1.0" name="viewport" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8">
<meta content="" name="description" />
<meta content="" name="author" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link
	href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all"
	rel="stylesheet" type="text/css">
<link
	href="<?php echo base_url();?>assets/global/plugins/font-awesome/css/font-awesome.min.css"
	rel="stylesheet" type="text/css">
<link
	href="<?php echo base_url();?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css"
	rel="stylesheet" type="text/css">
<link
	href="<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css"
	rel="stylesheet" type="text/css">
<link	href="<?php echo base_url();?>assets/global/plugins/uniform/css/uniform.default.css"
	rel="stylesheet" type="text/css">
<!-- END GLOBAL MANDATORY STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/css/datepicker3.css"/>
	
<link href="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"
	rel="stylesheet" type="text/css" />
<link
	href="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.css"
	rel="stylesheet" />
<!-- BEGIN:File Upload Plugin CSS files-->
<link
	href="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/blueimp-gallery/blueimp-gallery.min.css"
	rel="stylesheet" />
<link
	href="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/css/jquery.fileupload.css"
	rel="stylesheet" />
<link
	href="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/css/jquery.fileupload-ui.css"
	rel="stylesheet" />
<!-- END:File Upload Plugin CSS files-->
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN PAGE LEVEL STYLES -->
<link href="<?php echo base_url();?>assets/admin/pages/css/inbox.css"
	rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/global/css/developer-css.css"
	rel="stylesheet" type="text/css" />
<!-- END PAGE LEVEL STYLES -->
<!-- BEGIN THEME STYLES -->
<link
	href="<?php echo base_url();?>assets/global/css/components-rounded.css"
	id="style_components" rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/global/css/plugins.css"
	rel="stylesheet" type="text/css">
<link href="<?php echo base_url();?>assets/admin/layout3/css/layout.css"
	rel="stylesheet" type="text/css">
<link
	href="<?php echo base_url();?>assets/admin/layout3/css/themes/default.css"
	rel="stylesheet" type="text/css" id="style_color">
<link href="<?php echo base_url();?>assets/admin/layout3/css/custom.css"
	rel="stylesheet" type="text/css">
<!-- END THEME STYLES -->
<link rel="shortcut icon" href="favicon.ico" />

<script type="text/javascript">
var base_url = '<?php echo base_url();?>';
</script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3234816981395206"
     crossorigin="anonymous"></script>
<meta name="google-adsense-account" content="ca-pub-3234816981395206">
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-menu-fixed" class to set the mega menu fixed  -->
<!-- DOC: Apply "page-header-top-fixed" class to set the top menu fixed  -->
<body>
	<!-- BEGIN HEADER -->
	<?php $this->load->view('template/page_header');?>
	<!-- END HEADER -->
	<!-- BEGIN PAGE CONTAINER -->
	<div class="page-container">
		<!-- BEGIN PAGE CONTENT -->
		<div class="page-content">
			<div class="container">
				<!-- BEGIN PAGE BREADCRUMB -->
				<?php $this->load->view('template/breadcrumb');?>
				<!-- END PAGE BREADCRUMB -->
				<div class="row">
					<?php $this->load->view('template/alert_messages');?>
					<?php echo $body;?>				
				</div>
			</div>
		</div>
		<!-- END PAGE CONTENT -->
	</div>
	<!-- END PAGE CONTAINER -->

	<!-- BEGIN FOOTER -->
	<?php $this->load->view('template/footer');?>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->
	<!--[if lt IE 9]>
<script src="<?php echo base_url();?>assets/global/plugins/respond.min.js"></script>
<script src="<?php echo base_url();?>assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->
	<script
		src="<?php echo base_url();?>assets/global/plugins/jquery.min.js"
		type="text/javascript"></script>
	<script
		src="<?php echo base_url();?>assets/global/plugins/jquery-migrate.min.js"
		type="text/javascript"></script>
	<!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
	<script
		src="<?php echo base_url();?>assets/global/plugins/jquery-ui/jquery-ui.min.js"
		type="text/javascript"></script>
	<script
		src="<?php echo base_url();?>assets/global/plugins/bootstrap/js/bootstrap.min.js"
		type="text/javascript"></script>
	<script
		src="<?php echo base_url();?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"
		type="text/javascript"></script>
	<script
		src="<?php echo base_url();?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js"
		type="text/javascript"></script>
	<script
		src="<?php echo base_url();?>assets/global/plugins/jquery.blockui.min.js"
		type="text/javascript"></script>
	<script
		src="<?php echo base_url();?>assets/global/plugins/jquery.cokie.min.js"
		type="text/javascript"></script>
	<script
		src="<?php echo base_url();?>assets/global/plugins/uniform/jquery.uniform.min.js"
		type="text/javascript"></script>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN: Page level plugins -->
	<script
		src="<?php echo base_url();?>assets/global/plugins/fancybox/source/jquery.fancybox.pack.js"
		type="text/javascript"></script>
	<script
		src="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"
		type="text/javascript"></script>
	<script
		src="<?php echo base_url();?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"
		type="text/javascript"></script>
	<!-- BEGIN:File Upload Plugin JS files-->
	<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
	<script
		src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget.js"></script>
	<!-- The Templates plugin is included to render the upload/download listings -->
	<script
		src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min.js"></script>
	<!-- The Load Image plugin is included for the preview images and image resizing functionality -->
	<script
		src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/vendor/load-image.min.js"></script>
	<!-- The Canvas to Blob plugin is included for image resizing functionality -->
	<script
		src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min.js"></script>
	<!-- blueimp Gallery script -->
	<script
		src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min.js"></script>
	<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
	<script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport.js"></script>
	<!-- The basic File Upload plugin -->
	<script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload.js"></script>
	<!-- The File Upload processing plugin -->
	<script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process.js"></script>
	<!-- The File Upload image preview & resize plugin -->
	<script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image.js"></script>
	<!-- The File Upload audio preview plugin -->
	<script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio.js"></script>
	<!-- The File Upload video preview plugin -->
	<script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video.js"></script>
	<!-- The File Upload validation plugin -->
	<script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate.js"></script>
	<!-- The File Upload user interface plugin -->
	<script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui.js"></script>
	<!-- The main application script -->
	<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
	<!--[if (gte IE 8)&(lt IE 10)]>
    <script src="<?php echo base_url();?>assets/global/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js"></script>
    <![endif]-->
	<!-- END:File Upload Plugin JS files-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/css/components-rounded.css"/>
	<!-- SPINER -->
	
	<!-- BEGIN DATATABLE PLUGINS -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/select2/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
	<!-- END DATATABLE PLUGINS -->
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>

	<!-- END: Page level plugins -->
	<script src="<?php echo base_url();?>assets/global/scripts/metronic.js"	type="text/javascript"></script>
	<script	src="<?php echo base_url();?>assets/admin/layout3/scripts/layout.js" type="text/javascript"></script>
	<script	src="<?php echo base_url();?>assets/admin/layout3/scripts/demo.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/admin/pages/scripts/inbox.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
	<script src="<?php echo base_url();?>assets/global/plugins/jcrop/js/jquery.Jcrop.min.js"></script>
	<script src="<?php echo base_url();?>assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
	
	<!-- Include Date Range Picker -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/global/scripts/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/global/scripts/daterangepicker.js"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/global/css/daterangepicker.css" />
	
	<!-- Table shorting -->
	<script type="text/javascript" src="<?php echo base_url();?>assets/global/scripts/jquery.tablesorter.min.js"></script>
	
	<script src="<?php echo base_url();?>assets/global/scripts/jquery.formbuilder.js"></script>
	<link href="http://botsko.net/Demos/formbuilder/css/jquery.formbuilder.css" media="screen" rel="stylesheet" />
	<script src="<?php echo base_url();?>assets/global/scripts/developer-script.js" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/global/scripts/jquery.moveSelected.js" type="text/javascript"></script>

	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>