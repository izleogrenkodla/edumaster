
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
            <li class="btn-group">
                <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                    <span>Actions</span><i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'City', 'action' => 'index')) ?>">View All Cities</a>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'City', 'action' => 'add')) ?>">Add New City</a>
                    </li>
                </ul>
            </li>
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
                <a href="#">Interview Status</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Interview Status
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('StudentRegistration', array('class' => 'form-horizontal add', 'id' => 'Roles')); ?>
            <?php echo $this->Form->input("FORM_NO", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
                <div class="form-body">
                    <div class="row">
                    
                     <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Student Name<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                            <?php echo $this->request->data['StudentRegistration']['FIRST_NAME'].' '.$this->request->data['StudentRegistration']['MIDDLE_NAME'].' '.$this->request->data['StudentRegistration']['LAST_NAME']?>
                                   
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Interview Status<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
									 $st = array(
                                        '1' => 'Selected',
                                        '2' => 'Rejected',
                                        '3' => 'Hold',  
                                    );
					
                                    echo $this->Form->input('INTERVIEW_RESULT', array('options' => $st, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/row-->
                </div>
                
                
                <div class="form-body">
                    <div class="row">
                    
                                          <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Interview Round<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
			
                                    echo $this->Form->input('ROUND_ID', array('options' => $Round, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
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