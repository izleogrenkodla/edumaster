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
                <a href="#">Notice</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View All Notice</a>
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
        <span aria-hidden="true" class="icon-users"></span>View All Notice
    </div>
	<?php if(in_array($authUser["ROLE_ID"],array(TEACHER_ID))) { ?>
			<div class="btn-group pull-right">
						<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
						Actions <i class="fa fa-angle-down"></i>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li>
								<a href="<?php echo Router::url(array("controller"=>"NoticeBoard","action"=>"index")) ?>">Inbox</a>
							</li>
							<li>
								<a href="<?php echo Router::url(array("controller"=>"NoticeBoard","action"=>"teachers")) ?>">Outbox</a>
							</li>
						</ul>
					</div>
	<?php } ?>				
</div>
<div class="portlet-body">
   
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    <th>
        Notice Title
    </th>
    <th>
        Notice Description
    </th>
	<th width="100">
        Action
    </th>
</tr>
</thead>
<tbody>
<?php if(count($notices) > 0): ?>
    <?php foreach($notices as $key=>$notice) { ?>

        <tr>
            <td><?php echo $key+1; ?></td>

            <td><?php echo $notice['NoticeBoard']['NOTICE_TITLE']; ?></td>
            <td><?php echo $notice['NoticeBoard']['NOTICE_DESC']; ?></td>
			<td>
			<a href="<?php echo Router::url(array('controller' => 'NoticeBoard',
                    'action' => 'view', $notice['NoticeBoard']['NOTICE_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-eye"></i></a>
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
                            