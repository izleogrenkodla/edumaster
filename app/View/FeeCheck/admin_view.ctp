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
                <a href="#">Fee Fee Check</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Fee Fee Check</a>
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
                <span aria-hidden="true" class="icon-user"></span> Fee Check
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('FeeCheck', array('class' => 'form-horizontal add', 'id' => 'Form',
            'type' => 'file')); ?>
            
            <?php echo $this->Form->input("id", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
            
                <div class="form-body">
                   
					<div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Full Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                   <?php echo $this->request->data['Name']['FIRST_NAME'].' '. $this->request->data['Name']['MIDDLE_NAME'].' ' .$this->request->data['Name']['LAST_NAME']; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Bank Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                <?php echo $this->request->data["FeeCheck"]["Bank_Name"]; ; ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Account Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Last Name">
                                      <?php echo $this->request->data["FeeCheck"]["Ac_Name"]; ?>
                                  
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Account Number</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Last Name">
                                      <?php echo $this->request->data["FeeCheck"]["Ac_No"]; ?>
                                  
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Branch</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                              <?php echo $this->request->data["FeeCheck"]["Branch"]; ?>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Cheque Number</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data["FeeCheck"]["Cheque_No"]; ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
				
					
					<div class="row">
						<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Cheque Date</label>
									<div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
										 data-html='true' data-original-title="Mobile No.">
										  <?php echo $this->request->data["FeeCheck"]["Cheque_Date"]; ?>
										
									</div>
								</div>
						</div>
						<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Entry Date</label>
									<div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
										 data-html='true' data-original-title="Mobile No.">
										  <?php echo $this->request->data["FeeCheck"]["Entry_Date"]; ?>
										
									</div>
								</div>
						</div>

						
					</div>


                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Amount</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
									  <?php echo $this->request->data["FeeCheck"]["Amount"]; ?>
                                    
                                </div>
                            </div>
                        </div>
						
						
                    </div>

  
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div align="center">
                                <button type="button" class="btn default"  onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Go Back</button>
                            </div>
                        </div>
                       
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


