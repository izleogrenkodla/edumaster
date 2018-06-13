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
                <a href="#">Teacher Time Table</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Teacher Time Table</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; View Teacher Time Table
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <?php echo $this->Form->create('TeacherTimeTable', array('class' => 'form-horizontal add','type' => 'file')); ?>
			
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">  Class
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php  echo $this->request->data["AcademicClass"]["CLASS_NAME"];?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Teacher
                                </label>
                                <div class="col-md-9 tooltips">
                                   <?php  echo $this->request->data["User"]["FIRST_NAME"].' '.$this->request->data["User"]["LAST_NAME"];?>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Select Subject
                                </label>
                                <div class="col-md-9 tooltips">
                                   <?php  echo $this->request->data["Subject"]["TITLE"];?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Week Of Day
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php 
		                $weeks = array(
				'1' => 'Monday',
				'2' => 'Tuesday',
				'3' => 'Wednesday',
				'4' => 'Thursday',
				'5' => 'Friday',
				'6' => 'Saturday'
				);
                                echo $weeks[$this->request->data['TeacherTimeTable']['TT_DATE']];?>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Start Time
                                </label>
                                <div class="col-md-9 tooltips">
                                     <?php  echo date(TIMEFORMAT,strtotime($this->request->data["TeacherTimeTable"]["START_TIME"]));?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">End Time
                                </label>
                                <div class="col-md-9 tooltips">
                                     <?php  echo date(TIMEFORMAT,strtotime($this->request->data["TeacherTimeTable"]["END_TIME"]));?> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Narration  </label>
                                <div class="col-md-9 tooltips">
                                   <?php  echo $this->request->data["TeacherTimeTable"]["NARRATION"];?>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                    <!--/row-->
                </div>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
								<a href="<?php echo Router::url(array("action"=>"index")); ?>" class="btn default">Go Back</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
        </div>
    </div>

</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>