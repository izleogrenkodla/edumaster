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
                <a href="#">Student Ledger</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Student Ledger</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Student Ledger
    </div>
</div>
<div class="portlet-body">
<?php echo $this->Form->create("StudentLedger",array("type"=>"get")) ?>
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
					<button type="reset"  class="btn bg-blue-chambray" onclick="window.location='<?php echo Router::url(array("action"=>"index")); ?>'"  >Reset</button>
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
    <th class="text-center">
        Sr. No.
    </th>
    <th class="text-center">
        Student
    </th>
	 <th class="text-center">
        Class
    </th>
    <th class="text-center">
       Fee Terms 
    </th>
    <th class="text-center">
      Total Fee
    </th>
	<th class="text-center">
       Paid Fee
    </th>
    <th class="text-center">
      Remaining Fee
    </th>
    <th class="text-center">
       	Staus 
    </th>
   
    
</tr>
</thead>
<tbody>
<?php if(count($StudentLedger) > 0):
    $i = 1;
    ?>
    <?php foreach($StudentLedger as $pro) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $pro['Name']['FIRST_NAME'].' '. $pro['Name']['MIDDLE_NAME'].' ' .$pro['Name']['LAST_NAME']; ?></td>
            <td class="text-center"><?php echo $pro['AcademicClass']['CLASS_NAME']; ?></td>
			<td class="text-center"><?php echo $pro['PaymentType']['TITLE']; ?></td>
            <td class="text-center"><?php echo $pro['StudentLedger']['Total_Fees']; ?></td>
			<td class="text-center"><?php echo $pro['StudentLedger']['Paid_Fees'];   ?></td>
            <td class="text-center"><?php echo $pro['StudentLedger']['Remaining']; ?></td>
            <td class="text-center"><?php 
			if($pro['StudentLedger']['Staus'] == 1){
				echo 'Active';
			}else{
				echo 'inactive';
			}
			
			?></td>
      
            
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