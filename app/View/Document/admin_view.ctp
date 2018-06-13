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
                <a href="#">Admission</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Document</a>
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
                <span aria-hidden="true" class="icon-user"></span> View Document
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('Document', array('class' => 'form-horizontal add', 'id' => 'Form',
            'type' => 'file')); ?>
            <?php echo $this->Form->input("DOC_ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
                <div class="form-body">
                    <h3 class="form-section">Document</h3>
   <div class="row">
                  <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Class Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->request->data["AcademicClass"]["CLASS_NAME"]; ?>

                                </div>
                            </div>
                        </div>
                        
                            <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Medium</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                        <?php echo $this->request->data["Medium"]["MEDIUM_NAME"]; ?>
								    
                                </div>
                            </div>
                        </div>
                    </div>

                 
                    
             
                    
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Document Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                      <?php echo $this->request->data["Document"]["DOC_NAME"]; ?>
								
                                </div>
                            </div>
                        </div>



                     <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">State</label>
                                <div class="col-md-9">
                                         <?php 
										 if($this->request->data["Document"]["STATUS"] == 1)
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


                  <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="button" class="btn default"  onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Go Back</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                    
                </div>            </form>
            <!-- END FORM-->
      
    </div>

</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>