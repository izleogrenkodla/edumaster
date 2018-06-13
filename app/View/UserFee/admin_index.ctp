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
                <a href="#">Transports</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Students
    </div>
</div>
<div class="portlet-body">

<?php echo $this->Form->create('UserFee', 
array('class' => 'form-horizontal add custom_form','type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'post')); ?>

<div class="row custom_search_filter">
    <div class="col-md-12 custom_block">
    	<div class="col-md-8 custom_block">
        <label class="control-label flef">Select Vehicle: </label>
            <?php echo $this->Form->input('VEHICLE', array('options' => $vehicle,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['TeacherTimeTables']['CLASS_ID']) ? $this->request->query['data']['TeacherTimeTables']['CLASS_ID']: '')); ?>
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
    <th>
        Sr. No.
    </th>
    <th>
       Student Name
    </th>
	<th>
       Vehicle Shift
    </th>
	<th>
        Vehicle
    </th>
    <th>
        Route
    </th>
    <th>
        Stoppage
    </th>
	
</tr>
</thead>
<tbody>
<?php 


if(count($userlist) > 0):
    $i = 1;
    ?>
    <?php foreach($userlist as $lg) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td><?php echo $lg['User']['FIRST_NAME']." " .$lg['User']['MIDDLE_NAME']." ".$lg['User']['LAST_NAME'] ; ?></a></td>
            <td><?php echo $lg['VehicleShift']['VEHICLE_SHIFT_TYPE']; ?></a></td>
            <td><?php echo $lg['Vehicle']['VEHICLE_NUMBER']; ?></a></td>
            <td><?php echo $lg['Route']['ROUTE_NAME']; ?></a></td>
            <td><?php echo $lg['Stoppage']['STOPPAGE_NAME']; ?></a></td>
            
            
           
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
<script>
function update(x) {
	if(confirm("Are you sure want to do this payment ?")) { 
		window.location.href = x;
	}
}
</script> 