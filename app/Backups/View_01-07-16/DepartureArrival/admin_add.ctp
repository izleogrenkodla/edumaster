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
            <li class="btn-group">
                <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                    <span>Actions</span><i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'DepartureArrival', 'action' => 'index')) ?>">View All Departure Arrival</a>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'DepartureArrival', 'action' => 'add')) ?>">Add New Departure Arrival</a>
                    </li>
                </ul>
            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Departure Arrival</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Departure Arrival</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp;Add Departure Arrival
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('DepartureArrival', array('class' => 'form-horizontal add', 'id' => 'DepartureArrival')); ?>
                <div class="form-body">
                    <div class="row">
         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Vehicle Shift<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('SHIFT_ID', array('options' => $shift,
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' , 'onchange' => 'select()' ,'id'=>'role','onchange' => 'showOptions(this)')); ?>	
                                </div>
                            </div>
                        </div>
						 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Vehicle<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('VEHICLE_ID', array('options' => $vehicle,
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' , 'onchange' => 'select()' ,'id'=>'role','onchange' => 'showOptions(this)')); ?>	
                                </div>
                            </div>
                        </div>
						
						
						 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Date<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('DATE', array('type' => 'text', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control date-picker','readonly'=>"readonly", 'placeholder' => 'Example :- ( 25/12/2016 )')); ?>
                                        </div>
                            </div>
                        </div>
						
						
						
                       <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Departure Time<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('DEPARTURE_TIME', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','readonly'=>'readonly')); ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Arrival Time<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('ARRIVAL_TIME', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','readonly'=>'readonly')); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
						<div class="form-group">
                                <label class="control-label col-md-3">Description<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('DESCRIPTION', array('type' => 'textarea','id' => 'textarea',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1','maxlength' => '160' ,'class' => '8', 'rows' => '5' , 'data-error-container' => '#editor2_error')); ?>
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
	$('#DepartureArrivalDEPARTURETIME,#DepartureArrivalARRIVALTIME').timepicker({ 'step': 15 });
});
</script>
