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
                <a href="#">Student Vehicle Attendance</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Student Vehicle Attendance</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Student Vehicle Attendance
    </div>
</div>
<div class="portlet-body">
<?php if($authUser["ROLE_ID"]==TRANSPORTATION_ID) { ?>
    <!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'VehicleAttendance','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
	<a href="<?php echo Router::url(array('controller' => 'VehicleAttendance','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
	</a>
<?php } ?>
	<?php echo $this->Form->create('VehicleAttendance', 
array('class' => 'form-horizontal add custom_form','type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'post')); ?>

<div class="row custom_search_filter">
    <div class="col-md-12 custom_block">
    	<div class="col-md-8 custom_block">
        <label class="control-label flef">Select  Vehicle: </label>
            <?php echo $this->Form->input('VEHICLE_ID', array('options' => $vehicle,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['TeacherTimeTables']['CLASS_ID']) ? $this->request->query['data']['TeacherTimeTables']['CLASS_ID']: '')); ?>
				
				
		</div>	
<div class="row">
         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">From Date<span class="required"> * </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('FromDate', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control date-picker', 'placeholder' => 'Example :- ( 1/12/1989 )')); ?>
                                </div>
                            </div>
                        </div> 
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">To Date<span class="required"> * </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('ToDate', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control date-picker', 'placeholder' => 'Example :- ( 1/12/1989 )')); ?>
                                </div>
                            </div>
                        </div>
        </div>		
			
		
		
        <button type="submit" class="btn bg-blue-chambray">Search</button> OR
		<a href="<?php echo Router::url(array("action"=>"index")); ?>">RESET</a> OR
		<a href="<?php echo Router::url(array("action"=>"export_fees")); ?>"><i class="fa-file-excel-o"></i> Export</a>
		OR
		<a href="javascript:void(0)"  onclick="return printme('user_table');"><i class="fa fa-print"></i> Print</a>
    </div>
</div>
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th style="width: 100px;" class="text-center">
        Sr. No.
    </th>
    <th class="text-center">
        Date 
    </th>
    <th class="text-center">
        User
    </th>
    <th class="text-center">
       Vehicle
    </th>
    <th style="width: 200px;" class="text-center">
        Status
    </th>
   
</tr>
</thead>
<tbody>
<?php if(count($VehicleAttendance) > 0):
    $i = 1;
    ?>
    <?php foreach($VehicleAttendance as $sa) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"> <?php echo $sa['VehicleAttendance']['ATTENDENCE_DATE']; ?></td>
           <td class="text-center"><?php echo $sa['Name']['FIRST_NAME'].' '.$sa['Name']['MIDDLE_NAME'].' '.$sa['Name']['LAST_NAME']; ?></td>
           <td class="text-center"> <?php echo trim($sa['Vehicle']['VEHICLE_NUMBER']); ?> </td>
            
            <td class="text-center">
                <?php if($sa['VehicleAttendance']['STATUS'] == 1) { ?>
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

