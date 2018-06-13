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
                <a href="#">Fee Refund</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Fee Refund</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Fee Refund
    </div>
</div>
<div class="portlet-body">


<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th style="width: 100px;" class="text-center">
        Sr. No.
    </th>
    <th class="text-center">
        Student
    </th>
    <th class="text-center">
       GR. Number
    </th>
    <th class="text-center">
		Class
    </th>
	 <th class="text-center">
		Username
    </th>
	
	<th class="text-center">
		Medium
    </th>
	
	<th style="width: 200px;" class="text-center">
       	Action
    </th>
   
    
</tr>
</thead>
<tbody>

<?php
/*PR($Users);
die;*/
?>
<?php if(count($Users) > 0):
    $i = 1;
    ?>
    <?php foreach($Users as $pro) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $pro['User']['FIRST_NAME'].' '. $pro['User']['MIDDLE_NAME'].' ' .$pro['User']['LAST_NAME']; ?></td>
            <td class="text-center"><?php echo $pro['User']['GR_NO']; ?></td>
            <td class="text-center"><?php echo $pro['AcademicClass']['CLASS_NAME']; ?></td>
			<td class="text-center"><?php echo $pro['User']['USERNAME']; ?></td>
			<td class="text-center"><?php echo $pro['Medium']['MEDIUM_NAME']; ?></td>
			<td class="text-center"> 
					
					<a href="<?php echo Router::url(array('controller' => 'FeeRefund',
                    'action' => 'add', $pro['User']['ID']))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Refund">
                    <i class="fa fa-money"></i></a>
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