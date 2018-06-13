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
                <a href="#">Upload Document</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Upload Document</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Add Upload Document
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('StaffUploadDocument', 
			array('class' => 'form-horizontal add','id' => 'Form','type' => 'file')); ?>
            
             <?php echo $this->Form->input("ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
                <div class="form-body">
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Name
                                </label>
                                <div class="col-md-9 tooltips">
                            <?php echo $udocumaent['Users']['FIRST_NAME'].' '.$udocumaent['Users']['MIDDLE_NAME'].' '.$udocumaent['Users']['LAST_NAME']?>
                                    
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Role
                                </label>
                                <div class="col-md-9 tooltips">
                            <?php echo $role_name; ?>
							 </div>
                            </div>
                        </div>
                        
                        
                </div>
                
                <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Proof Type
                                </label>
                                <div class="col-md-9 tooltips">
                            	 <?php
                                    echo $this->Form->input('PROOF_ID', array('options' => $type, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Remark
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('REMARK', array('type' => 'textarea',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                        </div>
                        
                        
                </div>
                
				 <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Document<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                   <?php echo $this->Form->input('UPLOAD_DOC', array('type' => 'file', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
<?php //echo $this->General->uploadfilenotes(); ?>
                                </div>
                            </div>
                        </div>
                        
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Status</label>
                                <div class="col-md-9 tooltips">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="data[StaffUploadDocument][STATUS]" value="1" checked/>
                                            Active </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[StaffUploadDocument][STATUS]" value="0" />
                                            Inactive </label>
                                    </div>
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