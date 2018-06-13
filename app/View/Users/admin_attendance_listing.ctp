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
                <a href="#">Attendance</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View All Attendance</a>
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
        <span aria-hidden="true" class="icon-users"></span>View All Attendance
    </div>
</div>
  <div class="portlet-body form">
<div class="portlet-body">

<div class="form-body">

<?php  if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, SUPERVISOR_ID, TEACHER_ID, STUDENT_ID, ))) { ?>
<?php // if($authUser["ROLE_ID"]==array(ADMIN_ID, TEACHER_ID, STUDENT_ID, SUPERVISOR_ID)) { ?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'StudentAttendance')) ?>" 
			class="btn green bg-green">  Detail View 
            </a>
        </div>
    </div>
<?php } ?>

		<!-- sort_section -->
		<div class="sort_section">
			<div class="btn-group">
				<a class="btn btn-primary tooltips" data-toggle="tooltip" title="Export" href="<?php echo Router::url(array("action"=>"attendance_export")); ?>">
					<i class="fa fa-file-excel-o" aria-hidden="true" title="Export"></i>
				</a>
			</div>
		</div>
		<!-- End: sort_section -->
<br />
<?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID,TEACHER_ID,STUDENT_ID,SUPERVISOR_ID))) { ?>
	<?php echo $this->Form->create("User") ?>
			<div class="row">	
				<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Start Date</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                   <?php echo $this->Form->input('START_DATE', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control date-picker','readonly'=>'readonly' )); ?>	
										
                                </div>
                            </div>
                        </div>
				<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select End Date</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                   <?php echo $this->Form->input('END_DATE', array('type' => 'text',
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control date-picker','readonly'=>'readonly' )); ?>	
										
                                </div>
                            </div>
                        </div>
			</div>
			<!--<br />-->
			
			<div class="row">
				<?php if(!in_array($authUser["ROLE_ID"], array(STUDENT_ID,TEACHER_ID))) { ?>
				<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Select class</label>
										<div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
										   <?php echo $this->Form->input('CLASS_ID', array('options' => $classes,
												'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' )); ?>	
												
										</div>
									</div>
								</div>
								<?php } ?>
				<!--<div class="col-md-6">
                            <div class="col-md-3">
                                <button type="submit"  class="btn bg-blue-chambray">Search</button>
                                <a href="<?php echo Router::url(array("action"=>"attendance_listing")); ?>">RESET</a> OR
                                <a href="<?php echo Router::url(array("action"=>"attendance_export")); ?>"><i class="fa-file-excel-o"></i> Export</a>
                            </div>
                        </div>-->
				<div class="col-md-6">
					<div class="form-group">
						<div class="btn_block">
							<button type="submit"  class="btn bg-blue-chambray">Search</button>
							<button type="reset"  class="btn bg-blue-chambray" onclick="window.location='<?php echo Router::url(array("action"=>"attendance_listing")); ?>'">Reset</button>
							<!--<button type="submit"  class="btn bg-blue-chambray">Search</button>
							<a href="<?php echo Router::url(array("action"=>"attendance_listing")); ?>">RESET</a> OR
							<a href="<?php echo Router::url(array("action"=>"attendance_export")); ?>"><i class="fa-file-excel-o"></i> Export</a>-->
						</div>
					</div>
				</div>			
			</div>
	</form>
	
	<!--<br />
	<div class="row">
		<div class="col-md-3">&nbsp;
		</div>
		<div class="col-md-9">
				<div class="form-group">
					  <div id="jqChart" style="width: 500px; height: 300px;">
				</div>
					
				</div>
				</div>
	</div>
	<br  />-->
	<!-- chart_container -->
	<div class="chart_container">
		<div id="jqChart"></div>
	</div>
	<!-- End: chart_container -->
	 
<?php } ?>	
</div>
</div>
</div>


<!-- END EXAMPLE TABLE PORTLET-->
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<?php if(isset($this->request->data) && is_array($this->request->data)) {  ?>
<script>

    $(document).ready(function () {

            var background = {
                type: 'linearGradient',
                x0: 0,
                y0: 0,
                x1: 0,
                y1: 1,
                colorStops: [{ offset: 0, color: '#d2e6c9' },
                             { offset: 1, color: 'white' }]
            };

            $('#jqChart').jqChart({
                title: { text: 'Attendance Chart' },
                legend: { title: 'Students' },
                border: { strokeStyle: '#6ba851' },
                background: background,
                animation: { duration: 1 },
                shadows: {
                    enabled: true
                },
                series: [
                    {
                        type: 'pie',
                        fillStyles: ['<?php echo PRESENT_COLOR; ?>', '<?php echo ABSENT_COLOR; ?>' ],
                        labels: {
                            stringFormat: '%.1f%%',
                            valueType: 'percentage',
                            font: '15px sans-serif',
                            fillStyle: 'white'
                        },
                        explodedRadius: 10,
                        explodedSlices: [5],
                        data: [['<?php echo PRESENT_TEXT  ?>', '<?php echo $TotalPresent; ?>'], ['<?php echo ABSENT_TEXT  ?>', '<?php echo $TotalAbsent; ?>']]
                    }
                ]
            });
        });

</script>	

<?php } ?>