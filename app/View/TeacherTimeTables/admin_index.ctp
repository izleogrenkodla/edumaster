<?php  

$check = substr($this->here, -1);

?>
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
                <a href="#">Time Table</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Time Table</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Time Table
    </div>
</div>
<div class="portlet-body form">
	<div class="form-body">

   <?php if(in_array($authUser["ROLE_ID"],array(SUPERVISOR_ID))) { 
   
		
   ?>
   
		
    <!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'TeacherTimeTables','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
	<a href="<?php echo Router::url(array('controller' => 'TeacherTimeTables','action' => 'add')) ?>" class="btn
        green bg-green add_btn"> ADD NEW <i class="fa fa-plus"></i>
	</a>
		<?php } ?>

<?php   echo $this->Form->create('TeacherTimeTables', 
array('class' => 'form-horizontal add custom_form','type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'post')); ?>
<?php

?>
<?php /* ?>
<div class="row custom_search_filter">
    
    <div class="col-md-12 custom_block">
    	<div class="col-md-8 custom_block">
            <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID))) {?>
        <label class="control-label flef">Select Class</label>
            <?php echo $this->Form->input('CLASS_ID', array('options' => $classes,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['TeacherTimeTables']['CLASS_ID']) ? $this->request->query['data']['TeacherTimeTables']['CLASS_ID']: '')); ?>
           <?php }?>    
           <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID))) {?>
		<label class="control-label flef">Select Subject</label>
            <?php echo $this->Form->input('SUBJECT_ID', array('options' => $subject,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['TeacherTimeTables']['SUBJECT_ID']) ? $this->request->query['data']['TeacherTimeTables']['SUBJECT_ID']: '')); ?>	<?php }?>
                	<?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID))) {?>
        <label class="control-label flef">Select Teacher</label>
            <?php echo $this->Form->input('TEACHER_ID', array('options' => $teacher,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['TeacherTimeTables']['TEACHER_ID']) ? $this->request->query['data']['TeacherTimeTables']['TEACHER_ID']: '')); ?><?php }?>
        <label class="control-label flef">Select Day</label>
            <?php echo $this->Form->input('WEEK_ID', array('options' => $weeks,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                    'value' => isset($this->request->query['data']['TeacherTimeTables']['WEEK_ID']) ? $this->request->query['data']['TeacherTimeTables']['WEEK_ID']: ''));
                ?>        
        
		</div>	   
        <button type="submit" class="btn bg-blue-chambray">Search</button> OR
		<a href="<?php echo Router::url(array("action"=>"index")); ?>">RESET</a> OR
		<a href="<?php echo Router::url(array("action"=>"export_fees")); ?>"><i class="fa-file-excel-o"></i> Export</a>
		OR
		<a href="javascript:void(0)"  onclick="return printme('user_table');"><i class="fa fa-print"></i> Print</a>
    </div>
</div>
<?php */ ?>

<div class="row">
		<?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID,SUPERVISOR_ID))) {
				if(ctype_alpha($check) OR $check == "/" ){
				
				?>
		<div class="col-md-6">
			
			<div class="form-group">	
				<label class="control-label col-md-3">Select Class</label>
				<div class="control_bg col-md-9">
				<?php echo $this->Form->input('CLASS_ID', array('options' => $classes,
					'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me',
					'value' => isset($this->request->query['data']['TeacherTimeTables']['CLASS_ID']) ? $this->request->query['data']['TeacherTimeTables']['CLASS_ID']: '')); ?>
				</div>
			</div>
		</div>
			
				<?php }}?>
			<?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID,SUPERVISOR_ID))) {
				 if(ctype_alpha($check) OR $check == "/" ){
				
				
				
				?>
		<div class="col-md-6">
			
			<div class="form-group">
				<label class="control-label col-md-3">Select Subject</label>
				<div class="control_bg col-md-9">
				<?php echo $this->Form->input('SUBJECT_ID', array('options' => $subject,
					'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me',
					'value' => isset($this->request->query['data']['TeacherTimeTables']['SUBJECT_ID']) ? $this->request->query['data']['TeacherTimeTables']['SUBJECT_ID']: '')); ?>
				</div>
			</div>
		</div>
			<?php }}?>
				<?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID,SUPERVISOR_ID))) {
					
					if(ctype_alpha($check) OR $check == "/" ){
				
					
					?>
		<div class="col-md-6">
		
			<div class="form-group">
				<label class="control-label col-md-3">Select Teacher</label>
				<div class="control_bg col-md-9">
				<?php echo $this->Form->input('TEACHER_ID', array('options' => $teacher,
					'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me',
					'value' => isset($this->request->query['data']['TeacherTimeTables']['TEACHER_ID']) ? $this->request->query['data']['TeacherTimeTables']['TEACHER_ID']: '')); ?>
				</div>
			</div>
		</div>
					<?php }}?>
		<div class="col-md-6">
			<div class="form-group">
				<label class="control-label col-md-3">Select Day</label>
				<div class="control_bg col-md-9">
				<?php echo $this->Form->input('WEEK_ID', array('options' => $weeks,
				'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me',
					'value' => isset($this->request->query['data']['TeacherTimeTables']['WEEK_ID']) ? $this->request->query['data']['TeacherTimeTables']['WEEK_ID']: '')); ?>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group btn_block">
				<button type="submit" class="btn bg-blue-chambray">Search</button>
				<button type="reset" class="btn bg-blue-chambray" onclick="window.location='<?php echo Router::url(array("action"=>"index")); ?>'">Reset</button>
			</div>
		</div>
			
			<!--<button type="submit" class="btn bg-blue-chambray">Search</button> OR
			<a href="<?php echo Router::url(array("action"=>"index")); ?>">RESET</a> OR
			<a href="<?php echo Router::url(array("action"=>"export_fees")); ?>"><i class="fa-file-excel-o"></i> Export</a>
			OR
			<a href="javascript:void(0)"  onclick="return printme('user_table');"><i class="fa fa-print"></i> Print</a>-->
		
	</div>

<!-- sort_section -->
	<div class="sort_section">
		<div class="btn-group">
			<a class="btn btn-primary tooltips" data-toggle="tooltip" title="Export" href="<?php echo Router::url(array("action"=>"export_fees")); ?>">
				<i class="fa fa-file-excel-o" aria-hidden="true" title="Export"></i>
			</a>
			<a class="btn btn-success tooltips" data-toggle="tooltip" title="Print" href="javascript:void(0);" onclick="return printme('user_table');">
				<i class="fa fa-print" aria-hidden="true" title="Print"></i>
			</a>
		</div>
	</div>
	<!-- End: sort_section -->
	

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    <th>
       Teacher
    </th>
	<th>
       Week Of Day
    </th>
    <th>
       Subject
    </th>
	<th>
       Start Time
    </th>
	<th>
       End Time
    </th>
    <th>
        Class
    </th>
     <th>
        Duration
    </th>
   
    <th>
        Action
    </th>
   
</tr>
</thead>
<tbody>
<?php if(count($lists) > 0):
        $i = 1;
	$weeks = array(
	'1' => 'Monday',
	'2' => 'Tuesday',
	'3' => 'Wednesday',
	'4' => 'Thursday',
	'5' => 'Friday',
	'6' => 'Saturday',
	);
    ?>
    <?php foreach($lists as $list) { ?>
        <tr>

            <td class="text-center"><?php echo $i; ?></td>
            <td class=""><?php echo $list['User']['FIRST_NAME'].' '.$list['User']['LAST_NAME']; ?></td>
			<td class="text-center"><?php echo $weeks[$list['TeacherTimeTable']['TT_DATE']]; ?></td>			
            <td class="text-center"><?php echo $list['Subject']['TITLE']; ?></td>
			<td class="text-center"><?php echo date(TIMEFORMAT,strtotime($list['TeacherTimeTable']['START_TIME'])); ?></td>
			<td class="text-center"><?php echo date(TIMEFORMAT,strtotime($list['TeacherTimeTable']['END_TIME'])); ?></td>
            <td class="text-center"><?php echo $list['AcademicClass']['CLASS_NAME']; ?></td>
           	<td class="text-center"><?php echo $list['TeacherTimeTable']['DURATION'].' ' .'Min.'; ?></td>	
            <td class="text-center">
			<a href="<?php echo Router::url(array('controller' => 'TeacherTimeTables',
                    'action' => 'view', $list['TeacherTimeTable']['TT_ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" title="View">
                    <i class="fa fa-desktop"></i></a>
			  <?php if(in_array($authUser["ROLE_ID"],array(SUPERVISOR_ID))) { ?>
			    <a href="<?php echo Router::url(array('controller' => 'TeacherTimeTables',
                    'action' => 'edit', $list['TeacherTimeTable']['TT_ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-pencil"></i></a>
					
                    <a href="javascript:void(0)" onclick="remove_record('<?php echo Router::url(array('controller' => 'TeacherTimeTables','action' => 'delete', $list['TeacherTimeTable']['TT_ID']))?>')" class="tooltips btn" data-toggle="tooltip" title="Delete">
                        <i class="fa fa-trash-o"></i></a>
				<?php  }?>		
            </td>
           
        </tr>
    <?php $i++; } ?>
<?php endif; ?>
</tbody>
</table>



</div>
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