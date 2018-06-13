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
                <a href="#">View Receipt</a>
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
                <span aria-hidden="true" class="icon-user"></span> Admission Fee
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
              <?php echo $this->Form->create('AdmissionConfirm', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
            
                <div class="form-body">
                   <div id="abc">
				   
				   <?php /* ?>
                    <table align="center" width="95%" style="border:2px solid #999;">
                    
                        <tr align="center">
								 
                            <td colspan="2"><strong><?php echo $school['School']['SCHOOL_NAME']?></strong></td>
                                                   
                        </tr>
                        <tr align="center">
								 
                            <td colspan="2"><strong><?php echo $school['School']['ADDRESS']?></strong></td>
                                                   
                        </tr>
                        <tr align="center">
								 
                            <td colspan="2">&nbsp;</td>
                          
                        </tr>                    
                        
                        <tr align="center">
								 
                            <td colspan="2" ><strong>Fees Receipt</strong></td>
                                                   
                        </tr>
                       
                        <tr align="center"  >
								 
                            <td colspan="2">&nbsp;</td>
                                                   
                        </tr>
                         <tr>
							<td style="padding-left:20px;"><strong>Receipt No : </strong> <?php print(Date("Y").$AdmissionConfirm['AdmissionConfirm']['ADM_ID']); ?></td> 
                            <td align="right" style="padding-right:20px;"><strong>Date :</strong> <?php print(Date("d-m-Y")); ?></td>
                                                 
                        </tr>
                        <tr>
							 
                            <td colspan="2" style="padding-left:20px;"><strong>Student Name :</strong> <?php echo $data['StudentRegistration']['FIRST_NAME'].' '.$data['StudentRegistration']['MIDDLE_NAME'].' '.$data['StudentRegistration']['LAST_NAME']  ?></td>
                                                  
                        </tr>
						
                       
                        <tr align="center">
							<td colspan="2">
                             
                            	<table border="1" width="95%" style="margin:10px;">
                                	<tr align="center">
                                    	<td width="20%"><strong>Sr.No</strong></td>
                                        <td width="60%"><strong>Description</strong></td>
                                        <td width="20%"><strong>Amount</strong></td>
                                    </tr>
                                    <tr>
                                    	<td align="center">1</td>
                                        <td align="center">Donation Fee</td>
                                        <td align="center"><?php echo $AdmissionConfirm['AdmissionConfirm']['AMOUNT'] ?></td>
                                    </tr>
                                    <tr>
                                    	<td>&nbsp;</td>
                                        <td align="right" style="padding-right:5px"><strong>Total</strong></td>
                                        <td align="center"><strong><?php echo $AdmissionConfirm['AdmissionConfirm']['AMOUNT'] ?></strong></td>
                                    </tr>
                                </table>
                                 
                            </td>
						</tr>	
                        <tr align="center"  >
								 
                            <td colspan="2">&nbsp;</td>
                                                   
                        </tr>
                         <tr align="center"  >
								 
                            <td colspan="2">&nbsp;</td>
                                                   
                        </tr>
                        <tr>
								 
                            <td style="padding-left:20px;"><strong></strong></td>
                            <td align="right" style="padding-right:20px;"><strong></strong></td>                      
                        </tr>
                        </table>
                        <?php */ ?>
						
						<!-- receipt_main_container -->
						<div class="receipt_main_container">
							
							<!-- receipt_main_table -->
							<table class="receipt_main_table" align="center" width="100%" cellpadding="0" cellspacing="0">
								<tr align="center">
									<td colspan="2">
										<h1><?php echo $school['School']['SCHOOL_NAME']?></h1>
									</td> 
								</tr>
								<tr align="center">
									<td colspan="2">
										<h4><?php echo $school['School']['ADDRESS']?></h4>
									</td>
								</tr>
								<tr align="center">
									<td colspan="2">&nbsp;</td>
								</tr>                    
								<tr align="center">
									<td colspan="2">
										<h2>Fees Receipt</h2>
									</td>  
								</tr>
								<tr align="center">
									<td colspan="2">&nbsp;</td>
								</tr>								
								<tr>
									<td colspan="2">
										<div class="date_div">
											<table align="center" width="100%" cellpadding="0" cellspacing="0">
												<tr>
													<td align="left">
														<strong>Receipt No :</strong> <?php print(Date("Y").$AdmissionConfirm['AdmissionConfirm']['ADM_ID']); ?>
													</td>
													<td align="right">
														<strong>Date :</strong> <?php print(Date("d-m-Y")); ?>
													</td>
												</tr>
												<tr>
													<td align="left">
														<strong>Student Name :</strong> <?php echo $data['User']['FIRST_NAME'].' '.$data['User']['MIDDLE_NAME'].' '.$data['User']['LAST_NAME']  ?>
													</td>
													<td align="right">
														<strong>Class :</strong> <?php echo $data['AcademicClass']['CLASS_NAME']; ?>
													</td>
												</tr>
											</table>
										</div>
									</td>
								</tr>
								<tr align="center">
									<td colspan="2">
										<div class="amount_container">
											<table class="amount_table" align="center" width="100%" cellpadding="0" cellspacing="0">
												<tr>
													<th align="center" width="10%"><strong>Sr. No</strong></th>
													<th style="text-align:left;" width="70%"><strong>Description</strong></th>
													<th style="text-align:right;" width="20%"><strong>Amount</strong></th>
												</tr>
												<tr class="amount_raw">
													<td align="center">1</td>
													<td align="left">Admission Fee</td>
													<td align="right"><?php echo $AdmissionConfirm['AdmissionConfirm']['AMOUNT'] ?></td>
												</tr>
												<!--<tr class="amount_raw">
													<td align="center">2</td>
													<td align="left">Term</td>
													<td align="right">2000.00</td>
												</tr>-->
												<tr class="amount_raw seperator">
													<td align="center"></td>
													<td align="left"></td>
													<td align="right"></td>
												</tr>
												<tr class="amount_raw total_raw">
													<td>&nbsp;</td>
													<td align="right" style="padding-right:5px"><strong>Total</strong></td>
													<td align="right"><strong><?php echo $AdmissionConfirm['AdmissionConfirm']['AMOUNT'] ?></strong></td>
												</tr>
												<tr class="amount_raw seperator">
													<td align="center"></td>
													<td align="left"></td>
													<td align="right"></td>
												</tr>
												<!--<tr class="amount_raw">
													<td>&nbsp;</td>
													<td align="right" style="padding-right:5px">Late Fee Amount</td>
													<td align="right">0.00</td>
												</tr>
												<tr class="amount_raw">
													<td>&nbsp;</td>
													<td align="right" style="padding-right:5px">Disc Amount</td>
													<td align="right">1000.00</td>
												</tr>
												<tr class="amount_raw">
													<td>&nbsp;</td>
													<td align="right" style="padding-right:5px">Other Amount</td>
													<td align="right">0.00</td>
												</tr>
												<tr class="amount_raw seperator">
													<td align="center"></td>
													<td align="left"></td>
													<td align="right"></td>
												</tr>
												<tr class="grand_total">
													<td>&nbsp;</td>
													<td align="right" style="padding-right:5px"><strong>Grand Total</strong></td>
													<td align="right"><strong>16,000.00</strong></td>
												</tr>-->
											</table>
										</div>
									</td>
								</tr>	
								<tr align="center"  >
									<td colspan="2">&nbsp;</td>   
								</tr>
								 <tr align="center"  >
									<td colspan="2">&nbsp;</td>					   
								</tr>
								<tr> 
									<td style="padding-left:20px;"><strong></strong></td>
									<td align="right" style="padding-right:20px;"><strong></strong></td>                      
								</tr>
							</table>
							
						</div>
						<!-- receipt_main_container -->
						
                  </div>
				  <!-- End: abc -->
					
					<!--<div class="form-actions fluid">
						<div class="row">
							<div class="col-md-6">
								<div class="col-md-offset-3 col-md-9">
									<button type="submit" class="btn bg-blue-chambray"> <a href="printpage" onClick="printthis(); return false;">Print</a></button>
								   
								</div>
							</div>
							<div class="col-md-6">
						</div>
                    </div>-->
                    
					<div class="form-actions fluid">
						<div class="row">
							<div class="col-md-6">
								<div class="col-md-offset-3 col-md-9 no_bg">
									<button type="submit" class="btn bg-blue-chambray" onClick="printthis(); return false;">Print</button>
								</div>
							</div>
						</div>
					</div>
					
                </div>
				<!-- End: form-body -->

             
            </form>
            <!-- END FORM-->
        </div>
	    </div>
	


</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<script type="text/javascript">

function printthis()
{
 var w = window.open('', '', 'width=800,height=600,resizeable,scrollbars');
 w.document.write($("#abc").html());
 w.document.write('<link href="<?php echo ASSETS_URL; ?>admin/layout/css/print_layout.css" rel="stylesheet" type="text/css" />'); 
 w.document.close(); // needed for chrome and safari
 javascript:w.print();
 w.close();
 return false;
}
</script>

