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
                        <a href="<?php echo Router::url(array('controller' => 'Roles', 'action' => 'index')); ?>">View All Role</a>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'Roles', 'action' => 'add')); ?>">Add New Role</a>
                    </li>
                </ul>
            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Role</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Role</a>
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
                    <i class="fa icon-user"></i>View Role
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                    <div class="form-body">
                        <h4 class="margin-bottom-20"> View Role Info - <?php echo $this->General->first_letter_capitalized($role['Role']['ROLE_NAME']); ?> </h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Role ID:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $role['Role']['ID']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--/span-->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Section :</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $this->General->first_letter_capitalized($role['Section']['SECTION']); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
							<div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-4">Role Name :</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php echo $this->General->first_letter_capitalized($role['Role']['ROLE_NAME']); ?>
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
                                    <label class="control-label col-md-4">Status:</label>
                                    <div class="col-md-8">
                                        <p class="form-control-static">
                                            <?php if($role['Role']['STATUS']) { ?>
                                                <span class="label label-success flag_tag">Active</span>
                                            <?php } else { ?>
                                                <span class="label label-danger flag_tag">Inactive</span>
                                            <?php } ?>
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
                                    ('controller' => 'Roles', 'action' => 'edit', $role['Role']['ID'])) ?>'"><i class="fa fa-pencil"></i> Edit</button>
                                    <button type="button" class="btn default"  onclick="window.location.href='<?php echo Router::url(array
                                    ('controller' => 'Roles', 'action' => 'index')) ?>'">Cancel</button>
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