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
                <a href="#">Students</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View All Students</a>
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
        <span aria-hidden="true" class="icon-users"></span>View All Registration
    </div>
</div>
<div class="portlet-body">

                        <?php echo $this->Form->create('StudentRegistration', array('class' => 'form-horizontal add custom_form',
                            'type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'get')); ?>          
                    <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID))) { ?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'StudentRegistration','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
	
	<?php echo $this->Form->create("StudentRegistration",array("type"=>"get")) ?>
	
	</form>
	 
<?php } ?>	
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    <th>
       Full Name
    </th>
    <th>
        Mother Name
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
    <th>
        Status
    </th>
    <th style="width: 185px;">
        Action
    </th>
</tr>
</thead>
<tbody>

<?php if(count($StudentRegistration) > 0): ?>
    <?php foreach($StudentRegistration as $key=>$user) { ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $user['StudentRegistration']['FIRST_NAME'].' '.$user['StudentRegistration']['MIDDLE_NAME'].' '.$user['StudentRegistration']['LAST_NAME']; ?></td>
            <td><?php echo $user['StudentRegistration']['MOTHER_NAME']; ?></td>
            <td><?php echo $user['StudentRegistration']['EMAIL_ID']; ?></td>
            <td><?php echo $user['AcademicClass']['CLASS_NAME']; ?></td>

            <td class="text-center"><?php echo $user['StudentRegistration']['MOBILE_NO']; ?></td>
            <td class="text-center">

                <?php if($user['StudentRegistration']['STATUS']) { ?>
                    Active
                <?php } else { ?>
                    Inactive
                <?php } ?>
            </td>
            
            <td class="text-center">
            	<a href="<?php echo Router::url(array('controller' => 'StudentRegistration',
                    'action' => 'view', $user['StudentRegistration']['FORM_NO'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                  
                    <i class="fa fa-desktop"></i></a>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                     <a href="<?php echo Router::url(array('controller' => 'Uploaddocument',
                    'action' => 'add', $user['StudentRegistration']['FORM_NO'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   ><i class="icon-paper-clip"></i></a>
                   <?php  }  ?>
               	<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                <a href="<?php echo Router::url(array('controller' => 'StudentRegistration',
                    'action' => 'edit', $user['StudentRegistration']['FORM_NO'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>
			<?php } ?>		
            <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                <a href="<?php echo Router::url(array('controller' => 'StudentRegistration',
                    'action' => 'interview', $user['StudentRegistration']['FORM_NO'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="interview">
            <i class="fa fa-comments"></i></a>
            <?php }?>
            
            <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
            <?php
		 
		App::import('Controller', 'Uploaddocument');
			$EmpCont = new UploaddocumentController;
			$department_id = $user['StudentRegistration']['FORM_NO']; // put here department ID as per your need
			$employee_list = $EmpCont -> admin_Getdownload($department_id);
			
			if($employee_list == 1)
			{
				?>
				<a href="<?php echo Router::url(array('controller' => 'StudentRegistration',
                    'action' => 'download', $user['StudentRegistration']['FORM_NO'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="download">
                   
            <i class="fa fa-download"></i></a>
                <?php	
			}else{
				
			}

		?>
       <?php }?>      
            
            
		<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                <a href="<?php echo Router::url(array('controller' => 'StudentRegistration',
                    'action' => 'delete', $user['StudentRegistration']['FORM_NO'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Delete">
                    <i class="fa fa-trash-o"></i></a>
                <?php } ?>   
            </td>
        </tr>
    <?php } ?>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
