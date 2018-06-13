<script src="http://maps.google.com/maps/api/js?key=AIzaSyBi7e8AiTyqWiFt9vlbGqsAzGyRhVWqCsk&sensor=true"></script>
<script src="<?php echo ASSETS_URL; ?>gmaps/gmaps.js"></script>
<div class="page-content-wrapper">
<div class="page-content">
<div class="row">
    <div class="col-md-12">
        <!-- BEGIN PAGE TITLE & BREADCRUMB-->
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth'); ?>
        <ul class="page-breadcrumb breadcrumb">
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Transports</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View</a>
            </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="row">
<div class="col-md-12">
<div class="tabbable tabbable-custom boxless tabbable-reversed">

        <div class="portlet box blue-madison">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa icon-user"></i>Transport View
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                    <div class="form-body">
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Vehicle:
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $data["Transport"]["VEHICLE"];
                                    ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Vehicle #:
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                     echo $data["Transport"]["VEHICLE_NUMBER"];
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Source:
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $data["Transport"]["VEHICLE_FROM"];
                                    ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Destination:
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                     echo $data["Transport"]["VEHICLE_END"];
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>
					
                    <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Driver Name:
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $data["Driver"]["FIRST_NAME"].' '.$data["Driver"]["MIDDLE_NAME"].' '.$data["Driver"]["LAST_NAME"];
                                    ?>
                                </div>
                            </div>
                        </div>
					 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Driver Contact #:
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $data["Driver"]["MOBILE_NO"];
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
		</div>
                    
               
            </div>
        </div>
		<div class="portlet box blue-madison">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-map-marker"></i>Direction Navigator
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                    <div class="form-body">
                    <div class="row">
					<div class="col-md-6">
					<div class="portlet box blue-madison">

						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Graphic view
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body">
    						<div id="map" class="gmaps"></div>
						</div>
					</div>
					<!-- END BASIC PORTLET-->
				</div>
				<div class="col-md-6">
					<input type="button" id="start_travel"  style="background:#CD2011;color:#FFFFFF;border:#CD2011;" value="Start Route" />

<ul id="instructions"></ul>
					<!-- END BASIC PORTLET-->
				</div>
				
			</div>
                    </div>
                    
                <!-- END FORM-->
            </div>
        </div>

</div>
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>

<script type="text/javascript">
var map;
	$(document).ready(function () {
			map = new GMaps({
			  div: '#map',
			   lat: 22.3071588,
        lng: 73.1812187
		});	
		$("#start_travel").trigger("click");
		
		   $('#start_travel').click(function(e){
        e.preventDefault();
        map.travelRoute({
          origin: [<?php echo $from_lat ?>, <?php echo $from_long; ?>],
          destination: [<?php echo $end_lat; ?>, <?php echo $end_long; ?>],
          travelMode: 'driving',
          step: function(e){
            $('#instructions').append('<li>'+e.instructions+'</li>');
            $('#instructions li:eq('+e.step_number+')').delay(450*e.step_number).fadeIn(200, function(){
              map.setCenter(e.end_location.lat(), e.end_location.lng());
              map.drawPolyline({
                path: e.path,
                strokeColor: '#131540',
                strokeOpacity: 0.6,
                strokeWeight: 6
              });
            });
          }
        });
      });  
	});
</script>