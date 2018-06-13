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
            'enctype'=>'multipart/form-data')); ?>
            
            <?php echo $this->Form->input("ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
            
            
                <div class="form-body">
                    <h3 class="form-section">Student Info</h3>
                    
                     <h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Student Personal Information</h4>
                     
                     <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">General Registrar Number<span class="required">
										* </span></label>
                                        
                                        
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                    <?php echo $this->Form->input('GR_NO', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','onchange'=>'selectgr(this)', 'placeholder' => 'Example :- ( Bhavik )')); ?>
                                        
                                  <?php //if(sizeof($msg)>0){ PR($msg);} ?>      
                                </div>
                            </div>
                        </div>
                        
                        <div id = 'test'>
                        
                        </div>
                        
                    </div>


                    
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
                                        <label class="control-label col-md-3">Profile Photo</label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
                                            <?php echo $this->Form->input('UPLOAD_IMAGE', array('type' => 'file', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
<?php echo $this->General->uploadfilenotes(); ?>
                                        </div>
                                    </div>

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
                                            <input type="radio" name="data[User][GENDER]" value="Male" <?php echo $this->request->data['User']['GENDER'] == 'Male' ? "checked" : ""; ?>/>
                                            Male </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[User][GENDER]" value="Female" <?php echo $this->request->data['User']['GENDER'] == 'Female' ? "checked" : ""; ?>/>
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
                                <label class="control-label col-md-3">Birth Place<span class="required">
										* </span></label>
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
                                <label class="control-label col-md-3">Age</label>
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
                                <label class="control-label col-md-3">Father Occupation<span class="required">
										* </span></label>
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
                                <label class="control-label col-md-3">Father Email ID<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->Form->input('FATHER_EMAIL', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Sangeeta Ben )')); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Name<span class="required">
										* </span></label>
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
                                <label class="control-label col-md-3">Mother Mobile No.<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->Form->input('MOTHER_MOBILE', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Sangeeta Ben )')); ?>
                                </div>
                            </div>
                        </div>
                       
                       <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Email ID<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->Form->input('MOTHER_EMAIL', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Sangeeta Ben )')); ?>
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
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Indian )')); ?>
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
                                <label class="control-label col-md-3">Mother Tongue<span class="required"> * </span>
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
                                <label class="control-label col-md-3">Blood Group<span class="required">
										* </span></label>
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
                                    echo $this->Form->input('CLASS_ID', array('options' => $classes, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
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
                                    echo $this->Form->input('MEDIUM_ID', array('options' => $medium, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
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
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( xyz11@gmail.com )')); ?>
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
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( 9876543210 )')); ?>
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
                                    <?php
                                    echo $this->Form->input('COUNTRY_ID', array('options' => $country, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">State<span class="required">
										* </span></label>
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
                                <label class="control-label col-md-3">City<span class="required">
										* </span></label>
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
                                <label class="control-label col-md-3">Last School Name</label>
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
                                <label class="control-label col-md-3">Last Board</label>
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
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Gujarat High Secondary Board )')); ?>
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
                    <div style="height:auto;">
                     <div class="form-body">
 <h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Transport</h4>
 
 
  <div class="row">
						
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Transport Route</label>
                                <div class="col-md-9">
                                    <?php
									if(isset($user_route['Route']['ROUTE_ID'])){
											$route = $user_route['Route']['ROUTE_ID'];
									}else{
										$route = '';
									}
                                    echo $this->Form->input('ROUTE_ID', array('options' => $transport, 'default' =>$route , 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                       'onchange' => 'select(this)', 'id'=>'route' ,'div' => FALSE_VALUE));
									
                                    ?>
                                </div>
                            </div>
                        </div>
						
						 <div id="test">
                            <div class="col-md-6">

                            <div class="form-group">
                                <label class="control-label col-md-3">Select Stoppage</label>
                                <div class="col-md-9">
                                    <?php
                                      
                                    if(isset($user_route['Stoppage']['STOPPAGE_ID'])){
                                            $stop =$user_route['Stoppage']['STOPPAGE_ID'];

                                    }else{
                                        $stop = '';
                                    }
                                    echo $this->Form->input('STOPPAGE_ID', array('options' => $stoppage, 'default' => $stop, 'class' => 'form-control select2me', 'label' => FALSE_VALUE, 'id'=>'stoppage' ,'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div><?php
								 //echo $user_route['VehicleShift']['SHIFT_ID'];
							//PR($user_route);?>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Vehicle</label>
                                <div class="col-md-9">
                                    <?php
                                     
                                    if(isset($user_route['Vehicle']['ID'])){
                                            $v =$user_route['Vehicle']['ID'];

                                    }else{
                                        $v = '';
                                    }?>
                                    <?php
                                    echo $this->Form->input('VEHICLE_ID', array('options' => $vehicle, 'default' => $v, 'class' => 'form-control select2me', 'label' => FALSE_VALUE, 'id'=>'vehicle' ,'div' => FALSE_VALUE, 'onchange'=>'fn_shift(this)'));
                                    ?>
                                </div>
                            </div>
                        </div>
						
						<div class="col-md-6" id="shift1">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Shift</label>
                                <div class="col-md-9">
								<?php
                                     
                                    if(isset($user_route['VehicleShift']['SHIFT_ID'])){
                                            $s =$user_route['VehicleShift']['SHIFT_ID'];

                                    }else{
                                        $s = '';
                                    }?>
                                    <?php
                                    echo $this->Form->input('SHIFT_ID', array('options' => $shift, 'default' =>  $s , 'class' => 'form-control select2me', 'label' => FALSE_VALUE, 'id'=>'shift' ,'div' => FALSE_VALUE, 'onchange'=>'getSeats()'));
                                    ?>
                                </div>
                            </div>
                        </div>
						
						<div class="col-md-6" id="amount">
                          <div class="form-group">
                                <label class="control-label col-md-3">Route Fee Amount<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
									 	<?php
                                     
                                    if(isset($user_route['UserFee']['ROUTE_FEE_AMOUNT'])){
                                            $a =$user_route['UserFee']['ROUTE_FEE_AMOUNT'];

                                    }else{
                                        $a = '';
                                    }?>
                                    <?php echo $this->Form->input('ROUTE_FEE_AMOUNT', array('type' => 'text',
                                        'label' => FALSE_VALUE,
										'value' => $a, 
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                        </div>
				
					  
					  
                    </div>
				<div>	
                      <div id="test1"></div> 
						<div id="seats"></div>
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
                                    echo $this->Form->input('GROUP', array('options' => $group, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        
                        
                         <div class="col-md-6">
                            <div class="form-group" id="wrapper_user" >
                                <label class="control-label col-md-3">Subject<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <div id="users_list" style="height:150px;overflow:scroll;"></div>
                                </div>
                            </div>
                        </div>

                        </div>
					</div>
                    
                     <!---<h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Document</h4>
                    
                     <div class="row">
                     	 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Document</label>
                                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                             data-html='true' data-original-title="Upload Profile Photo">
                                            <?php echo $this->Form->input('DOCUMENT', array('type' => 'file', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>

                                        </div>
                                    </div>

                                   <?php
                                    if(isset($this->request->data["User"]["DOCUMENT"]) && $this->request->data["User"]["DOCUMENT"]!='') {
										?>
									<div align="center">
									<a href="<?php echo DOWNLOADURL.UPLOAD_STUDENT_DOCUMENT.'/'.$this->request->data['User']['DOCUMENT'];?>"><?php echo $this->request->data['User']['DOCUMENT']; ?></a>
									</div>							
                                    <?php 
									}else{ 
									
									}
									?>
                             

                                </div>
                     
                     </div>---->
                    
                     <h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Status</h4>
                    
                    <div class="row">
       
                          <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Status</label>
                                <div class="col-md-9">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="data[User][STATUS]" value="1" <?php echo $this->request->data['User']['STATUS'] == 1 ? "checked" : ""; ?> />
                                            Active </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[User][STATUS]" value="0" <?php echo $this->request->data['User']['STATUS'] == 0 ? "checked" : ""; ?> />
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
<!-- END PAGE CONTENT-->
</div>
</div>

<script>

        $(document).ready(function(){
            $("#UserCLASSID").bind("change",
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
					
                    data: $("#UserCLASSID").closest("form").serialize(),
                    dataType: "html",
                    success: function(data,
                    textStatus){
                        $("#UserGROUP").html(data);
                    },
                    type: "post",
                    url: REQUEST_URL+"Users/GetGroupByClass"
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
	
	if($("#UserGROUP").val()>0) { 
		subject();
	}
	
	$("#UserGROUP").change(function(){
		subject();
	});	
	
	$("#Form").submit(function(){
		var tmp = [];
		$("input[type=checkbox]:checked").each(function(){
			tmp[tmp.length] = $(this).val();
		});
		
		$("#UserSelectedFields").val(tmp.join(","));
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
							
							if($("#UserSelectedFields").val() !='') {
								var jtmp = [];
								jtmp =  $("#UserSelectedFields").val().split(",");
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
                    url: REQUEST_URL+"Users/getsubject"
                });
                return false;
		
	
	
}
</script>

<script>


		function select(data){
			var vid = $(data).val();
			if(vid==0){
			
			
			$("#sshift").remove();
			$("#rrseat").remove();
			$("#nrseat").remove();
			
			var data = 'id='+ vid;
			$.ajax({
			data:data,
			url:REQUEST_URL+"Users/route",
			type:"POST",
			cache:false,
			    // multiple data sent using ajax
			success: function (html) {

          var href =html;
         //href = href.substring(1);
          $('#test').html(href);
        }
		
      });
	  return false;
			}
			else{
			
			
			var data = 'id='+ vid;
			$.ajax({
			data:data,
			type:"POST",
			cache:false,
			url:REQUEST_URL+"Users/route",    // multiple data sent using ajax
			success: function (html) {

           var href =html;
         //href = href.substring(1);
          $('#test').html(href);
        }
		
      });
	  return false;
}
	
	
		}
		
			function fn_shift(data){
			
			var vid = $(data).val();
			
			
			if(vid==0){	
			$("#rrseat").remove();
			$("#nrseat").remove();
			$("#shift1").remove();
			$("#amount").remove();
			
			}else{
			$("#rrseat").remove();
			$("#nrseat").remove();
			$("#shift1").remove();
			$("#amount").remove();
			var data = 'id='+ vid;
			$.ajax({
			data:data,
			type:"POST",
			cache:false,
			url:REQUEST_URL+"Users/shift",    // multiple data sent using ajax
			success: function (html) {

           var href =html;
         //href = href.substring(1);
          
          $('#test1').html(href);
        }
		 
      });
			}
     
  
	
	
		}

		function getSeats(){
			var sid = $("#shift option:selected").val();
			var vid = $("#vehicle option:selected").val();
			var rid = $("#route option:selected").val();
			if(sid==0){
			$("#rrseat").remove();
			$("#nrseat").remove();
			$("#amount").remove();
		}else{
			$("#rrseat").remove();
			$("#nrseat").remove();
			$("#amount").remove();

			var data = 'id='+ rid +'&sid='+ sid + '&gid='+ vid;
			
			
			$.ajax({
			data:data,
			type:"POST",
			cache:false,
			url:REQUEST_URL+"Users/getSeats",    // multiple data sent using ajax
			success: function (html) {

          
           var href =html;
        // href = href.substring(1);
          $('#seats').html(href);
        }
		
      });
			
	
		}
		}
	
</script>
<script>

function selectgr(data){
			var vid = $(data).val();
			//alert (vid);
			
			if(vid==0){
				//$("#test").remove();
				alert('Please select  By');
			}else{
			var vid = $(data).val();
			var data = 'id='+ vid+ '&uid='+<?php echo $this->request->data['User']['ID']?>;
			//alert(data);
			$.ajax({
			data:data,
			url:REQUEST_URL+"Users/chkgr",
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