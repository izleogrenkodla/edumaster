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
		
							<?php /* ?>
							<?php echo $this->Form->create('User', array('class' => 'form-horizontal add custom_form',
								'type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'get')); ?>
								<!--<h3 class="form-section">User Search Form:</h3>-->
							<div class="row custom_search_filter">

								<div class="col-md-12 custom_block">
									<div class="col-md-6 custom_block">
										<label class="control-label flef">Name</label>
										<?php echo $this->Form->input('first_name', array('type' => 'text',
											'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small',
											'value' => isset($this->request->query['data']['User']['first_name']) ? $this->request->query['data']['User']['first_name']: '')); ?>
										<label class="control-label flef">Last</label>
										<?php echo $this->Form->input('last_name', array('type' => 'text',
											'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small',
											'value' => isset($this->request->query['data']['User']['last_name']) ? $this->request->query['data']['User']['last_name']: '')); ?>
										<label class="control-label flef">Email</label>
										<?php echo $this->Form->input('email', array('type' => 'text',
											'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small',
											'value' => isset($this->request->query['data']['User']['email']) ? $this->request->query['data']['User']['email']: '')); ?>
										<label class="control-label flef">Phone</label>
										<?php echo $this->Form->input('mobile_no', array('type' => 'text',
											'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small',
											'value' => isset($this->request->query['data']['User']['mobile_no']) ? $this->request->query['data']['User']['mobile_no']: '')); ?>
										<label class="control-label flef">Date: From</label>
										<input type="text" class="form-control form-control-inline date-picker input-small" name="data[User][from_date]"
											   value="<?php echo isset($this->request->query['data']['User']['from_date']) ? $this->request->query['data']['User']['from_date']
												   : '' ?>" readonly  />

										<label class="control-label flef">To</label>
										<input type="text" class="form-control form-control-inline date-picker input-small" name="data[User][to_date]"
											   value="<?php echo isset($this->request->query['data']['User']['to_date']) ? $this->request->query['data']['User']['to_date']
												   : '' ?>"  readonly />
									</div>
									<button type="submit" class="btn bg-blue-chambray">Search</button> OR
									<a href="<?php echo Router::url(array("action"=>"students")); ?>">RESET</a> OR
									<a href="<?php echo Router::url(array("action"=>"export_student")); ?>"><i class="fa-file-excel-o"></i> Export</a>
									OR
									<a href="javascript:void(0)"  onclick="return printme('user_table');"><i class="fa fa-print"></i> Print</a>
								</div>
							</div>
							</form>
							<?php */ ?>
	<?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID))) { ?>
	   
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
		 
	<?php } ?>	

		<!-- sort_section -->
		<div class="sort_section">
			<div class="btn-group">
				<a class="btn btn-primary tooltips" data-toggle="tooltip" title="Export" href="<?php echo Router::url(array("action"=>"export_student")); ?>">
					<i class="fa fa-file-excel-o" aria-hidden="true" title="Export"></i>
				</a>
				<a class="btn btn-success tooltips" data-toggle="tooltip" title="Print" href="javascript:void(0);" onclick="return printme('user_table');">
					<i class="fa fa-print" aria-hidden="true" title="Print"></i>
				</a>
				<a id="btn_grid" class="btn btn-warning tooltips" data-toggle="tooltip" title="Grid View" href="javascript:void(0);">
					<i class="fa fa-th-large" aria-hidden="true" title="Grid View"></i>
				</a>
				<a id="btn_list" class="btn btn-danger tooltips" data-toggle="tooltip" title="List View" href="javascript:void(0);">
					<i class="fa fa-th-list" aria-hidden="true" title="List View"></i>
				</a>
			</div>
		</div>
		<!-- End: sort_section -->

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
				Gr. No.
			</th>
			<th>
				Role
			</th>
			<th>
				User Name
			</th>
			<th>
				Email Address
			</th>
			<th>
				Class Name
			</th>
		   
			<th>
				Mobile No
			</th>
			<th>
				Status
			</th>
			<th>
				Action
			</th>
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
					<td class="ul_fullname"><?php echo $user['User']['FIRST_NAME'].' '.$user['User']['LAST_NAME']; // '.$user['User']['MIDDLE_NAME'].'  ?></td>
					<td class="ul_gr_number"><?php echo $user['User']['GR_NO']; ?></td>
					<td class="ul_role"><?php echo $user['Role']['ROLE_NAME']; ?></td>
					<td class="ul_username"><?php echo $user['User']['USERNAME']; ?></td>
					<td class="ul_email"><?php echo $user['User']['EMAIL_ID']; ?></td>
					<td class="ul_classname"><?php echo $user['AcademicClass']['CLASS_NAME']; ?></td>

					<td class="ul_mobile"><?php echo $user['User']['MOBILE_NO']; ?></td>
					<td class="ul_status">

						<?php if($user['User']['STATUS']) { ?>
							Active
						<?php } else { ?>
							Inactive
						<?php } ?>
					</td>
					
					<td class="ul_action">
						<div class="ul_action_inner">
							<a class="action_btn" href="javascript:void(0);"><i class="fa fa-ellipsis-v"></i></a>
							<div class="action_block">
							
							<a href="<?php echo Router::url(array('controller' => 'Users',
							'action' => 'student_section', $user['User']['ID'],
						))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="View Dashboard">
							<i class="fa fa-eye" aria-hidden="true"></i></a>
							
						<a href="<?php echo Router::url(array('controller' => 'Users',
							'action' => 'view_student', $user['User']['ID'],
						))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="View">
							<i class="fa fa-desktop"></i></a>
							
						<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
						<a href="<?php echo Router::url(array('controller' => 'Users',
							'action' => 'edit_student', $user['User']['ID'],
						))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Edit">
							<i class="fa fa-pencil"></i></a>
					<?php } ?>		
				<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
						<a href="<?php echo Router::url(array('controller' => 'Users',
							'action' => 'delete_student', $user['User']['ID'],
						))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Delete">
							<i class="fa fa-trash-o"></i></a>
						<?php } ?>  
						<?php if($user['User']['ADM_ID'])  {?>
						 <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
						<a href="<?php echo Router::url(array('controller' => 'Users',
							'action' => 'download', $user['User']['ADM_ID'],
						))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="download">
						   
					<i class="fa fa-download"></i></a>
					<?php } ?>
					<?php }?> 
					
						<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
						<a href="<?php echo Router::url(array('controller' => 'AcademicHistory',
							'action' => 'list', $user['User']['ID'],
						))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Academic History">
						   <i class="fa fa-book"></i></a>
						<?php } ?>  
						
						<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
						<a href="<?php echo Router::url(array('controller' => 'Remark',
							'action' => 'list', $user['User']['ID'],
						))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Remark">
						   <i class="fa fa-comments-o"></i></a>
						<?php } ?> 
						
						<a href="<?php echo Router::url(array('controller' => 'Users',
							'action' => 'student_idcard', $user['User']['ID'],
						))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="ID Card">
							<i class="fa fa-list-alt"></i></a>
						
							</div>
						</div>

					</td>
				</tr>
			<?php } ?>
		<?php endif; ?>
		</tbody>
		</table>
		</div>
	</div>
</div>
<script>
	// User Grid List
	$(document).ready(function () {

		/*$("#btn_grid").click(function () {
		 $("#user_table").addClass("user_grid_table");
		 $("#user_table").removeClass("table-bordered table-striped");
		 });*/
		$("#btn_grid").click(function () {
			$("#user_table").addClass("user_grid_table");
			$("#user_table").removeClass("user_listing_table table-bordered table-striped");
		});


		$("#btn_list").click(function () {
			$("#user_table").addClass("user_listing_table table-bordered table-striped");
			$("#user_table").removeClass("user_grid_table");
		});

		$(".table .action_btn").click(function () {
			$(this).nextAll(".table .action_block").slice(0, 2).toggleClass("show");
		});

	});
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})

</script>