<div class="page-content-wrapper">
<div class="page-content">
<!-- BEGIN STYLE CUSTOMIZER -->
<?php // echo $this->element('theme_customizer'); ?>
<!-- END STYLE CUSTOMIZER -->
<!-- BEGIN PAGE HEADER-->
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth'); ?>
        <ul class="page-breadcrumb breadcrumb">
            <li class="btn-group">
                <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                    <span>Actions</span><i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'index')); ?>">View All</a>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'add')); ?>">Add New</a>
                    </li>
                </ul>
            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">User</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View User</a>
            </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-12">
<div class="tabbable tabbable-custom boxless tabbable-reversed">

        <div class="portlet box blue-madison">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa icon-user"></i>View User
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                    <div class="form-body">
                        <h4 class="margin-bottom-20"> View User Info - <?php echo
                        $this->General->first_letter_capitalized($user['User']['first_name']. ' ' .
                            $user['User']['last_name'] ); ?> </h4>
                        <h5 class="form-section">Person Info</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">User ID:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $user['User']['user_id']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">First name:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $this->General->first_letter_capitalized
                                        ($user['User']['first_name']);
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Middle name:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $this->General->first_letter_capitalized
                                        ($user['User']['middle_name']); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Last name:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $this->General->first_letter_capitalized
                                        ($user['User']['last_name']); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                        </div>
                        <!--/row-->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Contact No.:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $user['User']['contact_no']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Mobile No.:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $user['User']['mobile_no']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Email ID:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $user['User']['email']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Gender:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                        <?php if($user['User']['gender'] == 'M') {
                                        echo "Male";
                                        } else {
                                        echo "FeMale";
                                        }
                                        ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Status:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $user['User']['status'] == 1 ? "Active" : "Inactive"; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Role:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $user['Role']['role_name']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Created:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo date('d-m-Y', strtotime($user['User']['created'])); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Modified:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo date('d-m-Y', strtotime($user['User']['modified'])); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/row-->

                    </div>
                    <div class="form-actions fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" class="btn bg-blue-chambray" onclick="window.location.href='<?php echo Router::url(array
                                    ('controller' => 'Users', 'action' => 'edit',
                                        $user['User']['id'])) ?>'"><i class="fa fa-pencil"></i> Edit</button>
                                    <button type="button" class="btn default"  onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Cancel</button>
                                </div>
                            </div>
                            <div class="col-md-6">
                            </div>
                        </div>
                    </div>
                <!-- END FORM-->
            </div>
        </div>

</div>
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>