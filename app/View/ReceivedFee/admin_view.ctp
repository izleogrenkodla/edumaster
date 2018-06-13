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
                        <a href="#">Fee</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">View Fee</a>
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
                            <span aria-hidden="true" class="icon-user"></span>View Fee
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->

                        <div class="form-body" >
						
							<div class="row">
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Fees Pay Date</label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $Fee['ReceivedFee']['ENTRY_DATE']; ?>
                                        </div>
										
                                    </div>
								</div>
							
							
							</div>
							<div class="row">
							    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Student Name</label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $Fee['Name']['FIRST_NAME'].' '.$Fee['Name']['MIDDLE_NAME'].' '.$Fee['Name']['LAST_NAME']; ?>
                                        </div>
										
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Class
                                        </label>
                                        <div class="col-md-9 tooltips">
                                         <?php  echo $Fee['AcademicClass']['CLASS_NAME']; ?>
                                        </div>
										
                                    </div>
                                </div>
							</div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Term</label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $Fee['ReceivedFee']['PTEARMS']; ?>
                                        </div>
                                    </div>
                                </div>
								 <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Fees Month</label>
                                        <div class="col-md-9 tooltips">
                                           <?php  echo $Fee['MonthDistribution']['month']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Total Amount</label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $Fee['ReceivedFee']['FEES_AMT']; ?>
                                        </div>
                                    </div>
                                </div>
								  <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Late Fees</label>
                                        <div class="col-md-9 tooltips">
                                           <?php  echo $Fee['ReceivedFee']['LATE_FEES']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Discount</label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $Fee['ReceivedFee']['DISCOUNT']; ?>
                                        </div>
                                    </div>
                                </div>
								  <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Other Amount</label>
                                        <div class="col-md-9 tooltips">
                                           <?php  echo $Fee['ReceivedFee']['OTHER_AMT']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Paid Amount</label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $Fee['ReceivedFee']['NET_AMT']; ?>
                                        </div>
                                    </div>
                                </div>
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Payment By</label>
                                        <div class="col-md-9 tooltips">
                                           <?php  //echo $Fee['ReceivedFee']['PAY_TYPE']; 
												if($Fee['ReceivedFee']['PAY_TYPE'] == 1){
													echo 'Cash';
												}elseif($Fee['ReceivedFee']['PAY_TYPE'] == 2){
													echo 'Cheque';
												}elseif($Fee['ReceivedFee']['PAY_TYPE'] == 3){
													echo 'Challan';
												}elseif($Fee['ReceivedFee']['PAY_TYPE'] == 4){
													echo 'Demand Draft';
												}
										   
										   ?>
                                        </div>
                                    </div>
                                </div>
							</div>	
								<?php 
									if($Fee['ReceivedFee']['PAY_TYPE'] == 2){	
								?>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">Bank Name</label>
											<div class="col-md-9 tooltips">
											   <?php echo $by['FeeCheck']['Bank_Name'];  ?>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">Account Holder Name</label>
											<div class="col-md-9 tooltips">
											   <?php echo $by['FeeCheck']['Ac_Name'];  ?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">Account Number</label>
											<div class="col-md-9 tooltips">
											   <?php echo $by['FeeCheck']['Ac_No'];  ?>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">Branch</label>
											<div class="col-md-9 tooltips">
											   <?php echo $by['FeeCheck']['Branch'];  ?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">Cheque Number</label>
											<div class="col-md-9 tooltips">
											   <?php echo $by['FeeCheck']['Cheque_No'];  ?>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">Cheque Date</label>
											<div class="col-md-9 tooltips">
											   <?php echo $by['FeeCheck']['Cheque_Date'];  ?>
											</div>
										</div>
									</div>
								</div>
								
								<?php
									}elseif($Fee['ReceivedFee']['PAY_TYPE'] == 3){
								?>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">Transaction Number</label>
											<div class="col-md-9 tooltips">
											   <?php echo $by['FeeChalan']['TRANS_ID'];  ?>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">Contact Number</label>
											<div class="col-md-9 tooltips">
											   <?php echo $by['FeeChalan']['CON_NO'];  ?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">Transaction Date</label>
											<div class="col-md-9 tooltips">
											   <?php echo $by['FeeChalan']['TRANS_DATE'];  ?>
											</div>
										</div>
									</div>	
								</div>
								
								<?php
									}elseif($Fee['ReceivedFee']['PAY_TYPE'] == 4){
								?>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">Bank Name</label>
											<div class="col-md-9 tooltips">
											   <?php echo $by['FeeDemandDraft']['Bank_Name'];  ?>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">DD Number</label>
											<div class="col-md-9 tooltips">
											   <?php echo $by['FeeDemandDraft']['DD_No'];  ?>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">Branch</label>
											<div class="col-md-9 tooltips">
											   <?php echo $by['FeeDemandDraft']['Branch'];  ?>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label col-md-3">DD Date</label>
											<div class="col-md-9 tooltips">
											   <?php echo $by['FeeDemandDraft']['DD_Date'];  ?>
											</div>
										</div>
									</div>
								</div>
								
								<?php
									}
								?>
                            
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