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
                <a href="#">Fee Refund</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Fee Refund</a>
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
                <span aria-hidden="true" class="icon-user"></span>Add Fee Refund
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('FeeRefund', array('class' => 'form-horizontal add', 'id' => 'Roles')); ?>
            
                <div class="form-body">
                
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" style="height:52px;">Full Name</label>
                                <div class="col-md-9 tooltips" style="vertical-align:middle;">
                                    <?php echo $ro['Users']['FIRST_NAME']." ".$ro['Users']['MIDDLE_NAME']." ".$ro['Users']['LAST_NAME'] ?>
                                </div>
                            </div>
                        </div>
						
						 <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" style="height:52px;">Class</label>
                                <div class="col-md-9 tooltips" style="vertical-align:middle;">
                                    <?php echo $ro['AcademicClass']['CLASS_NAME']; ?>
                                </div>
                            </div>
                        </div> -->
				</div>
				
				<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" style="height:52px;">Received Fee</label>
                                <div class="col-md-9 tooltips" style="vertical-align:middle;">
                                   <?php echo $rec_fee;    ?>
                                </div>
                            </div>
                        </div>
						
						 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" style="height:52px;">Refund Type</label>
                                <div class="col-md-9 tooltips" style="vertical-align:middle;">
                                    <div id="users_list" style="height:150px;overflow:scroll;">
										<?php
										
											foreach($ti_fee as $key=>$vel)
											{
												foreach ($te as $t){	
												//$t =$t;
																		
												echo '<li>
												<input type="checkbox" name="REF_TYPE[]" value='.$vel.' id="RTYPE"  onclick = "if (this.checked) { gettotfee(this) } else { gettotfeeuncheck(this) }" />'
												." ".$t.'
												</li>';
												}
												break;
											//echo $t;
											}
										?>
										
										
									</div>
                                </div>
                            </div>
                        </div>
				</div>
				
                <div class="row">  
						<div id= 'test'>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Refund Amount</label>
									<div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
										 data-html='true' data-original-title="First Name">
										<?php
										echo $this->Form->input('REFUND_FEE', array('type' => 'Text', 'class' => 'form-control','label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'value' =>0));
										?>
										
									</div>
								</div>
							</div>
						</div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Refund Date<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('REF_DATE', array('type' => 'text',
                                        'label' => FALSE_VALUE,'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control date-picker', 'placeholder' => 'Example :- ( 1/12/1989 )')); ?>
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
										<?php
										echo $this->Form->input('REMARK', array('type' => 'textarea', 'class' => 'form-control','label' => FALSE_VALUE, 'div' => FALSE_VALUE,));
										?>
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

function gettotfee(data){
	
			 var vid = document.getElementById('RTYPE').value;
			 var rfee = document.getElementById('FeeRefundREFUNDFEE').value;
			
			 
			
            var data = 'id='+ vid+ '&r_fee='+ rfee;
            //alert(data);
            $.ajax({
            data:data,
            url:REQUEST_URL+"FeeRefund/Getfee",
            type:"POST",
            cache:false,
                // multiple data sent using ajax
            success: function (html) {

          var href =html;
          href = href.substring(1);
          $('#test').html(href);
			}
			
		  });
	
      
    }
    
</script>

<script>
function gettotfeeuncheck(data){
	 var vid = document.getElementById('RTYPE').value;
			 var rfee = document.getElementById('FeeRefundREFUNDFEE').value;
			 
			 
			
            var data = 'id='+ vid+ '&r_fee='+ rfee;
            //alert(data);
            $.ajax({
            data:data,
            url:REQUEST_URL+"FeeRefund/Getfeeuncheck",
            type:"POST",
            cache:false,
                // multiple data sent using ajax
            success: function (html) {

          var href =html;
          href = href.substring(1);
          $('#test').html(href);
			}
			
		  });
	
}

</script>


