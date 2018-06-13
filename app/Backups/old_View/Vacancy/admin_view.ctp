<div class="page-content-wrapper">
<div class="page-content">
<!-- BEGIN STYLE CUSTOMIZER -->
<?php // echo $this->element('theme_customizer'); ?>
<!-- END STYLE CUSTOMIZER -->
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth'); ?>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Vacancy</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Vacancy</a>
            </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-12">
<div class="tabbable tabbable-custom boxless tabbable-reversed">

        <div class="portlet box blue-madison">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa icon-user"></i>View Vacancy
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Name:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $this->request->data['Vacancy']['TITLE']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">EMAIL:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $this->request->data['Vacancy']['EMAIL']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Phone:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $this->request->data['Vacancy']['PHONE']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Education:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $this->request->data['Vacancy']['EDUCATION']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
						<!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Gender:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $this->request->data['Vacancy']['GENDER']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Designation:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $this->request->data['Vacancy']['DESIGNATION']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
						<div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Apply for:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $this->request->data['Vacancy']['APPLY_FOR']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Resume:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php if($this->request->data['Vacancy']['RESUME']!='') {  ?>
												<a href="<?php echo $this->request->data['Vacancy']['RESUME']; ?>" target="_blank">View Resume</a>
											<?php }else{ ?>
											No Resume found.
											<?php } ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                    </div>
                    <div class="form-actions fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="button" class="btn default"  onclick="window.location.href='<?php echo Router::url(array
                                    ('action' => 'index')) ?>'">Go Back</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                <!-- END FORM-->
            </div>
        </div>

</div>
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>