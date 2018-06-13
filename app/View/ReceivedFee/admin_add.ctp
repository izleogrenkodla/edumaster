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
                <a href="#">Fee</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Fee</a>
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
                <span aria-hidden="true" class="icon-user"></span>Add Fee
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('ReceivedFee', array('class' => 'form-horizontal add', 'id' => 'Roles')); ?>
            
                <div class="form-body">
                
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" style="height:52px;">Full Name</label>
                                <div class="col-md-9 tooltips" style="vertical-align:middle;">
                                    <?php echo $ro['Name']['FIRST_NAME']." ".$ro['Name']['MIDDLE_NAME']." ".$ro['Name']['LAST_NAME'] ?>
                                </div>
                            </div>
                        </div>
						
						 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" style="height:52px;">Class</label>
                                <div class="col-md-9 tooltips" style="vertical-align:middle;">
                                    <?php echo $ro['AcademicClass']['CLASS_NAME']; ?>
                                </div>
                            </div>
                        </div>
				</div>
				
				<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" style="height:52px;">Payment Type</label>
                                <div class="col-md-9 tooltips" style="vertical-align:middle;">
                                    <?php echo $ro['PaymentType']['TITLE']; ?>
                                </div>
                            </div>
                        </div>
						
						 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3" style="height:52px;">Fee</label>
                                <div class="col-md-9 tooltips" style="vertical-align:middle;">
                                    <?php echo $ro['FeeDue']['Fees']; ?>
                                </div>
                            </div>
                        </div>
				</div>
				
                <div class="row">  
						<?php $by = array('0'=>'Select Received Type','1'=>'Regular','2'=>'Advance')?>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Received Type<span class="required">
											* </span></label>
									<div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
										 data-html='true' data-original-title="First Name">
										<?php
										echo $this->Form->input('REC_TYPE', array('options' => $by , 'default' => '', 'class' => 'form-control select2me','label' => FALSE_VALUE,'div' => FALSE_VALUE));
										?>
										
									</div>
								</div>
							</div>
					
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Date<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('FEE_DATE', array('type' => 'text',
                                        'label' => FALSE_VALUE,'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control date-picker', 'placeholder' => 'Example :- ( 1/12/1989 )')); ?>
                                </div>
                            </div>
                        </div>
                        
                        
                     </div>
					 
					 
					<div class="row">
						<?php $by = array('0'=>'Select Payment by','1'=>'Cash','2'=>'Check','3'=>'Challan','4'=>'Demand Draft')  ?>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Payment By<span class="required">
											* </span></label>
									<div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
										 data-html='true' data-original-title="First Name">
										<?php
										echo $this->Form->input('PAY_TYPE', array('options' => $by , 'default' => '', 'class' => 'form-control select2me','label' => FALSE_VALUE,'div' => FALSE_VALUE,'onchange'=>'getby(this)'));
										?>
										
									</div>
								</div>
							</div>
							
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Amount<span class="required">
											* </span>
									</label>
									<div class="col-md-9 tooltips">
										<?php
										echo $this->Form->input('AMOUNT', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Example :- ( 15,000 )','label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'Value' => 0,'onblur'=>'getfee()'));
										?>
									</div>
								</div>
							</div>
					
					</div>
					
					<div class="row">
						<div id= 'test'>
					
						</div>
					
					</div>
					
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Late Fee<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                     <?php
                                    echo $this->Form->input('LATE_FEE', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Example :- ( 15,000 )','label' => FALSE_VALUE, 'div' => FALSE_VALUE,'Value' => 0,'onblur'=>'getfee()'));
                                    ?> 
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Discount<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $this->Form->input('DISCOUNT', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Example :- ( 15,000 )','label' => FALSE_VALUE, 'div' => FALSE_VALUE,'Value' => 0,'onblur'=>'getfee()'));
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Other Amount<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                     <?php
                                    echo $this->Form->input('OTHER_AMOUNT', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Example :- ( 15,000 )','label' => FALSE_VALUE, 'div' => FALSE_VALUE,'onblur'=>'getfee()', 'Value' => 0));
                                    ?> 
                                </div>
                            </div>
                        </div>
						<div id= 'test10'>
								<div class="col-md-6">
								
									<div class="form-group">
										<label class="control-label col-md-3">Net Amount<span class="required">
												* </span>
										</label>
										<div class="col-md-9 tooltips">
											<?php
											echo $this->Form->input('FEE', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Example :- ( 15,000 )','label' => FALSE_VALUE, 'div' => FALSE_VALUE,'Value' => 0));
											?>
										</div>
									</div>
								</div>
                        </div>
                    </div>   

					  <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Status</label>
                                <div class="col-md-9 tooltips">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="data[ReceivedFee][STATUS]" value="1" checked/>
                                            Active </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[ReceivedFee][STATUS]" value="0" />
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

<script>
function getby(data){
            var vid = $(data).val();
            //alert (vid);
            
            if(vid==0){
                $("#test").remove();
                alert('Please select  By');
            }else{
            var vid = $(data).val();
            var data = 'id='+ vid;
            //alert(data);
            $.ajax({
            data:data,
            url:REQUEST_URL+"ReceivedFee/Getfill",
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

<script>
function getfee(){
            //var vid = $(data).val();
            //alert (vid);
            var amt = document.getElementById('ReceivedFeeAMOUNT').value;
			var late = document.getElementById('ReceivedFeeLATEFEE').value;
			var dis = document.getElementById('ReceivedFeeDISCOUNT').value;
			var oth = document.getElementById('ReceivedFeeOTHERAMOUNT').value;
			//alert (vid);
            if(amt==0){
                //$("#test").remove();
                alert('Please Enter Amount');
            }else{
				
			}
            //var vid = $(data).val();
            var data1 = 'amt='+ amt+ '&late_fee='+ late+ '&discount='+ dis+ '&other='+ oth;
            //alert(data1);
		
            $.ajax({
            data:data1,
            url:REQUEST_URL+"ReceivedFee/Getfee",
            type:"POST",
            cache:false,
                // multiple data sent using ajax
            success: function (html) {

          var href =html;
         //href = href.substring(1);
          $('#test10').html(href);
        }
        
  });
         
    }
    
</script>