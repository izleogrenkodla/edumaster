<div id="maincontent" class="leftcontent register">
    <div class="pagetitle">Applicant Registration</div>
    <div class="pagedesc">
	<div class="error">Please enter following details. * Denotes compulsory fields. </div>
    <?php echo $this->Session->flash(); ?>
        <?php echo $this->Form->create('User', array('class' => 'form-horizontal add regpage',
            'type' => 'file', 'novalidate')); ?>
            <!-- start formfield -->
            <div class="formfield">
                <div class="leftform leftcontent">
                    <div class="formtext leftcontent">Email ID</div>
                    <div class="formvalue leftcontent">
                        <?php echo $this->Form->input('email', array('type' => 'email',
                            'label' => FALSE_VALUE,
                            'div' => FALSE_VALUE, 'class' => 'validate[required,custom[email]] text-input')); ?>
                    </div>
					<span class="input-group-addon" title="Required" data-toggle="tooltip" style="color:#f00;">*</span>
                </div>
                <div class="rightform rightcontent">
                    <div class="formtext leftcontent">Password </div>
                    <div class="formvalue leftcontent">
                        <?php echo $this->Form->input('password', array('type' => 'password',
                            'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'class' => 'validate[required,minSize[6]] text-input')); ?>

                    </div>
					<span class="input-group-addon" title="Required" data-toggle="tooltip" style="color:#f00;">*</span>
                </div>
            </div>
            <!-- end formfield -->
            <!-- start formfield -->
            <div class="formfield">
                <div class="leftform leftcontent">
                    <div class="formtext leftcontent">First Name</div>
                    <div class="formvalue leftcontent">
                        <?php echo $this->Form->input('first_name', array('type' => 'text',
                            'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'class' => 'validate[required, custom[onlyLetterSp]] text-input')); ?>
                    </div>
					<span class="input-group-addon" title="Required" data-toggle="tooltip" style="color:#f00;">*</span>
                </div>

                <div class="rightform rightcontent">
                    <div class="formtext leftcontent">Middle Name</div>
                    <div class="formvalue leftcontent">
                        <?php echo $this->Form->input('middle_name', array('type' => 'text',
                            'label' => FALSE_VALUE, 'div' => FALSE_VALUE)); ?>
                    </div>
					<span class="input-group-addon" title="Required" data-toggle="tooltip" style="color:#f00;">&nbsp;&nbsp;</span>
                </div>

            </div>
            <!-- end formfield -->
            <!-- start formfield -->
            <div class="formfield">
                <div class="leftform leftcontent">
                    <div class="formtext leftcontent">Last Name</div>
                    <div class="formvalue leftcontent">
                        <?php echo $this->Form->input('last_name', array('type' => 'text',
                            'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'class' => 'validate[required] text-input')); ?>
                    </div>
					<span class="input-group-addon" title="Required" data-toggle="tooltip" style="color:#f00;">*</span>
                </div>
                <div class="rightform rightcontent">
                    <div class="formtext leftcontent">Mobile no</div>
                    <div class="formvalue leftcontent">
                        <?php echo $this->Form->input('mobile_no', array('type' => 'text',
                            'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'class' => 'validate[required] text-input')); ?>
                    </div>
					<span class="input-group-addon" title="Required" data-toggle="tooltip" style="color:#f00;">*</span>
                </div>
            </div>

            <!-- end formfield -->
            <!-- start formfield -->
            <div class="formfield">
                <div class="leftform leftcontent">
                    <div class="formtext leftcontent">Contact No.</div>
                    <div class="formvalue leftcontent">
                        <?php echo $this->Form->input('contact_no', array('type' => 'text',
                            'label' => FALSE_VALUE, 'div' => FALSE_VALUE)); ?>
                    </div>
					<span class="input-group-addon" title="Required" data-toggle="tooltip" style="color:#f00;">&nbsp;&nbsp;</span>
                </div>
                <div class="rightform rightcontent">
                    <div class="formtext leftcontent">Address </div>
                    <div class="formvalue leftcontent">
                        <?php echo $this->Form->input('address', array('type' => 'text',
                            'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'class' => 'validate[required] text-input')); ?>
                    </div>
					<span class="input-group-addon" title="Required" data-toggle="tooltip" style="color:#f00;">*</span>
                </div>
            </div>

            <div class="formfield">
                <div class="leftform leftcontent">
                    <div class="formtext leftcontent">Date Of Birth</div>
                    <div class="formvalue leftcontent">
                        <div id="short-month-birthday"></div>
                    </div>
                </div>
                <div class="rightform rightcontent">
                    <div class="formtext leftcontent formtextgender">Gender <span class="required">*</span></div>
                    <div class="formvalue leftcontent">
                        <input type="radio" name="data[User][gender]" value="1" checked/>
                        Male
                        <input type="radio" name="data[User][gender]" value="0"/>
                        Female
                    </div>
                </div>
            </div>
            <!-- end formfield -->
            <!-- start formfield -->

            <div class="formfield">
                <div class="leftform leftcontent">
                    <div class="formtext leftcontent">Country<span class="required">*</span></div>
                    <div class="formvalue leftcontent">
                            <?php
                            echo $this->Form->input('country_id', array('options' => $country, 'default' => '', 'class' => 'form-control validate[required]', 'label' => FALSE_VALUE,
                                'div' => FALSE_VALUE));
                            ?>
                    </div>

                </div>
                <div class="rightform rightcontent">
                    <div class="formtext leftcontent formtextgender">State<span class="required">*</span></div>
                    <div class="formvalue leftcontent">
                        <?php
                        echo $this->Form->input('state_id', array('options' => $state, 'default' => '', 'class' => 'form-control validate[required]', 'label' => FALSE_VALUE,
                            'div' => FALSE_VALUE));
                        ?>
                    </div>

                </div>
            </div>

            <div class="formfield">
                <div class="leftform leftcontent">
                    <div class="formtext leftcontent">City<span class="required">*</span></div>
                    <div class="formvalue leftcontent">
                        <?php
                        echo $this->Form->input('city_id', array('options' => $city, 'default' => '', 'class' => 'form-control validate[required]', 'label' => FALSE_VALUE,
                            'div' => FALSE_VALUE));
                        ?>
                    </div>
                </div>
                <div class="rightform rightcontent">
                    <div class="formtext leftcontent">Pincode</div>
                    <div class="formvalue leftcontent">
                        <?php echo $this->Form->input('pincode', array('type' => 'text',
                            'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'class' => 'text-input')); ?>
                    </div>
                    <span class="input-group-addon" title="Required" data-toggle="tooltip" style="color:#f00;">&nbsp;&nbsp;</span>
                </div>
            </div>

            <div class="formfield">
                <div class="leftform leftcontent">
                    <div class="formtext leftcontent">Services<span class="required">*</span></div>
                    <div class="formvalue leftcontent">
                        <div class="multiselect">
                            <?php foreach($subscriptions as $key=>$result) { ?>
                                <label><input type="checkbox" name="data[User][subscription_id][]" value="<?php echo $key;?>" class="select_fees"/><?php echo $result;?></label>
                            <?php } ?>
                        </div>
                        <a href="#nogo" class="tooltip tooltip_icon">&nbsp;<span>Select services as required for you</span></a>
                    </div>
                </div>

                <div class="leftform rightcontent">
                    <div class="formtext leftcontent">Select Handling Fees</div>
                    <div class="formvalue leftcontent">
                        <div class="multiselect">
                            <?php foreach($get_charges as $key=>$result) { ?>
                                <label><input type="checkbox" name="data[User][subscription_charges][]" value="<?php echo $key;?>" class="select_fees"/><?php echo $result;?></label>
                            <?php } ?>
                        </div>
                        <a href="#nogo" class="tooltip tooltip_icon">&nbsp;<span>Select handling services as required for you</span></a>
                    </div>
                </div>

            </div>
            <!-- end formfield -->
            <!-- start formfield -->
            <div class="formfield">
                <div class="leftform leftcontent">
                    <div class="formtext leftcontent">Visa Refusal Doc. <span class="required">*</span></div>
                    <div class="formvalue leftcontent">
                        <input type="file" name="data[User][visa_refusal_doc]">
                        <a href="#nogo" class="tooltip tooltip_icon">&nbsp;<span>Upload Visa Refusal document</span></a>
                    </div>
                </div>

                <div class="rightform rightcontent">
                    <div class="formtext leftcontent">Passport <span class="required">*</span></div>
                    <div class="formvalue leftcontent">
                        <input type="file" name="data[User][passport_doc]">
                        <a href="#nogo" class="tooltip tooltip_icon">&nbsp;<span>Upload Passport document</span></a>
                    </div>
					
                </div>
            </div>
            <!-- end formfield -->

			 <!-- start formfield -->
            <div class="formfield">
                <div class="leftform leftcontent">
                    <div class="formtext leftcontent">Upload Additional Document.</div>
                    <div class="formvalue leftcontent">
					<div class="add_more_block">
                    </div>
                       
                </div>
				<button type="button" class="btn green add_more_button">Add More</button>
                </div>

                <div class="rightform rightcontent">
                    <div class="formtext leftcontent">Passport No.</div>
                    <div class="formvalue leftcontent">
                        <?php echo $this->Form->input('passport_no', array('type' => 'text',
                            'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'class' => 'text-input')); ?>
                    </div>
                    <span class="input-group-addon" title="Required" data-toggle="tooltip" style="color:#f00;">&nbsp;&nbsp;</span>
                </div>
		    </div>
            <!-- end formfield -->

            <div class="formfield">
                <div class="formvalue leftcontent chktext">
                    <input name="data[User][agree]" type="checkbox" value="" class="agree validate[required]" required/> I have read and agree to terms and conditions of service ordering.
                </div>

            </div>

            <!-- start formfield -->
            <div class="formfield">
                <div class="alignright">
                    <input type="submit" value="Submit" class="submit" />
                    <input type="reset" value="Cancel" class="reset"/>
                </div>
            </div>
            <!-- end formfield -->
        </form>
    </div>
</div>


<?php
$this->Js->get('#UserCountryId')->event('change',
    $this->Js->request(array(
        'controller' => 'Users',
        'action' => 'GetStateByCountry',
        'admin' => false
    ), array(
        'before' => "$('#UserStateId').attr('disabled', true);",
        'update' => '#UserStateId',
        'async' => true,
        'method' => 'post',
        'dataExpression' => true,
        'complete' => "$('#UserStateId').attr('disabled', false);",
        'data' => $this->Js->serializeForm(array(
                'isForm' => false,
                'inline' => true
        ))
    ))
);


$this->Js->get('#UserStateId')->event('change',
    $this->Js->request(array(
        'controller' => 'Users',
        'action' => 'GetCityByCountry',
        'admin' => false
    ), array(
        'before' => "$('#UserCityId').attr('disabled', true);",
        'update' => '#UserCityId',
        'async' => true,
        'method' => 'post',
        'dataExpression' => true,
        'complete' => "$('#UserCityId').attr('disabled', false);",
        'data' => $this->Js->serializeForm(array(
                'isForm' => false,
                'inline' => true
        ))
    ))
);
?>
