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
                <a href="#">Classwork</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View All Classwork</a>
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
			<span aria-hidden="true" class="icon-users"></span>View All Classwork
		</div>
	</div>
<div class="portlet-body form">
<div class="form-body">
  
						
						
                   <?php if(in_array($authUser["ROLE_ID"],array(TEACHER_ID))) { ?>
    <!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Classwork','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
	<a href="<?php echo Router::url(array('controller' => 'Classwork','action' => 'add')) ?>" class="btn
        green bg-green add_btn no_marbtm"> ADD NEW <i class="fa fa-plus"></i>
    </a>
	
	 
<?php } ?>	

<?php 
/*PR($Classwork);
die;*/
?>
		<table class="table table-striped table-bordered table-hover" id="user_table">
		<thead>
		<tr role="row" class="heading">
			<th style="width: 100px;">
				Sr. No.
			</th>
			<th>
				Teacher
			</th>
			<th>
				Subject
			</th>
			<th>
				Class Name
			</th>
			<th>
				Class Work Date
			</th>
			<th>
				Start Time
			</th>
			<th>
				End Time
			</th>
			<th>
				Narration
			</th>
			<th style="width: 200px;">
				Action
			</th>
			
		</tr>
		</thead>
		<tbody>

		<?php if(count($Classwork) > 0): ?>
			<?php foreach($Classwork as $key=>$user) { ?>
				<tr>
					<td class="text-center"><?php echo $key+1; ?></td>
					<td><?php echo $user['User']['FIRST_NAME'].' '.$user['User']['MIDDLE_NAME'].' '.$user['User']['LAST_NAME']; ?></td>
					<td><?php echo $user['Subject']['TITLE']; ?></td>
					<td><?php echo $user['AcademicClass']['CLASS_NAME']; ?></td>
					<td><?php echo $user['Classwork']['CW_DATE']; ?></td>
					<td><?php echo $user['Classwork']['START_TIME']; ?></td>
					<td><?php echo $user['Classwork']['END_TIME']; ?></td>

					<td class="text-center"><?php echo $user['Classwork']['NARRATION']; ?></td>
					
					<td class="text-center">
						<a href="<?php echo Router::url(array('controller' => 'Classwork',
							'action' => 'view', $user['Classwork']['CW_ID'],
						))?>" class="tooltips btn" data-placement="top" data-toggle="tooltip" title="View">
							<i class="fa fa-desktop"></i></a>
						   <?php if(in_array($authUser["ROLE_ID"],array(TEACHER_ID))) { ?>
					   
						<a href="<?php echo Router::url(array('controller' => 'Classwork',
							'action' => 'edit', $user['Classwork']['CW_ID'],
						))?>" class="tooltips btn" data-placement="top" data-toggle="tooltip" title="Edit">
							<i class="fa fa-pencil"></i></a>

						<a href="<?php echo Router::url(array('controller' => 'Classwork',
							'action' => 'delete', $user['Classwork']['CW_ID'],
						))?>" class="tooltips btn" data-placement="top" data-toggle="tooltip" title="Delete">
							<i class="fa fa-trash-o"></i></a>
							<?php } ?>
						
					</td>
					
				</tr>
			<?php } ?>
		<?php endif; ?>
		</tbody>
		</table>

		</div>
	</div>
</div>
