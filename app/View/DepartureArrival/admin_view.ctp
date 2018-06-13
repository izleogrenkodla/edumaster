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
                        <a href="#">Departure Arrival</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">View Departure Arrival</a>
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
                            <span aria-hidden="true" class="icon-user"></span>&nbsp; View Departure Arrival
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php echo $this->Form->create('DepartureArrival', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
                       
                        <div class="form-body" >
							<div class="row">
							    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Vehicle Shift</label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $dep['VehicleShift']['VEHICLE_SHIFT_TYPE'];?>
                                        </div>
										
                                    </div>
                                </div> 
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Vehicle Number
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $dep['Vehicle']['VEHICLE_NUMBER']; ?>
                                        </div>
										
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Departure Time
                                        </label>
                                        <div class="col-md-9 tooltips">
                                         <?php  echo date(TIMEFORMAT,strtotime($dep['DepartureArrival']['DEPARTURE_TIME'])); ?>
                                        </div>
										
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Arrival Time
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo date(TIMEFORMAT,strtotime($dep['DepartureArrival']['ARRIVAL_TIME'])); ?>
                                        </div>
										
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Date
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $dep['DepartureArrival']['DATE']; ?>
                                        </div>
										
                                    </div>
                                </div>
							</div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Description:
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $dep['DepartureArrival']['DESCRIPTION']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="button" class="btn default" onclick="window.history.back();">Back</button>
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