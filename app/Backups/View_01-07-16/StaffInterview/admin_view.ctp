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
                <a href="#">Interview</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Interview</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Add Interview
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('VacancyReplay', array('class' => 'form-horizontal add', 'id' => 'Roles')); ?>
            
                <div class="form-body">
                
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Full Nmae</label>
                                <div class="col-md-9 tooltips">
                                   <?php echo $data['VacancyReplay']['NAME'];  ?>
                                </div>
                            </div>
                        </div>
                        
                
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">E-mail</label>
                                <div class="col-md-9 tooltips">
                                   <?php echo $data['VacancyReplay']['EMAIL_ID'];  ?>
                                </div>
                            </div>
                        </div>
                        
                        
                     </div>
                                
                
                    <div class="row">
                       <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Contact Number</label>
                                <div class="col-md-9 tooltips">
                                   <?php echo $data['VacancyReplay']['CONTACT_NUMBER'];  ?>
                                </div>
                            </div>
                        </div>
                        
                       <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">EXPERIENCE</label>
                                <div class="col-md-9 tooltips">
                                   <?php echo $data['VacancyReplay']['EXPERIENCE'];  ?>
                                </div>
                            </div>
                        </div>
                        
                        
                     </div>
                     
                       <div class="row">
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">QUALIFICATION</label>
                                <div class="col-md-9 tooltips">
                                   <?php echo $data['VacancyReplay']['QUALIFICATION'];  ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Apply For</label>
                                <div class="col-md-9 tooltips">
                                   <?php echo $data['VacancyReplay']['APPLY_FOR'];  ?>
                                </div>
                            </div>
                        </div>
                        
                        </div>
                        
                          
                        
                       <div class="row">
                       
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Interview Status</label>
                                <div class="col-md-9 tooltips">
                                   <?php
								   if($data['VacancyReplay']['INQ_STATUS'] == 1)
								   {
									   echo 'Selected';
								   }elseif($data['VacancyReplay']['INQ_STATUS'] == 2){
								    	echo 'Rejected';
								   }elseif($data['VacancyReplay']['INQ_STATUS'] == 3){
									   echo 'Hold';
								   }
								   
								   
                                   
                              		?>
                                
                                </div>
                            </div>
                        </div>
                       
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">DESCRIPTION
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $data['VacancyReplay']['DESCRIPTION'] ?>
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
                               <button type="button" class="btn default"  onclick="window.location.href='<?php echo Router::url(array
                                    ('action' => 'index')) ?>'">Go Back</button>
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