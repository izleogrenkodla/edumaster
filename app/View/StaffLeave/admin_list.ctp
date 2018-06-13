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
                <a href="#">Leave</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View All Leave</a>
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
        <span aria-hidden="true" class="icon-users"></span> Leave
    </div>
</div>
<div class="portlet-body">

<?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID))) { ?>
   
	<?php echo $this->Form->create("User",array("type"=>"get")) ?>
    <strong> 
	<div class="row">
		<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Filter by Role</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                   <?php echo $this->Form->input('CLS', array('options' => $user_roles,
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
   
    <th class="text-center">
        Sr. No.
    </th>
     <th class="text-center">
        User
    </th>
    <th class="text-center">
        Role
    </th>
    <th class="text-center">
       Leave Type
    </th>
    <th class="text-center">
       Number Of Leave
    </th>
	<?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
     <th class="text-center">
       Action
    </th>
	<?php } ?>

   
</tr>
</thead>
<tbody>

<?php if(count($list) > 0): ?>
    <?php foreach($list as $key=>$AH) { ?>
        <tr>
       
            <td class="text-center"><?php echo $key+1; ?></td>
           
           <td class="text-center"><?php echo $AH['Name']['FIRST_NAME'].' '. $AH['Name']['MIDDLE_NAME'].' ' .$AH['Name']['LAST_NAME']; ?></td>
            <td class="text-center"><?php echo $AH['Role']['ROLE_NAME']; ?></td>
            <td class="text-center"><?php echo $AH['LeaveType']['LEAVE_NAME']; ?></td>
			 <td class="text-center"><?php echo $AH['StaffLeave']['NUMBER_LEAVE']; ?></td>
			 <?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
           	 <td class="text-center">  
                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'StaffLeave','action' => 'delete', $AH['StaffLeave']['LEAVE_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                       data-original-title="Delete">
                        <i class="fa fa-trash-o"></i></a>
             </td>
			 <?php } ?>
        </tr>
    <?php } ?>
<?php endif; ?>
</tbody>
</table>
</form>
</div>
</div>
</div>
<script>
function remove_record(x) {
    if(confirm("Are you sure want to remove this ?")) { 
        window.location.href = x;
    }
}
</script> 