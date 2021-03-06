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
                <a href="#">Library User</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View All Library User</a>
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
        <span aria-hidden="true" class="icon-users"></span>View All Library User
    </div>
</div>
<div class="portlet-body">

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Users','action' => 'add_library')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
<?php } ?>	

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
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
    <th style="width: 185px;">
        Action
    </th>
</tr>
</thead>
<tbody>
<?php if(count($users) > 0): ?>
    <?php foreach($users as $key=>$user) { ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $user['User']['FIRST_NAME'].' '.$user['User']['MIDDLE_NAME'].' '.$user['User']['LAST_NAME']; ?></td>
            <td><?php echo $user['User']['USERNAME']; ?></td>
            <td><?php echo $user['User']['EMAIL_ID']; ?></td>
            <td class="text-center"><?php echo $user['User']['MOBILE_NO']; ?></td>
            <td class="text-center">

                <?php if($user['User']['STATUS']) { ?>
                    Active
                <?php } else { ?>
                    Inactive
                <?php } ?>
            </td>
            <td class="text-center">
			
			<a href="<?php echo Router::url(array('controller' => 'Users',
                    'action' => 'library_section', $user['User']['ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="View Dashboard">
                    <i class="fa fa-eye" aria-hidden="true"></i></a>
			
            <a href="<?php echo Router::url(array('controller' => 'Users',
                    'action' => 'view_account', $user['User']['ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-desktop"></i></a>
                    
               <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
				<a href="<?php echo Router::url(array('controller' => 'Users',
                    'action' => 'edit_account', $user['User']['ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>
			
                <a href="javascript:void(0)" onclick="usr_remove('<?php echo Router::url(array('controller' => 'Users',
                    'action' => 'delete_account', $user['User']['ID'],
                ))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
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
<script>
function usr_remove(x) {
	if(confirm("Are you sure ?")) { 
		window.location.href = x;
	}
}
</script>
                            