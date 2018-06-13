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
                <a href="#">View</a>
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
                <span aria-hidden="true" class="icon-user"></span> Donation Fee
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
                        						
                  </div>
						
                   
                
                  
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

