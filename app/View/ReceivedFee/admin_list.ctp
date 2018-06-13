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
                <a href="#">Received Fee</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Received Fee</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Received Fees
    </div>
</div>
<div class="portlet-body">
<?php // PR($row); die; ?>

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
       	Receive Type
    </th>
    <th class="text-center">
       Class
    </th>
	<th class="text-center">
       Fees Month
    </th>
    <th class="text-center">
       	Paid Fees
    </th>
    <th class="text-center">
       	Total Fees
    </th>
    <th class="text-center">
        Payment By
    </th>
    <th class="text-center">
        Action
    </th>
    
</tr>
</thead>
<tbody>
<?php if(count($row) > 0):
    $i = 1;
    ?>
    <?php foreach($row as $pro) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $pro['Name']['FIRST_NAME'].' '. $pro['Name']['MIDDLE_NAME'].' ' .$pro['Name']['LAST_NAME']; ?></td>
            <td class="text-center"><?php if($pro['ReceivedFee']['RECEIVE_TYPE'] == 1){ echo 'Regular';}elseif($pro['ReceivedFee']['RECEIVE_TYPE'] == 2){echo 'Advance';} ?></td>
            <td class="text-center"><?php echo $pro['AcademicClass']['CLASS_NAME']; ?></td>
			<td class="text-center"><?php
				if($pro['ReceivedFee']['FEE_MONTH'] == 06){
					$month = 'June';
				}elseif($pro['ReceivedFee']['FEE_MONTH'] == 07){
					$month = 'July';
				}elseif($pro['ReceivedFee']['FEE_MONTH'] == 08){
					$month = 'August';
				}elseif($pro['ReceivedFee']['FEE_MONTH'] == 09){
					$month = 'September';
				}elseif($pro['ReceivedFee']['FEE_MONTH'] == 10){
					$month = 'October';
				}elseif($pro['ReceivedFee']['FEE_MONTH'] == 11){
					$month = 'November';
				}elseif($pro['ReceivedFee']['FEE_MONTH'] == 12){
					$month = 'December';
				}elseif($pro['ReceivedFee']['FEE_MONTH'] == 01){
					$month = 'January';
				}elseif($pro['ReceivedFee']['FEE_MONTH'] == 02){
					$month = 'February';
				}elseif($pro['ReceivedFee']['FEE_MONTH'] == 03){
					$month = 'March';
				}elseif($pro['ReceivedFee']['FEE_MONTH'] == 04){
					$month = 'April';
				}elseif($pro['ReceivedFee']['FEE_MONTH'] == 05){
					$month = 'May';
				}
			
				echo $month;
			?></td>
            <td class="text-center"><?php echo $pro['ReceivedFee']['FEES_AMT']; ?></td>
            <td class="text-center"><?php echo $pro['ReceivedFee']['NET_AMT']; ?></td>
            <td class="text-center"><?php 
			if($pro['ReceivedFee']['PAY_TYPE'] == 1){
				echo 'Cash';
			}elseif($pro['ReceivedFee']['PAY_TYPE'] == 2){
				echo 'Check';
			}elseif($pro['ReceivedFee']['PAY_TYPE'] == 3){
				echo 'Challan';
			}elseif($pro['ReceivedFee']['PAY_TYPE'] == 4){
				echo 'Demand Draft';
			}
				
			
			?></td>
            <td class="text-center">
			<a href="<?php echo Router::url(array('controller' => 'ReceivedFee',
                    'action' => 'view', $pro['ReceivedFee']['id']
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true" title="View News"
                   data-original-title="Delete">
                    <i class="fa fa-desktop"></i></a>
			
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