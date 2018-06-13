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
                        <a href="<?php echo Router::url(array('controller' => 'SmsComm', 'action' => 'index')) ?>">View All Content</a>
                    </li>
                   
                </ul>
            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">SMS</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Send SMS</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Add SMS
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
			
            <?php echo $this->Form->create('SmsComm', array('class' => 'form-horizontal add','type' => 'file','url' => array('controller' => 'SmsComm', 'action' => 'list'))); ?>
                <div class="form-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Title<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $this->Form->input('SMS_TITLE', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Example :- Notice For Exams','label' => FALSE_VALUE, 'div' => FALSE_VALUE));
                                    ?>
                                </div>
								<input name="ids" type="hidden" value="<?php echo $id;?>" />
                            </div>
							<div class="form-group">
                                <label class="control-label col-md-3"> Sms List<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
								
                                    <?php echo $this->Form->input('SMS_ID', array('type' => 'textarea',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1','readonly' => 'readonly', 'value'=>$user,'class' => 'form-control')); ?>
                                </div>
                            </div>
							<div class="form-group">
                                <label class="control-label col-md-3">Message<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
								
                                    <?php echo $this->Form->input('SMS_BODY', array('type' => 'textarea','id' => 'textarea',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1','maxlength' => '160' ,'class' => '8', 'rows' => '5' , 'data-error-container' => '#editor2_error')); ?>
										<div id="textarea_message"></div>
										
										
										
                                </div>
								
                            </div>
							
							
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                               
                            </div>
                        </div>


                    </div>


              
                    <!--/row-->
                </div>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" id="btn1" onclick = "" class="btn bg-blue-chambray">Submit</button>
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

$(document).ready(function() {
    var text_max = 160;
    $('#textarea_message').html(text_max + ' characters remaining');

    $('#textarea').keyup(function() {
        var text_length = $('#textarea').val().length;
        var text_remaining = text_max - text_length;

        $('#textarea_message').html(text_remaining + ' characters remaining');
    });
});

</script>