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

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Users','action' => 'add_supervisor')) ?>" class="btn
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
        Father Name
    </th>
    <th>
        Mother Name
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
            <td><?php echo $user['User']['FATHER_NAME']; ?></td>
            <td><?php echo $user['User']['MOTHER_NAME']; ?></td>
            <td><?php echo $user['User']['USERNAME']; ?></td>
            <td><?php echo $user['User']['EMAIL_ID']; ?></td>
            <td><?php echo $user['AcademicClass']['CLASS_NAME']; ?></td>
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
                    'action' => 'view_supervisor', $user['User']['ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-desktop"></i></a>
                
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                <a href="<?php echo Router::url(array('controller' => 'Users',
                    'action' => 'edit_supervisor', $user['User']['ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>
		
                <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'Users','action' => 'delete_supervisor', $user['User']['ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
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
function remove_record(x) {
	if(confirm("Are you sure want to remove this ?")) { 
		window.location.href = x;
	}
}
</script>
                            