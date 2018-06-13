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
                <a href="#">Vacancy Replay</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Vacancy Replay</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Vacancy Replay
    </div>
</div>
<div class="portlet-body">


<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th style="width: 100px;">
        Sr. No.
    </th>
    <th> 
       Name
    </th>
	<th>
       Eamil
    </th>
	<th>
	  Contact Number
    </th>
    <th>
		Experience
    </th>
    <th>
	   Qualification
    </th>
     <th>
	    Post Name
    </th>
      <th>
	    Resume
    </th>
    <th>
	   Description
    </th>
    <th style="width: 200px;">
	   Status
    </th>
	<?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
    <th style="width: 200px;">
        Action
    </th>
	<?php  }  ?>
</tr>
</thead>
<tbody>
<?php if(count($VacancyReplay) > 0):
    $i = 1;
    ?>
    <?php foreach($VacancyReplay as $v) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
			<td class="text-center"> <?php echo $v['VacancyReplay']['NAME']; ?></td>
            <td class="text-center"> <?php echo $v['VacancyReplay']['EMAIL_ID']; ?></td>
			<td class="text-center"> <?php echo $v['VacancyReplay']['CONTACT_NUMBER']; ?></td> 
            <td class="text-center"> <?php echo $v['VacancyReplay']['EXPERIENCE']; ?></td>
              <td class="text-center"> <?php echo $v['VacancyReplay']['QUALIFICATION']; ?></td>
                <td class="text-center"> <?php echo $v['VacancyReplay']['APPLY_FOR']; ?></td>
                <td class="text-center"> 
				<?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==HR_ID) { ?>
				<a href="<?php echo DOWNLOADURL.STAFF_RESUME.'/'.$v['VacancyReplay']['RESUME'];?>">
				<?php } ?>
				<?php echo $v['VacancyReplay']['RESUME']; ?>
				<?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==HR_ID) { ?>
				</a>
				<?php } ?>
				</td>
                 <td class="text-center"> <?php echo $v['VacancyReplay']['DESCRIPTION']; ?></td>
                
                 <td class="text-center"><?php //echo $inquiry['Medium']['MEDIUM_NAME']; 
			  $status='';
				if($v['VacancyReplay']['INQ_STATUS'] == 0)
            	{
            		$status = 'Pending';
            	}
            	elseif($v['VacancyReplay']['INQ_STATUS'] == 1)
            	{
            		$status = 'Selected';
            	}
				elseif($v['VacancyReplay']['INQ_STATUS'] == 2)
				{
					$status = 'Rejected';
				}
				elseif($v['VacancyReplay']['INQ_STATUS'] == 3)
				{
					$status = 'Hold';
				}
				
				echo $status;
				?>
              </td>
              
				<?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
            <td class="text-center">
            	    <a href="<?php echo Router::url(array('controller' => 'VacancyReplay',
                    'action' => 'edit', $v['VacancyReplay']['REPLAY_ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Edit">
                    <i class="fa fa-pencil"></i></a>      
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

<script>
function ch_status(x) {
	if(confirm("Are you sure want to proceed this ?")) {
			window.location.href = x;
	}
} 
</script>