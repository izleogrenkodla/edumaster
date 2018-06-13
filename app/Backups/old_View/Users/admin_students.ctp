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
        <span aria-hidden="true" class="icon-users"></span>View All Students
    </div>
</div>
<div class="portlet-body">
<strong>User Search Form: </strong>
                        <?php echo $this->Form->create('User', array('class' => 'form-horizontal add custom_form',
                            'type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'get')); ?>
                        <div class="row custom_search_filter">

                            <div class="col-md-12 custom_block">
                                <div class="col-md-6 custom_block">
                                    <label class="control-label flef">Name</label>
                                    <?php echo $this->Form->input('first_name', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small',
                                        'value' => isset($this->request->query['data']['User']['first_name']) ? $this->request->query['data']['User']['first_name']: '')); ?>
                                    <label class="control-label flef">Last</label>
                                    <?php echo $this->Form->input('last_name', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small',
                                        'value' => isset($this->request->query['data']['User']['last_name']) ? $this->request->query['data']['User']['last_name']: '')); ?>
                                    <label class="control-label flef">Email</label>
                                    <?php echo $this->Form->input('email', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small',
                                        'value' => isset($this->request->query['data']['User']['email']) ? $this->request->query['data']['User']['email']: '')); ?>
                                    <label class="control-label flef">Phone</label>
                                    <?php echo $this->Form->input('mobile_no', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small',
                                        'value' => isset($this->request->query['data']['User']['mobile_no']) ? $this->request->query['data']['User']['mobile_no']: '')); ?>
                                    <label class="control-label flef">Date: From</label>
                                    <input type="text" class="form-control form-control-inline date-picker input-small" name="data[User][from_date]"
                                           value="<?php echo isset($this->request->query['data']['User']['from_date']) ? $this->request->query['data']['User']['from_date']
                                               : '' ?>" readonly  />

                                    <label class="control-label flef">To</label>
                                    <input type="text" class="form-control form-control-inline date-picker input-small" name="data[User][to_date]"
                                           value="<?php echo isset($this->request->query['data']['User']['to_date']) ? $this->request->query['data']['User']['to_date']
                                               : '' ?>"  readonly />
                                </div>
                                <button type="submit" class="btn bg-blue-chambray">Search</button> OR
                                <a href="<?php echo Router::url(array("action"=>"students")); ?>">RESET</a> OR
                                <a href="<?php echo Router::url(array("action"=>"export_student")); ?>"><i class="fa-file-excel-o"></i> Export</a>
                                OR
                                <a href="javascript:void(0)"  onclick="return printme('user_table');"><i class="fa fa-print"></i> Print</a>
                            </div>
                        </div>
                        </form>
<?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID))) { ?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Users','action' => 'add_student')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
	
	<?php echo $this->Form->create("User",array("type"=>"get")) ?>
	<div class="row">
		<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Filter by Class</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                   <?php echo $this->Form->input('CLS', array('options' => $classes,
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' )); ?>	
										
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="col-md-3">
                                <button type="submit"  class="btn bg-blue-chambray">Search</button>
                            </div>
                        </div>
	</div>
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
        Father Name
    </th>
    <th>
        Mother Name
    </th>
    <th>
        User Name
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

<?php if(count($users) > 0): ?>
    <?php foreach($users as $key=>$user) { ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $user['User']['FIRST_NAME'].' '.$user['User']['MIDDLE_NAME'].' '.$user['User']['LAST_NAME']; ?></td>
            <td><?php echo $user['User']['FATHER_NAME']; ?></td>
            <td><?php echo $user['User']['MOTHER_NAME']; ?></td>
            <td><?php echo $user['User']['USERNAME']; ?></td>
            <td><?php echo $user['User']['EMAIL_ID']; ?></td>
            <td><?php echo $user['AcademicClass']['CLASS_NAME']; ?></td>

            <td class="text-center"><?php echo $user['User']['MOBILE_NO']; ?></td>
            <td class="text-center">

                <?php if($user['User']['STATUS']) { ?>
                    Active
                <?php } else { ?>
                    Inactive
                <?php } ?>
            </td>
            
            <td class="text-center">
            	<a href="<?php echo Router::url(array('controller' => 'Users',
                    'action' => 'view_student', $user['User']['ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-eye"></i></a>
                    
               	<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                <a href="<?php echo Router::url(array('controller' => 'Users',
                    'action' => 'edit_student', $user['User']['ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-edit"></i></a>
			<?php } ?>		
		<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                <a href="<?php echo Router::url(array('controller' => 'Users',
                    'action' => 'delete_student', $user['User']['ID'],
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
