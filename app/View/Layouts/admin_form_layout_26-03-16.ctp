<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8" />
    <title><?php echo WEBSITE_NAME; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="keywords" content="<?php // echo $meta_keywords ?>"/>
    <meta name="description" content="<?php // echo $meta_description ?>"/>
    <meta content="" name="author"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="Identifier-URL" content="<?php echo SITE_URL; ?>"/>
    <?php echo $this->element('admin_form_assets'); ?>
    <script type="text/javascript">
        var JS_SITEURL = "<?php echo SITE_URL; ?>";
        var ADMINURL = "<?php echo RESOURCES_DIRECTORY; ?>";
        var REQUEST_URL = "<?php echo ADMIN_URL; ?>";
    </script>
</head>
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed ">
<!-- BEGIN HEADER -->
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner">
        <!-- BEGIN LOGO -->
        <div class="page-logo">
                <a href="<?php echo Router::url(array("controller"=>"Users","action"=>"dashboard")); ?>"><?php  echo $this->Html->image('logo-small.png', array('alt' => WEBSITE_NAME, 'title' => WEBSITE_NAME, 'style' => 'width:120px; margin-top:0;')); ?></a>
            <!--  <h3 class="form-title"><?php // echo WEBSITE_NAME; ?></h3> -->

            <div class="menu-toggler sidebar-toggler hide">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
        <div class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
        </div>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <?php echo $this->element('admin_default_top_menu'); ?>
        <!-- END TOP NAVIGATION MENU -->
   </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <?php  			
			// echo $this->element('admin_left_rights'); 
			echo $this->element('admin_default_sidebar_menu'); 
	?>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <?php echo $this->fetch('content'); ?>
    <?php // echo $this->element('sql_dump'); ?>
</div>
<?php echo $this->element('admin_form_footer'); ?>
<!-- END LOGIN -->

<!-- scripts_for_layout -->
<?php echo $scripts_for_layout; ?>
<!-- Js writeBuffer -->
<?php
if (class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer'))
    echo $this->Js->writeBuffer();
// Writes cached scripts
?>
</body>
<!-- END BODY -->
</html>