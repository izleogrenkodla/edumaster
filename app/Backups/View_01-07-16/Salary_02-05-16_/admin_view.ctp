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
                <a href="#">Salary</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Salary</a>
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
                <span aria-hidden="true" class="icon-user"></span> Salary
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('Salary', array('class' => 'form-horizontal add', 'id' => 'Form',
            'type' => 'file')); ?>
            
            <?php echo $this->Form->input("SALARY_ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
            
            
                <div class="form-body">
                    
                        <div class="row">
                  
                  

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Full Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                   <?php echo $list['Name']['FIRST_NAME'].' '. $list['Name']['MIDDLE_NAME'].' ' .$list['Name']['LAST_NAME']; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Role</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                <?php echo $list["Role"]["ROLE_NAME"]; ; ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Base Salary</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Last Name">
                                      <?php echo $list["Salary"]["BASE_SALARY"]; ?>
                                  
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Paid For Month</label>
                                <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                                     data-html='true' data-original-title="Select Gender">
                                     <?php if($list['Salary']['PAID_MONTH'] == 01)
                {
                    echo 'January';
                }elseif ($list['Salary']['PAID_MONTH'] == 02) {
                    echo 'February';
                }elseif ($list['Salary']['PAID_MONTH'] == 03) {
                    echo 'March';
                }elseif ($list['Salary']['PAID_MONTH'] == 04) {
                    echo 'April';
                }elseif ($list['Salary']['PAID_MONTH'] == 05) {
                    echo 'May';
                }elseif ($list['Salary']['PAID_MONTH'] == 06) {
                   echo 'June';
                }elseif ($list['Salary']['PAID_MONTH'] == 07) {
                    echo 'July';
                }elseif ($list['Salary']['PAID_MONTH'] == 08) {
                    echo 'August';
                }elseif ($list['Salary']['PAID_MONTH'] == 09) {
                    echo 'September';
                }elseif ($list['Salary']['PAID_MONTH'] == 10) {
                   echo 'October';
                }elseif ($list['Salary']['PAID_MONTH'] == 11) {
                    echo 'November';
                }elseif ($list['Salary']['PAID_MONTH'] == 12) {
                    echo 'December';
                }
                ?>
                                   
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Total Day</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                               <?php echo $list["Salary"]["TOTAL_DAY"]; ?>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">PRESENT DAY</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    
                                     <?php echo $list["Salary"]["PRESENT_DAY"]; ?>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">NET SALARY</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <?php echo $list["Salary"]["NET_SALARY"]; ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                   

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">TD</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <?php echo $list["Salary"]["TA"]; ?>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">DA</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                     
                                     <?php echo $list["Salary"]["DA"]; ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">PF</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Email ID">
                                     
                                     <?php echo $list["Salary"]["PF"]; ?>
                                </div>
                            </div>
                        </div>
                        
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">TAX</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <?php echo $list["Salary"]["TAX"]; ?>
                                   
                                </div>
                          
                            </div>
                        </div>
                      </div>
                        
                        <div class="row">
                                   <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">OTHER ADDITION</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                
                                 <?php echo $list["Salary"]["OTHER_ADDITION"]; ?>
                                   
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">OTHER DEDUCTION</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                
                             <?php echo $list["Salary"]["OTHER_DEDUCTION"]; ?>
                            
                                </div>
                            </div>
                        </div>
                    </div>


            <div class="row">
            <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">PAYABLE SALARY</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                
                                  <?php echo $list["Salary"]["PAYABLE_SALARY"]; ?>
                                    
                                </div>
                            </div>
                        </div>
                       
                       <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">REMARK</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                
                                 <?php echo $list["Salary"]["REMARK"]; ?>
                                    
                                </div>
                            </div>
                        </div> 
                       
            
            </div>

            <?php if($list["Salary"]["OUTSANDING_AMOUNT"] > 0) { ?>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">OUTSANDING AMOUNT</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Email ID">
                                <?php echo $list["Salary"]["OUTSANDING_AMOUNT"]; ?>
                                </div>
                            </div>
                        </div>


                   
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">DEDUCT AMOUNT
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                     <?php echo $list["Salary"]["DEDUCT_AMOUNT"]; ?>
                                </div>
                            </div>
                        </div>

                       

                    </div>
                    <?php } ?>

                    
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


