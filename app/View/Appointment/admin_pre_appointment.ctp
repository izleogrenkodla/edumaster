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
                <a href="#">Appointment Letter</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Appointment Letter</a>
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
                <span aria-hidden="true" class="icon-user"></span> Appointment Letter
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
              <?php echo $this->Form->create('Appointment', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
            
                <div class="form-body">
                   <div id="abc">
                    <table align="center" width="85%" style="border:3px solid #999;">
                    
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
                       
                       	<td colspan="2" style="font-family:'Arial Black', Gadget, sans-serif; font-size:20px" align="center"><strong>APPOINTMENT LETTER</strong></td>
                       </tr>
                      
                       
                        <tr>
                        
               
							<td colspan="2" style="padding-left:25px">
                             <strong style="font:'MS Serif', 'New York', serif; margin-left:px">
                            	Dear  <?php echo $data["User"]["FIRST_NAME"]." ".$data["User"]["MIDDLE_NAME"]." ".$data["User"]["LAST_NAME"] ?><br />
<br />
I HR Manager hereby inform you that our hiring team hass appointed for the post of <?php  echo $data['Role']['ROLE_NAME']  ?>,
<br />
<br/>
further details are listed below.
<br />
<br/>
Designation : <?php  echo $data['Role']['ROLE_NAME']  ?>
<br />
<br/>
Salary : <?php  echo $data['User']['BASE_SALARY']  ?>
<br />
<br/>
Joining Date :  <?php  echo $data['User']['JOINING_DATE']  ?>
<br />
<br/>

In the best interest of the school we are required your confirmation immediately.
<br />
<br/>

Regards,
<br />
<br/>
<?php echo $hr;   ?>
</strong>
                                 
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

