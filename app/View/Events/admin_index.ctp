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
                <a href="#">Event</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Event</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Events
    </div>
</div>
<div class="portlet-body form">
	<div class="form-body">
                        <?php /*echo $this->Form->create('Event', array('class' => 'form-horizontal add custom_form',
                            'type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'get')); ?>
							<!--<h3 class="form-section">Event Search Form: </h3>-->
                        <div class="row custom_search_filter">

                            <div class="col-md-12 custom_block">
                                <div class="col-md-7 custom_block">


                                    <label class="control-label flef">Select Class</label>
                                    <?php echo $this->Form->input('CLASS_ID', array('options' =>$class_list,
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me input-small',
                                        'value' => isset($this->request->query['data']['Event']['CLASS_ID']) ? $this->request->query['data']['Event']['CLASS_ID']: '')); ?>
                                    <label class="control-label flef">Date: From</label>
                                    <input type="text" class="form-control form-control-inline date-picker input-small" name="data[Event][from_date]"
                                           value="<?php echo isset($this->request->query['data']['Event']['from_date']) ? $this->request->query['data']['Event']['from_date']
                                               : '' ?>" readonly />
                                </div>
                                <button type="submit" class="btn bg-blue-chambray">Search</button> OR
                                <a href="<?php echo Router::url(array("action"=>"index")); ?>">RESET</a> OR
                                <a href="<?php echo Router::url(array("action"=>"export_events")); ?>"><i class="fa-file-excel-o"></i> Export</a>
                                OR
                                <a href="javascript:void(0)"  onclick="return printme('calendar');"><i class="fa fa-print"></i> Print</a>
                            </div>
                        </div>
                        </form>
						<?php */ ?>
						<?php echo $this->Form->create('Event', array('class' => 'form-horizontal add custom_form',
										'type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'get')); ?>
									<div class="row">
										
										<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
											<div class="form-group no_marbtm">
												<label class="control-label col-md-3">Date: From</label>
												<div class="col-md-9">
													<input type="text" class="form-control form-control-inline date-picker" name="data[Event][from_date]"
																		   value="<?php echo isset($this->request->query['data']['Event']['from_date']) ? $this->request->query['data']['Event']['from_date']
																			   : '' ?>" readonly />
												</div>
											</div>
										</div>
										<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
											<div class="btn_block">
												<button type="submit" class="btn bg-blue-chambray">Search</button>
												<button type="reset" class="btn bg-blue-chambray" onclick="window.location='<?php echo Router::url(array("action"=>"index")); ?>'">Reset</button>
											</div>
										</div>
									</div>
												
									</form>		
										</div>
									</div>
								
                        
  <?php if(in_array($authUser["ROLE_ID"],array(SUPERVISOR_ID))){?>
	<!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
	<a href="<?php echo Router::url(array('action' => 'add')) ?>" class="btn
		green bg-green add_btn"> ADD NEW <i class="fa fa-plus"></i>
	</a>
	<?php  } ?>
	<div id="calendar"></div>
	</div>
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
			editable: true,
			eventLimit: true, 
			  eventClick: function(calEvent, jsEvent){
					$(".modal-title").html(calEvent.title);
					$("#cal_start_date").html(calEvent.view_start);
					$("#cal_end_date").html(calEvent.view_end);
					$("#cal_description").html(calEvent.description);
					$("#cal_edit").attr("href","Events/edit/"+calEvent.id);
					var tmpRemove = "Events/delete/"+calEvent.id;
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