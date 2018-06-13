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
                <a href="#">Students Ledger</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View All Students Ledger</a>
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
        <span aria-hidden="true" class="icon-users"></span>View All Students Ledger
    </div>
</div>
<div class="portlet-body">
<strong>Fees Search Form: </strong>
<?php echo $this->Form->create('User', array('class' => 'form-horizontal add custom_form',
    'type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'get')); ?>
<div class="row custom_search_filter">
    <div class="col-md-12 custom_block">
    	<div class="col-md-8 custom_block">
        <label class="control-label flef">Select Class</label>
            <?php echo $this->Form->input('CLASS_ID', array('options' => $classes,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['User']['CLASS_ID']) ? $this->request->query['data']['User']['CLASS_ID']: '')); ?>
		<label class="control-label flef">Select Student</label>
            <?php echo $this->Form->input('USER_ID', array('options' => $selected_students,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['User']['USER_ID']) ? $this->request->query['data']['User']['USER_ID']: '')); ?>		
        <label class="control-label flef">Fee Status</label>
            <?php echo $this->Form->input('STATUS', array('options' => $fee_status,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['User']['STATUS']) ? $this->request->query['data']['User']['STATUS']: '')); ?>
        
		</div>	   
        <button type="submit" class="btn bg-blue-chambray">Search</button> OR
		<a href="<?php echo Router::url(array("action"=>"index")); ?>">RESET</a> OR
		<a href="<?php echo Router::url(array("action"=>"export_fees")); ?>"><i class="fa-file-excel-o"></i> Export</a>
		OR
		<a href="javascript:void(0)"  onclick="return printme('user_table');"><i class="fa fa-print"></i> Print</a>
    </div>
</div>
</form>
<?php /*?><?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,ACCOUNT_ID))) { ?>
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
<?php  } ?><?php */?>	 
	
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
    <?php 

	foreach($users as $key=>$user) { ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $user['User']['FIRST_NAME'].' '.$user['User']['MIDDLE_NAME'].' '.$user['User']['LAST_NAME']; ?></td>
            <td><?php echo $user['User']['FATHER_NAME']; ?></td>
            <td><?php echo $user['User']['MOTHER_NAME']; ?></td>
            <td><?php echo $user['User']['USERNAME']; ?></td>
            <td><?php echo $user['User']['EMAIL_ID']; ?></td>
            <td><?php echo $user["User"]['AcademicClass']['CLASS_NAME']; ?></td>
            
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
                   data-original-title="Edit" title="View Student">
                    <i class="fa fa-desktop"></i></a>
				&nbsp;	
					            	<a href="<?php echo Router::url(array('controller' => 'Users',
                    'action' => 'view_student_ledger', $user['User']['ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit" title="View Ledger">
                    <i class="fa fa-credit-card"></i></a>

               
            </td>
        </tr>
    <?php } ?>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<script>
$(document).ready(function(){
	 $("#UserCLASSID").bind("change",
            function(event){
			var class_id = $(this).val();
                $.ajax({
                    async: true,
                    beforeSend: function(XMLHttpRequest){
                        $('#StudentFee').html('Wait..');
                    },
                    complete: function(XMLHttpRequest,
                    textStatus){
                        $('#StudentFee').attr('disabled',
                        true);
                    },
                    data: $("#UserAdminStudentLedgerForm").serialize(),
                    dataType: "html",
                    success: function(data,textStatus){
						var tmp = jQuery.parseJSON(data);
						if(tmp.status=='success') { 
                        	$("#UserUSERID").html(tmp.msg);
						}
                    },
                    type: "post",
                    url: REQUEST_URL+"Users/GetstudentbyClass"
                });
                return false;
            });
})
</script>