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
                <a href="#">Exam Result</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">All Exam Result</a>
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
        <span aria-hidden="true" class="icon-users"></span>All Exam Result
    </div>
</div>
<div class="portlet-body">

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th style="width: 100px;">
        Sr. No.
    </th>
    <th>
		Exam
    </th>
	<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
    <th style="width: 200px;">
        Action
    </th>
	<?php } ?>
    
</tr>
</thead>
<tbody>
<?php 

if(count($Examtypelist) > 0): ?>
    <?php foreach($Examtypelist as $key=>$list) { ?>
        <tr>
            <td class="text-center"><?php echo $key+1; ?></td>
            <td><?php echo $list['ExamType']['TITLE']; ?></td>
            <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
			<td class="text-center">
			
			<a href="<?php echo Router::url(array('controller' => 'ExamList',
                    'action' => 'result', $list['ExamList']['EXAM_TYPE_ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Generate Result">
                    <i class="fa fa-check-square"></i></a>        
            </td>
			<?php } ?>
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
                            