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
                <a href="#">Advance Fee</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Advance Fee</a>
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
                <span aria-hidden="true" class="icon-user"></span> Advance Fee
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('AdvanceFee', array('class' => 'form-horizontal add', 'id' => 'Form',
            'type' => 'file')); ?>
            
            <?php echo $this->Form->input("ADV_ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
            
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
                                <label class="control-label col-md-3">Class</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                <?php echo $this->request->data["AcademicClass"]["CLASS_NAME"]; ; ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Tearms</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Last Name">
                                      <?php echo $this->request->data["PaymentType"]["TITLE"]; ?>
                                  
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Fee Amount</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Last Name">
                                      <?php echo $this->request->data["AdvanceFee"]["FEES_AMT"]; ?>
                                  
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Late Fee</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                              <?php echo $this->request->data["AdvanceFee"]["LATE_FEES"]; ?>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Discount</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data["AdvanceFee"]["DISCOUNT"]; ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Other Amount</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
									  <?php echo $this->request->data["AdvanceFee"]["OTHER_AMT"]; ?>
                                    
                                </div>
                            </div>
                        </div>
						
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Net Fee</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->request->data["AdvanceFee"]["NET_AMT"]; ?>
                                    
                                </div>
                            </div>
                        </div>


                    </div>

                   

                    <div class="row">
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Entry Date</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                     <?php echo $this->request->data["AdvanceFee"]["ENTRY_DATE"]; ?>
                                     
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Pay Type</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Email ID">
									 <?php 
									 if($this->request->data["AdvanceFee"]["PAY_TYPE"]==1)
									 {
										 echo 'Cash';
									 }elseif($this->request->data["AdvanceFee"]["PAY_TYPE"]==2){
										 echo 'Check';
									 }elseif($this->request->data["AdvanceFee"]["PAY_TYPE"]==3){
										 echo 'Challan';
									 }elseif($this->request->data["AdvanceFee"]["PAY_TYPE"]==4){
										  echo 'Demand Draft';
									 }
									 
									 ?>
                                     
                                     
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


