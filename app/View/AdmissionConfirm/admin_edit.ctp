
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
               
            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Admission Fee</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Admission Fee</a>
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
                <span aria-hidden="true" class="icon-user"></span>Add Admission Fee
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('AdmissionConfirm', array('class' => 'form-horizontal add', 'id' => 'Roles')); ?>
           <?php echo $this->Form->input("FORM_NO", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
                <div class="form-body">
                <div class="row">
                    
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Student Name
                                </label>
                                <div class="col-md-9 tooltips">
                              <?php echo $udocumaent['StudentRegistration']['FIRST_NAME'].' '.$udocumaent['StudentRegistration']['MIDDLE_NAME'].' '.$udocumaent['StudentRegistration']['LAST_NAME']?>
                                   
                                </div>
                            </div>
						</div>
						
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Class
                                </label>
                                <div class="col-md-9 tooltips">
                              <?php echo $udocumaent['AcademicClass']['CLASS_NAME']?>
                                   
                                </div>
                            </div>
						</div>
				</div>
				<div class="row">
					 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Admission Fee</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php  echo $fee_det;  ?>
                                </div>
                            </div>
                        </div>
						
						
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Total Fee</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php  echo $total_fee;  ?>
                                </div>
                            </div>
                        </div>
					</div>
				<div class="row">		
						
						
						 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Received Fee</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                   <?php echo $this->Form->input('ADM_FEE', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( 15000 )')); ?>
                                </div>
                            </div>
                        </div>
						
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Payment Term<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
								<?php 
									echo $this->Form->input("PAYMENT_TERM",array('options'=>$payment_terms,"label"=>false,"div"=>false,'class'=>'form-control select2me','onchange'=>'getfee(this)'));
								 ?>
                                    
                                </div>
                            </div>
                        </div>

                       
                </div>		

				
				
				<div class="row">
					<div id="test">
					<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Fee </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
								
                                    
                                </div>
                            </div>
                        </div>
					</div>
				
					<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Remark</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
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
function getfee(data){
            var vid = $(data).val();
            //alert (vid);
            
            if(vid==0){
                //$("#test").remove();
                //alert('Please select  By');
            }else{
            var vid = $(data).val();
            var data = 'id='+ vid+ '&total='+<?php echo $total_fee?>;
            //alert(data);
            $.ajax({
            data:data,
            url:REQUEST_URL+"AdmissionConfirm/GetFee",
            type:"POST",
            cache:false,
                // multiple data sent using ajax
            success: function (html) {

          var href =html;
         //href = href.substring(1);
          $('#test').html(href);
        }
        
      });
        }
    }
    
</script>  