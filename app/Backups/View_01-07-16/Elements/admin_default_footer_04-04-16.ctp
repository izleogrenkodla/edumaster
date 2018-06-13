<div class="page-footer">
    <div class="page-footer-inner">
        2015 &copy; <?php echo WEBSITE_NAME; ?>. Admin Control Panel.
    </div>
    <div class="page-footer-tools">
		<span class="go-top">
		<i class="fa fa-angle-up"></i>
		</span>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?php echo ASSETS_URL; ?>global/plugins/respond.min.js"></script>
<script src="<?php echo ASSETS_URL; ?>global/plugins/excanvas.min.js"></script>
<![endif]-->
<script src="<?php echo ASSETS_URL; ?>global/plugins/jquery-1.11.0.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>global/plugins/jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
<!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
<script src="<?php echo ASSETS_URL; ?>global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>global/plugins/jquery.cokie.min.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>global/plugins/uniform/jquery.uniform.min.js" type="text/javascript"></script>
<!-- END CORE PLUGINS -->
<!-- BEGIN PAGE LEVEL PLUGINS -->
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/select2/select2.min.js"></script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo ASSETS_URL; ?>global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>admin/pages/scripts/form-samples.js"></script>
<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        FormSamples.init();
    });
</script>
<!-- END JAVASCRIPTS -->