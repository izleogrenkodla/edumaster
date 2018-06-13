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
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">HR</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Profile</a>
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
                <span aria-hidden="true" class="icon-user"></span> Profile
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('User', array('class' => 'form-horizontal add', 'id' => 'Form',
            'type' => 'file')); ?>
            <?php echo $this->Form->input("ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
                <div class="form-body">
                    <!--<h3 class="form-section">Profile</h3>-->


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label col-md-3">Profile Photo</label>
                            <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                 data-html='true' data-original-title="Upload Profile Photo">
                                <?php
                                if(isset($this->request->data["User"]["IMAGE_URL"]) && $this->request->data["User"]["IMAGE_URL"] !='') {
                                    $img = $this->request->data["User"]["IMAGE_URL"];
                                    $path = SITE_URL . 'files/upload_document/'.$img;
                                    ?>

                                    <img src="<?php echo $path ?>"  width="100" />

                                <?php } ?>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">First Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                    <?php echo $this->request->data["User"]["FIRST_NAME"]; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Employee No</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data["User"]["ID"]; ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Middle Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->request->data["User"]["MIDDLE_NAME"]; ?>
                                </div>
                            </div>
                        </div>
                        
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Class Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->request->data["AcademicClass"]["CLASS_NAME"]; ?>
                                </div>
                            </div>
                        </div>-->
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Joining Date</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                        <?php echo $this->request->data["User"]["JOINING_DATE"]; ?>								  
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Last Name">
                                    <?php echo $this->request->data["User"]["LAST_NAME"]; ?>
                                </div>
                            </div>
                        </div>

						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Qualification</label>
                                <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                                     data-html='true' data-original-title="Select Gender">
                                    <div class="radio-list">
                                        <?php echo $this->request->data["User"]["QUALIFICATION"]; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
						
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Gender</label>
                                <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                                     data-html='true' data-original-title="Select Gender">
                                    <div class="radio-list">
                                        <?php echo $this->request->data["User"]["GENDER"]; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Medium</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                        <?php echo $this->request->data["Medium"]["MEDIUM_NAME"]; ?>								    
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Date Of Birth</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                        <?php echo $this->request->data["User"]["DOB"]; ?>								  
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Email Address</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                         <?php echo $this->request->data["User"]["EMAIL_ID"]; ?>								 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        
			<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Age</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data["User"]["AGE"]; ?>
                                </div>
                            </div>
                        </div>
                        
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Subject</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                         <?php echo $this->request->data["Subject"]["TITLE"]; ?>								 
                                </div>
                            </div>
                        </div>-->
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mobile No</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data["User"]["MOBILE_NO"]; ?>
                                </div>
                            </div>
                        </div>

                        
                    </div>

                    <div class="row">
                        <div class="col-md-6">
							<div class="form-group">
                                <label class="control-label col-md-3">Marital Status</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                         <?php echo $this->request->data["User"]["MARITAL_STATUS"]; ?>								 
                                </div>
                            </div>                            
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Contact No</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data["User"]["CONTACT_NO"]; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Address</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data["User"]["ADDRESS"]; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Pincode</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data["User"]["PINCODE"]; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">City Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data["City"]["CITY_NAME"]; ?>
                                </div>
                            </div>
                        </div>                        
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">State Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data["State"]["STATE_NAME"]; ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <!--<div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">State Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data["State"]["STATE_NAME"]; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Address</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data["User"]["ADDRESS"]; ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>-->

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Country Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data["Country"]["COUNTRY_NAME"]; ?>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="button" class="btn default"  onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Go Back</button>
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