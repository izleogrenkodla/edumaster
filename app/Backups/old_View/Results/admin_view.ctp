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
                <a href="#">Result</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Result </a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; View Result
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('Result', array('class' => 'form-horizontal', 'type' => 'get')); ?>
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Class
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $this->request->data["Exam"]["AcademicClass"]["CLASS_NAME"];
                                    ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Supervisor
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php 
                                    echo $this->request->data["Exam"]["Supervisor"]["FIRST_NAME"].' '.$this->request->data["Exam"]["Supervisor"]["MIDDLE_NAME"].' '.$this->request->data["Exam"]["Supervisor"]["LAST_NAME"];
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Start Date
                                </label>
                                <div class="col-md-9 tooltips">
                                     <?php
                                    echo $this->General->dbfordate($this->request->data["Exam"]["START_DATE"]);
                                    ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">End Date
                                </label>
                                <div class="col-md-9 tooltips">
                                     <?php
                                    echo $this->General->dbfordate($this->request->data["Exam"]["END_DATE"]);
                                    ?>

                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Result Type
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $this->request->data["Exam"]["ExamType"]["TITLE"];
                                    ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Student
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                  echo $this->request->data["Student"]["FIRST_NAME"].' '.$this->request->data["Student"]["MIDDLE_NAME"].' '.$this->request->data["Student"]["LAST_NAME"];
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Result Publish on
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                     echo $this->General->dbfordate($this->request->data["Result"]["PUBLISH_DATE"]);
                                    ?>
                                </div>
                            </div>
                        </div>
						<?php if(isset($this->request->data["Result"]["RESULT_UPLOAD"]) &&  $this->request->data["Result"]["RESULT_UPLOAD"]!='') {  ?>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select File
                                </label>
							    <div class="col-md-9 tooltips">
                                   <div class="fileinput fileinput-new" data-provides="fileinput">
												<div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
												
												<img src="<?php echo $this->request->data["Result"]["RESULT_UPLOAD"]; ?>" width="200" />
												
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
						<?php } ?>
						
                    </div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Result Status
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $this->General->GetResultStatus($this->request->data["Result"]["EXAM_STATUS"]);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</form>	
        </div>
    </div>
	
	<?php if(isset($this->request->data["Result"]["RESULT_UPLOAD"]) && $this->request->data["Result"]["RESULT_UPLOAD"]=='') {  ?>
	<div class="portlet box blue-madison">
        <div class="portlet-title">
            <div class="caption">
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Subjects Marks
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
          
                <div class="form-body">
					<div class="row">
						<div class="col-md-12">
                            
                                <div class="col-md-2 tooltips">
                                   <strong> Subject</strong>
                                </div>
								<div class="col-md-2 tooltips">
                                    <strong>Result Date</strong>
                                </div>
								<div class="col-md-2 tooltips">
                                    <strong>Total Marks</strong>
                                </div>
								<div class="col-md-2 tooltips">
                                    <strong>Achived Marks</strong>
                                </div>
								<div class="col-md-2 tooltips">
                                    <strong>Status</strong>
                                </div>
                        </div>	
					</div>
					<br />
                    <?php 
						$totalMarks = 0;
						$totalget = 0;
					foreach($Result_xref as $Result) {   $nameprefix = $Result["ResultXref"]["EX_REF_ID"].']';
						$totalget = $totalget+$Result["ResultXref"]["MARKS"];
						$totalMarks = $totalMarks+$Result["ExamXref"]["TOTAL_MARKS"];
					?>
					<div class="row">
                        <div class="col-md-12">
                                <div class="col-md-2">
                                    <?php echo $Result["ExamXref"]["Subject"]["TITLE"]; ?>
                                </div>
                                <div class="col-md-2">
                                    <?php
									$Result["ExamXref"]["EX_DATE"] = $this->General->dbfordate($Result["ExamXref"]["EX_DATE"]);
									if($Result["ExamXref"]["EX_DATE"]=='31/12/1969') {
										 $Result["ExamXref"]["EX_DATE"]= '';
									}
                                    echo $Result["ExamXref"]["EX_DATE"];
                                    ?>
									
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    echo $Result["ExamXref"]["TOTAL_MARKS"];
                                    ?>
                                </div>
								<div class="col-md-2">
                                    <?php
                                    echo $Result["ResultXref"]["MARKS"];
                                    ?>
                                </div>
								<div class="col-md-2">
                                    <?php
                                    echo $this->General->GetResultStatus($Result["ResultXref"]["SUBJECT_STATUS"]);
                                    ?>
                                </div>
                        </div>
                    </div>
					<br />
					<?php } ?>
					<div class="row">
                        <div class="col-md-12">
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    <strong>Total</strong>
									
                                </div>
                                <div class="col-md-2">
                                    <strong><?php
                                    echo $totalMarks;
                                    ?></strong>
                                </div>
								<div class="col-md-2">
                                    <strong><?php
                                    echo $totalget;
                                    ?></strong>
                                </div>
                        </div>
                    </div>
                </div>
				
		</form>	
            <!-- END FORM-->
        </div>
    </div>
<?php  } ?>

<div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="button" class="btn default" onclick="window.location.href='<?php echo Router::url(array("controller"=>"Results","action"=>"index")); ?>'">Go Back</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<script>
$(document).ready(function(){
	$("#ResultSTUDENTID").change(function(){
		if($(this).val().length>0) { 
			$("#ResultAdminViewForm").submit();
		}
	});
})
</script>