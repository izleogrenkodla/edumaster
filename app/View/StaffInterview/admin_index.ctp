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
                <a href="#">Interview</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Interview</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Interview</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Interview
    </div>
</div>
<div class="portlet-body">


<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
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
	   Status
    </th>
    <th style="width: 185px;">
        Action
    </th>
</tr>
</thead>
<tbody>


<?php if(count($inq) > 0):
    $i = 1;
    ?>
    <?php foreach($inq as $v) { ?>

        <tr>
            <td class="text-center"><?php echo $i; ?></td>
			<td class="text-center"> <?php echo $v['VacancyReplay']['NAME']; ?></td>
            <td class="text-center"> <?php echo $v['VacancyReplay']['EMAIL_ID']; ?></td>
			<td class="text-center"> <?php echo $v['VacancyReplay']['CONTACT_NUMBER']; ?></td> 
            <td class="text-center"> <?php echo $v['VacancyReplay']['EXPERIENCE']; ?></td>
              <td class="text-center"> <?php echo $v['VacancyReplay']['QUALIFICATION']; ?></td>
                <td class="text-center"> <?php echo $v['VacancyReplay']['APPLY_FOR']; ?></td>
                <td class="text-center"> 
				<a href="<?php echo DOWNLOADURL.STAFF_RESUME.'/'.
				$v['VacancyReplay']['RESUME'];?>"><?php echo $v['VacancyReplay']['RESUME']; ?></a>
				</td>
                
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
              					           
            <td class="text-center">
            	    <a href="<?php echo Router::url(array('controller' => 'StaffInterview',
                    'action' => 'view', $v['VacancyReplay']['REPLAY_ID'],
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

<script>
function ch_status(x) {
	if(confirm("Are you sure want to proceed this ?")) {
			window.location.href = x;
	}
} 
</script>