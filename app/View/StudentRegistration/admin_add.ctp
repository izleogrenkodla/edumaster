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
            <?php echo $this->Form->create('StudentRegistration', array('class' => 'form-horizontal add', 'id' => 'Form',
            'type' => 'file')); ?>
            
             <?php echo $this->Form->input("FORM_NO", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
                <div class="form-body">
                    <h3 class="form-section">Student Info</h3>
                    
                     <h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Student Personal Information</h4>

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
                                            <input type="radio" name="data[StudentRegistration][GENDER]" value="Male" checked/>
                                            Male </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[StudentRegistration][GENDER]" value="Female" />
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
                                <label class="control-label col-md-3">Father Name<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                    <?php echo $this->Form->input('FATHER_NAME', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Jayanti Bhai)')); ?>
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
                                    <?php echo $this->Form->input('FATHER_OCCUPATION', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Engineer )')); ?>
                                </div>
                            </div>
                        </div>
                        
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Father Mobile No.<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('FATHER_MOBILE', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( 9876543210 )')); ?>
                                </div>
                          
                            </div>
                        </div>
                      </div>
						
						<div class="row">
                                   <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Father Email ID</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->Form->input('FATHER_EMAIL', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( demo@example.com )')); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->Form->input('MOTHER_NAME', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Sangeeta Ben )')); ?>
                                </div>
                            </div>
                        </div>
                    </div>


			<div class="row">
            <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Mobile No</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->Form->input('MOTHER_MOBILE', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( 1234567890 )')); ?>
                                </div>
                            </div>
                        </div>
                       
                       <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Email ID</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->Form->input('MOTHER_EMAIL', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( demo@example.com )')); ?>
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
                                    <?php echo $this->Form->input('MOTHER_OCCUPATION', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Housewife )')); ?>
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
                                    <?php echo $this->Form->input('NATIONAL_LANGUAGE', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Hindi )')); ?>
                                </div>
                            </div>
                        </div>

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
                                <label class="control-label col-md-3">Class<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php
                                    echo $this->Form->input('ADM_CLASS_ID', array('options' => $classes, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
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
                                    <?php
                                    echo $this->Form->input('ADM_MEDIUM_ID', array('options' => $medium, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
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
                                <label class="control-label col-md-3">Contact No</label>
                               <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('CONTACT_NO', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( 0261-7755668 )')); ?>
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
                                    <?php
                                    echo $this->Form->input('COUNTRY_ID', array('options' => $country, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
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
                                <label class="control-label col-md-3">UID NUMBER</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('UID_NUMBER', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','onchange'=>'selectuid(this)', 'placeholder' => 'Example :- ( 123456789120 )')); ?>
                                </div>
                            </div>
                        </div>

                        <div id = 'test'>

                        </div>

                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Aadhaar number</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('AADHAR_NUMBER', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','onchange'=>'selectaddh(this)', 'placeholder' => 'Example :- ( 123456789120 )')); ?>
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
                                <label class="control-label col-md-3">Extra Curiculam Activities</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('EXTRA_ACTIVITIES', array('type' => 'textarea',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
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
                                <label class="control-label col-md-3">Last School Name <span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('LAST_SCHOOL_NAME', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Delhi Public High School )')); ?>
                                </div>
                            </div>
                        </div>
                   
                    
                     <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Board <span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('LAST_BOARD', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Gujarat High Secondary Board )')); ?>
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
                                    <?php
                                    echo $this->Form->input('LAST_MEDIUM_ID', array('options' => $medium, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>

                          
 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Class<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php
                                    echo $this->Form->input('LAST_CLASS_ID', array('options' => $classes, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
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
                                    <?php echo $this->Form->input('LAST_PERCENTAGE', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( 90 )')); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Description</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('ACD_HISTORY_DESCRIPTION', array('type' => 'textarea',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Subject Group</h4>
                   
                   <div class="row">
                   
                   	<div class="form-group">
                    <div class="col-md-6">
                                <label class="control-label col-md-3">Select Group<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php
                                    echo $this->Form->input('GROUP', array('options' => '', 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        
                        
                         <div class="col-md-6">
                            <div class="form-group" id="wrapper_user" >
                                <label class="control-label col-md-3">Subject</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <div id="users_list" style="height:150px;overflow:scroll;"></div>
                                </div>
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
                                                <input type="radio" name="data[StudentRegistration][STATUS]" value="1" checked/>
                                                Active </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="data[StudentRegistration][STATUS]" value="0" />
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

<script>

        $(document).ready(function(){
            $("#StudentRegistrationADMCLASSID").bind("change",
            function(event){
                $.ajax({
					
                    async: true,
                    beforeSend: function(XMLHttpRequest){
                        // $('#UserAMOUNT').attr('readonly',true);
                    },
                    complete: function(XMLHttpRequest,
                    textStatus){
                        // $('#UserAMOUNT').attr('readonly', true);
                    },
					
                    data: $("#StudentRegistrationADMCLASSID").closest("form").serialize(),
                    dataType: "html",
                    success: function(data,
                    textStatus){
                        $("#StudentRegistrationGROUP").html(data);
                    },
                    type: "post",
                    url: REQUEST_URL+"StudentRegistration/GetGroupByClass"
                });
                return false;
            });
        });
</script>


<script>
function checkall(obj) {

	$("#users_list").find("input[type=checkbox]").each(function(){
		$(this).prop('checked',obj.checked);
	});	
}

$(document).ready(function(){
	if($("#StudentRegistrationGROUP").val()>0) { 
		subject();
	}
	
	$("#StudentRegistrationGROUP").change(function(){
		subject();
	});	
	
	$("#Form").submit(function(){
		var tmp = [];
		$("input[type=checkbox]:checked").each(function(){
			tmp[tmp.length] = $(this).val();
		});
		
		$("#StudentRegistrationSelectedFields").val(tmp.join(","));
		//return false;
	});
	
});

function subject() { 

		
		$.ajax({    async: true,
                    beforeSend: function(XMLHttpRequest){
                        $('#wrapper_user').hide();
						
						$("#checkall").find("input[type=checkbox]").each(function(){
							$(this).prop('checked',false);
						});
						
						$("#checkall").hide();
							
                    },
                    complete: function(XMLHttpRequest,textStatus){ 
                        // $('#UserAMOUNT').attr('readonly', true);
                    },
                    data:$("#Form").serialize(),
                    dataType: "html",
                    success: function(data,textStatus){
                        $('#wrapper_user').show();
						var tmp = jQuery.parseJSON(data);
						if(tmp.status=='success') { 
							$("#checkall").show();
							$("#users_list").html(tmp.lists);
							
							if($("#StudentRegistrationSelectedFields").val() !='') {
								var jtmp = [];
								jtmp =  $("#StudentRegistrationSelectedFields").val().split(",");
								for(i in jtmp) {
									var tmpk = jtmp[i];
									if(tmpk=='on') { 
										$("#checkall").find("input[type=checkbox]").prop('selected',true);
									}else{
										$("#users_list").find("input[type=checkbox]").each(function(){
											if($(this).val()==tmpk) {
												$(this).prop('checked',true);
											}
										});
									}
								}
							}
							
						}else{
							$("#users_list").html('No User Found.');
						}
						return false;
						
                    },
                    type: "post",
                    url: REQUEST_URL+"StudentRegistration/getsubject"
                });
                return false;
		
	
	
}
</script>
<script>

function selectuid(data){
            var vid = $(data).val();
            //alert (vid);
            
            if(vid==0){
                //$("#test").remove();
                //alert('Please select  By');
            }else{
            var vid = $(data).val();
            var data = 'id='+ vid;
            // alert(data);
            $.ajax({
            data:data,
            url:REQUEST_URL+"StudentRegistration/chkuid",
            type:"POST",
            cache:false,
                // multiple data sent using ajax
            success: function (html) {

          var href =html;
         //href = href.substring(1);
          $('#test').html(href);
        }
        
      });
        }
    }
    
</script>

<script>

function selectaddh(data){
            var vid = $(data).val();
            //alert (vid);
            
            if(vid==0){
                //$("#test").remove();
                //alert('Please select  By');
            }else{
            var vid = $(data).val();
            var data = 'id='+ vid;
            //alert(data);
            $.ajax({
            data:data,
            url:REQUEST_URL+"StudentRegistration/addh",
            type:"POST",
            cache:false,
                // multiple data sent using ajax
            success: function (html) {

          var href =html;
         //href = href.substring(1);
          $('#test').html(href);
        }
        
      });
        }
    }
    
</script>