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
                        <a href="#">Leave Application</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">view Leave Applications</a>
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
                            <span aria-hidden="true" class="icon-user"></span>&nbsp; View Leave Applications
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php echo $this->Form->create('LeaveApplication', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
                       
                        <div class="form-body" >
							<div class="row">
							    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">First Name:
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php

										  echo $leaveApplications['User']['FIRST_NAME']; ?> &nbsp;  <?php echo $leaveApplications['User']['MIDDLE_NAME']; ?>
                                        </div>
										
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Last Name:
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php echo $leaveApplications['User']['LAST_NAME']; ?>
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
                                            <?php echo date(DTFRMT,strtotime($leaveApplications['LeaveApplication']['FROM_DATE'])); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">End Date:
                                        </label>
                                        <div class="col-md-9 tooltips">
                                           <?php echo date(DTFRMT,strtotime($leaveApplications['LeaveApplication']['TO_DATE'])); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                
								

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Reason:
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php echo $leaveApplications['LeaveApplication']['REASON']; ?>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">User Type:
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php echo $leaveApplications['Role']['ROLE_NAME']; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
							<div class="row" >
									
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Leave Status
                                        </label>
                                        <div class="col-md-9 tooltips">
										<?php  $status='';
										if($leaveApplications['LeaveApplication']['LEAVE_STATUS'] == 0)
            	{
            		$status = 'Pending';
            	}
            	elseif($leaveApplications['LeaveApplication']['LEAVE_STATUS'] == 1)
            	{
            		$status = 'Approved';
            	}
										?>
                                          <?php echo $status; ?>
                                        </div>
                                    </div>
                                </div>

                                

                            </div >
                        </div>
                        <div class="form-actions fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="col-md-offset-3 col-md-9">
                                        <button type="button" class="btn default" onclick="window.location.href='<?php echo Router::url(array("controller"=>"LeaveApplications",'action'=>"index")); ?>'">Back</button>
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