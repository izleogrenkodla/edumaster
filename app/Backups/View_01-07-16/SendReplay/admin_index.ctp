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
                <a href="#">Send Replay</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Send Replay</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Send Replay
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
       Name
    </th>
	<th class="text-center">
       Eamil
    </th>
	<th class="text-center">
	    Post Name
    </th>
    <th class="text-center">
       Description
    </th>
    <th class="text-center">
	   Status
    </th>
    <th class="text-center">
	    Massage
    </th>
   
</tr>
</thead>
<tbody>
<?php if(count($SendReplay) > 0):
    $i = 1;
    ?>
    <?php foreach($SendReplay as $v) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
			<td class="text-center"> <?php echo $v['SendReplay']['NAME']; ?></td>
            <td class="text-center"> <?php echo $v['SendReplay']['EMAIL_ID']; ?></td>
		
                <td class="text-center"> <?php echo $v['SendReplay']['APPLY_FOR']; ?></td>
                <td class="text-center"> <?php echo $v['SendReplay']['DESCRIPTION']; ?></td>
                
                 <td class="text-center"><?php //echo $inquiry['Medium']['MEDIUM_NAME']; 
			  $status='';
				if($v['SendReplay']['INQ_STATUS'] == 0)
            	{
            		$status = 'Pending';
            	}
            	elseif($v['SendReplay']['INQ_STATUS'] == 1)
            	{
            		$status = 'Selected';
            	}
				elseif($v['SendReplay']['INQ_STATUS'] == 2)
				{
					$status = 'Rejected';
				}
				elseif($v['SendReplay']['INQ_STATUS'] == 3)
				{
					$status = 'Hold';
				}
				
				echo $status;
				?>
              </td>
              					           
             
              <td class="text-center"> <?php echo $v['SendReplay']['MSG']; ?></td>
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
function ch_status(x) {
	if(confirm("Are you sure want to proceed this ?")) {
			window.location.href = x;
	}
} 
</script>