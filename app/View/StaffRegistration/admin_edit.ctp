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
                <a href="#">Edit Staff</a>
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
                <span aria-hidden="true" class="icon-user"></span>  Edit
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('StaffRegistration', array('class' => 'form-horizontal add', 'id' => 'Form','type' => 'file')); ?>
            
                <div class="form-body">
                    
                     <h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Personal Information</h4>
                     
                       <div class="row">
                       
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Profile Photo<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                     
                                      <?php echo $this->Form->input('UPLOAD_IMAGE', array('type' => 'file', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                        <?php echo $this->General->uploadfilenotes(); ?>

                       
                                   <?php
                                if(isset($this->request->data["StaffRegistration"]["IMAGE_URL"]) && $this->request->data["StaffRegistration"]["IMAGE_URL"] !='') {


                                    $img = $this->request->data["StaffRegistration"]["IMAGE_URL"];
                                    $path = SITE_URL . 'files/upload_document/'.$img;
                                  // $path = SITE_URL . 'files/upload_document/144057757911.jpg';
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
                                   <?php
                                    echo $this->Form->input('ROLE_ID', array('options' => $user_roles, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
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
                                    <?php echo $this->Form->input('FIRST_NAME', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Bhavik )')); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Middle Name<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->Form->input('MIDDLE_NAME', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( JayantiBhai )')); ?>
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
                                    <?php echo $this->Form->input('LAST_NAME', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( Panchal )')); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Gender<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                                     data-html='true' data-original-title="Select Gender">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="data[StaffRegistration][GENDER]" value="Male" checked/>
                                            Male </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[StaffRegistration][GENDER]" value="Female" />
                                            Female </label>
                                    </div>
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
                                    <?php echo $this->Form->input('DOB', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control date-picker', 'placeholder' => 'Example :- ( 1/12/1989 )')); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Birth Place</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('BIRTH_PLACE', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Vadodara )')); ?>
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
                                    <?php echo $this->Form->input('AGE', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( 25 )')); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Emergency Contact Person<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('EMG_CON_PER', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Mukeshbhai )')); ?>
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
                                    <?php echo $this->Form->input('EMG_CONTACT', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( 9876543210 )')); ?>
                                </div>
                          
                            </div>
                        </div>
                        
                          <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Emergency Email ID</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->Form->input('EMG_EMAIL_ID', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( demo@example.com )')); ?>
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
                                    <?php echo $this->Form->input('RELIGION', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Hindu )')); ?>
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
                                    <?php echo $this->Form->input('MOTHER_TONGUE', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Gujarati )')); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Cast<span class="required"> * </span>
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                    <?php echo $this->Form->input('CAST', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Hindu )')); ?>
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
                                    <?php echo $this->Form->input('SUB_CAST', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Luhar )')); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Cast Category<span class="required">
										* </span></label>
                                <div class="col-md-9">
                                    <?php
                                    echo $this->Form->input('CAST_CAT_ID', array('options' => $CastCategories, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
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
                                    <?php
                                    echo $this->Form->input('BLOOD_GROUP_ID', array('options' => $bloodgroups, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE, 'placeholder' => 'Example :- ( O+ )', 
                                        'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>

                        
                  
                      

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Email<span class="required"> * </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('EMAIL_ID', array('type' => 'email',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( xyz@gmail.com )')); ?>
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
                                    <?php echo $this->Form->input('MOBILE_NO', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( 9876543210 )')); ?>
                                </div>
                            </div>
                        </div>

						  <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">State</label>
                                <div class="col-md-9">
                                    <?php
                                    echo $this->Form->input('STATE_ID', array('options' => $state, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>
                       
                    </div>

                   
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">City</label>
                                <div class="col-md-9">
                                    <?php
                                    echo $this->Form->input('CITY_ID', array('options' => $cities, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Pincode<span class="required"> * </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('PINCODE', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( 390010 )')); ?>
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
                                    <?php echo $this->Form->input('ADDRESS', array('type' => 'textarea',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                        </div>

                    </div>

               
                        <div class="row">
                        
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Marital Status</label>
                                <div class="col-md-9">
                                  <?php

                                    $marital_status = array(
                                        'Single' => 'Single',
                                        'Married' => 'Married',
                                        'Separated' => 'Separated',
                                        'Divorced' => 'Divorced',
                                        'Widowed' => 'Widowed',
                                    );
                                    echo $this->Form->input('MARITAL_STATUS', array('options' => $marital_status, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>
                     
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Joining Date<span class="required"> * </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('JOINING_DATE', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control date-picker', 'placeholder' => 'Example :- ( 1/12/1989 )')); ?>
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
                                    <?php echo $this->Form->input('BASE_SALARY', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Bhavik )')); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Experience<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->Form->input('EXPERIENCE', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( JayantiBhai )')); ?>
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
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                                <input type="radio" name="data[StaffRegistration][STATUS]" value="1" checked/>
                                                Active </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="data[StaffRegistration][STATUS]" value="0" />
                                                Inactive </label>
                                        </div>
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



