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
                <a href="#">Student</a>
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
                    <!--<h3 class="form-section">Student Info</h3>-->
					
					<!--<h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Student Identity Information</h4>-->
					<h3 class="form-section">Identity Information</h3>
					
					<div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">General Register Number</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                   <?php echo $this->request->data["User"]["GR_NO"]; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">UID Number</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                <?php echo $this->request->data["User"]["UID_NUMBER"]; ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
					
					<div class="row">
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">AADHAR Number</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                   <?php echo $this->request->data["User"]["AADHAR_NUMBER"]; ?>
                                </div>
                            </div>
                        </div>
					</div>
                    
                    <!--<h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Student Personal Information</h4>-->
					<h3 class="form-section">Personal Information</h3>                     
                     
                        <div class="row">
                  
                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Profile Photo</label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
                                            
                                       

                                    <?php
                                    if(isset($this->request->data["User"]["IMAGE_URL"]) && $this->request->data["User"]["IMAGE_URL"]!='') {
                                        $img = $this->request->data["User"]["IMAGE_URL"];
                                        $path = SITE_URL . 'files/upload_document/'.$img;
                                        ?>
                                        <div style="float:left;width:500px;">
                                            <img src="<?php echo $path ?>"  width="100" />
                                        </div>
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
                                <label class="control-label col-md-3">Middle Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                <?php echo $this->request->data["User"]["MIDDLE_NAME"]; ?>
                                    
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
                                <label class="control-label col-md-3">Gender</label>
                                <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                                     data-html='true' data-original-title="Select Gender">
                                      <?php echo $this->request->data["User"]["GENDER"]; ?>
                                   
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Birth Date</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                               <?php echo $this->request->data["User"]["DOB"]; ?>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Birth Place</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <?php echo $this->request->data["User"]["BIRTH_PLACE"]; ?>
                                    
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

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Father Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                     
                                     <?php echo $this->request->data["User"]["FATHER_NAME"]; ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Father Occupation</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Email ID">
                                     
                                      <?php echo $this->request->data["User"]["FATHER_OCCUPATION"]; ?>
                                </div>
                            </div>
                        </div>
                        
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Father Mobile No.</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                      <?php echo $this->request->data["User"]["FATHER_MOBILE"]; ?>
                                   
                                </div>
                          
                            </div>
                        </div>
                      </div>
						
						<div class="row">
                                   <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Father Email ID</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                
                                 <?php echo $this->request->data["User"]["FATHER_EMAIL"]; ?>
                                   
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                
                             <?php echo $this->request->data["User"]["MOTHER_NAME"]; ?>
                            
                                </div>
                            </div>
                        </div>
                    </div>


			<div class="row">
            <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Mobile No.</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                
                                  <?php echo $this->request->data["User"]["MOTHER_MOBILE"]; ?>
                                    
                                </div>
                            </div>
                        </div>
                       
                       <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Email ID</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                
                                 <?php echo $this->request->data["User"]["MOTHER_EMAIL"]; ?>
                                    
                                </div>
                            </div>
                        </div> 
                       
            
            </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Occupation</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Email ID">
                          <?php echo $this->request->data["User"]["MOTHER_OCCUPATION"]; ?>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">National Language
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                     <?php echo $this->request->data["User"]["NATIONAL_LANGUAGE"]; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Religion
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                     
                                      <?php echo $this->request->data["User"]["RELIGION"]; ?>
                                   
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
                                     
                                      <?php echo $this->request->data["User"]["MOTHER_TONGUE"]; ?>
                                   
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Cast
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                     
                                     <?php echo $this->request->data["User"]["CAST"]; ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Sub Cast
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                     <?php echo $this->request->data["User"]["SUB_CAST"]; ?> 
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Cast Category</label>
                                <div class="col-md-9">
                                
                               <?php echo $this->request->data["CastCategory"]["CAST_CAT_NAME"]; ?>
                                    
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
                                     
                                    <?php echo $this->request->data["BloodGroup"]["BLOOD_GROUP_NAME"]; ?>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Class</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                                     <?php echo $this->request->data["AcademicClass"]["CLASS_NAME"]; ?>
                                       </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Medium</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <?php echo $this->request->data["Medium"]["MEDIUM_NAME"]; ?>
                                     
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Email</label>
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
                                <label class="control-label col-md-3">Mobile No.</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <?php echo $this->request->data["User"]["MOBILE_NO"]; ?> 
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
                                <label class="control-label col-md-3">Country</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                                      <?php echo $this->request->data["Country"]["COUNTRY_NAME"]; ?>
                                    
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">State</label>
                                <div class="col-md-9">
                                 <?php echo $this->request->data["State"]["STATE_NAME"]; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">City</label>
                                <div class="col-md-9">
                              <?php echo $this->request->data["City"]["CITY_NAME"]; ?>
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
                                <label class="control-label col-md-3">Address</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                                      <?php echo $this->request->data["User"]["ADDRESS"]; ?> 
                                </div>
                            </div>
                        </div>

                    </div>

               
                        <div class="row">
                        
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Marital Status</label>
                                <div class="col-md-9">
                                
                                 <?php echo $this->request->data["User"]["MARITAL_STATUS"]; ?> 
                                </div>
                            </div>
                        </div>
                     

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Extra Curiculam Activities</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <?php echo $this->request->data["User"]["EXTRA_ACTIVITIES"]; ?> 
                                    
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        
                        <div class="form-body">
						<!--<h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Academic History</h4>-->
						<h3 class="form-section">Academic History</h3>
 
 					 <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last School Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                                      <?php echo $this->request->data["User"]["LAST_SCHOOL_NAME"]; ?> 
                                </div>
                            </div>
                        </div>
                   
                    
                     <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Board</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                                     <?php echo $this->request->data["User"]["LAST_BOARD"]; ?> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    
                     <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Medium</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                                      <?php echo $this->request->data["Medium"]["MEDIUM_NAME"]; ?>
                                   
                                </div>
                            </div>
                        </div>

                          
 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Class</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    
                                     <?php echo $this->request->data["AcademicClass"]["CLASS_NAME"]; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    
                    
                    <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Percentage of Marks / Grade </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <?php echo $this->request->data["User"]["LAST_PERCENTAGE"]; ?> 
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!--<h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Transport</h4>-->
					<h3 class="form-section">Transportation Details</h3>
					 <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Route</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $user_route['Route']['ROUTE_NAME']; ?>

                                </div>
                            </div>
                        </div>
                    

                      
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Stoppage</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $user_route['Stoppage']['STOPPAGE_NAME']; ?>

                                </div>
                            </div>
                        </div>
                    </div>

                     <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Vehicle</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $user_route['Vehicle']['VEHICLE_NUMBER']; ?>

                                </div>
                            </div>
                        </div>
                    

                    
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Route Fee</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $user_route['UserFee']['ROUTE_FEE_AMOUNT']; ?>

                                </div>
                            </div>
                        </div>
                    </div>
					
                    <!--<h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Subject Group</h4>-->
					<h3 class="form-section">Subject Group Details</h3>
                    <div class="row">
						 <div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Group</label>
									<div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
										 data-html='true' data-original-title="Mobile No.">
										
										 <?php echo $this->request->data["Group"]["GROUP_NAME"]; ?> 
									</div>
								</div>
						 </div>
					</div>
                    
                      <!----<h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Document</h4>
                    
                     <div class="row">
                     	 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Document</label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
                                           
                                       
                                   <?php
                                    if(isset($this->request->data["User"]["DOCUMENT"]) && $this->request->data["User"]["DOCUMENT"]!='') {
										?>
									
									<a href="<?php echo DOWNLOADURL.UPLOAD_STUDENT_DOCUMENT.'/'.$this->request->data['User']['DOCUMENT'];?>"><?php echo $this->request->data['User']['DOCUMENT']; ?></a>
															
                                    <?php 
									}else{ 
									
									}
									?>
                              </div>
                          </div>


                       </div>
                     
                   </div>---->
                    
                    <!--<h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Status</h4>-->
					<h3 class="form-section">Status</h3>
                    
                    <div class="row">
       
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Status</label>
                                    <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                                         data-html='true' data-original-title="Status">
                                         <?php $abc=$this->request->data["User"]["STATUS"]; 
										 if($abc == 1)
										 {
											echo 'Active'; 
										 }else{
											echo 'Inactive' ;
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