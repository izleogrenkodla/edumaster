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
                        <a href="#">Bank Reconciliation Statements</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">View Bank Reconciliation Statement</a>
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
                            <span aria-hidden="true" class="icon-user"></span>&nbsp; View Bank Reconciliation Statement
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php echo $this->Form->create('AccountBankReconciliationStatement', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
                       
                        <div class="form-body" >
							<div class="row">														
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Date
                                        </label>
                                        <div class="col-md-9 tooltips">										 
                                          <?php  echo $data['AccountBankReconciliationStatement']['DATE']; ?>
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
							
							<h3 class="form-section">Bank Statement Details</h3>
							
							<div class="row">
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Balance as per Bank Statement
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $data['AccountBankReconciliationStatement']['BALANCE_BANK']; ?>
                                        </div>										
                                    </div>
                                </div>
							</div>
							
						<?php
							if($BANK_ADDITION_HEADS_CNT > 0 && !empty($BANK_ADDITION_HEADS_ARR))
							{
								for($i=0;$i<$BANK_ADDITION_HEADS_CNT;$i++)
								{								
									$BANK_ADDITION_HEADS_VAL = $BANK_ADDITION_HEADS_ARR[$i];
									$BANK_ADDITION_AMOUNTS_VAL = $BANK_ADDITION_AMOUNTS_ARR[$i];
								
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Bank Addition Head
									</label>
									<div class="col-md-9 tooltips">
									  <?php  echo $BANK_ADDITION_HEADS_VAL; ?>
									</div>									
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Bank Addition Amount
									</label>
									<div class="col-md-9 tooltips">
									  <?php  echo $BANK_ADDITION_AMOUNTS_VAL; ?>
									</div>									
								</div>
							</div>
						</div>						
						<?php	
								}
							}
						?>
						
						<?php
							if($BANK_DEDUCTION_HEADS_CNT > 0 && !empty($BANK_DEDUCTION_HEADS_ARR))
							{
								for($i=0;$i<$BANK_DEDUCTION_HEADS_CNT;$i++)
								{								
									$BANK_DEDUCTION_HEADS_VAL = $BANK_DEDUCTION_HEADS_ARR[$i];
									$BANK_DEDUCTION_AMOUNTS_VAL = $BANK_DEDUCTION_AMOUNTS_ARR[$i];
								
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Bank Deduction Head
									</label>
									<div class="col-md-9 tooltips">
									  <?php  echo $BANK_DEDUCTION_HEADS_VAL; ?>
									</div>									
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Bank Deduction Amount
									</label>
									<div class="col-md-9 tooltips">
									  <?php  echo $BANK_DEDUCTION_AMOUNTS_VAL; ?>
									</div>									
								</div>
							</div>
						</div>						
						<?php	
								}
							}
						?>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Adjusted Bank Balance
									</label>
									<div class="col-md-9 tooltips">
									  <?php  echo $data['AccountBankReconciliationStatement']['ADJUSTED_BALANCE_BANK']; ?>
									</div>									
								</div>
							</div>
						</div>
						
						<h3 class="form-section">Book Details</h3>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Balance as per Book
									</label>
									<div class="col-md-9 tooltips">
									  <?php  echo $data['AccountBankReconciliationStatement']['BALANCE_BOOK']; ?>
									</div>										
								</div>
							</div>
						</div>
						
						<?php
							if($BOOK_ADDITION_HEADS_CNT > 0 && !empty($BOOK_ADDITION_HEADS_ARR))
							{
								for($i=0;$i<$BOOK_ADDITION_HEADS_CNT;$i++)
								{								
									$BOOK_ADDITION_HEADS_VAL = $BOOK_ADDITION_HEADS_ARR[$i];
									$BOOK_ADDITION_AMOUNTS_VAL = $BOOK_ADDITION_AMOUNTS_ARR[$i];							
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Book Addition Head
									</label>
									<div class="col-md-9 tooltips">
									  <?php  echo $BOOK_ADDITION_HEADS_VAL; ?>
									</div>									
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Book Addition Amount
									</label>
									<div class="col-md-9 tooltips">
									  <?php  echo $BOOK_ADDITION_AMOUNTS_VAL; ?>
									</div>									
								</div>
							</div>
						</div>						
						<?php	
								}
							}
						?>
						
						<?php
							if($BOOK_DEDUCTION_HEADS_CNT > 0 && !empty($BOOK_DEDUCTION_HEADS_ARR))
							{
								for($i=0;$i<$BOOK_DEDUCTION_HEADS_CNT;$i++)
								{								
									$BOOK_DEDUCTION_HEADS_VAL = $BOOK_DEDUCTION_HEADS_ARR[$i];
									$BOOK_DEDUCTION_AMOUNTS_VAL = $BOOK_DEDUCTION_AMOUNTS_ARR[$i];							
						?>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Book Deduction Head
									</label>
									<div class="col-md-9 tooltips">
									  <?php  echo $BOOK_DEDUCTION_HEADS_VAL; ?>
									</div>									
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Book Deduction Amount
									</label>
									<div class="col-md-9 tooltips">
									  <?php  echo $BOOK_DEDUCTION_AMOUNTS_VAL; ?>
									</div>									
								</div>
							</div>
						</div>						
						<?php	
								}
							}
						?>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Adjusted Book Balance
									</label>
									<div class="col-md-9 tooltips">
									  <?php  echo $data['AccountBankReconciliationStatement']['ADJUSTED_BALANCE_BOOK']; ?>
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
									  <?php  echo $data['AccountBankReconciliationStatement']['DESCRIPTION']; ?>
									</div>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Bank Statement Document
									</label>
									<div class="col-md-9 tooltips">
									<?php
										if(isset($BANK_STATEMENT_DOCUMENT) && $BANK_STATEMENT_DOCUMENT != "")
										{
									?>
									<a href="<?php echo $BANK_STATEMENT_DOCUMENT_DL; ?>" target="_blank"><?php echo $BANK_STATEMENT_DOCUMENT; ?></a>
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
                                          <?php  echo $data['AccountBankReconciliationStatement']['SORT_ORDER']; ?>
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
                                          <?php if($data['AccountBankReconciliationStatement']['STATUS']) { ?>
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