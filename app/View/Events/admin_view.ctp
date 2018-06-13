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
                                <a href="<?php echo Router::url(array('controller' => 'Events', 'action' => 'index')) ?>">View All Events</a>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('controller' => 'Events', 'action' => 'add')) ?>">Add New Event</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="#">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Event</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">View Events</a>
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
                            <span aria-hidden="true" class="icon-user"></span>&nbsp; View Event
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php echo $this->Form->create('Event', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
                       
                        <div class="form-body" >

                            <div class="row">
                                

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Event Title
                                        </label>
                                        <div class="col-md-9 tooltips">
											<?php echo $EventData['Event']['EVENT_TITLE']; ?>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Class Name:
                                        </label>
                                        <div class="col-md-9 tooltips">
											<?php echo $EventData['AcademicClass']['CLASS_NAME']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Start Date:
                                        </label>
                                        <div class="col-md-9 tooltips">
                                            <?php echo date(DTFRMT,strtotime($EventData['Event']['EVENT_START'])); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">End Date:
                                        </label>
                                        <div class="col-md-9 tooltips">
                                           <?php echo date(DTFRMT,strtotime($EventData['Event']['EVENT_END'])); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Event Description:
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php echo $EventData['Event']['EVENT_DESC']; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Upload Event Photo: </label>
                                      		<div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                           data-html='true' data-original-title="Upload Profile Photo">
                                                    <?php 
		                        if($EventData["Event"]["EVENT_IMAGE"]!='') {
		                            $img = $EventData["Event"]["EVENT_IMAGE"];
		                            $path = SITE_URL . 'files/upload_document/'.$img;
		                            ?>
		                            <div style="float:right;width:500px;">
		                                <img src="<?php echo $path ?>"  width="100" />
		                            </div>
                        	<?php } ?>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>

                            <div class="row" >

                                <div class="col-md-6" >
                                    <div class="form-group" >
                                        <label class="control-label col-md-3">Status:</label>
                                        <div class="col-md-9 tooltips" >
                                            <div class="radio-list" >
                                                  <?php echo  $EventData['Event']['STATUS']==1?'Active':'Inactive';  ?>
                                            </div>
                                        </div >
                                    </div>
                                </div >

                            </div >

                            <!--/row-->
                        </div>
                        <div class="form-actions fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="button" class="btn default" onclick="window.location.href='<?php echo Router::url(array("controller"=>"Events",'action'=>"index")); ?>'">Back</button>
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