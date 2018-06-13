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
            <!--<li class="btn-group">
                <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                    <span>Actions</span><i class="fa fa-angle-down"></i>
                </button>
                
            </li>-->
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Academic History</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Academic History</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; View Academic History
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
		
		<div class="form-body">
		
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('AcademicHistory', array('class' => 'form-horizontal add', 'id' => 'Roles')); ?>
            	<?php echo $this->Form->input("ACD_HIS_ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
               <div> &nbsp; </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last School Name
                                </label>
                                <div class="col-md-9 tooltips">
                                   <?php echo $list['AcademicHistory']['LAST_SCHOOL_NAME']  ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Board Name
                                </label>
                                <div class="col-md-9 tooltips">
                                     <?php echo $list['AcademicHistory']['LAST_BOARD']  ?>
                                </div>
                            </div>
                        </div>
                        
                        
                     </div>
                     
                       <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Medium
                                </label>
                                <div class="col-md-9 tooltips">
                                <?php echo $list['Medium']['MEDIUM_NAME'];  ?>
                                
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">DESCRIPTION
                                </label>
                                <div class="col-md-9 tooltips">
                                  <?php echo $list['AcademicHistory']['DESCRIPTION']  ?>
                                </div>
                            </div>
                        </div>
                        
                     </div>

                      <div class="row">
                     
                      <?php if($list['AcademicHistory']['ROLE_ID'] == 5){ ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Class
                                </label>
                                <div class="col-md-9 tooltips">
                             <?php echo $list['AcademicClass']['CLASS_NAME'] ?>
                   
                                   
                            </div>
                        </div>
                        </div>
                        <?php } ?>
                     
                     
    	<?php if($list['AcademicHistory']['ROLE_ID'] == 5){ ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Percentage
                                </label>
                                <div class="col-md-9 tooltips">
                                     <?php echo $list['AcademicHistory']['PERCENTAGE']  ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        
                       
                        
                        
                     </div>
                     
					  <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Status</label>
                                <div class="col-md-9 tooltips">
                                  <?php  
								  if($list['AcademicHistory']['STATUS'] = 1)
								  {
									echo 'Active';  
								  }else{
									echo 'Inactive';  
								  }
								  ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                     <div class="form-actions fluid">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="button" class="btn default"  onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Go Back</button>
                            </div>
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