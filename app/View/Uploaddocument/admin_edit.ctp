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
                <a href="#">User</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add New</a>
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
                <span aria-hidden="true" class="icon-user"></span>  Add New User
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('Uploaddocument', 
			array('class' => 'form-horizontal add', 'id' => 'Form','type' => 'file')); ?>
            
            <?php echo $this->Form->input("UPLOAD_DOC_ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
            
                <div class="form-body">
                
                  <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Student<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                 <?php
                                    echo $this->Form->input('INQUIRY_ID', array('options' => $name, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>

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
			</div>
                
                   <div class="row">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Status</label>
                                <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                                     data-html='true' data-original-title="Status">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="data[Uploaddocument][STATUS]" value="1" checked/>
                                            Active </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[Uploaddocument][STATUS]" value="0" />
                                            Inactive </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                           <!--<div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn bg-blue-chambray">Submit</button>
                                <button type="button" class="btn default"  onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Cancel</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>-->
				</div>
                
                        <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn bg-blue-chambray">Submit</button>
                                <button type="button" class="btn default"  onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Cancel</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
                        
                        <!--<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Upload Profile Photo</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Upload Profile Photo">
                                    <input type="hidden" name="data[User][IsUpload]" class="IsUpload" value="0"/>
                                    <input type="file" name="Files[]" id="photoupload"/>
                                </div>
                            </div>
                        </div>-->

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


