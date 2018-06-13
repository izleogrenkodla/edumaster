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
                <a href="#">Students</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View All Students</a>
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
        <span aria-hidden="true" class="icon-users"></span>View All Students
    </div>
</div>
	<div class="portlet-body form">
		<div class="form-body">
		<?php echo $this->Form->create("User",array("type"=>"get")) ?>
		<div class="row">
			<div class="col-lg-6 col-md-7 col-sm-7 col-xs-12">
				<div class="form-group no_marbtm">
					<label class="control-label col-md-3">Filter by Class</label>
					<div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
					   <?php echo $this->Form->input('CLS', array('options' => $classes,
							'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' )); ?>	
							
					</div>
				</div>
			</div>
			<div class="col-lg-6 col-md-5 col-sm-5 col-xs-12">
				<div class="btn_block">
					<button type="submit"  class="btn bg-blue-chambray">Search</button>
					<button type="reset"  class="btn bg-blue-chambray" onclick="window.location='<?php echo Router::url(array("action"=>"students")); ?>'">Reset</button>
				</div>
			</div>
		</div>
		</form>
		 
	<?php //} ?>	

		<table class="table table-striped table-bordered table-hover user_listing_table student_list_table" id="user_table">
		<thead>
		<tr role="row" class="heading">
			<th>
				Sr. No.
			</th>
			<th>
				Profile Photo
			</th>
			<th>
			   Full Name
			</th>
			<th>
				General Register Number
			</th>
			<th>
				Class Name
			</th>
			<th>
				Action
			</th>
			<!--<th style="display: none;"></th>-->
		</tr>
		</thead>
		<tbody>

		<?php if(count($users) > 0): ?>
			<?php foreach($users as $key=>$user) { ?>
				<tr>
					<td class="ul_sr"><?php echo $key+1; ?></td>
					<?php
						$user_img = "14525121041.jpg";				
						if(isset($user['User']['IMAGE_URL']) && $user['User']['IMAGE_URL']!="")
						{
							$user_img=$user['User']['IMAGE_URL'];
							$path = DOWNLOADURL.UPLOAD_DOCUMENT.$user_img;
						}
						else
						{
							$path = DOWNLOADURL.UPLOAD_DOCUMENT.$user_img;
						}				
					?>
					<td class="ul_profile_photo"><img src="<?php echo $path; ?>" alt=""></td>
					<td class="ul_fullname"><?php echo $user['User']['FIRST_NAME'].' '.$user['User']['LAST_NAME'].' '.$user['User']['LAST_NAME']; // '.$user['User']['MIDDLE_NAME'].'  ?></td>
					<td class="ul_gr_number"><?php echo $user['User']['GR_NO']; ?></td>
					<td class="ul_classname"><?php echo $user['AcademicClass']['CLASS_NAME']; ?></td>
					<!--<td class="ul_grid_view_dashboard">
                    	<a href="<?php echo Router::url(array('controller' => 'Users',
							'action' => 'student_section', $user['User']['ID'],
						))?>" class="tooltips btn_view_dashboard" data-toggle="tooltip" data-placement="top" title="View Dashboard">View Dashboard</a>
                    </td>-->
					<td class="ul_action">
						<?php
						foreach($Examtypelist as $key=>$list) { 
								?>
							
							<a href="<?php echo Router::url(array('controller' => 'ExamList','action' => 'result', $list['ExamList']['EXAM_TYPE_ID'],$user['User']['ID'],
							))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Generate Result">
									<?php echo $list['ExamType']['TITLE']; ?></a>    
									<?php echo '<br>'; ?>
							
						<?php
						}
						?>
					</td>
				</tr>
			<?php } ?>
		<?php endif; ?>
		</tbody>
		</table>
		</div>
	</div>
</div>