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
                <a href="#">Outstanding</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Outstanding</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Add Outstanding
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('Outstanding', array('class' => 'form-horizontal add', 'id' => 'Roles')); ?>
            
                <div class="form-body">
                
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Full Nmae</label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $ro['User']['FIRST_NAME']." ".$ro['User']['MIDDLE_NAME']." ".$ro['User']['LAST_NAME'] ?>
                                </div>
                            </div>
                        </div>
                        
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Base Salary</label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $ro['User']['BASE_SALARY'] ?>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                     </div>

                      
               
                                
               
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Amount
                                </label>
                                <div class="col-md-9 tooltips">
                                   <?php echo $rsal; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Loan Amount<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('LOAN_AMOUNT', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( 5000 )')); ?>
                                </div>
                            </div>
                        </div>
                        
                        
                     </div>
                     
                     
                       <div class="row">
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Remark
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('REMARK', array('type' => 'textarea', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                        </div>
                        
                     </div>
                    
                     
                    <!--/row-->
                </div>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn bg-blue-chambray">Submit</button>
                                <button type="button" class="btn default" onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Cancel</button>
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