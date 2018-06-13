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
                        <a href="#">Supervisors</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">View All Supervisors</a>
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
                            <span aria-hidden="true" class="icon-users"></span>View All Supervisors
                        </div>
                    </div>
                    <div class="portlet-body">

    <?php //if($authUser["ROLE_ID"]==ADMIN_ID) {
		if($authUser["ROLE_ID"]==HR_ID) {
	?>
                        <!--<div class="table-toolbar">
                            <div class="btn-group">
                                <a href="<?php echo Router::url(array('controller' => 'Users','action' => 'add_supervisor')) ?>" class="btn
                                   green bg-green"> ADD NEW <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>-->
						<a href="<?php echo Router::url(array('controller' => 'Users','action' => 'add_supervisor')) ?>" class="btn
                                   green bg-green no_marbtm"> ADD NEW <i class="fa fa-plus"></i>
                        </a>
    <?php } ?>
                        <!-- sort_section -->
						<div class="sort_section">
							<div class="btn-group">
								<a class="btn btn-primary tooltips" data-toggle="tooltip" title="Export" href="<?php echo Router::url(array("action"=>"export_user",SUPERVISOR_ID)); ?>">
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
                        <table class="table table-striped table-bordered table-hover user_listing_table" id="user_table">
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
										Employee. No.
									</th>
									<th>
										Role
									</th>
                                    <!--<th>
                                        Father Name
                                    </th>
                                    <th>
                                        Mother Name
                                    </th>-->
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
                                    <td class="ul_fullname"><?php echo $user['User']['FIRST_NAME'].' '.$user['User']['LAST_NAME']; //'.$user['User']['MIDDLE_NAME'].'  ?></td>
									<td class="ul_employee_number"><?php echo $user['User']['ID']; ?></td>
									<td class="ul_role"><?php echo $user['Role']['ROLE_NAME']; ?></td>
                                    <!--<td class="ul_fathername"><?php echo $user['User']['FATHER_NAME']; ?></td>
                                    <td class="ul_mothername"><?php echo $user['User']['MOTHER_NAME']; ?></td>-->
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
									<!--<td class="ul_grid_view_dashboard">
                                        <a href="<?php echo Router::url(array('controller' => 'Users',
                                        'action' => 'superviser_section', $user['User']['ID'],
                                        ))?>" class="tooltips btn_view_dashboard" data-toggle="tooltip" data-placement="top" title="View Dashboard">View Dashboard</a>
                                    </td>-->
                                    <td class="ul_action">
                                        <div class="ul_action_inner">
                                            <a class="action_btn" href="javascript:void(0);"><i class="fa fa-ellipsis-v"></i></a>
                                            <div class="action_block">


                                                <!--<a href="<?php echo Router::url(array('controller' => 'Users',
                    'action' => 'superviser_section', $user['User']['ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="View Dashboard">
                                                    <i class="fa fa-eye" aria-hidden="true"></i></a>-->
													
												<a href="<?php echo Router::url(array('controller' => 'Users',
                    'action' => 'idcard', $user['User']['ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="ID Card">
                                                    <i class="fa fa-list-alt" aria-hidden="true"></i></a>	
													
												<a href="<?php echo Router::url(array('controller' => 'AcademicHistory',
                    'action' => 'list', $user['User']['ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Academic History">
                                                    <i class="fa fa-history" aria-hidden="true"></i></a>
													
												<a href="<?php echo Router::url(array('controller' => 'StaffUploadDocument',
                    'action' => '', $user['User']['ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Documents">
                                                    <i class="fa fa-file-text-o" aria-hidden="true"></i></a>	
													
												<?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==HR_ID ) { ?>
						<a href="<?php echo Router::url(array('controller' => 'Remark',
							'action' => 'list', $user['User']['ID'],
						))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Remarks">
						   <i class="fa fa-comments-o"></i></a>
						<?php } ?>	

                                                <a href="<?php echo Router::url(array('controller' => 'Users',
                    'action' => 'view_supervisor', $user['User']['ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="View">
                                                    <i class="fa fa-desktop"></i></a>

                <?php //if($authUser["ROLE_ID"]==ADMIN_ID) {
					if($authUser["ROLE_ID"]==ADMIN_ID) {
				?>
                                                <a href="<?php echo Router::url(array('controller' => 'Users',
                    'action' => 'edit_supervisor', $user['User']['ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Edit">
                                                    <i class="fa fa-pencil"></i></a>

                                                <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'Users',
												'action' => 'delete_supervisor', $user['User']['ID']
												))?>')" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Delete">
                                                    <i class="fa fa-trash-o"></i></a>
                <?php } ?>   
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
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<script>
    function remove_record(x) {
        if (confirm("Are you sure want to remove this ?")) {
            window.location.href = x;
        }
    }

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