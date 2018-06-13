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
                <a href="#">Add New</a>
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
                <span aria-hidden="true" class="icon-user"></span>  Add New Student
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('StudentRegistration', array('class' => 'form-horizontal add', 'id' => 'Form',
            'type' => 'file')); ?>
            
            <?php echo $this->Form->input("FORM_NO", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
            
            
                <div class="form-body">
                    <h3 class="form-section">Student Info</h3>
                    
                     <h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Student Personal Information</h4>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">First Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                   <?php echo $this->request->data["StudentRegistration"]["FIRST_NAME"]; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Middle Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                <?php echo $this->request->data["StudentRegistration"]["MIDDLE_NAME"]; ?>
                                    
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
                                      <?php echo $this->request->data["StudentRegistration"]["LAST_NAME"]; ?>
                                  
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Gender</label>
                                <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                                     data-html='true' data-original-title="Select Gender">
                                      <?php echo $this->request->data["StudentRegistration"]["GENDER"]; ?>
                                   
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
                                     
                               <?php echo $this->request->data["StudentRegistration"]["DOB"]; ?>

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Birth Place</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <?php echo $this->request->data["StudentRegistration"]["BIRTH_PLACE"]; ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Age</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <?php echo $this->request->data["StudentRegistration"]["AGE"]; ?>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Father Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                     
                                     <?php echo $this->request->data["StudentRegistration"]["FATHER_NAME"]; ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Father Occupation</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Email ID">
                                     
                                      <?php echo $this->request->data["StudentRegistration"]["FATHER_OCCUPATION"]; ?>
                                </div>
                            </div>
                        </div>
                        
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Father Mobile No.</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                      <?php echo $this->request->data["StudentRegistration"]["FATHER_MOBILE"]; ?>
                                   
                                </div>
                          
                            </div>
                        </div>
                      </div>
						
						<div class="row">
                                   <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Father Email ID</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                
                                 <?php echo $this->request->data["StudentRegistration"]["FATHER_EMAIL"]; ?>
                                   
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                
                             <?php echo $this->request->data["StudentRegistration"]["MOTHER_NAME"]; ?>
                            
                                </div>
                            </div>
                        </div>
                    </div>


			<div class="row">
            <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Mobile No.</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                
                                  <?php echo $this->request->data["StudentRegistration"]["MOTHER_MOBILE"]; ?>
                                    
                                </div>
                            </div>
                        </div>
                       
                       <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Email ID</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                
                                 <?php echo $this->request->data["StudentRegistration"]["MOTHER_EMAIL"]; ?>
                                    
                                </div>
                            </div>
                        </div> 
                       
            
            </div>
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Occupation</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Email ID">
                          <?php echo $this->request->data["StudentRegistration"]["MOTHER_OCCUPATION"]; ?>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">National Language
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                     <?php echo $this->request->data["StudentRegistration"]["NATIONAL_LANGUAGE"]; ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Religion
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                     
                                      <?php echo $this->request->data["StudentRegistration"]["RELIGION"]; ?>
                                   
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mother Tongue
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                     
                                      <?php echo $this->request->data["StudentRegistration"]["MOTHER_TONGUE"]; ?>
                                   
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Cast
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                     
                                     <?php echo $this->request->data["StudentRegistration"]["CAST"]; ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Sub Cast
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Password">
                                     <?php echo $this->request->data["StudentRegistration"]["SUB_CAST"]; ?> 
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Cast Category</label>
                                <div class="col-md-9">
                                
                               <?php echo $this->request->data["CastCategory"]["CAST_CAT_NAME"]; ?>
                                    
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Blood Group</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Contact No.">
                                     
                                    <?php echo $this->request->data["BloodGroup"]["BLOOD_GROUP_NAME"]; ?>
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Class</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                                     <?php echo $this->request->data["AcademicClass"]["CLASS_NAME"]; ?>
                                       </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Medium</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <?php echo $this->request->data["Medium"]["MEDIUM_NAME"]; ?>
                                     
                                    
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Email</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                                     <?php echo $this->request->data["StudentRegistration"]["EMAIL_ID"]; ?> 
                                    
                                </div>
                            </div>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Mobile No.</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <?php echo $this->request->data["StudentRegistration"]["MOBILE_NO"]; ?> 
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Contact No</label>
                               <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <?php echo $this->request->data["StudentRegistration"]["CONTACT_NO"]; ?> 
                                    
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
                                <label class="control-label col-md-3">Pincode</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                      <?php echo $this->request->data["StudentRegistration"]["PINCODE"]; ?> 
                                    
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
                                     
                                      <?php echo $this->request->data["StudentRegistration"]["ADDRESS"]; ?> 
                                </div>
                            </div>
                        </div>

                    </div>

               
                        <div class="row">
                        
                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Marital Status</label>
                                <div class="col-md-9">
                                
                                 <?php echo $this->request->data["StudentRegistration"]["MARITAL_STATUS"]; ?> 
                                </div>
                            </div>
                        </div>
                     

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Extra Curiculam Activities</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <?php echo $this->request->data["StudentRegistration"]["EXTRA_ACTIVITIES"]; ?> 
                                    
                                </div>
                            </div>
                        </div>
                        </div>
                        </div>
                        
                         <div class="form-body">
 <h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Academic History</h4>
 
 					 <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last School Name</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                                      <?php echo $this->request->data["StudentRegistration"]["LAST_SCHOOL_NAME"]; ?> 
                                </div>
                            </div>
                        </div>
                   
                    
                     <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Board</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                                     <?php echo $this->request->data["StudentRegistration"]["LAST_BOARD"]; ?> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    
                     <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Medium</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     
                                      <?php echo $this->request->data["Medium"]["MEDIUM_NAME"]; ?>
                                   
                                </div>
                            </div>
                        </div>

                          
 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Class</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    
                                     <?php echo $this->request->data["AcademicClass"]["CLASS_NAME"]; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                    
                    
                    <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Percentage of Marks / Grade </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <?php echo $this->request->data["StudentRegistration"]["LAST_PERCENTAGE"]; ?> 
                                </div>
                            </div>
                        </div>
                        
                          <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Description</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                      <?php echo $this->request->data["StudentRegistration"]["ACD_HISTORY_DESCRIPTION"]; ?> 
                                   
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    
                    <h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Subject Group</h4>
                    
                      <div class="row">
                   
                   	<div class="form-group">
                    <div class="col-md-6">
                                <label class="control-label col-md-3">Select Group<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                   <?php echo $this->request->data["Group"]["GROUP_NAME"]; ?> 
                                </div>
                            </div>
                        
                        

                        </div>
					</div>
                    
                    
                   
                  
                     <h4 style="background:#996; margin-bottom::15px; color:#fff; padding:5px; text-align:center;">Status</h4>
                    
                    <div class="row">
       
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Status</label>
                                    <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                                         data-html='true' data-original-title="Status">
                                         <?php $abc=$this->request->data["StudentRegistration"]["STATUS"]; 
										 if($abc == 1)
										 {
											echo 'Active'; 
										 }else{
											echo 'Inactive' ;
										 }
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

</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>


<script>
function checkall(obj) {

	$("#users_list").find("input[type=checkbox]").each(function(){
		$(this).prop('checked',obj.checked);
	});	
}

$(document).ready(function(){
	if($("#StudentRegistrationGROUP").val()>0) { 
		subject();
	}
	
	$("#StudentRegistrationGROUP").change(function(){
		subject();
	});	
	
	$("#Form").submit(function(){
		var tmp = [];
		$("input[type=checkbox]:checked").each(function(){
			tmp[tmp.length] = $(this).val();
		});
		
		$("#StudentRegistrationSelectedFields").val(tmp.join(","));
		//return false;
	});
	
});

function subject() { 

		
		$.ajax({    async: true,
                    beforeSend: function(XMLHttpRequest){
                        $('#wrapper_user').hide();
						
						$("#checkall").find("input[type=checkbox]").each(function(){
							$(this).prop('checked',false);
						});
						
						$("#checkall").hide();
							
                    },
                    complete: function(XMLHttpRequest,textStatus){ 
                        // $('#UserAMOUNT').attr('readonly', true);
                    },
                    data:$("#Form").serialize(),
                    dataType: "html",
                    success: function(data,textStatus){
                        $('#wrapper_user').show();
						var tmp = jQuery.parseJSON(data);
						if(tmp.status=='success') { 
							$("#checkall").show();
							$("#users_list").html(tmp.lists);
							
							if($("#StudentRegistrationSelectedFields").val() !='') {
								var jtmp = [];
								jtmp =  $("#StudentRegistrationSelectedFields").val().split(",");
								for(i in jtmp) {
									var tmpk = jtmp[i];
									if(tmpk=='on') { 
										$("#checkall").find("input[type=checkbox]").prop('selected',true);
									}else{
										$("#users_list").find("input[type=checkbox]").each(function(){
											if($(this).val()==tmpk) {
												$(this).prop('checked',true);
											}
										});
									}
								}
							}
							
						}else{
							$("#users_list").html('No User Found.');
						}
						return false;
						
                    },
                    type: "post",
                    url: REQUEST_URL+"StudentRegistration/getsubject"
                });
                return false;
		
	
	
}
</script>


