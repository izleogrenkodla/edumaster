<div class="page-content-wrapper">
<div class="page-content">
<div class="row">
    <div class="col-md-12">
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Classwork</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Classwork</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; View Classwork
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
		<?php  if($user_role==TEACHER_ID) { ?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Classwork','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
	<?php } ?>

          <div id="calendar"></div>
        </div>
    </div>

</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<div class="modal fade" id="CalenderModal" style="display:none;">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" ></h4>
      </div>
      <div class="modal-body">
	   <?php if($authUser["ROLE_ID"]==TEACHER_ID) { ?>
		<div style="float:right;"><a href="" id="cal_edit">Edit</a> | <a id="cal_del" href="">Delete</a></div>
		<?php } ?>
	  <p>
        	<strong>Date</strong>: <span id="cal_start_date"></span> | <strong>Subject</strong>: <span id="cal_subject"></span>
	  </p>
	  <p>
        	<strong>Start Time</strong>: <span id="cal_start_time"></span> | <strong>End Time</strong>: <span id="cal_end_time"></span>
	  </p>
		
		<strong>Description: </strong>
		<div id="cal_description"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: '2015-08-12',
			editable: true,
			eventLimit: true,
			eventLimit: true, 
			  eventClick: function(calEvent, jsEvent){
					$(".modal-title").html(calEvent.title);
					$("#cal_start_date").html(calEvent.cw_date);
					$("#cal_description").html(calEvent.description);
					$("#cal_start_time").html(calEvent.start_time);
					$("#cal_end_time").html(calEvent.end_time);
					$("#cal_subject").html(calEvent.subject);
					$("#cal_edit").attr("href","Classwork/edit/"+calEvent.id);
					var tmpRemove = "Classwork/delete/"+calEvent.id;
					$("#cal_del").attr("onClick",'remove_record("'+tmpRemove+'")');
					$("#cal_del").attr("href","javascript:void(0)");
					$('#CalenderModal').modal('show');
        },
			events: <?php echo json_encode($listing);  ?>
		});
		
	});
	
	function remove_record(x) {
	if(confirm("Are you sure want to remove this ?")) { 
		window.location.href = x;
	}
}
</script>