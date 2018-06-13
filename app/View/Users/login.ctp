<div id="maincontent" class="leftcontent">
    <div class="pagedesc">
	<div class="loginhome">
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Form->create('User', array('class' => 'form-horizontal add',
            'type' => 'file')); ?>
            <!-- start formfield -->
			<div class="logintitle">Login to Email Marketer Account | <span>Don't have a Email Marketer Account?  <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'register', 'admin' => false, 'plugin' => false)); ?>" class="logintitle links">Sign up now</a></span></div>
			<div class="error">Please enter following details. * Denotes compulsory fields. </div>
            <div class="formfield">
                <div class="leftform leftcontent">
                    <div class="formtext leftcontent">Email ID</div>
                    <div class="formvalue">
						
                        <?php echo $this->Form->input('email', array('type' => 'email',
                            'label' => FALSE_VALUE,
							'class' => 'form-control leftcontent validate[required,custom[email]] text-input',
                            'div' => FALSE_VALUE)); ?>
                    </div>
					<span class="input-group-addon" title="Required" data-toggle="tooltip" style="color:#f00;">*</span>
                </div>
            </div>

            <div class="formfield">
                <div class="leftform leftcontent">
                    <div class="formtext leftcontent">Password </div>
                    <div class="formvalue leftcontent">
                        <?php echo $this->Form->input('password', array('type' => 'password',
                            'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'class' => 'validate[required,minSize[6]] text-input')); ?>
                    </div>
					<span class="input-group-addon" title="Required" data-toggle="tooltip" style="color:#f00;">*</span>
                </div>
            </div>
			


            <!-- start formfield -->
            <div class="formfield">
                <div class="alignright login_css">
                    <input type="submit" value="Sign In" class="leftcontent"  />
                   <!-- <input type="reset" value="Cancel" class="leftcontent" />-->
                </div>
            </div>
            <!-- end formfield -->
        </form>
    </div>
	</div>
</div>
