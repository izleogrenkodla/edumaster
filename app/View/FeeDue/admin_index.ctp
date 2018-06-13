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
                <a href="#">Due Fees</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Due Fees</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Due Fees
    </div>
</div>
<div class="portlet-body">

<?php echo $this->Form->create("FeeDue",array("type"=>"get")) ?>
		<div class="row">
			<div class="col-lg-6 col-md-7 col-sm-7 col-xs-12">
				<div class="form-group no_marbtm">
					<label class="control-label col-md-3">Filter by Class</label>
					<div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
					   <?php echo $this->Form->input('CLS', array('options' => $classes,
							'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' )); ?>	
							
					</div>
				</div>
				<!-- <div class="form-group no_marbtm">
					<label class="control-label col-md-3">Filter by Medium</label>
					<div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
					   <?php echo $this->Form->input('MEDIUM', array('options' => $medium,
							'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' )); ?>	
							
					</div>
				</div> -->
			</div>
			<div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
				<div class="btn_block">
					<button type="submit"  class="btn bg-blue-chambray">Search</button>
					<button type="reset"  class="btn bg-blue-chambray" onclick="window.location='<?php echo Router::url(array("action"=>"index")); ?>'">Reset</button>
					<a class="btn btn-success tooltips" data-toggle="tooltip" title="Print" href="javascript:void(0);" onclick="return printme('user_table');">
					<i class="fa fa-print" aria-hidden="true" title="Print"></i>
					</a>
				</div>
				
                               
			</div>
		</div>
		</form>

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th style="width: 100px;">
        Sr. No.
    </th>
    <th>
        Student
    </th>
    <th>
        Class
    </th>
	<th>
        Fees
    </th>
	<th>
        Month
    </th>
	<th>
        Year
    </th>
	<th>
        Total Fee
    </th>
	<th style="width: 200px;">
        Status
    </th>
	<?php if($authUser["ROLE_ID"]==SUPERVISOR_ID) { ?>
    <th style="width: 200px;">
        Action
    </th>
	<?php } ?>
</tr>
</thead>
<tbody>

<?php if(count($FeeDue) > 0):
    $i = 1;
    ?>
    <?php foreach($FeeDue as $Fee) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $Fee['Name']['FIRST_NAME'].' '.$Fee['Name']['MIDDLE_NAME'].' '.$Fee['Name']['LAST_NAME'] ; ?></td>
            <td class="text-center"><?php echo $Fee['AcademicClass']['CLASS_NAME']; ?></td>
			<td class="text-center"><?php echo $Fee['FeeDue']['Fees']; ?></td>
			<td class="text-center"><?php 
			echo $Fee['MonthDistribution']['month'];
			
			 ?></td>
			<td class="text-center"><?php echo $Fee['FeeDue']['Year']; ?></td>
			<td class="text-center"><?php echo $Fee['FeeDue']['Total_Fees']; ?></td>
			<td class="text-center"><?php 
				if($Fee['FeeDue']['Status'] == 0){
					echo 'Inactive';
				}else{
					echo 'Active'; 
				} 
				?></td>
				<?php if($authUser["ROLE_ID"]==SUPERVISOR_ID) { ?>
            <td class="text-center">
                <a href="<?php echo Router::url(array('controller' => 'ReceivedFee',
                    'action' => 'add', $Fee['FeeDue']['USER_ID'],$Fee['FeeDue']['id']
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Edit">
                    <i class="fa fa-pencil"></i></a>

                   <a href="<?php echo Router::url(array('controller' => 'ReceivedFee',
                    'action' => 'delete', $Fee['FeeDue']['USER_ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Delete">
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