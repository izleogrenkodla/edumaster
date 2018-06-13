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
                <a href="#">Admission</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Confirm Admission</a>
            </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth'); ?>
    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-12">
<!-- BEGIN EXAMPLE TABLE PORTLET-->
<div class="portlet box blue-madison">
<div class="portlet-title">
    <div class="caption">
        <span aria-hidden="true" class="icon-users"></span>View All Confirm Registration
    </div>
</div>
<div class="portlet-body form">
            <div class="form-body">

  <?php echo $this->Form->create('StudentRegistration', array('class' => 'form-horizontal add custom_form',
                            'type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'get')); ?>          
                            
                             <!--<h3 class="form-section">User Search Form:</h3>-->
                       
                        <!--<div class="row custom_search_filter">

                            <div class="col-md-12 custom_block">
                                <div class="col-md-6 custom_block">
                                
                                    <label class="control-label flef">First Name</label>
                                    <?php echo $this->Form->input('first_name', 
										array('type' => 'text','label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small',
                                        'value' => isset($this->request->query['data']['StudentRegistration']['first_name']) ? $this->request->query['data']['StudentRegistration']['first_name']: '')); ?>
                                        
                                         <label class="control-label flef">Middle Name</label>
                                    <?php echo $this->Form->input('middle', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small',
                                        'value' => isset($this->request->query['data']['StudentRegistration']['middle']) ? $this->request->query['data']['StudentRegistration']['middle']: '')); ?>
                                        
                                    <label class="control-label flef">Last Name</label>
                                    <?php echo $this->Form->input('last_name', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small',
                                        'value' => isset($this->request->query['data']['StudentRegistration']['last_name']) ? $this->request->query['data']['StudentRegistration']['last_name']: '')); ?>
                                </div>
                                <button type="submit" class="btn bg-blue-chambray">Search</button> OR
                                <a href="<?php  echo Router::url(array("action"=>"index")); ?>">RESET</a> 
                            </div>
                        </div>-->
						
						<div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">First Name</label>
                                            <div class="control_bg col-md-9">
                                                <?php echo $this->Form->input('first_name', 
                                                    array('type' => 'text','label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control',
                                                    'value' => isset($this->request->query['data']['StudentRegistration']['first_name']) ? $this->request->query['data']['StudentRegistration']['first_name']: '')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Middle Name</label>
                                            <div class="control_bg col-md-9">
                                                <?php echo $this->Form->input('middle', array('type' => 'text',
                                                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control',
                                                'value' => isset($this->request->query['data']['StudentRegistration']['middle']) ? $this->request->query['data']['StudentRegistration']['middle']: '')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Last Name</label>
                                            <div class="control_bg col-md-9">
                                                <?php echo $this->Form->input('last_name', array('type' => 'text',
                                                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control',
                                                'value' => isset($this->request->query['data']['StudentRegistration']['last_name']) ? $this->request->query['data']['StudentRegistration']['last_name']: '')); ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                        <div class="btn_block">
                                            <button type="submit" class="btn bg-blue-chambray">Search</button>
                                            <button type="reset" class="btn bg-blue-chambray" onclick="window.location='<?php echo Router::url(array("action"=>"index")); ?>'">Reset</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
						
                        </form>


                        <?php echo $this->Form->create('StudentRegistration', array('class' => 'form-horizontal add custom_form',
                            'type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'get')); ?>          
                 
		<table class="table table-striped table-bordered table-hover" id="user_table">
		<thead>
		<tr role="row" class="heading">
			<th style="width: 100px;">
				Sr. No.
			</th>
			<th>
			   Full Name
			</th>
			<th>
				Email Address
			</th>
			<th>
				Class Name
			</th>
		   
			<th>
				Mobile No
			</th>
			<th style="width: 200px;">
				Status
			</th>
			<th style="width: 200px;">
				Action
			</th>
		</tr>
		</thead>
		<tbody>

		<?php if(count($StudentRegistration) > 0): ?>
			<?php foreach($StudentRegistration as $key=>$user) { ?>
				<tr>
					<td class="text-center"><?php echo $key+1; ?></td>
					<td><?php echo $user['StudentRegistration']['FIRST_NAME'].' '.$user['StudentRegistration']['MIDDLE_NAME'].' '.$user['StudentRegistration']['LAST_NAME']; ?></td>
				  
					<td><?php echo $user['StudentRegistration']['EMAIL_ID']; ?></td>
					<td class="text-center"><?php echo $user['AcademicClass']['CLASS_NAME']; ?></td>

					<td class="text-center"><?php echo $user['StudentRegistration']['MOBILE_NO']; ?></td>
					<td class="text-center">
				   <?php
				 
				App::import('Controller', 'AdmissionConfirm');
					$EmpCont = new AdmissionConfirmController;
					$department_id = $user['StudentRegistration']['FORM_NO']; // put here department ID as per your need
					$employee_list = $EmpCont -> admin_GetStatus($department_id);
					
					if($employee_list == 1)
					{
						echo 'Paid';	
					}else{
						echo 'Unpaid';
					}

				?>
				   
					 

					</td>
					
					<td class="text-center">
						<a href="<?php echo Router::url(array('controller' => 'StudentRegistration',
							'action' => 'view', $user['StudentRegistration']['FORM_NO'],
						))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="View">
						  
							<i class="fa fa-desktop"></i></a>
						   <?php if(in_array($authUser["ROLE_ID"],array(SUPERVISOR_ID))) { ?>
						
						<a href="<?php echo Router::url(array('controller' => 'AdmissionConfirm',
							'action' => 'edit', $user['StudentRegistration']['FORM_NO'],
						))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Edit">
							<i class="fa fa-pencil"></i></a>
					<?php } ?>		
					
					
					</td>
				</tr>
			<?php } ?>
		<?php endif; ?>
		</tbody>
		</table>
</div>
</div>
</div>
