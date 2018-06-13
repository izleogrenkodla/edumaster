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
                <a href="#">Interview</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View All Interview</a>
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
        <span aria-hidden="true" class="icon-users"></span>View All Interview
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
       Full Name
    </th>
    <th>
       Interview Status
    </th> 
    <th>
       Interview Result
    </th>
   
</tr>
</thead>
<tbody>

<?php if(count($StudentRegistration) > 0): ?>
    <?php foreach($StudentRegistration as $key=>$user) { ?>
        <tr>
            <td class="text-center"><?php echo $key+1; ?></td>
            <td class="text-center"><?php echo $user['StudentRegistration']['FIRST_NAME'].' '.$user['StudentRegistration']['MIDDLE_NAME'].' '.$user['StudentRegistration']['LAST_NAME']; ?></td>
            <td class="text-center"><?php 
			if($user['StudentRegistration']['INTERVIEW_ID'] == 0)
			{
				echo 'Pending';
			}else{
				echo 'Finish';
			}
			
			
			 ?></td>
             <td class="text-center"><?php 
			if($user['StudentRegistration']['INTERVIEW_RESULT'] == 0)
			{
				echo 'Pending';
			}elseif($user['StudentRegistration']['INTERVIEW_RESULT'] == 1){
				echo 'Selected';
			}elseif($user['StudentRegistration']['INTERVIEW_RESULT'] == 2){
				echo 'Rejected';
			}elseif($user['StudentRegistration']['INTERVIEW_RESULT'] == 3){
				echo 'Hold';
			}
			
			
			 ?></td>
           
          
        </tr>
    <?php } ?>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
