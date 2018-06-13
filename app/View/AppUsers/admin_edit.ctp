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
            <li class="btn-group">
                <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                    <span>Actions</span><i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'index')) ?>">View All</a>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'add')) ?>">Add New</a>
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
                <a href="#">Edit User</a>
            </li>
        </ul>
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth'); ?>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-12">

<div class="portlet box blue-madison">
<div class="portlet-title">
    <div class="caption">
        <span aria-hidden="true" class="icon-user"></span>  Edit User
    </div>
    <div class="tools">
        <a href="javascript:void(0);" class="collapse">
        </a>
    </div>
</div>
<div class="portlet-body form">
    <!-- BEGIN FORM-->
    <?php echo $this->Form->create('User', array('class' => 'form-horizontal add', 'id' => 'Form',
    'type' => 'file')); ?>
    <?php echo $this->Form->input("id", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>

    <div class="form-body">
        <h3 class="form-section">Person Info</h3>
        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
            The user could not be saved. Please, try again.
        </div>
        <div class="alert alert-success display-hide">
            <button class="close" data-close="alert"></button>
            The user has been saved.
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">User ID<span class="required">
										* </span>
                    </label>
                    <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                         data-html='true' data-original-title="User ID">
                        <?php echo $this->Form->input('user_id', array('type' => 'text', 'label' => FALSE_VALUE,
                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control',
                        'readonly' => 'readonly')); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Select Role<span class="required">
										* </span>
                    </label>
                    <div class="col-md-9 tooltips"  data-container='body' data-placement='bottom' data-html='true' data-original-title="">
                        <?php
                        echo $this->Form->input('role_id', array('options' => $user_roles, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                            'div' => FALSE_VALUE));
                        ?>
                    </div>
                </div>
            </div>

        </div>
        <!--/row-->
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Password<span class="required">* </span>
                    </label>
                    <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                         data-html='true' data-original-title="Password">
                        <?php echo $this->Form->input('password', array('type' => 'password',
                            'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control', 'Placeholder' => 'Left empty if you don\'t want to change')); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">First Name<span class="required">
										* </span></label>
                    <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                         data-html='true' data-original-title="First Name">
                        <?php echo $this->Form->input('first_name', array('type' => 'text',
                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Last Name<span class="required">
										* </span></label>
                    <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                         data-html='true' data-original-title="Last Name">
                        <?php echo $this->Form->input('last_name', array('type' => 'text',
                            'label' => FALSE_VALUE,
                            'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Middle Name</label>
                    <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                        <?php echo $this->Form->input('middle_name', array('type' => 'text',
                        'label' => FALSE_VALUE,
                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
            <!--/span-->

            <!--/span-->
        </div>
        <!--/row-->
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Contact No.</label>
                    <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                         data-html='true' data-original-title="Contact No.">
                        <?php echo $this->Form->input('contact_no', array('type' => 'text',
                            'label' => FALSE_VALUE,
                            'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Mobile no<span class="required">
										* </span></label>
                    <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                         data-html='true' data-original-title="Mobile No.">
                        <?php echo $this->Form->input('mobile_no', array('type' => 'text',
                        'label' => FALSE_VALUE,
                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                    </div>
                </div>
            </div>
            <!--/span-->

            <!--/span-->
        </div>
        <!--/row-->
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Email ID<span class="required">
										* </span></label>
                    <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                         data-html='true' data-original-title="Email ID">
                        <?php echo $this->Form->input('email', array('type' => 'email',
                            'label' => FALSE_VALUE,
                            'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Gender</label>
                    <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                         data-html='true' data-original-title="Select Gender">
                        <div class="radio-list">
                            <label class="radio-inline">
                                <input type="radio" name="data[User][gender]" value="1"  <?php echo $this->request->data['User']['gender'] == 1 ? "checked" : ""; ?>/>
                                Male </label>
                            <label class="radio-inline">
                                <input type="radio" name="data[User][gender]" value="0"  <?php echo $this->request->data['User']['gender'] == 0 ? "checked" : ""; ?>/>
                                Female </label>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">File input</label>
                    <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                         data-html='true' data-original-title="Upload Profile Photo">
                        <?php /*echo $this->Form->input('file_upload', array('type' => 'file', 'label' => FALSE_VALUE,
                                    'div' => FALSE_VALUE));
                                    */?>
                        <input type="hidden" name="data[User][IsUpload]" class="IsUpload" value="0"/>
                        <input type="file" name="Files[]" id="photoupload"/>
                        <?php if (isset($file_error)): ?>
                            <div class="error-message"><?php echo $file_error; ?></div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label class="control-label col-md-3">Status</label>
                    <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                         data-html='true' data-original-title="Status">
                        <div class="radio-list">
                            <label class="radio-inline">
                                <input type="radio" name="data[User][status]" value="1" <?php echo $this->request->data['User']['status'] == 1 ? "checked" : ""; ?> />
                                Active </label>
                            <label class="radio-inline">
                                <input type="radio" name="data[User][status]" value="0" <?php echo $this->request->data['User']['status'] == 0 ? "checked" : ""; ?> />
                                Inactive </label>
                        </div>
                    </div>
                </div>
            </div>

            <input name="data[User][old_image]" type="hidden"
                   value="<?php if (isset($this->data['User']['image_url'])): echo $this->data['User']['image_url']; endif; ?>"/>
        </div>

        <div class="row">
            <?php if (isset($this->data['User']['image_url']) && $this->data['User']['image_url'] != '') { ?>

                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label col-md-3">Remove Profile Photo?</label>
                        <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                             data-html='true' data-original-title="Upload Profile Photo">
                            <div class="fileupload fileupload-new" data-provides="fileupload">
                                <div class="fileupload-new thumbnail">
                                    <input type="checkbox" name="data[User][IsDelete]" class="IsDelete"/>
                                    <?php echo $this->html->image("/admin/images/view/user/100/*/false/"
                                        . $this->data['User']['id'],
                                        array('alt' => $this->data['User']['first_name'], 'class' => 'inline_elem'));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <?php } ?>
        </div>
        <!--/row-->
    </div>
    <div class="form-actions fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="col-md-offset-3 col-md-9">
                    <button type="submit" class="btn bg-blue-chambray">Submit</button>
                    <button type="button" class="btn default"  onclick="window.location.href='<?php echo Router::url(array
                    ('controller' => 'Users', 'action' => 'index')) ?>'">Cancel</button>
                </div>
            </div>
            <div class="col-md-6">
            </div>
        </div>
    </div>
    </form>
    <!-- END FORM-->
</div>
</div>

</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>