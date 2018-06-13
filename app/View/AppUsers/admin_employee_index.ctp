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
                        <a href="<?php echo Router::url(array('controller' => 'Users',
                            'action' => 'add')) ?>">Add New</a>
                    </li>
                </ul>
            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Employee</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View All Employees</a>
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
        <span aria-hidden="true" class="icon-users"></span>View All Employees
    </div>
</div>
<div class="portlet-body">
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
       User Name
    </th>
    <th>
       Email-ID
    </th>
    <th>
        Full Name
    </th>
    <th>
        Role Name
    </th>
    <th>
        Status
    </th>
    <th style="width: 185px;">
        Action
    </th>
</tr>
</thead>
<tbody>
<?php //pr($AppUsers);die;?>
<?php if(count($AppUsers) > 0): ?>
    <?php foreach($AppUsers as $user) { ?>
        <tr>
            <td><a href="<?php echo Router::url(array('controller' => 'AppUsers', 'action' => 'edit', $user['AppUser']['id'],
                ))?>"><?php echo $user['AppUser']['id']; ?></td>
            <td><?php echo $user['AppUser']['email_id']; ?></td>
            <td><?php echo $this->General->first_letter_capitalized
                    ($user['AppUser']['first_name']. ' '.$user['AppUser']['last_name']); ?></a></td>
            <td><?php echo $user['Role']['role_name']; ?></td>
            <td class="text-center">
            <?php if($user['AppUser']['role_id'] != 1) { ?>
                <?php if($user['AppUser']['status']) { ?>
                    <button type="button" class="btn green tooltips" data-container="body" data-placement="top" data-html="true" data-original-title="Click To Inactive" onclick="changed_status(this, '<?php echo Router::url(array('controller' => 'AppUsers', 'action' => 'changed_status', $user['AppUser']['id'],
                    ))?>');" data-mode="0">Active</button>
                <?php } else { ?>
                    <button type="button" class="btn red tooltips" data-container="body" data-placement="top" data-html="true" data-original-title="Click To Active" onclick="changed_status(this, '<?php echo Router::url(array('controller' => 'AppUsers', 'action' => 'changed_status', $user['AppUser']['id'],
                    ))?>');" data-mode="1">Inactive</button>
                <?php } ?>
              <?php } ?>  
            </td>
            <td class="text-center">
                <a href="<?php echo Router::url(array('controller' => 'AppUsers',
                    'action' => 'view', $user['AppUser']['id'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="View">
                    <i class="fa fa-search"></i></a>

                <a href="<?php echo Router::url(array('controller' => 'AppUsers',
                    'action' => 'edit', $user['AppUser']['id'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>
		<?php if($user['AppUsers']['role_id'] != 1) { ?>
                <a href="<?php echo Router::url(array('controller' => 'AppUsers',
                    'action' => 'delete', $user['AppUser']['id'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Delete">
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
<!-- END EXAMPLE TABLE PORTLET-->
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
                            