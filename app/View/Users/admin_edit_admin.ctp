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
                <a href="#">Admin</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Edit</a>
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
                <span aria-hidden="true" class="icon-user"></span>  Edit Admin
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
                <div class="form-body">
                    <h3 class="form-section">Admin Info</h3>

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
                                <label class="control-label col-md-3">Middle Name<span class="required"> * </span></label>
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
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( Panchal )')); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Gender<span class="required"> * </span></label>
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
                                <label class="control-label col-md-3">Birth Date<span class="required"> * </span></label>
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
                                <label class="control-label col-md-3">Age</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('AGE', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( 25 )')); ?>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Blood Group<span class="required"> * </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Contact No.">
                                    <?php
                                    echo $this->Form->input('BLOOD_GROUP_ID', array('options' => $bloodgroups, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Marital Status<span class="required"> * </span></label>
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

                        

                    </div>

                    

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Qualification<span class="required"> * </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->Form->input('QUALIFICATION', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( BA )')); ?>
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
                                <label class="control-label col-md-3">Mobile no<span class="required"> * </span></label>
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
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :- ( 0265-1234567 )')); ?>
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
                                <label class="control-label col-md-3">City<span class="required"> * </span></label>
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
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'placeholder' => 'Example :-( 390009 )')); ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Address<span class="required"> * </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('ADDRESS', array('type' => 'textarea',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Transport Vehicle</label>
                                <div class="col-md-9">
                                    <?php
                                    echo $this->Form->input('TRANSPORT_ID', array('options' => $transport, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Upload Profile Photo <span class="required">* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Upload Profile Photo">
                                    <?php echo $this->Form->input('UPLOAD_IMAGE', array('type' => 'file', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
									<?php echo $this->General->uploadfilenotes(); ?>
									<?php
                                    if(isset($this->request->data["User"]["IMAGE_URL"]) && $this->request->data["User"]["IMAGE_URL"]!='') {
                                    $img = $this->request->data["User"]["IMAGE_URL"];
                                    $path = SITE_URL . 'files/upload_document/'.$img;
                                    ?>
                                    <div class="preview_container">
                                        <img src="<?php echo $path ?>" alt="" />
                                    </div>
                                    <?php } ?>	

                                </div>
                            </div>
                            
                            <?php /*
                        	if(isset($this->request->data["User"]["IMAGE_URL"]) && $this->request->data["User"]["IMAGE_URL"]!='') {
                            	$img = $this->request->data["User"]["IMAGE_URL"];
                            	$path = SITE_URL . 'files/upload_document/'.$img;
                            ?>
                            <div style="float:right;width:500px;">
                                <img src="<?php echo $path ?>"  width="100" />
                            </div>
                        <?php } */ ?>
                            
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Upload Address Proof Photo <span class="required">* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Upload Profile Photo">
                                    <?php echo $this->Form->input('UPLOAD_ADDRESS', array('type' => 'file', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
									<?php echo $this->General->uploadfilenotes(); ?>
									<?php
                                    if(isset($this->request->data["User"]["ADDRESS_PROOF"]) && $this->request->data["User"]["ADDRESS_PROOF"]!='') {
                                        $img = $this->request->data["User"]["ADDRESS_PROOF"];
                                        $path = SITE_URL . 'files/upload_document/'.$img;
                                        ?>
                                        <div class="preview_container">
                                            <img src="<?php echo $path ?>" alt="" />
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                            
                            <?php /*
                            if(isset($this->request->data["User"]["ADDRESS_PROOF"]) && $this->request->data["User"]["ADDRESS_PROOF"]!='') {
                                $img = $this->request->data["User"]["ADDRESS_PROOF"];
                                $path = SITE_URL . 'files/upload_document/'.$img;
                                ?>
                                <div style="float:right;width:500px;">
                                    <img src="<?php echo $path ?>"  width="100" />
                                </div>
                            <?php } */ ?>
                            
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Joining Date</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('JOINING_DATE', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control date-picker','placeholder' => 'Example :- ( 1/12/1989 )')); ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Status</label>
                                <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                                     data-html='true' data-original-title="Status">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="data[User][STATUS]" value="1" <?php echo $this->request->data['User']['STATUS'] == 1 ? "checked" : ""; ?>/>
                                            Active </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[User][STATUS]" value="0" <?php echo $this->request->data['User']['STATUS'] == 0 ? "checked" : ""; ?>/>
                                            Inactive </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<!--<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Section</label>
								<div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
									 data-html='true' data-original-title="Mobile No.">
									<?php
									echo $this->Form->input('SECTION', array('options' => $section, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
										'div' => FALSE_VALUE));
									?>
								</div>
							</div>
						</div>
					</div>-->

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
				
				  <?php echo $this->Form->input("ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
            </form>
            <!-- END FORM-->
        </div>
		
    </div>

</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>