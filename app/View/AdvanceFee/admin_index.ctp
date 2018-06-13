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
                <a href="#">Advance Fee</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Advance Fee</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Advance Fee
    </div>
</div>
<div class="portlet-body">


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
		Tearms
    </th>
	 <th class="text-center">
		Fee Amount
    </th>
	<th class="text-center">
		Net Amount
    </th>
    <th class="text-center">
       	Date
    </th>
	 <th class="text-center">
       	Action
    </th>
   
    
</tr>
</thead>
<tbody>
<?php if(count($AdvanceFee) > 0):
    $i = 1;
    ?>
    <?php foreach($AdvanceFee as $pro) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $pro['Name']['FIRST_NAME'].' '. $pro['Name']['MIDDLE_NAME'].' ' .$pro['Name']['LAST_NAME']; ?></td>
            <td class="text-center"><?php echo $pro['AcademicClass']['CLASS_NAME']; ?></td>
			<td class="text-center"><?php echo $pro['PaymentType']['TITLE'];   ?></td>
			<td class="text-center"><?php echo $pro['AdvanceFee']['FEES_AMT'];   ?></td>
            <td class="text-center"><?php echo $pro['AdvanceFee']['NET_AMT']; ?></td>
            <td class="text-center"><?php echo $pro['AdvanceFee']['ENTRY_DATE']; ?></td>
			<td class="text-center"> 
			 <a href="<?php echo Router::url(array('controller' => 'AdvanceFee',
                    'action' => 'view', $pro['AdvanceFee']['ADV_ID']
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
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