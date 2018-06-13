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
                <a href="#">Student Attendance</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Student Attendance</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Student Attendance
    </div>
</div>
<div class="portlet-body">
               
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

         
                        
<?php if(in_array($authUser["ROLE_ID"],array(TEACHER_ID))) { ?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'StudentAttendance','action' => 'add')) ?>" class="btn
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
        Class 
    </th>
    <th class="text-center">
       Attendance Status
    </th>
    <th class="text-center">
        Status
    </th>
   
</tr>
</thead>
<tbody>

<?php if(count($StudentAttendance) > 0):
    $i = 1;
    ?>
    <?php foreach($StudentAttendance as $sa) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"> <?php echo $sa['StudentAttendance']['ATTENDANCE_DATE']; ?></td>
           <td class="text-center"><?php echo $sa['Name']['FIRST_NAME'].' '.$sa['Name']['MIDDLE_NAME'].' '.$sa['Name']['LAST_NAME']; ?></td>
            <td class="text-center"><?php echo $sa['AcademicClass']['CLASS_NAME']; ?></td>
            <td class="text-center">
                <?php if($sa['StudentAttendance']['AVAILABILITY'] == 'P') { ?>
                   Present
                <?php } else { ?>
                    Absent
                <?php } ?>
            </td>
             <td class="text-center">
                <?php if($sa['StudentAttendance']['STATUS'] == 1) { ?>
                   Active
                <?php } else { ?>
                    Inactive
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

