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
                <a href="#">Exam Type</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View All Exam Type</a>
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
        <span aria-hidden="true" class="icon-users"></span>View All Exam Type
    </div>
</div>
<div class="portlet-body">

  
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
  


<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
   
    <th>
        Notice Title
    </th>
    <th style="width: 185px;">
        Action
    </th>
    
</tr>
</thead>
<tbody>
<?php 

if(count($listing) > 0): ?>
    <?php foreach($listing as $key=>$list) { ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $list['ExamType']['TITLE']; ?></td>
            <td class="text-center">
            
                
                <a href="<?php echo Router::url(array("action"=>"edit",$list["ExamType"]["EX_TYPE_ID"])) ?>" class="tooltips btn"  title="Edit" data-container="body" data-placement="top" data-html="true" data-original-title="Delete"   >
                    <i class="fa fa-pencil"></i></a> | 
                    <a href="javascript:void(0);" class="tooltips btn"  onclick="remove_record('<?php echo Router::url(array("action"=>"delete",$list["ExamType"]["EX_TYPE_ID"])) ?>')" title="Delete" data-container="body" data-placement="top" data-html="true" data-original-title="Delete"   >
                    <i class="fa fa-trash-o"></i></a>
                
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
                            