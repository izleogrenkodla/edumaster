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
                <a href="#">Student</a>
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
                <span aria-hidden="true" class="icon-user"></span> ID Card
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
                    <table align="center" width="27%" style="border:1px solid #6a6a68;">
                    
                        <!-- <tr class="idcard_header">
				                <td rowspan="4">
                                <?php
                                    if(isset($school["School"]["LOGO_IMAGE"]) && $school["School"]["LOGO_IMAGE"]!='') {
                                        $img = $school["School"]["LOGO_IMAGE"];
                                        $path = SITE_URL . 'files/upload_document/'.$img;
                                        ?>
                                        <div style="float:left;">
                                            <img src="<?php echo $path ?>" height="100" width="130" />
                                        </div>
                                    <?php } ?>
                                </td> 
                            <td><h3><strong><?php echo $school['School']['SCHOOL_NAME']?></strong></h3></td>
                                                   
                        </tr> -->
                        <tr class="idcard_header">
                            <td colspan="2">
                                                                    <?php
                                    $path = SITE_URL . 'assets/admin/layout/img/idcard_logo.jpg';
                                    ?>

                                    <img src="<?php echo $path ?>" alt="" />
                            </td>
                        </tr>
                        <!-- <tr>
								
                            <td><strong><?php // echo $school['School']['ADDRESS']?></strong></td>
                                                   
                        </tr>
                         <tr>
								 
                            <td colspan="2"><strong><?php //echo $school['School']['EMAIL']?></strong></td>
                                                   
                        </tr>
                         <tr>
								 
                            <td><strong><?php //echo $school['School']['PHONE_NO']?></strong></td>
                                                   
                        </tr> 
                 	<tr>
                    	<td colspan="2">&nbsp;</td>
                    </tr> 
                       <tr>
                       
                       	<td colspan="2" style="border-top:5px solid #2c156f; margin:10px 0;">&nbsp;</td>
                       </tr> -->
                       
                         <tr>
                                <!--<td colspan="2" align="center"><strong><?php //echo $data["Role"]["ROLE_NAME"].' '.'ID Card' ?></strong></td>-->
                        </tr>
                      
                       
                        <tr align="center">
							<td colspan="2">
                             
                            	<table border="0" width="95%" id="id_card">
                                	<tr align="center" >
                                    	<td align="center" colspan="2">
                                        <?php
											if(isset($data["User"]["IMAGE_URL"]) && $data["User"]["IMAGE_URL"]!='') {
												$img = $data["User"]["IMAGE_URL"];
												$path = SITE_URL . 'files/upload_document/'.$img;
												?>
												<div class="idcard_photo">
													<img src="<?php echo $path ?>" alt="" />
												</div>
										<?php } ?>
                                        </td> 
                                       
                                       
                                    </tr>
									<tr>
                                        <td align="center" colspan="2">&nbsp;</td>
									</tr>
									
                                    <tr class="idcard_name">
                                        <td width="20%"><strong> Name</strong></td>
                                        <td class="idcard_name_value"><strong> <?php echo $data["User"]["FIRST_NAME"]." ".$data["User"]["MIDDLE_NAME"]." ".$data["User"]["LAST_NAME"] ?></strong></td>
                                        
                                    </tr>
									 <tr>
                                    	 <td width="20%"><strong> Class</strong></td>
                                         <td><strong><?php echo $data["AcademicClass"]["CLASS_NAME"] ?></strong></td>
                                        
                                    </tr>
                                     <tr >
                                    	 <td valign='top' width="20%"><strong> Address</strong></td>
                                        <td><strong><?php echo $data["User"]["ADDRESS"] ?></strong></td>
                                        
                                    </tr>
                                     <tr>
                                     	
                                    	 <td width="20%"><strong>Contact</strong></td>
                                          <td><strong><?php echo $data["User"]["CONTACT_NO"] ?></strong></td>
                                        
                                    </tr>
                                </table>
                                 
                            </td>
						</tr>	
                        
                         <tr align="center"  >
								 
                            <td colspan="2">&nbsp;</td>
                                                   
                        </tr>
						<tr>
                       
                       	<td colspan="2" style="border-top:3px solid #281773; margin:10px 0;">&nbsp;</td>
                       </tr>
                        
                        <tr>	 
                            <td colspan="2" class="idcard_footer">
                                <p class="idcard_address"><?php echo $school['School']['ADDRESS']?></p>
                                <p class="idcard_contact"><?php echo $data["User"]["CONTACT_NO"] ?></p>
                            </td>  
                        </tr>
                        </table>
                        						
                  </div>
						
                   <div> &nbsp; </div>
                   <div> &nbsp; </div>
                  
                  

            <!-- END FORM-->
        </div>
		<div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <!--<button type="submit" class="btn bg-blue-chambray"> <a href="printpage" onClick="printthis(); return false;">Print</a></button>-->
                                <button type="submit" class="btn bg-blue-chambray" onClick="printthis(); return false;">Print</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
      
                </div>

             
            </form>
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

