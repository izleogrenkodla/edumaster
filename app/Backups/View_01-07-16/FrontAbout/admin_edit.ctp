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
                        <a href="<?php echo Router::url(array('controller' => 'FrontAbout', 'action' => 'index')) ?>">View All Front About</a>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'FrontAbout', 'action' => 'add')) ?>">Add New Front About</a>
                    </li>
                </ul>
            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Front About</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Front About</a>
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
                <span aria-hidden="true" class="icon-user"></span>Add Front About
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('FrontAbout', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
			<?php //echo $this->Form->create('FrontAbout', array('class' => 'form-horizontal add', 'id' => 'Roles')); ?>
            <?php echo $this->Form->input("ABOUT_ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                 <label class="control-label col-md-3">School Name<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('SCHOOL_NAME', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( RYAN INTERNATIONAL )')); ?>
                               
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="row">
						<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Upload Logo<span class="required">
                                        * </span></label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
                                            <?php echo $this->Form->input('LOGO', array('type' => 'file', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
<?php echo $this->General->uploadfilenotes(); ?>
                                        </div>
                                    </div>
						</div>
						
						<?php      
						if(isset($this->request->data["FrontAbout"]["LOGO"]) && $this->request->data["FrontAbout"]["LOGO"]!='') {
						?>
						<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
												  <?php
													if(isset($this->request->data["FrontAbout"]["LOGO"]) && $this->request->data["FrontAbout"]["LOGO"]!='') {
														$img = $this->request->data["FrontAbout"]["LOGO"];
														$path = SITE_URL . 'files/upload_document/'.$img;
														?>
													<input type="hidden" name="data[HID_LOGO]" value="<?php echo $img; ?>">
														<div style="float:left;width:500px;">
															<img src="<?php echo $path ?>"  width="150" height="130" />
														</div>
													<?php } ?>
                                        </div>
                                    </div>
						</div>
						<?php  } ?>
				
					</div>
					
                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Email Address<span class="required">
                                        * </span>
                                </label>
                                 <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('EMAIL', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- (edu@gmail.com )')); ?>
                                </div>
                               
                            </div>
                        </div>

						 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Contact Number<span class="required">
                                        * </span>
                                </label>
                                 <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('CONTACT_NO', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( 9988776655 )')); ?>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       

                       <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Address<span class="required">
                                        * </span>
                                </label>
                               <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('ADDRESS', array('type' => 'textarea','id' => 'textarea',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1','maxlength' => '160' ,'class' => '8', 'rows' => '5' , 'data-error-container' => '#editor2_error')); ?>
                                </div>
                            </div>
                        </div>
						
						    <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Content<span class="required">
                                        * </span>
                                </label>
                               <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('CONTENT', array('type' => 'textarea','id' => 'textarea',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1' ,'class' => '8', 'rows' => '5' , 'data-error-container' => '#editor2_error'));//,'maxlength' => '160' ?>
                                </div>
                            </div>
                        </div>

                    </div>
					
					
					<div class="row">
						<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Photo 1<span class="required">
                                        * </span></label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
                                            <?php echo $this->Form->input('P1', array('type' => 'file', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
<?php echo $this->General->uploadfilenotes(); ?>
                                        </div>
                                    </div>
						</div>
						
						<?php      
						if(isset($this->request->data["FrontAbout"]["PHOTO1"]) && $this->request->data["FrontAbout"]["PHOTO1"]!='') {
						?>
						<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
												  <?php
													if(isset($this->request->data["FrontAbout"]["PHOTO1"]) && $this->request->data["FrontAbout"]["PHOTO1"]!='') {
														$img = $this->request->data["FrontAbout"]["PHOTO1"];
														$path = SITE_URL . 'files/upload_document/'.$img;
														?>
														<div style="float:left;width:500px;">
															<img src="<?php echo $path ?>"  width="150" height="130" />
														</div>
													<?php } ?>
                                        </div>
                                    </div>
						</div>
						<?php  } ?>
				
					</div>
					
					<div class="row">
						<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Photo 2<span class="required">
                                        * </span></label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
                                            <?php echo $this->Form->input('P2', array('type' => 'file', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
<?php echo $this->General->uploadfilenotes(); ?>
                                        </div>
                                    </div>
						</div>
						
						<?php      
						if(isset($this->request->data["FrontAbout"]["PHOTO2"]) && $this->request->data["FrontAbout"]["PHOTO2"]!='') {
						?>
						<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
												  <?php
													if(isset($this->request->data["FrontAbout"]["PHOTO2"]) && $this->request->data["FrontAbout"]["PHOTO2"]!='') {
														$img = $this->request->data["FrontAbout"]["PHOTO2"];
														$path = SITE_URL . 'files/upload_document/'.$img;
														?>
														<div style="float:left;width:500px;">
															<img src="<?php echo $path ?>"  width="150" height="130" />
														</div>
													<?php } ?>
                                        </div>
                                    </div>
						</div>
						<?php  } ?>
				
					</div>
					
					<div class="row">
						<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Photo 3<span class="required">
                                        * </span></label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
                                            <?php echo $this->Form->input('P3', array('type' => 'file', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
<?php echo $this->General->uploadfilenotes(); ?>
                                        </div>
                                    </div>
						</div>
						
						<?php      
						if(isset($this->request->data["FrontAbout"]["PHOTO3"]) && $this->request->data["FrontAbout"]["PHOTO3"]!='') {
						?>
						<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"></label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
												  <?php
													if(isset($this->request->data["FrontAbout"]["PHOTO3"]) && $this->request->data["FrontAbout"]["PHOTO3"]!='') {
														$img = $this->request->data["FrontAbout"]["PHOTO3"];
														$path = SITE_URL . 'files/upload_document/'.$img;
														?>
														<div style="float:left;width:500px;">
															<img src="<?php echo $path ?>"  width="150" height="130" />
														</div>
													<?php } ?>
                                        </div>
                                    </div>
						</div>
						<?php  } ?>
				
					</div>
					
					<div class="row">
					   <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Facebook Link
                                </label>
                                 <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('FACEBOOK_LINK', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                </div>
                               
                            </div>
                        </div>

                       <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Youtube Link
                                </label>
                               <div class="col-md-9 tooltips">
                                   <?php echo $this->Form->input('YOUTUBE_LINK', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="row">
					   <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Twitter Link
                                </label>
                                 <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('TWITTER_LINK', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                </div>
                               
                            </div>
                        </div>

                       <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Google <b>+</b>
                                </label>
                               <div class="col-md-9 tooltips">
							   <?php echo $this->Form->input('GOOGLE_LINK', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                    
                                </div>
                            </div>
                        </div>
					</div>
                    <!--/row-->
                </div>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn bg-blue-chambray">Submit</button>
                                <button type="button" class="btn default" onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Cancel</button>
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