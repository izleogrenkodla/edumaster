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
                <a href="#">Exam</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Exams</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Exam 
    </div>
</div>
<div class="portlet-body">
	<div id="calendar"></div>
</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
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
	  	   <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
		<div style="float:right;"><a href="" id="cal_edit">Edit</a> | <a id="cal_del" href="">Delete</a></div>
		<?php } ?>
        <div><strong>Start Date</strong>: <span id="cal_start_date"></span> | <strong>End Date</strong>: <span id="cal_end_date"></span></div>
		<div id="cal_description"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script>

	$(document).ready(function() {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,basicWeek,basicDay'
			},
			defaultDate: '2015-02-12',
			editable: false,
			eventLimit: true, 
/*			eventClick: function(calEvent, jsEvent){
					$(".modal-title").html(calEvent.title);
					$("#cal_start_date").html(calEvent.view_start);
					$("#cal_end_date").html(calEvent.view_end);
					$("#cal_description").html(calEvent.description);
					$("#cal_edit").attr("href","Events/edit/"+calEvent.id);
					var tmpRemove = "Events/delete/"+calEvent.id;
					$("#cal_del").attr("onClick",'remove_record("'+tmpRemove+'")');
					$("#cal_del").attr("href","javascript:void(0)");
					$('#CalenderModal').modal('show');
        },*/
			events: <?php echo json_encode($listing);  ?>
		});
		
	});
	
	function remove_record(x) {
	if(confirm("Are you sure want to remove this ?")) { 
		window.location.href = x;
	}
}
</script>