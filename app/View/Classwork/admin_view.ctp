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
                <a href="#">View Classwork</a>
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

<?php
//PR($listing);
//die;
?>

    <div class="portlet box blue-madison">
        <div class="portlet-title">
            <div class="caption">
                <span aria-hidden="true" class="icon-user"></span>View Classwork
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('Classwork', array('class' => 'form-horizontal add')); ?>
                <div class="form-body">
				
					 <div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">TEACHER
									</label>
									<div class="col-md-9 tooltips">
									  <?php echo $listing['User']['FIRST_NAME'].' '.$listing['User']['MIDDLE_NAME'].' '.$listing['User']['LAST_NAME']  ?>
								</div>
							</div>
                        </div>
					 
					 </div>
				
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Class
                                </label>
                                <div class="col-md-9 tooltips">
                                  <?php echo $listing['AcademicClass']['CLASS_NAME']; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Subject
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $listing['Subject']['TITLE']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Start Time
									</span>
                                </label>
                                <div class="col-md-9 tooltips">
                                     <?php echo $listing['Classwork']['START_TIME']; ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">End Time
                                </label>
                                <div class="col-md-9 tooltips">
                                     <?php echo $listing['Classwork']['END_TIME']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Select Date
                                </label>
                                <div class="col-md-9 tooltips">
                                   <?php echo $listing['Classwork']['CW_DATE']; ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Narration
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $listing['Classwork']['NARRATION']; ?>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="row">
						 <div class="col-md-6">
                            <div class="form-group">
							<label class="control-label col-md-3">Photo </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Upload Profile Photo">
                                    
									<?php
										if(isset($listing["Classwork"]["IMAGE_URL"]) && $listing["Classwork"]["IMAGE_URL"]!='') {
											$img = $listing["Classwork"]["IMAGE_URL"];
											$path = SITE_URL . 'files/homework_classwork/'.$img;
											?>
											<div class="preview_container">
											<a href ="<?php echo DOWNLOADURL.HOMEWORK_CLASSWORK.$listing["Classwork"]["IMAGE_URL"] ?>" target = "blank" >
												<img src="<?php echo $path ?>" alt="" />
											</a>
											</div>
									<?php } ?>
									
									
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