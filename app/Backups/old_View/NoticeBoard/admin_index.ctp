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

    <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,TEACHER_ID,HR_ID,ACCOUNT_ID,SUPERVISOR_ID))) { ?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'NoticeBoard','action' => 'add')) ?>" class="btn
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
        Notice Title
    </th>
    <th>
        Notice Description
    </th>
    <th style="width: 185px;">
        Action
    </th>
    
</tr>
</thead>
<tbody>
<?php 

if(count($notices) > 0): ?>
    <?php foreach($notices as $key=>$notice) { ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $notice['NoticeBoard']['NOTICE_TITLE']; ?></td>
            <td><?php echo $notice['NoticeBoard']['NOTICE_DESC']; ?></td>
            <td class="text-center">
            
                <?php if(!in_array($authUser["ROLE_ID"],array(STUDENT_ID))) { ?>
                <a href="javascript:void(0);" class="tooltips btn" data-toggle="modal" onclick="showModal('<?php echo $notice["NoticeBoard"]["NOTICE_ID"]; ?>');"  title="Sent Message" data-container="body" data-placement="top" data-html="true" data-original-title="Delete"   >
                    <i class="fa fa-envelope"></i></a> | <?php } ?>
                    <a href="<?php echo Router::url(array('controller' => 'NoticeBoard',
                    'action' => 'view', $notice['NoticeBoard']['NOTICE_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true" title="View Message"
                   data-original-title="Delete">
                    <i class="fa fa-eye"></i></a>
                
            </td>
            <?php } ?>
        </tr>

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

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade noticemodal" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Notice Board Info</h4>
      </div>
      <div class="modal-body">
        
		
		
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script>

function remove_record(x) {
	if(confirm("Are you sure want to remove this ?")) { 
		window.location.href = x;
	}
}

function showModal(h) {
		$.ajax({  
		  async: true,
			dataType: "html",
			success: function(data,textStatus){
				var tmp = jQuery.parseJSON(data);
				$("#myModal").find(".modal-body").html(tmp.html);
				$(".noticemodal").modal('show');
			},
			type: "post",
			url: REQUEST_URL+"NoticeBoard/getNoticeInfo/"+h
        });
		
}
</script>
                            