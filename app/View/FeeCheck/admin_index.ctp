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
                <a href="#">Cheque Fee</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Cheque Fee</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Cheque Fee
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
       Bank Name
    </th>
    <th class="text-center">
		Account Number
    </th>
	<th class="text-center">
       Cheque Number
    </th>
    <th class="text-center">
		Cheque Date
    </th>
    <th class="text-center">
       	Amount 
    </th>
	 <th class="text-center">
       	Action
    </th>
   
    
</tr>
</thead>
<tbody>
<?php if(count($FeeCheck) > 0):
    $i = 1;
    ?>
    <?php foreach($FeeCheck as $pro) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $pro['Name']['FIRST_NAME'].' '. $pro['Name']['MIDDLE_NAME'].' ' .$pro['Name']['LAST_NAME']; ?></td>
            <td class="text-center"><?php echo $pro['FeeCheck']['Bank_Name']; ?></td>
            <td class="text-center"><?php echo $pro['FeeCheck']['Ac_No']; ?></td>
			<td class="text-center"><?php echo $pro['FeeCheck']['Cheque_No'];   ?></td>
            <td class="text-center"><?php echo $pro['FeeCheck']['Cheque_Date']; ?></td>
            <td class="text-center"><?php echo $pro['FeeCheck']['Amount']; ?></td>
			<td class="text-center"> 
			 <a href="<?php echo Router::url(array('controller' => 'FeeCheck',
                    'action' => 'view', $pro['FeeCheck']['id'],
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