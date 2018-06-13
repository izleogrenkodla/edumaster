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
                <a href="#">Salary</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Salary</a>
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
                <span aria-hidden="true" class="icon-user"></span> Salary Slip
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
              <?php echo $this->Form->create('Salary', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
            
                <div class="form-body">
                   <div id="abc">
                    <table align="center" width="90%" style="border:3px solid #999;">
                    
                        <tr>
								<td rowspan="4">
                                <?php
                                    if(isset($school["School"]["LOGO_IMAGE"]) && $school["School"]["LOGO_IMAGE"]!='') {
                                        $img = $school["School"]["LOGO_IMAGE"];
                                        $path = SITE_URL . 'files/upload_document/'.$img;
                                        ?>
                                        <div style="float:left;width:100px;">
                                            <img src="<?php echo $path ?>" height="100" width="130" />
                                        </div>
                                    <?php } ?>
                                </td> 
                            <td><h3><strong><?php echo $school['School']['SCHOOL_NAME']?></strong></h3></td>
                                                   
                        </tr>
                        <tr>
								
                            <td><strong><?php echo $school['School']['ADDRESS']?></strong></td>
                                                   
                        </tr>
                         <tr>
								 
                            <td><strong><?php echo $school['School']['EMAIL']?></strong></td>
                                                   
                        </tr>
                         <tr>
								 
                            <td><strong><?php echo $school['School']['PHONE_NO']?></strong></td>
                                                   
                        </tr>
                 	<tr>
                    	<td colspan="2">&nbsp;</td>
                    </tr>
                       <tr>
                       
                       	<td colspan="2" style="border-top:3px solid #666; margin:10px 0;">&nbsp;</td>
                       </tr>
                       
                         <tr>
                                <td colspan="2" align="center"><strong>Paid Slip For The Period of
								<?php if($data['Salary']['PAID_MONTH'] == 01)
								{
									echo 'January';
								}elseif ($data['Salary']['PAID_MONTH'] == 02) {
									echo 'February';
								}elseif ($data['Salary']['PAID_MONTH'] == 03) {
									echo 'March';
								}elseif ($data['Salary']['PAID_MONTH'] == 04) {
									echo 'April';
								}elseif ($data['Salary']['PAID_MONTH'] == 05) {
									echo 'May';
								}elseif ($data['Salary']['PAID_MONTH'] == 06) {
								   echo 'June';
								}elseif ($data['Salary']['PAID_MONTH'] == 07) {
									echo 'July';
								}elseif ($data['Salary']['PAID_MONTH'] == 08) {
									echo 'August';
								}elseif ($data['Salary']['PAID_MONTH'] == 09) {
									echo 'September';
								}elseif ($data['Salary']['PAID_MONTH'] == 10) {
								   echo 'October';
								}elseif ($data['Salary']['PAID_MONTH'] == 11) {
									echo 'November';
								}elseif ($data['Salary']['PAID_MONTH'] == 12) {
									echo 'December';
								}
								?>
                                
                                <?php echo date("Y")  ?></strong></td>            
                        </tr>
                        
                        </tr>	
                        <tr align="center"  >
								 
                            <td colspan="2">&nbsp;</td>
                                                   
                        </tr>
                       
                        <tr align="center">
													
                                <td colspan="2">
                                    <table align="center" width="95%">
                                    	<tr>
                                            <td width="20%"><strong>Name</strong></td>
                                            <td width="30%"><?php echo $data['Name']['FIRST_NAME'].' '. $data['Name']['MIDDLE_NAME'].' ' .$data['Name']['LAST_NAME']; ?></td></td>
                                        	<td width="20%"><strong>Role</strong></td>
                                            <td width="30%"><?php echo $data['Role']['ROLE_NAME']; ?></td>
                                        </tr>
                                        <tr>
                                            <td><strong>Base Salary</strong></td>
                                            <td><?php echo $data['Salary']['BASE_SALARY']; ?></td></td>
                                        	<td><strong>Date</strong></td>
                                            <td><?php echo $data['Salary']['GEN_DATE']; ?></td>
                                        </tr>
                                        
                                         <tr>
                                            <td><strong>Month Total Day</strong></td>
                                            <td><?php echo $data['Salary']['TOTAL_DAY']; ?></td>
                                        	<td><strong>Present Day</strong></td>
                                            <td><?php echo $data['Salary']['PRESENT_DAY']; ?></td>
                                        </tr>
                                        
                                         <tr align="center"  >
								 
                                            <td colspan="2">&nbsp;</td>
                                                                   
                                        </tr>
                                        
                                        <tr>
                                            <td colspan="2">
                                            	<table align="center" width="95%" border="1">
                                                	<tr>
                                                    	<td align="center"><strong>Earning</strong></td>
                                                        <td align="center"><strong>Amount</strong></td>
                                                   </tr>
                                             		<tr>
                                                        <td><strong>Net Salary</strong></td>
                                                        <td align="right"><?php echo $data['Salary']['NET_SALARY']; ?></td>
                                             		</tr>
                                                    <tr>
                                                        <td><strong>TA</strong></td>
                                                        <td align="right"><?php echo $data['Salary']['TA']; ?></td>
                                             		</tr>
                                                     <tr>
                                                        <td><strong>DA</strong></td>
                                                        <td align="right"><?php echo $data['Salary']['DA']; ?></td>
                                             		</tr>
                                                      <tr>
                                                        <td><strong>Other Addition</strong></td>
                                                        <td align="right"><?php echo $data['Salary']['OTHER_ADDITION']; ?></td>
                                             		</tr>
                                                    <?php $pul =  $data['Salary']['OTHER_ADDITION']+$data['Salary']['DA']+$data['Salary']['TA']+$data['Salary']['NET_SALARY']; ?>
                                                     <tr>
                                                        <td align="right"><strong>Total</strong></td>
                                                        <td align="right"><?php echo $pul; ?></td>
                                             		</tr>
                                                </table>
                                            </td>
                                            
                                        	<td colspan="2">
                                            <table align="center" width="95%" border="1">
                                                	<tr>
                                                    	<td align="center"><strong>Deduction</strong></td>
                                                        <td align="center"><strong>Amount</strong></td>
                                                   </tr>
                                             		<tr>
                                                        <td><strong>PF</strong></td>
                                                        <td align="right"><?php echo $data['Salary']['PF']; ?></td>
                                             		</tr>
                                                    <tr>
                                                        <td><strong>Tax</strong></td>
                                                        <td align="right"><?php echo $data['Salary']['TAX']; ?></td>
                                             		</tr>
                                                     <tr>
                                                        <td><strong>Other Deduction</strong></td>
                                                        <td align="right"><?php echo $data['Salary']['OTHER_DEDUCTION']; ?></td>
                                             		</tr>
                                                     <?php 
                        if($data['Salary']['OUTSANDING_AMOUNT'])
						{
						?>
                          							<tr>
                                                        <td><strong>Deduct Amount</strong></td>
                                                        <td align="right"><?php echo $data['Salary']['DEDUCT_AMOUNT']; ?></td>
                                             		</tr>
                        <?php
						}else{
						?>
                                                     <tr>
                                                        <td><strong>&nbsp;</strong></td>
                                                        <td align="right">&nbsp;</td>
                                             		</tr>
                                                    <?php } ?>
                                                     <?php $dud=  $data['Salary']['PF']+$data['Salary']['TAX']+$data['Salary']['OTHER_DEDUCTION']+$data['Salary']['DEDUCT_AMOUNT'];?>
                                                     <tr>
                                                        <td align="right"><strong>Total</strong></td>
                                                        <td align="right"><?php echo $dud;?></td>
                                             		</tr>
                                                </table>
                                            
                                            </td>
                                            
                                        </tr>
                                        
                                    </table>
                                </td>                
                                                    
                         </tr>	
                        <tr align="center"  >
								 
                            <td colspan="2">&nbsp;</td>
                                                   
                        </tr>
                        <?php 
                        if($data['Salary']['OUTSANDING_AMOUNT']>1)
						{
						?>
                         <tr>
                                <td colspan="2" align="center"><strong>Current Outstanding <?php echo $data['Salary']['OUTSANDING_AMOUNT']; ?>.
								</strong></td>          
                        </tr>
                        <?php
						}
						?>
                         <tr>
                                <td colspan="2" align="center"><strong><h3>Net Payable Salary is <?php echo $pul-$dud; ?>.</h3>
								</strong></td>   
                         </tr>
                        
                         <tr align="center"  >
								 
                            <td colspan="2">&nbsp;</td>
                                                   
                        </tr>
                        <tr>
								 
                            <td style="padding-left:20px;"><strong></strong></td>
                            <td align="right" style="padding-right:20px;">
                            <?php
							
                                    if(isset($school['School']['AUT_SIGN']) && $school['School']['AUT_SIGN']!='') {
                                        $img = $school['School']['AUT_SIGN'];
                                        $path = SITE_URL . 'files/upload_document/'.$img;
                                        ?>
                                        <div style="width:100px;">
                                            <img src="<?php echo $path ?>" height="40" width="90" align="middle" />
                                        </div>
                                    <?php } ?>
                            
                            </td>                      
                        </tr>
                        <tr>
								 
                            <td style="padding-left:20px;"><strong></strong></td>
                            <td align="right" style="padding-right:20px;"><strong>Authority Sign</strong></td>                      
                        </tr>
                        </table>
                        						
                  </div>
						
                   <div> &nbsp; </div>
                   <div> &nbsp; </div>
                  
                  
<div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn bg-blue-chambray"> <a href="printpage" onClick="printthis(); return false;">Print</a></button>
                               
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

