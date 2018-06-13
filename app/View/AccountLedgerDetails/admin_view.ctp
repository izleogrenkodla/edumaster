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
                        <a href="#">Account Ledger Details</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">View Account Ledger Detail</a>
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
                            <span aria-hidden="true" class="icon-user"></span>&nbsp; View Account Ledger Detail
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php echo $this->Form->create('AccountLedgerDetail', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
                       
                        <div class="form-body" >
							<div class="row">														
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Date
                                        </label>
                                        <div class="col-md-9 tooltips">										 
                                          <?php  echo $data['AccountLedgerDetail']['DATE']; ?>
                                        </div>										
                                    </div>
                                </div>
							</div>	
							
							<div class="row">							
							    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Account Department
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $data['AccountDepartment']['ACCOUNT_DEPARTMENT_TITLE']; ?>
                                        </div>										
                                    </div>
                                </div>
							</div>	
							
							<div class="row">
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Account Name [Account Number]
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  
												if(isset($data['AccountName']['ACCOUNT_NUMBER']) && $data['AccountName']['ACCOUNT_NUMBER']!="")
												{
													echo ucwords($data['AccountName']['ACCOUNT_NAME'])." [ ".$data['AccountName']['ACCOUNT_NUMBER']." ]";
												}
												else
												{
													echo ucwords($data['AccountName']['ACCOUNT_NAME']);
												}											
										  ?>
                                        </div>										
                                    </div>
                                </div>
							</div>
							
							<div class="row">							
							    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Account Group
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $data['AccountGroup']['ACCOUNT_GROUP_TITLE']; ?>
                                        </div>										
                                    </div>
                                </div>
							</div>
							
							<div class="row">							
							    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Account Payment Type
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $data['AccountPaymentType']['ACCOUNT_PAYMENT_TYPE']; ?>
                                        </div>										
                                    </div>
                                </div>
							</div>
							
							<div class="row">							
							    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Account Head
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $data['AccountLedgerDetail']['ACCOUNT_HEAD']; ?>
                                        </div>										
                                    </div>
                                </div>
							</div>
							
							<div class="row">							
							    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Voucher Number
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $data['AccountLedgerDetail']['VOUCHER_NUMBER']; ?>
                                        </div>										
                                    </div>
                                </div>
							</div>
							
							<div class="row">							
							    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Cheque Number
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $data['AccountLedgerDetail']['CHEQUE_NUMBER']; ?>
                                        </div>										
                                    </div>
                                </div>
							</div>
							
							<div class="row">							
							    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">DD Number
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $data['AccountLedgerDetail']['DD_NUMBER']; ?>
                                        </div>										
                                    </div>
                                </div>
							</div>
							
							<div class="row">							
							    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Bank Name
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $data['AccountLedgerDetail']['BANK_NAME']; ?>
                                        </div>										
                                    </div>
                                </div>
							</div>
							
							<div class="row">
							    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Bank Branch
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $data['AccountLedgerDetail']['BANK_BRANCH']; ?>
                                        </div>										
                                    </div>
                                </div>
							</div>
							
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Description
										</label>
										<div class="col-md-9 tooltips">
										  <?php  echo $data['AccountLedgerDetail']['DESCRIPTION']; ?>
										</div>
									</div>
								</div>
							</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Account Ledger Document
									</label>
									<div class="col-md-9 tooltips">
									<?php
										if(isset($ACCOUNT_LEDGER_DOCUMENT) && $ACCOUNT_LEDGER_DOCUMENT != "")
										{
									?>
									<a href="<?php echo $ACCOUNT_LEDGER_DOCUMENT_DL; ?>" target="_blank"><?php echo $ACCOUNT_LEDGER_DOCUMENT; ?></a>
									<?php
										}
									?>
									</div>									
								</div>
							</div>
						</div>
							
							<div class="row">
								  <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Sort Order
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $data['AccountLedgerDetail']['SORT_ORDER']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							<div class="row">
								  <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Status
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php if($data['AccountLedgerDetail']['STATUS']) { ?>
											Active
										  <?php } else { ?>
											Inactive
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