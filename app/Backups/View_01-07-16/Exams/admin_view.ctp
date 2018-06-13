<link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL ?>/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>

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
                <a href="#">Exams</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Exam Result</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; View Exam Result
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('Exam', array('class' => 'form-horizontal add', 'type' => 'file')); ?>
                <div class="form-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Class<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $this->Form->input('CLASS_ID', array('options' => $AcademicClass, 'default' => '', 'class' => 'form-control select2me','disabled'=>true, 'label' => FALSE_VALUE,'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Supervisor<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $this->Form->input('SUPERVISOR_ID', array('options' => $supervisor, 'default' => '', 'class' => 'form-control select2me','disabled'=>true, 'label' => FALSE_VALUE,'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Start Date<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $this->Form->input('START_DATE', array('type' => 'text', 'default' => '', 'class' => 'form-control date-picker','readonly'=>"readonly",'disabled'=>true, 'label' => FALSE_VALUE,'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">End Date<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $this->Form->input('END_DATE', array('type' => 'text', 'default' => '', 'class' => 'form-control date-picker','readonly'=>"readonly",'disabled'=>true, 'label' => FALSE_VALUE,'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Exam Type<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $this->Form->input('EXAM_TYPE_ID', array('options' => $exam_types, 'default' => '', 'class' => 'form-control select2me','disabled'=>true,'label' => FALSE_VALUE,'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Student<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $this->Form->input('STUDENT_ID', array('options' => $students, 'default' => '', 'class' => 'form-control select2me','label' => FALSE_VALUE,'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Result Publish on<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $this->Form->input('PUBLISH_DATE', array('type' => 'text', 'default' => '', 'class' => 'form-control date-picker','readonly'=>true,'label' => FALSE_VALUE,'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select File
                                </label>
                                <div class="col-md-9 tooltips">
                                   <div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
												</div>
												<div>
													<span class="btn default btn-file">
													<span class="fileinput-new">
													Select image </span>
													<span class="fileinput-exists">
													Change </span>
													<?php  echo $this->Form->input('RESULT_UPLOAD', array('type' => 'file', 'default' => '', 'class' => 'form-control','label' => FALSE_VALUE,'div' => FALSE_VALUE));  ?>
													
													</span>
													<a href="#" class="btn red fileinput-exists" data-dismiss="fileinput">
													Remove </a>
												</div>
											</div>
								   <div class="clearfix margin-top-10">
												<span class="label label-danger">
												NOTE! </span>
												<strong>
												&nbsp; if you choose upload result instead of enter marks  then it will consider only uploaded result will display only uploaded result, Also Image preview only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and Opera11.1+. In older browsers the filename is shown instead.  </strong>
											</div>
									<strong>
									<?php echo 'Allowed Extention: '.ALLOWED_EXT; ?>
									</strong>		
                                </div>
                            </div>
                        </div>
						
                    </div>
                    <!--/row-->
                </div>
            <!-- END FORM-->
        </div>
    </div>
	<div class="portlet box blue-madison">
        <div class="portlet-title">
            <div class="caption">
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Subjects Listing
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('ExamXref', array('class' => 'form-horizontal add', 'type' => 'file')); ?>
                <div class="form-body">
					<div class="row">
						<div class="col-md-9">
                            
                                <div class="col-md-3 tooltips">
                                   <strong> Subject</strong>
                                </div>
								<div class="col-md-3 tooltips">
                                    <strong>Exam Date</strong>
                                </div>
								<div class="col-md-3 tooltips">
                                    <strong>Total Marks</strong>
                                </div>
								<div class="col-md-3 tooltips">
                                    <strong>Total Marks</strong>
                                </div>
                        </div>	
					</div>
					<br />
                    <?php foreach($exam_xref as $exam) {   $nameprefix = $exam["ExamXref"]["EX_REF_ID"].']';?>
					<div class="row">
                        <div class="col-md-9">
                                <div class="col-md-3">
                                    <?php echo $exam["Subject"]["TITLE"]; ?>
                                </div>
                                <div class="col-md-3">
                                    <?php
									$exam["ExamXref"]["EX_DATE"] = $this->General->dbfordate($exam["ExamXref"]["EX_DATE"]);
									if($exam["ExamXref"]["EX_DATE"]=='31/12/1969') {
										 $exam["ExamXref"]["EX_DATE"]= '';
									}
                                    echo $this->Form->input($nameprefix.'[EX_DATE]', array('type' => 'text','readonly'=>'readonly', 'default' => '', 'class' => 'form-control', 'label' => FALSE_VALUE,'readonly'=>'readonly','div' => FALSE_VALUE,"value"=>$exam["ExamXref"]["EX_DATE"]));
                                   
                                    echo $this->Form->input($nameprefix.'[EX_REF_ID]', array('type' => 'hidden', 'default' => '', 'class' => 'form-control','readonly'=>'readonly', 'label' => FALSE_VALUE,'value' => $exam["ExamXref"]["EX_REF_ID"]));
                                    ?>
									
                                </div>
                                <div class="col-md-3">
                                    <?php
                                    echo $this->Form->input($nameprefix.'[TOTAL_MARKS]', array('type' => 'text', 'default' => '', 'class' => 'form-control', 'label' => FALSE_VALUE,'div' => FALSE_VALUE,'value' => $exam["ExamXref"]["TOTAL_MARKS"],'readonly'=>'readonly'));
                                    ?>
                                </div>
								<div class="col-md-3">
                                    <?php
                                    echo $this->Form->input($nameprefix.'[MARKS]', array('type' => 'text', 'default' => '', 'class' => 'form-control', 'label' => FALSE_VALUE,'div' => FALSE_VALUE));
                                    ?>
                                </div>
                        </div>
                    </div>
					<br />
					<?php } ?>
                    
                </div>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn bg-blue-chambray">Update</button>
                                <button type="button" class="btn default" onclick="window.location.href='<?php echo Router::url(array("controller"=>"Exams","action"=>"index")); ?>'">Cancel</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
            </form>
		</form>	
            <!-- END FORM-->
        </div>
    </div>

</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<script type="text/javascript" src="<?php echo ASSETS_URL; ?>/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js"></script>