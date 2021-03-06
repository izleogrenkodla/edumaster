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
	
	
	 <?php if(in_array($authUser["ROLE_ID"],array(TEACHER_ID,HR_ID,ACCOUNT_ID,SUPERVISOR_ID))) { ?>
	<div class="btn-group pull-right">
						<button type="button" class="btn btn-fit-height grey-salt dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
						Actions <i class="fa fa-angle-down"></i>
						</button>
						<ul class="dropdown-menu pull-right" role="menu">
							<li>
								<a href="<?php echo Router::url(array("controller"=>"NoticeBoard","action"=>"teachers")) ?>">Inbox</a>
							</li>
							<li>
								<a href="<?php echo Router::url(array("controller"=>"NoticeBoard","action"=>"index")) ?>">Outbox</a>
							</li>
						</ul>
					</div>
					<?php } ?> 
</div>



<div class="portlet-body">
							<div class="panel-group accordion" id="accordion1">
								<?php if(count($notices) > 0):
								//pr($notices);die;
								foreach($notices as $key=>$notice) { ?>
							
								<div class="panel panel-default">
									<div class="panel-heading" style="padding:5px;">
										<div class="task-title-sp" >
										<a class="accordion-toggle collapsed" style="text-decoration:none;color:#000000;" data-toggle="collapse" data-parent="#accordion1" href="#collapse_<?php echo $notice["NoticeBoardXref"]["ID"]; ?>">
										<span class="label label-sm label-danger">
										<?php echo $this->General->dbfordate($notice['NoticeBoard']['created']); ?> </span>
										&nbsp;
										<span class="label label-sm label-success">
										<?php echo $notice['UserFrom']['FIRST_NAME'].' '.$notice['UserFrom']['LAST_NAME']; ?> </span>
										 &nbsp; <?php echo $notice['NoticeBoard']['NOTICE_TITLE']; ?>
										<?php echo $notice['NoticeBoard']['NOTICE_TITLE']; ?> 
										
										</a>
										
										</div>
									</div>
									<div id="collapse_<?php echo $notice["NoticeBoardXref"]["ID"]; ?>" class="panel-collapse collapse" style="height: 0px;">
										<div class="panel-body">
											<!--Subject : - <?php echo $notice['NoticeBoard']['NOTICE_TITLE']; ?> <br /><br />-->
											<?php echo $notice['NoticeBoard']['NOTICE_DESC']; ?> <br /><br />
										</div>
									</div>
								</div>
								
								<?php } ?>
								
								<?php endif; ?>
							</div>
						

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
                            