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
                <a href="#">Staff Attendance</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Staff Attendance</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Staff Attendance
    </div>
</div>
<div class="portlet-body">

<?php echo $this->Form->create('User', array('class' => 'form-horizontal add custom_form',
                            'type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'get')); ?>
                            <strong>User Search Form: </strong>
                       
                        <div class="row custom_search_filter">

                            <div class="col-md-12 custom_block">
                                <div class="col-md-6 custom_block">
                                      
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
                                <a href="<?php  echo Router::url(array("action"=>"index")); ?>">RESET</a> 
                              
                            </div>
                        </div>
                        </form>
                        
                        
<?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'StaffAttendance','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
<?php } ?>

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th class="text-center">
        Sr. No.
    </th>
    <th class="text-center">
        Date 
    </th>
    <th class="text-center">
        User
    </th>
    <th class="text-center">
       Role
    </th>
    <th class="text-center">
        Status
    </th>
   
</tr>
</thead>
<tbody>

<?php if(count($StaffAttendance) > 0):
    $i = 1;
    ?>
    <?php foreach($StaffAttendance as $sa) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"> <?php echo $sa['StaffAttendance']['ATTENDANCE_DATE']; ?></td>
           <td class="text-center"><?php echo $sa['Name']['FIRST_NAME'].' '.$sa['Name']['MIDDLE_NAME'].' '.$sa['Name']['LAST_NAME']; ?></td>
            <td class="text-center"> <?php echo $sa['Role']['ROLE_NAME']; ?></td>
            <td class="text-center">
                <?php if($sa['StaffAttendance']['STATUS'] == 1) { ?>
                   Present
                <?php } else { ?>
                    Absent
                <?php } ?>
            </td>
           
        </tr>
    <?php $i++; } ?>
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
function remove_record(x) {
	if(confirm("Are you sure want to remove this ?")) { 
		window.location.href = x;
	}
}
</script>

