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
                <a href="#">Homework</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Homework</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Homework
    </div>
</div>
<div class="portlet-body">

   <?php if($authUser["ROLE_ID"]==TEACHER_ID) { ?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Homeworks','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
<?php } ?>	

<div style="color:#FF0000;">
  <?php if(in_array($authUser["ROLE_ID"],array(TEACHER_ID))) {  ?>
Note: RED Mark is  representing updated response from Student.
<?php }else{ ?>
Note: RED Mark is representing updated response from Teacher.
<?php } ?>
</div>
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th width="100">
        Sr. No.
    </th>
    <th>
       Assigned By
    </th>
	<th>
       Subject
    </th>
    <?php if($authUser["ROLE_ID"]==TEACHER_ID) { ?>
    <th width="150">
        Class
    </th>
    <?php } ?>
    <th>
        Home Work
    </th>
    <th>
        Assigned Date
    </th>
    <th>
        Submission Date
    </th>
	  <?php if($authUser["ROLE_ID"]!=TEACHER_ID) {  ?>
	<th>
		    Teacher's Comment		
    </th>
		<?php } ?>
    <th style="width: 185px;">
        Action
    </th>
   
</tr>
</thead>
<tbody>
<?php if(count($homeworks) > 0):
    $i = 1;

    ?>
    <?php foreach($homeworks as $k=>$homework) { 
		if(in_array($authUser["ROLE_ID"],array(TEACHER_ID))) { 
			if((isset($homework["HomeworkXref"][0]["STUDENT_STATUS"]) && $homework["HomeworkXref"][0]["STUDENT_STATUS"]==1) && (isset($homework["HomeworkXref"][0]["TEACHER_STATUS"]) && $homework["HomeworkXref"][0]["TEACHER_STATUS"]==0) ) { 
		?>
			<tr  style="border-left:10px solid #FF0000;">
		<?php }else{ ?>	
		<tr>
		<?php } ?>
	
<?php } ?>	
<?php  
		if(in_array($authUser["ROLE_ID"],array(STUDENT_ID))) { 
			if((isset($homework["HomeworkXref"][0]["TEACHER_STATUS"]) && $homework["HomeworkXref"][0]["TEACHER_STATUS"]==1) && (isset($homework["HomeworkXref"][0]["STUDENT_STATUS"]) && $homework["HomeworkXref"][0]["STUDENT_STATUS"]==0) ) { 
		?>
			<tr  style="border-left:10px solid #FF0000;">
		<?php }else{ ?>	
		<tr>
		<?php } ?>
	
<?php } ?>	
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $homework['User']['FIRST_NAME'].' '.$homework['User']['LAST_NAME']; ?></td>
			<td class="text-center"><?php echo $homework['Subject']['TITLE']; ?></td>
            <?php if($authUser["ROLE_ID"]==TEACHER_ID) { ?>
            <td class="text-center"><?php echo $homework['AcademicClass']['CLASS_NAME']; ?></td>
            <?php } ?>
            <td class="text-center"><?php echo $homework['Homework']['DESCRIPTION']; ?></td>
            <td class="text-center"><?php echo $this->General->dbfordate($homework['Homework']['DATE']); ?></td>
            <td class="text-center"><?php echo $this->General->dbfordate($homework['Homework']['SUBMISSION_DATE']); ?></td>
	  <?php if($authUser["ROLE_ID"]!=TEACHER_ID) {  ?>
			<td class="text-center"><?php echo (isset($homework["HomeworkXref"][0]["COMMENT"]) && $homework["HomeworkXref"][0]["COMMENT"]!='')?$homework["HomeworkXref"][0]["COMMENT"]:'Not provided yet...'; ?></td>
		<?php } ?>	
           
            <td class="text-center">
                <?php if($authUser["ROLE_ID"]==STUDENT_ID) { 
					$hw_work = 0;
					$show = 0;
					if(isset($homework["Homework"]["HW_ID"])) $hw_work = $homework["Homework"]["HW_ID"];
					
					if(isset($homework["HomeworkXref"][0]["HW_ID"]) && $homework["HomeworkXref"][0]["STUDENT_ID"]==$authUser["ID"] && $homework["HomeworkXref"][0]["STUDENT_STATUS"]==1) {
					if($hw_work === $homework["HomeworkXref"][0]["HW_ID"]) $show = 1;
						}
			if($show==0) { 	
				?>
				<a href="javascript:void(0)" onclick="updatests('<?php echo Router::url(array('controller' => 'Homeworks',
					'action' => 'updateHomework', $homework['Homework']['HW_ID'],'Done'
				))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
					   data-original-title="View">
						   Done ?
				</a>
				<?php }else{
					if((isset($homework["HomeworkXref"][0]["STUDENT_STATUS"]) && $homework["HomeworkXref"][0]["STUDENT_STATUS"]==1) && (isset($homework["HomeworkXref"][0]["TEACHER_STATUS"]) && $homework["HomeworkXref"][0]["TEACHER_STATUS"]==1)) { 
				 ?>
				 <span style="color:#003300;font-weight:bold;">Completed</span>
				 <?php }else{ 
				 	
				 ?>
					<i class="fa fa-check-circle" title="You have Sent Homework"></i>
					<?php } ?>
			<?php } ?>
<?php  } ?>

                <?php if(in_array($authUser["ROLE_ID"],array(TEACHER_ID))) { ?>
                    <a href="<?php echo Router::url(array('controller' => 'Homeworks',
                        'action' => 'view', $homework['Homework']['HW_ID']))?>"  class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                       data-original-title="View">
                        <i class="fa fa-eye"></i>
                    </a>
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

    function updatests(x) {
      if(confirm("Is your work complete ?, You can not go back if you have clicked this okay?")) {
          window.location.href = x;
      }

    }
</script>