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
                        <a href="#">Account Users</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">View All Account Users</a>
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
                            <span aria-hidden="true" class="icon-users"></span>View All Account Users
                        </div>
                    </div>
                    <div class="portlet-body">

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                        <!--<div class="table-toolbar">
                            <div class="btn-group">
                                <a href="<?php echo Router::url(array('controller' => 'Users','action' => 'add_library')) ?>" class="btn
                            green bg-green"> ADD NEW <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>-->
<?php } ?>	

                        <div class="sort_section">
                            <div class="btn-group">
                                <a id="btn_grid" href="javascript:void(0);"><i class="fa fa-th-large"></i></a>
                                <a id="btn_list" href="javascript:void(0);"><i class="fa fa-th-list"></i></a>
                            </div>
                        </div>
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
                                        User Name
                                    </th>
                                    <th>
                                        Email Address
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
					$path = SITE_URL . 'files/'.UPLOAD_DOCUMENT.$user_img;
				}
				else
				{
					$path = SITE_URL . 'files/'.UPLOAD_DOCUMENT.$user_img;
				}				
			?>
                                    <td class="ul_profile_photo"><img src="<?php echo $path; ?>" alt=""></td>
                                    <td class="ul_fullname"><?php echo $user['User']['FIRST_NAME'].' '.$user['User']['MIDDLE_NAME'].' '.$user['User']['LAST_NAME']; ?></td>
                                    <td class="ul_username"><?php echo $user['User']['USERNAME']; ?></td>
                                    <td class="ul_email"><?php echo $user['User']['EMAIL_ID']; ?></td>
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
                    'action' => 'account_section', $user['User']['ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="View Dashboard">
                                            <i class="fa fa-eye" aria-hidden="true"></i></a>

                                        <a href="<?php echo Router::url(array('controller' => 'Users',
                    'action' => 'view_account', $user['User']['ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="View">
                                            <i class="fa fa-desktop"></i></a>

               <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                        <a href="<?php echo Router::url(array('controller' => 'Users',
                    'action' => 'edit_account', $user['User']['ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Edit">
                                            <i class="fa fa-pencil"></i></a>

                                        <a href="javascript:void(0)" onclick="usr_remove('<?php echo Router::url(array('controller' => 'Users',
                    'action' => 'delete_account', $user['User']['ID'],
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
    function usr_remove(x) {
        if (confirm("Are you sure ?")) {
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
