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
                <a href="#">Leave Application</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View All Leave Applications</a>
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
        <span aria-hidden="true" class="icon-users"></span>View All Leave Applications
    </div>
	<?php if(in_array($authUser["ROLE_ID"],array(TEACHER_ID))) { ?>
			<div class="btn-group pull-right">
						<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
						Actions <i class="fa fa-angle-down"></i>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li>
								<a href="<?php echo Router::url(array("action"=>"index")) ?>">Inbox</a>
							</li>
							<li>
								<a href="<?php echo Router::url(array("action"=>"outbox")) ?>">Outbox</a>
							</li>
						</ul>
					</div>
	<?php } ?>	
</div>
<div class="portlet-body">

<?php if(in_array($authUser["ROLE_ID"],array(STUDENT_ID))) { ?>
  <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
	<?php  } ?>
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
<?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID))) { ?>
    <th>
       User Type
    </th>
    <th>
        First Name
    </th>
    <th>
        Middle Name
    </th>
    <th>
        Last Name
    </th>
<?php }else{ ?>
<th>
        Reason
    </th>
<?php } ?>
    <th>
        Start Date
    </th>
    <th>
        End Date
    </th>
    <th>
        Status
    </th>
     <th>
        Action
    </th>
</tr>
</thead>
<tbody>
<?php if(count($leaveApplications) > 0):

 ?>
    <?php foreach($leaveApplications as $key=>$leaveApplication) { 
                  $show_control = false;
		 switch($authUser["ROLE_ID"]) {
		 	case TEACHER_ID:
				if($leaveApplication['LeaveApplication']['ROLE_ID']==STUDENT_ID) {
					$show_control = true;
				}
			break;
			case HR_ID:
				if($leaveApplication['LeaveApplication']['ROLE_ID']==TEACHER_ID) {
					$show_control = true;
				}
			break;
		 }
     ?>
        <tr>
            <td><?php echo $key+1; ?></td>
<?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID))) { ?>
            <td><?php echo $leaveApplication['Role']['ROLE_NAME']; ?></td>
            <td><?php echo $leaveApplication['User']['FIRST_NAME']; ?></td>
            <td><?php echo $leaveApplication['User']['MIDDLE_NAME']; ?></td>
            <td><?php echo $leaveApplication['User']['LAST_NAME']; ?></td>
<?php }else{ ?>
<td align=center><?php echo substr($leaveApplication['LeaveApplication']['REASON'],0,50); echo strlen($leaveApplication['LeaveApplication']['REASON'])>50?"...":""; ?></td>
<?php } ?>
            <td align=center><?php echo $this->General->dbfordate($leaveApplication['LeaveApplication']['FROM_DATE']); ?></td>
            <td align=center><?php echo $this->General->dbfordate($leaveApplication['LeaveApplication']['TO_DATE']); ?>

			</td>
            <?php 
            	if($leaveApplication['LeaveApplication']['LEAVE_STATUS'] == LVSTS_PENDING)
            	{
            		$status = '<span class="label label-sm label-warning">Pending</span>';
            	}
            	elseif($leaveApplication['LeaveApplication']['LEAVE_STATUS'] == LVSTS_APPROVED)
            	{
            		$status = '<span class="label label-sm label-success">Approved</span>';
            	}
				elseif($leaveApplication['LeaveApplication']['LEAVE_STATUS'] == LVSTS_REJECT)
            	{
            		$status = '<span class="label label-sm label-danger">Rejected</span>';
            	}
            
            ?>
            <td align=center><?php echo $status; ?></td>
            <td>
				<a href="<?php echo Router::url(array('controller' => 'LeaveApplications',
                    'action' => 'view', $leaveApplication['LeaveApplication']['LEAVE_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-eye"></i></a>
                    <?php   if($show_control) { ?>
				  <?php if(in_array($leaveApplication['LeaveApplication']['LEAVE_STATUS'],array(LVSTS_REJECT,LVSTS_PENDING))) {  ?>
				   
				 <a href="javascript:void(0)" onclick="ch_status('<?php echo Router::url(array('controller' => 'LeaveApplications','action' => 'stactive', $leaveApplication['LeaveApplication']['LEAVE_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                   <span class="label label-sm label-success"><u>Approve</u></span></a>	
				  <?php } ?> &nbsp;
				 <?php if(in_array($leaveApplication['LeaveApplication']['LEAVE_STATUS'],array(LVSTS_PENDING,LVSTS_APPROVED))) {  ?>
				    <a href="javascript:void(0)" onclick="ch_status('<?php echo Router::url(array('controller' => 'LeaveApplications','action' => 'streject', $leaveApplication['LeaveApplication']['LEAVE_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                   <span class="label label-sm label-danger"><u>Reject</u></span></a>	
				   				  <?php } ?>
				<?php  }?>	
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
function ch_status(x) {
	if(confirm("Are you sure want to proceed this ?")) {
			window.location.href = x;
	}
} 
</script>