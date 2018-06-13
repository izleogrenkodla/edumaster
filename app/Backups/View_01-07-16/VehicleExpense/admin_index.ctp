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
                <a href="#">Vehicle Expense</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Vehicle Expense </a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Vehicle Expense
    </div>
</div>
<div class="portlet-body">
<?php if(in_array($authUser["ROLE_ID"],array(TRANSPORTATION_ID))){?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'VehicleExpense','action' => 'add')) ?>" class="btna
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
<?php }?>
<?php echo $this->Form->create('VehicleExpense', 
array('class' => 'form-horizontal add custom_form','type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'post')); ?>

<div class="row custom_search_filter">
    <div class="col-md-12 custom_block">
    	<div class="col-md-8 custom_block">
        <label class="control-label flef">Select Expense Type: </label>
            <?php echo $this->Form->input('EXPENSE_TYPE', array('options' => $exp,
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
       Vehicle Number
    </th>
	<th>
       Expense Type
    </th>
	<th>
      Date
    </th>
	<th>
      Amount
    </th>
	
    <th style="width: 185px;">
        Action
    </th>
	
</tr>
</thead>
<tbody>
<?php 

if(count($expense) > 0):
    $i = 1;
    ?>
    <?php foreach($expense as $expenses) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td><?php echo $expenses['Vehicle']['VEHICLE_NUMBER']; ?></a></td>
            <td><?php echo $expenses['VehicleExpense']['EXPENSE']; ?></a></td>
            <td><?php echo $expenses['VehicleExpense']['DATE']; ?></a></td>
            <td><?php echo $expenses['VehicleExpense']['AMOUNT']; ?>
            
</a></td>
          
            <td class="text-center">
			<a href="<?php echo Router::url(array('controller' => 'VehicleExpense',
                    'action' => 'view', $expenses['VehicleExpense']['EXPENSE_ID']
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true" title="View Expense"
                   data-original-title="Delete">
                    <i class="fa fa-desktop"></i></a>
					  <?php if(in_array($authUser["ROLE_ID"],array(TRANSPORTATION_ID))){?>
                <a href="<?php echo Router::url(array('controller' => 'VehicleExpense',
                    'action' => 'edit', $expenses['VehicleExpense']['EXPENSE_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>
                
                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'VehicleExpense','action' => 'delete',  $expenses['VehicleExpense']['EXPENSE_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                       data-original-title="Delete">
                        <i class="fa fa-trash-o"></i></a>
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