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
                <a href="#">Add New</a>
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
                <span aria-hidden="true" class="icon-user"></span>  Add New Student
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
                    <h3 class="form-section">Profile</h3>
                    
                     <h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Student Personal Information</h4>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">First Name<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                   <?php echo $user["User"]["FIRST_NAME"]; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Middle Name<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                <?php echo $user["User"]["MIDDLE_NAME"]; ?>
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
                                   
                                      <?php echo $user["User"]["LAST_NAME"]; ?>
                                  
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Gender<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                                     data-html='true' data-original-title="Select Gender">
                                     
                                      <?php echo $user["User"]["GENDER"]; ?>
                                   
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
                                     
                               <?php echo $user["User"]["DOB"]; ?>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Birth Place<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    
                                     <?php echo $user["User"]["BIRTH_PLACE"]; ?>
                                    
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
                                     
                                     <?php echo $user["User"]["AGE"]; ?>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Father Name<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                    
                                     <?php echo $user["User"]["FATHER_NAME"]; ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Father Occupation<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Email ID">
                                     
                                      <?php echo $user["User"]["FATHER_OCCUPATION"]; ?>
                                </div>
                            </div>
                        </div>
                        
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Father Mobile No.<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                                      <?php echo $user["User"]["FATHER_MOBILE"]; ?>
                                   
                                </div>
                          
                            </div>
                        </div>
                      </div>
						
						<div class="row">
                                   <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Father Email ID<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                
                                 <?php echo $user["User"]["FATHER_EMAIL"]; ?>
                                   
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Name<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                             
                             <?php echo $user["User"]["MOTHER_NAME"]; ?>
                            
                                </div>
                            </div>
                        </div>
                    </div>


			<div class="row">
            <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Mobile No.<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                
                                  <?php echo $user["User"]["MOTHER_MOBILE"]; ?>
                                    
                                </div>
                            </div>
                        </div>
                       
                       <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Email ID<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                              
                                 <?php echo $user["User"]["MOTHER_EMAIL"]; ?>
                                    
                                </div>
                            </div>
                        </div> 
                       
            
            </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Occupation<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Email ID">
                                    
                          			<?php echo $user["User"]["MOTHER_OCCUPATION"]; ?>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">National Language<span class="required"> * </span>
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                    
                                     <?php echo $user["User"]["NATIONAL_LANGUAGE"]; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Religion<span class="required"> * </span>
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                    
                                      <?php echo $user["User"]["RELIGION"]; ?>
                                   
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Tongue<span class="required"> * </span>
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                   
                                      <?php echo $user["User"]["MOTHER_TONGUE"]; ?>
                                   
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Cast<span class="required"> * </span>
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                    
                                     <?php echo $user["User"]["CAST"]; ?>
                                    
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
                                    
                                     <?php echo $user["User"]["SUB_CAST"]; ?> 
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Cast Category<span class="required">
										* </span></label>
                                <div class="col-md-9">
                                
                               <?php echo $user["CastCategory"]["CAST_CAT_NAME"]; ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Blood Group<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Contact No.">
                                     
                                    <?php echo $user["BloodGroup"]["BLOOD_GROUP_NAME"]; ?>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Class<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    
                                     <?php echo $user["AcademicClass"]["CLASS_NAME"]; ?>
                                       </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Medium<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                                     <?php echo $user["Medium"]["MEDIUM_NAME"]; ?>
                                     
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Email<span class="required"> * </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                   
                                     <?php echo $user["User"]["EMAIL_ID"]; ?> 
                                    
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
                                    
                                     <?php echo $user["User"]["MOBILE_NO"]; ?> 
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Contact No</label>
                               <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                   
                                     <?php echo $user["User"]["CONTACT_NO"]; ?> 
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Country<span class="required"> * </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    
                                      <?php echo $user["Country"]["COUNTRY_NAME"]; ?>
                                    
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">State<span class="required">
										* </span></label>
                                <div class="col-md-9">
                                
                                 <?php echo $user["State"]["STATE_NAME"]; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">City<span class="required">
										* </span></label>
                                <div class="col-md-9">
								
                                
                              <?php echo $user["City"]["CITY_NAME"]; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Pincode<span class="required"> * </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                   
                                      <?php echo $user["User"]["PINCODE"]; ?> 
                                    
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
                                     
                                      <?php echo $user["User"]["ADDRESS"]; ?> 
                                </div>
                            </div>
                        </div>

                    </div>

               
                        <div class="row">
                        
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Marital Status</label>
                                <div class="col-md-9">
                               
                                 <?php echo $user["User"]["MARITAL_STATUS"]; ?> 
                                </div>
                            </div>
                        </div>
                     

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Extra Curiculam Activities</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                
                                     <?php echo $user["User"]["EXTRA_ACTIVITIES"]; ?> 
                                    
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        
                         <div class="form-body">
 <h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Academic History</h4>
 
 					 <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last School Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                   
                                      <?php echo $user["User"]["LAST_SCHOOL_NAME"]; ?> 
                                </div>
                            </div>
                        </div>
                   
                    
                     <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Board</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                                     <?php echo $user["User"]["LAST_BOARD"]; ?> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    
                     <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Medium<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                   
                                      <?php echo $user["Medium"]["MEDIUM_NAME"]; ?>
                                   
                                </div>
                            </div>
                        </div>

                          
 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Class<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    
                                     <?php echo $user["AcademicClass"]["CLASS_NAME"]; ?>
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
                                    
                                     <?php echo $user["User"]["LAST_PERCENTAGE"]; ?> 
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Subject Group</h4>
                   
                   <div class="row">
                   
                   	<div class="form-group">
                    <div class="col-md-6">
                                <label class="control-label col-md-3">Group<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                                     <?php echo $user["Group"]["GROUP_NAME"]; ?> 
                                   
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
                                         <?php $abc=$user["User"]["STATUS"]; 
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


*/