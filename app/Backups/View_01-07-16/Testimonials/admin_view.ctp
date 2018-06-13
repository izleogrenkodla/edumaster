<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN STYLE CUSTOMIZER -->
        <?php // echo $this->element('theme_customizer'); ?>
        <!-- END STYLE CUSTOMIZER -->
        <!-- BEGIN PAGE HEADER-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                <ul class="page-breadcrumb breadcrumb">
                    <li class="btn-group">
                        <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                            <span>Actions</span><i class="fa fa-angle-down"></i>
                        </button>
                        <ul class="dropdown-menu pull-right" role="menu">
                            <li>
                                <a href="<?php echo Router::url(array('controller' => 'Testimonials', 'action' => 'index')) ?>">View All Testimonials</a>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('controller' => 'Testimonials', 'action' => 'add')) ?>">Add New Testimonial</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="#">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Testimonials</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">View Testimonial</a>
                    </li>
                </ul>
                <?php echo $this->Session->flash(); ?>
                <?php echo $this->Session->flash('auth'); ?>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">

                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <span aria-hidden="true" class="icon-user"></span>&nbsp; View Achievement
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                       
                        <div class="form-body">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Name :
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->request->data["Testimonial"]["NAME"]; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Designation :
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->request->data["Testimonial"]["DESIGNATION"]; ?>
											
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Upload Photo</label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
                                             <?php
                                if($this->request->data["Testimonial"]["PROFILE_IMAGE"]!='') {
                                    $img = $this->request->data["Testimonial"]["PROFILE_IMAGE"];
                                    $path = SITE_URL . 'files/upload_document/'.$img;
                                    ?>
                                    <div >
                                        <img src="<?php echo $path ?>"  width="100" />
                                    </div>
                                <?php } ?>
                                        </div>
                                    </div>
                                </div>
									<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Client Experience :
                                        </label>
                                        <div class="col-md-9 tooltips">
										
										 <?php echo $this->request->data["Testimonial"]["CLIENT_EXE"]; ?>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="button" class="btn default" onclick="window.location.href='<?php echo Router::url(array("controller"=>"Testimonials","action"=>"index")); ?>'">Go Back</button>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                </div>
                            </div>
                        </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>

            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>