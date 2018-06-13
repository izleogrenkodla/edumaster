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
                <a href="#">Vehicle </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Vehicle </a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Vehicle
    </div>
</div>
<div class="portlet-body form">

<div class="form-body">

<?php if(in_array($authUser["ROLE_ID"],array(TRANSPORTATION_ID))){?>
    <!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Vehicle','action' => 'add')) ?>" class="btna
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>		
    </div>-->
	<a href="<?php echo Router::url(array('controller' => 'Vehicle','action' => 'add')) ?>" class="btn
		green bg-green add_btn"> ADD NEW <i class="fa fa-plus"></i>
	</a>
<?php }?>
	<?php echo $this->Form->create('Vehicle', 
array('class' => 'form-horizontal add custom_form','type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'post')); ?>

<?php /* ?>
<div class="row custom_search_filter">
    <div class="col-md-12 custom_block">
    	<div class="col-md-8 custom_block">
        <label class="control-label flef">Select Vehicle Type: </label>
            <?php echo $this->Form->input('VEHICLE_TYPE', array('options' => $type,
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
<?php */ ?>

		<div class="row">
			<div class="col-lg-6 col-md-7 col-sm-7 col-xs-12">
				<div class="form-group no_marbtm">
					<label class="control-label col-md-3">Select Vehicle Type:</label>
					<div class="col-md-9" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
					   <?php echo $this->Form->input('VEHICLE_TYPE', array('options' => $type,
							'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me',
							'value' => isset($this->request->query['data']['TeacherTimeTables']['CLASS_ID']) ? $this->request->query['data']['TeacherTimeTables']['CLASS_ID']: '')); ?>	
							
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
				<div class="btn_block">
					<button type="submit" class="btn bg-blue-chambray">Search</button>
					<button type="reset" class="btn bg-blue-chambray" onclick="window.location='<?php echo Router::url(array("action"=>"index")); ?>'">Reset</button>
				</div>
			</div>
		</div>
		
		</form>

		<!-- sort_section -->
		<div class="sort_section">
			<div class="btn-group">
				<a class="btn btn-primary tooltips" data-toggle="tooltip" title="Export" href="<?php echo Router::url(array("action"=>"export_fees")); ?>">
					<i class="fa fa-file-excel-o" aria-hidden="true" title="Export"></i>
				</a>
				<a class="btn btn-success tooltips" data-toggle="tooltip" title="Print" href="javascript:void(0);" onclick="return printme('user_table');">
					<i class="fa fa-print" aria-hidden="true" title="Print"></i>
				</a>
			</div>
		</div>
		<!-- End: sort_section -->	

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th style="width: 100px;">
        Sr. No.
    </th>
    <th>
       Vehicle Number
    </th>
	<th>
       Number Of Seats
    </th>
	<th>
      Vehicle Shift
    </th>
	<th>
      Vehicle Type
    </th>
    <th style="width: 200px;">
        Status
    </th>
	<?php if(in_array($authUser["ROLE_ID"],array(TRANSPORTATION_ID))){?>
    <th style="width: 200px;">
        Action
    </th>
	<?php } ?>
</tr>
</thead>
<tbody>
<?php if(count($Vehicle) > 0):
    $i = 1;
    ?>
    <?php foreach($Vehicle as $vehicle) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $vehicle['Vehicle']['VEHICLE_NUMBER']; ?></a></td>
            <td class="text-center"><?php echo $vehicle['Vehicle']['NO_OF_SEATS']; ?></a></td>
            <td class="text-center"><?php echo $vehicle['VehicleShift']['VEHICLE_SHIFT_TYPE']; ?>
            <td class="text-center"><?php echo $vehicle['VehicleType']['VEHICLE']; ?>
</a></td>
            <td class="text-center">
                <?php if($vehicle['Vehicle']['STATUS']) { ?>
                    Active
                <?php } else { ?>
                    Inactive
                <?php } ?>
            </td>
			<?php if(in_array($authUser["ROLE_ID"],array(TRANSPORTATION_ID))){?>
            <td class="text-center">
                <a href="<?php echo Router::url(array('controller' => 'Vehicle',
                    'action' => 'edit', $vehicle['Vehicle']['ID'],
                ))?>" class="tooltips btn" data-placement="top" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-pencil"></i></a>
                
                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'Vehicle','action' => 'delete', $vehicle['Vehicle']['ID']))?>')" class="tooltips btn" data-placement="top" data-toggle="tooltip" title="Delete">
                        <i class="fa fa-trash-o"></i></a>
                
            </td>
			<?php } ?>
        </tr>
    <?php $i++; } ?>
<?php endif; ?>
</tbody>
</table>
</div>
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