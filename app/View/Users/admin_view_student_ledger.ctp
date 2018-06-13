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
                <a href="#">Users</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Student Ledger</a>
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
                <span aria-hidden="true" class="icon-user"></span>  View Student
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
                <div class="form-body">
                    <h3 class="form-section">Student Info</h3>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">First Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                    <?php echo $this->request->data["User"]["FIRST_NAME"]; ?>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Middle Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
								<?php echo $this->request->data["User"]["MIDDLE_NAME"]; ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Last Name">
          								<?php echo $this->request->data["User"]["LAST_NAME"]; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Email ID</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Email ID">
      								<?php echo $this->request->data["User"]["EMAIL_ID"]; ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Father Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                  <?php echo $this->request->data["User"]["FATHER_NAME"]; ?>
								   
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
								<?php echo $this->request->data["User"]["MOTHER_NAME"]; ?>
                                  
                                </div>
                            </div>
                        </div>

                    </div>

                   

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Birth Date</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                      <?php echo $this->request->data["User"]["DOB"]; ?>
								  
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Joining Date</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
									     <?php echo $this->request->data["User"]["JOINING_DATE"]; ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Class</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
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
                                <label class="control-label col-md-3">Mobile no</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                      <?php echo $this->request->data["User"]["MOBILE_NO"]; ?>
								
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Contact No</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                         <?php echo $this->request->data["User"]["CONTACT_NO"]; ?>
								 
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Country</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                           <?php echo $this->request->data["Country"]["COUNTRY_NAME"]; ?>
								    
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">State</label>
                                <div class="col-md-9">
                                         <?php echo $this->request->data["State"]["STATE_NAME"]; ?>
								   
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">City</label>
                                <div class="col-md-9">
                                          <?php echo $this->request->data["City"]["CITY_NAME"]; ?>
								
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Gender</label>
                                <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                                     data-html='true' data-original-title="Select Gender">
                                    <div class="radio-list">
                                                 <?php echo $this->request->data["User"]["GENDER"]; ?>
									  
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Address</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <?php echo $this->request->data["User"]["ADDRESS"]; ?>
								
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Profile Photo</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Upload Profile Photo">
                                   <?php  
							if($this->request->data["User"]["IMAGE_URL"]!='') { 
							$img = $this->request->data["User"]["IMAGE_URL"];
							$path = SITE_URL . 'files/upload_document/'.$img;
						?>
						
							<img src="<?php echo $path ?>"  width="100" />
						
						<?php } ?>
                                </div>
                            </div>
                        </div>
						
                    </div>

                    

                </div>
        </div>
    </div>
	<div class="portlet box blue-madison">
		<div class="portlet-title">
            <div class="caption" style="width:100%;">
                Student Ledger
            </div>
			<?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,ACCOUNT_ID))) { ?>
			
			 
			<?php echo $this->Form->create("User",array("type"=>"get")) ?>
	<div class="row">
						<div class="col-md-12" style="padding:20px 0;">
                            <div class="form-group">
                               
                                <label class="control-label flef col-xs-1">Date: From</label>
                                    
                                    <input type="text" class="col-xs-4 form-control form-control-inline date-picker input-small" name="data[User][from_date]"
                                           value="<?php echo isset($this->request->query['data']['User']['from_date']) ? $this->request->query['data']['User']['from_date']
                                               : '' ?>" readonly  />

                                    <label class="control-label col-xs-1 flef">To</label>
                                    <input type="text" class="col-xs-4 form-control form-control-inline date-picker input-small" name="data[User][to_date]"
                                           value="<?php echo isset($this->request->query['data']['User']['to_date']) ? $this->request->query['data']['User']['to_date']
                                               : '' ?>"  readonly />
                                               
                                               
                         
								<div class="col-md-2" align="center">
									<button type="submit"  style="margin:0 !important;" class="btn bg-blue-chambray">Search</button>
								</div>
							     
                            
                   		<a href="printpage" onClick="printthis(); return false;">Print</a>   
           
                                               
                            </div>
                        </div>
						
	</div>
	</form>
			<?php } ?>
   
			  
			 
			 
             
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
            
           
				
        </div>
		 <div id="abc">
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
                <div class="form-body">
				
					<?php 
					$receive_date = 'Receive Date';
					$receive_amount = 'Receive Amount';
					if(in_array($authUser["ROLE_ID"],array(STUDENT_ID))) { 
						$receive_date = 'Paid Date';
						$receive_amount = 'Paid Amount';
					 } ?>
					<table class="gridtable table table-condensed table-striped table-hover table-bordered">
                                           <thead> <tr>
                                                <th>Fee Type</th>
                                                <th><?php echo $receive_date ?></th>
                                                <th><?php echo $receive_amount ?></th>
                                                <th >Narration</th>
                                                																								                                            </tr></thead>
																																															<tbody>
                                
						<?php  $total = 0;
							if(is_array($ledgers) && sizeof($ledgers)>0) { 
							foreach($ledgers as $ledger) {  
							$total = $total+$ledger["LedgerXref"]["AMOUNT"];

						?>

                                                <tr align="center">
                                                    <td data-label="Fee Type"><?php echo $ledger["FeeType"]["TITLE"] ?></td>
                                                    <td data-label="Receive Date"><?php echo date(DTFRMT,strtotime($ledger["LedgerXref"]["created"])); ?></td>
                                                    <td data-label="Amount"><?php echo number_format($ledger["LedgerXref"]["AMOUNT"],2) ?></td>
                                                    <td data-label="Narration"><?php echo $ledger["LedgerXref"]["NARRATION"] ?></td>
																																						
												                                                </tr>                    	
						
						<?php  } }else{?>
						<tr>
							<td colspan="10" align="center">No Record Found yet.</td>
						</tr>
						<?php } ?>
						<?php if($total>0) {  ?>
						<tr>
							<td colspan="2" align="center"><strong>Total </strong></td>
							<td   align="center"><strong><?php echo number_format($total,2); ?></strong> </td>
							<td></td>
						</tr>
						<?php } ?>
						</tbody>
						        </table>
                </div>
            <!-- END FORM-->
        </div>
		</div>
    </div>
	<?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,ACCOUNT_ID))) { ?>
		<div class="portlet box blue-madison">
		<div class="portlet-title">
            <div class="caption">
                <span aria-hidden="true" class="icon-user"></span>  Receive Fees
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('User', array('class' => 'form-horizontal add','type' => 'file')); ?>
			<?php 
				echo $this->Form->input("CLASS_ID",array('type'=>'hidden',"label"=>false,"div"=>false,'value'=>$CLASS_ID));
								 ?>
                <div class="form-body">
                    <h3 class="form-section">Fees Submission</h3>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Admission Fees: </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
									 <?php if(isset($admission_fees) && ($admission_fees!='') && ($admission_fees>0) && (is_numeric($admission_fees))) {  ?>
                                    <?php echo number_format($admission_fees,2); ?> (in Rs)
									<?php } ?>
                                </div>
                            </div>
                        </div>

					</div>
					<div class="row">
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Fee Type: <span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
								<?php 
									echo $this->Form->input("FEES_TYPE",array('options'=>$fees_types,"label"=>false,"div"=>false,'class'=>'form-control select2me'));
								 ?>
                                    
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Payment Terms: <span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
								<?php 
									echo $this->Form->input("PAYMENT_TERM",array('options'=>$payment_terms,"label"=>false,"div"=>false,'class'=>'form-control select2me'));
								 ?>
                                    
                                </div>
                            </div>
                        </div>
                        
					</div>
					<div class="row">
					<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Amount: </label>
								<div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
								<div id="StudentFee"></div>
                                    
                                </div>
                            </div>
                        </div>
					</div>
					<div class="row">	
					<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Receive Amount: <span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
								<?php 
									echo $this->Form->input("AMOUNT",array('type'=>"text","label"=>false,"div"=>false,"placeholder"=>"Please provide receive amount",'class'=>'form-control','maxlength'=>8));
								 ?>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Narration: </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
								<?php 
									echo $this->Form->input("NARRATION",array('type'=>"textarea","label"=>false,"div"=>false,"placeholder"=>"Please provide Narration",'rows'=>2,'cols'=>50,'class'=>'form-control'));
								 ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
								<button type="submit" class="btn bg-blue-chambray"  >Submit</button>
                                <button type="button" class="btn default"  onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Go Back</button>
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
	<?php  } ?>
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<style>
table.gridtable {
    font-family: verdana,arial,sans-serif;
    font-size: 11px;
    color: #333333;
    border-width: 1px;
    border-color: #666666;
    border-collapse: collapse;
}
</style>
<script type="text/javascript">

        $(document).ready(function(){
            $("#UserPAYMENTTERM,#UserFEESTYPE").bind("change",
            function(event){
                $.ajax({
                    async: true,
                    beforeSend: function(XMLHttpRequest){
                        $('#StudentFee').html('Wait..');
                    },
                    complete: function(XMLHttpRequest,
                    textStatus){
                        $('#StudentFee').attr('disabled',
                        true);
                    },
                    data: $("#UserPAYMENTTERM").closest("form").serialize(),
                    dataType: "html",
                    success: function(data,textStatus){
						var tmp = jQuery.parseJSON(data);
                        $("#StudentFee").html(tmp.status=='success'?tmp.msg+' Rs.':tmp.msg);
                    },
                    type: "post",
                    url: REQUEST_URL+"Users/GetFeeByTerms"
                });
                return false;
            });
        });
</script>

<script type="text/javascript">

function printthis()
{
 var w = window.open('', '', 'width=800,height=600,resizeable,scrollbars');
 w.document.write($("#abc").html());
 w.document.close(); // needed for chrome and safari
 javascript:w.print();
 w.close();
 return false;
}
</script>
