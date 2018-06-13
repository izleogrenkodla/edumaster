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
                <a href="#">Staff</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add New Staff</a>
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
                <span aria-hidden="true" class="icon-user"></span>  Add New 
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('StaffRegistration', array('class' => 'form-horizontal add', 'id' => 'Form','type' => 'file')); ?>
            <?php echo $this->Form->input("ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
                <div class="form-body">
                    
                     <h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Personal Information</h4>
                     
                       <div class="row">
                       
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Profile Photo<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                  	 <?php
                                if(isset($this->request->data["StaffRegistration"]["IMAGE_URL"]) && $this->request->data["StaffRegistration"]["IMAGE_URL"] !='') {
                                    $img = $this->request->data["StaffRegistration"]["IMAGE_URL"];
                                    $path = SITE_URL . 'files/upload_document/'.$img;
								   /*$path = SITE_URL . 'files/upload_document/144057757911.jpg';*/
                                    ?>

                                    <img src="<?php echo $path ?>"  width="100" />

                                <?php } ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Role<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                   <?php echo $this->request->data['Role']['ROLE_NAME']  ?>
                                </div>
                            </div>
                        </div>
                       
                       </div>
                     

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">First Name<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                    <?php echo $this->request->data['StaffRegistration']['FIRST_NAME']  ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Middle Name<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->request->data['StaffRegistration']['MIDDLE_NAME']  ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Name<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Last Name">
                                    <?php echo $this->request->data['StaffRegistration']['LAST_NAME']  ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Gender<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                                     data-html='true' data-original-title="Select Gender">
                                    <?php echo $this->request->data['StaffRegistration']['GENDER']  ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Birth Date<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data['StaffRegistration']['DOB']  ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Birth Place</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
										<?php echo $this->request->data['StaffRegistration']['BIRTH_PLACE']  ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Age <span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data['StaffRegistration']['AGE']  ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Emergency Contact Person<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
										<?php echo $this->request->data['StaffRegistration']['EMG_CON_PER']  ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                     
                        
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Emergency Contact Number<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data['StaffRegistration']['EMG_CONTACT']  ?>
                                </div>
                          
                            </div>
                        </div>
                        
                          <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Emergency Email ID</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                   <?php echo $this->request->data['StaffRegistration']['EMG_EMAIL_ID']  ?>
                                </div>
                            </div>
                        </div>
                        
                      </div>
		
                    <div class="row">
                       

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Religion<span class="required"> * </span>
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                    <?php echo $this->request->data['StaffRegistration']['RELIGION']  ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Tongue
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                     <?php echo $this->request->data['StaffRegistration']['MOTHER_TONGUE']  ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Cast<span class="required"> * </span>
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                    <?php echo $this->request->data['StaffRegistration']['CAST']  ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Sub Cast<span class="required"> * </span>
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                    <?php echo $this->request->data['StaffRegistration']['SUB_CAST']  ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Cast Category<span class="required">
										* </span></label>
                                <div class="col-md-9">
                                    <?php echo $this->request->data['CastCategory']['CAST_CAT_NAME']  ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Blood Group</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Contact No.">
                                   <?php echo $this->request->data['BloodGroup']['BLOOD_GROUP_NAME']  ?>
                                </div>
                            </div>
                        </div>

                        
                  
                      

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Email<span class="required"> * </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data['StaffRegistration']['EMAIL_ID']  ?>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mobile No.<span class="required"> * </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
									 <?php echo $this->request->data['StaffRegistration']['MOBILE_NO']  ?>
      
                                </div>
                            </div>
                        </div>

						  <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">State</label>
                                <div class="col-md-9">
								<?php echo $this->request->data['State']['STATE_NAME']  ?>
                                    
                                </div>
                            </div>
                        </div>
                       
                    </div>

                   
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">City</label>
                                <div class="col-md-9">
								<?php echo $this->request->data['City']['CITY_NAME']  ?>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Pincode<span class="required"> * </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
									 
									 <?php echo $this->request->data['StaffRegistration']['PINCODE']  ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Address<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
									 <?php echo $this->request->data['StaffRegistration']['ADDRESS']  ?>
                                </div>
                            </div>
                        </div>

                    </div>

               
                        <div class="row">
                        
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Marital Status</label>
                                <div class="col-md-9">
                                 <?php echo $this->request->data['StaffRegistration']['MARITAL_STATUS']  ?>
                                  
                                </div>
                            </div>
                        </div>
                     
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Joining Date<span class="required"> * </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
							         <?php echo $this->request->data['StaffRegistration']['JOINING_DATE']  ?>
                                    
                                </div>
                            </div>
                        </div>

                     
                        </div>
                        
                        <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Base Salary<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
									 
									 <?php echo $this->request->data['StaffRegistration']['BASE_SALARY']  ?>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Experience<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
								<?php echo $this->request->data['StaffRegistration']['EXPERIENCE']  ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                    
                         
                     <h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Status</h4>
                    
                    <div class="row">
       
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Status</label>
                                    <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                                         data-html='true' data-original-title="Status">
                                        <?php if($this->request->data['StaffRegistration']['STATUS'] == 1)
										{
											echo 'Active';
										}else{
											echo 'Inactive';
										}	
										?>
                                    </div>
                                </div>
                        </div>
                    </div>

                </div>
                
                
                

                    <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn bg-blue-chambray">Submit</button>
                                <button type="button" class="btn default"  onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Cancel</button>
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
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
