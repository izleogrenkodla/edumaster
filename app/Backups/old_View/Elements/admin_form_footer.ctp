<div class="page-footer">
    <div class="page-footer-inner">
        <?php echo date('Y'); ?> &copy; <?php echo WEBSITE_NAME; ?>. Admin Control Panel.
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
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/data-tables/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/data-tables/tabletools/js/dataTables.tableTools.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/ckeditor/ckeditor.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/bootstrap-markdown/js/bootstrap-markdown.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/bootstrap-markdown/lib/markdown.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/plupload/jquery.plupload.queue.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/plupload/plupload.full.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>admin/charts/jquery.jqChart.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/jquery-mixitup/jquery.mixitup.min.js"></script>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>global/plugins/fancybox/source/jquery.fancybox.pack.js"></script>
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="<?php echo ASSETS_URL; ?>global/scripts/metronic.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="<?php echo ASSETS_URL; ?>admin/pages/scripts/form-samples.js"></script>
<script src="<?php echo ASSETS_URL; ?>global/scripts/datatable.js"></script>
<script src="<?php echo ASSETS_URL; ?>admin/pages/scripts/table-advanced.js"></script>
<script src="<?php echo ASSETS_URL; ?>admin/pages/scripts/table-ajax.js"></script>
<?php echo $this->Html->Script('admin/caips_global'); ?>
<script src="<?php echo ASSETS_URL; ?>admin/pages/scripts/form-validation.js"></script>
<script src="<?php echo ASSETS_URL; ?>admin/pages/scripts/ui-extended-modals.js"></script>
<script src="<?php echo ASSETS_URL; ?>admin/pages/scripts/components-pickers.js"></script>
<script src="<?php echo ASSETS_URL; ?>admin/pages/scripts/portfolio.js"></script>

<!-- END PAGE LEVEL SCRIPTS -->
<script>
    jQuery(document).ready(function() {
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        UIExtendedModals.init();
        //TableAjax.init();
       // FormValidation.init();
        TableAdvanced.init();
        ComponentsPickers.init();

    });
</script>
<!-- END JAVASCRIPTS -->