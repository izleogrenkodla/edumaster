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
                        <a href="#">Homework</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Edit Homework</a>
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
                            <span aria-hidden="true" class="icon-user"></span>&nbsp; Edit Homework
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <?php echo $this->Form->create('Homework', array('class' => 'form-horizontal add','type' => 'file')); ?>
                        <?php echo $this->Form->input("HW_ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"> Select Class<span class="required">
										* </span>
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('CLASS_ID', array('options' => $classes, 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me')); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"> Select Subject<span class="required">
										* </span>
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('SUBJECT_ID', array('options' => $subjects, 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me')); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Select Date<span class="required">
										* </span>
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('DATE', array('type' => 'text', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control date-picker','placeholder'=>"Please provide Date")); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Select Submission Date<span class="required">
										* </span>
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('SUBMISSION_DATE', array('type' => 'text', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control date-picker','placeholder'=>"Please provide Date")); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Narration<span class="required">
										* </span></label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('DESCRIPTION', array('type' => 'textarea',
                                                'label' => FALSE_VALUE,
                                                'rows'=>2,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder'=>"Please provide Narration ")); ?>
                                        </div>
                                    </div>
                                </div>

                                <?php

                                $status = array(
                                    'Done' => 'Done',
                                    'Not Done' => 'Not Done',
                                )

                                ?>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3"> Status<span class="required">
										* </span>
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('STATUS', array('options' => $status, 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me')); ?>
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
                                        <button type="submit" class="btn bg-blue-chambray">Submit</button>
                                        <a href="<?php echo Router::url(array("action"=>"index")); ?>" class="btn default">Cancel</a>
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
<script>
    $(document).ready(function(){
        $('#TeacherTimeTableENDTIME,#TeacherTimeTableSTARTTIME').timepicker({ 'step': 15 });
    });
</script>