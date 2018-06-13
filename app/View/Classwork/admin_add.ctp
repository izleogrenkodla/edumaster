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
                <a href="#">Add Classwork</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Add Classwork
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('Classwork', array('class' => 'form-horizontal add' , 'type' => 'file')); ?>
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Class<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('CLASS_ID', array('options' => $AcademicClass, 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me')); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Subject<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('SUBJECT_ID', array('options' => $Subject, 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Start Time<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('START_TIME', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','readonly'=>'readonly')); ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">End Time<span class="required">*</span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('END_TIME', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','readonly'=>'readonly')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Select Date<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('CW_DATE', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1','readonly'=>"readonly", 'class' => 'form-control date-picker','placeholder'=>"Example :- ( 12/08/2015 )")); ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Narration<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('NARRATION', array('type' => 'textarea', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="row">
						 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Upload Photo <span class="required">* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Upload Profile Photo">
                                    <?php echo $this->Form->input('UPLOAD_IMAGE', array('type' => 'file', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
										<?php echo $this->General->uploadfilenotes(); ?>
                                </div>
                            </div>
                         </div>
					</div>
					
                </div>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn bg-blue-chambray">Submit</button>
                                <button type="button" class="btn default" onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Cancel</button>
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
	$('#ClassworkSTARTTIME,#ClassworkENDTIME').timepicker({ 'step': 15 });
});
</script>