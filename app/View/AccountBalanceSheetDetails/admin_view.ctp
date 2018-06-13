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
                        <a href="#">Account Balance Sheet Details</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">View Account Balance Sheet Detail</a>
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
                            <span aria-hidden="true" class="icon-user"></span>&nbsp; View Account Balance Sheet Detail
                        </div>
                        <div class="tools">
                            <a href="javascript:void(0);" class="collapse">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php echo $this->Form->create('AccountBalanceSheetDetail', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
                       
                        <div class="form-body" >
							<div class="row">														
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Date
                                        </label>
                                        <div class="col-md-9 tooltips">										 
                                          <?php  echo $data['AccountBalanceSheetDetail']['DATE']; ?>
                                        </div>
										
                                    </div>
                                </div>
							</div>	
							
							<div class="row">							
							    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Account Balance Sheet Head
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $data['AccountBalanceSheetHead']['ACCOUNT_BALANCE_SHEET_HEAD']; ?>
                                        </div>
										
                                    </div>
                                </div>
							</div>	
							
							<div class="row">
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Account Balance Sheet Sub Head
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $data['AccountBalanceSheetSubHead']['ACCOUNT_BALANCE_SHEET_SUB_HEAD']; ?>
                                        </div>
										
                                    </div>
                                </div>
							</div>
							
							<div class="row">
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Account Balance Sheet Head Category
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $data['AccountBalanceSheetDetail']['ACCOUNT_BALANCE_SHEET_HEAD_CATEGORY']; ?>
                                        </div>
										
                                    </div>
                                </div>
							</div>
							
							<div class="row">
								<div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Amount
                                        </label>
                                        <div class="col-md-9 tooltips">
                                          <?php  echo $data['AccountBalanceSheetDetail']['AMOUNT']; ?>
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
                                          <?php  echo $data['AccountBalanceSheetDetail']['DESCRIPTION']; ?>
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
                                          <?php  echo $data['AccountBalanceSheetDetail']['SORT_ORDER']; ?>
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
                                          <?php if($data['AccountBalanceSheetDetail']['STATUS']) { ?>
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