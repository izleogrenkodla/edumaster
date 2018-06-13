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
                <a href="#">Registration</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View All Registration</a>
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

  <?php echo $this->Form->create('StaffRegistration', array('class' => 'form-horizontal add custom_form',
                            'type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'get')); ?>          
                            
                            <strong>User Search Form: </strong>
                            <div> &nbsp;</div>
                       
                        <div class="row custom_search_filter">

                            <div class="col-md-12 custom_block">
                                <div class="col-md-6 custom_block">
                                
                                    <label class="control-label flef">First Name</label>
                                    <?php echo $this->Form->input('first_name', 
										array('type' => 'text','label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small',
                                        'value' => isset($this->request->query['data']['StaffRegistration']['first_name']) ? $this->request->query['data']['StaffRegistration']['first_name']: '')); ?>
                                        
                                         <label class="control-label flef">Middle Name</label>
                                    <?php echo $this->Form->input('middle', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small',
                                        'value' => isset($this->request->query['data']['StaffRegistration']['middle']) ? $this->request->query['data']['StaffRegistration']['middle']: '')); ?>
                                        
                                    <label class="control-label flef">Last Name</label>
                                    <?php echo $this->Form->input('last_name', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small',
                                        'value' => isset($this->request->query['data']['StaffRegistration']['last_name']) ? $this->request->query['data']['StaffRegistration']['last_name']: '')); ?>
                                        
                                      
                                   
                                        
                                    <label class="control-label flef">Date: From</label>
                                    <input type="text" class="form-control form-control-inline date-picker input-small" name="data[StaffRegistration][from_date]"
                                           value="<?php echo isset($this->request->query['data']['StaffRegistration']['from_date']) ? $this->request->query['data']['StaffRegistration']['from_date']
                                               : '' ?>" readonly  />

                                    <label class="control-label flef">To</label>
                                    <input type="text" class="form-control form-control-inline date-picker input-small" name="data[StaffRegistration][to_date]"
                                           value="<?php echo isset($this->request->query['data']['StaffRegistration']['to_date']) ? $this->request->query['data']['StaffRegistration']['to_date']
                                               : '' ?>"  readonly />
                                </div>
                                <button type="submit" class="btn bg-blue-chambray">Search</button> OR
                                <a href="<?php  echo Router::url(array("action"=>"index")); ?>">RESET</a> OR
                                <a href="<?php // echo Router::url(array("action"=>"export_vacancy")); ?>"><i class="fa-file-excel-o"></i> Export</a>
                                OR
                                <a href="javascript:void(0)"  onclick="return printme('user_table');"><i class="fa fa-print"></i> Print</a>
                            </div>
                        </div>
                        </form>
<?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
    <!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'StaffRegistration','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
	<a href="<?php echo Router::url(array('controller' => 'StaffRegistration','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
	</a>	 
<?php } ?>	
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th style="width: 100px;">
        Sr. No.
    </th>
    <th class="text-center">
       Full Name
    </th>
    <th class="text-center">
        Email Address
    </th>
    <th class="text-center">
       Role Name
    </th>
   
    <th class="text-center">
        Mobile No
    </th>
    <th style="width: 200px;" class="text-center">
        Status
    </th>
    <th style="width: 200px;" class="text-center">
        Action
    </th>
</tr>
</thead>
<tbody>

<?php if(count($StaffRegistration) > 0): ?>
    <?php foreach($StaffRegistration as $key=>$user) { ?>
        <tr>
            <td class="text-center"><?php echo $key+1; ?></td>
            <td class="text-center"><?php echo $user['StaffRegistration']['FIRST_NAME'].' '.$user['StaffRegistration']['MIDDLE_NAME'].' '.$user['StaffRegistration']['LAST_NAME']; ?></td>
            <td class="text-center"><?php echo $user['StaffRegistration']['EMAIL_ID']; ?></td>
            <td class="text-center"><?php echo $user['Role']['ROLE_NAME']; ?></td>
            <td class="text-center"><?php echo $user['StaffRegistration']['MOBILE_NO']; ?></td>
            <td class="text-center">

                <?php if($user['StaffRegistration']['STATUS']) { ?>
                    Active
                <?php } else { ?>
                    Inactive
                <?php } ?>
            </td>
            
            <td class="text-center">
			
				<a href="<?php echo Router::url(array('controller' => 'StaffRegistration',
                    'action' => 'view', $user['StaffRegistration']['ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="View">
                    <i class="fa fa-desktop"></i></a>
					
					<?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
                 <a href="<?php echo Router::url(array('controller' => 'StaffRegistration',
                    'action' => 'edit', $user['StaffRegistration']['ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Edit">
                    <i class="fa fa-pencil"></i></a>
                
                     <a href="<?php echo Router::url(array('controller' => 'StaffUploadDocument',
                    'action' => 'add', $user['StaffRegistration']['ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Upload Document">
						<i class="icon-paper-clip"></i></a>
                   <?php  }  ?>
                   
                   
  
            </td>
        </tr>
    <?php } ?>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
