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
                        <a href="<?php echo Router::url(array('controller' => 'Mailer', 'action' => 'index','type' => 'file')) ?>">View All Content</a>
                    </li>
                   
                </ul>
            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Mail</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Send Mail</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Send Mail
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
			
            <?php echo $this->Form->create('Mailer', array('class' => 'form-horizontal add','type' => 'file','url' => array('controller' => 'Mailer', 'action' => 'list'))); ?>
                <div class="form-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Title<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $this->Form->input('MAIL_TITLE', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Example :- Notice For Exams','label' => FALSE_VALUE, 'div' => FALSE_VALUE));
                                    ?>
                                </div>
								<input name="ids" type="hidden" value="<?php echo $id;?>" />
                            </div>
							<div class="form-group">
                                <label class="control-label col-md-3"> Emails List<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
								
                                    <?php echo $this->Form->input('EMAIL_ID', array('type' => 'textarea',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1','readonly' => 'readonly', 'value'=>$user,'class' => 'form-control')); ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                               
                            </div>
                        </div>


                    </div>


                    <div class="row">

                        <div class="col-md-12">
                            <div class="form-group">
                                
                                <div class="col-md-12 tooltips">
                                    <?php echo $this->Form->input('MAIL_BODY', array('type' => 'textarea',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'ckeditor form-control',  'data-error-container' => '#editor2_error')); ?>
                                </div>
                            </div>
                        </div>
						 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Upload Attachment <span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Upload Profile Photo">
                                    <?php echo $this->Form->input('UPLOAD_ATTACHMENT.', array('id'=>'confirm','type'=>'file', 'multiple' => 'multiple', 'enctype'=>'x-zip','label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
								<?php echo $this->General->uploadfilenotesATTACHMENT(); ?>
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
                                <button type="submit" id="btn1" onclick ="" class="btn bg-blue-chambray">Submit</button>
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
<script>

document.getElementById('confirm').addEventListener('change', checkFile, false);

function checkFile(e) {

    var file_list = e.target.files;

    for (var i = 0, file; file = file_list[i]; i++) {
        var sFileName = file.name;
        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
        var iFileSize = file.size;
       var iConvert = (file.size / 5000000).toFixed(2);
		//alert(iFileSize);
        if (iFileSize > 5000000) {
            txt = "Please make sure your file is less than <?php echo ATTACHMENT_ALLOWED_SIZE;?> MB.";
			alert(txt)
            
			//alert('hii')
			document.getElementById("confirm").value = "";
			
        }
    }
}


</script>