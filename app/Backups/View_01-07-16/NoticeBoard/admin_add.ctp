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
                <a href="#">Notice</a>
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
                <span aria-hidden="true" class="icon-user"></span>  Add New Notice
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('NoticeBoard', array('class' => 'form-horizontal add', 'id' => 'Form',
            'type' => 'file')); 
			 echo $this->Form->input('selected_fields', array('type' => 'hidden', 'default' => '', 'class' => 'form-control','label' => FALSE_VALUE,'div' => FALSE_VALUE));
			?>
                <div class="form-body">
                    <h3 class="form-section">Notice Board</h3>

                    <div class="row">
						
						
						<?php if(in_array($user_role,array(TEACHER_ID,ADMIN_ID,HR_ID,ACCOUNT_ID,SUPERVISOR_ID))) {  ?>
                        
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Role<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
									<?php
                                    echo $this->Form->input('ROLE_ID', array('options' => $students , 'default' => '', 'class' => 'form-control select2me','label' => FALSE_VALUE,'div' => FALSE_VALUE));
                                    ?>
									
                                </div>
                            </div>
							<div class="form-group">
                                <label class="control-label col-md-3">Select Class<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
									<?php
                                    echo $this->Form->input('CLASS_ID', array('options' => $class ,'disabled', 'default' => '','onchange' => 'test()', 'class' => 'form-control select2me','label' => FALSE_VALUE,'div' => FALSE_VALUE));
                                    ?>
									
                                </div>
								
                            </div>
							<div align="center" id="checkall" style="display:none;"><input type="checkbox"   onclick="checkall(this)"  />Check All</div>
                        </div>
						
						<?php } ?>
						


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Notice Title <span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->Form->input('NOTICE_TITLE', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group" id="wrapper_user" >
                                <label class="control-label col-md-3">User selected <span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <div id="users_list" style="height:150px;overflow:scroll;"></div>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Notice Description <span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('NOTICE_DESC', array('type' => 'textarea',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn bg-blue-chambray">Submit</button>
                                <button type="button" class="btn default"  onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Cancel</button>
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

function uncheck(){
	
	
    $('div.checker').find('span').prop('class','');
   //alert(hasCheckedClas);

}
$(document).ready(function(){
	if($("#NoticeBoardROLEID").val()>0) { 
		noticeboard();
		return false;
	}

	
	$("#NoticeBoardROLEID").change(function(){
		noticeboard();
	});	
	
	$("#Form").submit(function(){
		var tmp = [];
		$("input[type=checkbox]:checked").each(function(){
			tmp[tmp.length] = $(this).val();
		});
		
		$("#NoticeBoardSelectedFields").val(tmp.join(","));
		//return false;
	});
	
});

function noticeboard() { 
		
		if($("#NoticeBoardROLEID").val()==0) {
			
			 
			$("#NoticeBoardCLASSID").attr('disabled', 'disabled');
			document.getElementById("users_list").innerHTML = "";
			$("#checkall").hide();
			alert("Please select Valid Role");
			
			
		}else if($("#NoticeBoardROLEID").val()== <?php echo STUDENT_ID;?> && $("#NoticeBoardCLASSID").val()==0){
			document.getElementById("users_list").innerHTML = "";
			$("#checkall").hide();
			$("#NoticeBoardCLASSID").removeAttr("disabled");
			return false;
			
			
			
		}else if($("#NoticeBoardROLEID").val()== <?php echo STUDENT_ID;?> && $("#NoticeBoardCLASSID").val() > 0){
			test();
			return false;
			
		}else{
			
			$("#NoticeBoardCLASSID").attr('disabled', 'disabled');
		}
		
			
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
							uncheck();
							$("#users_list").html(tmp.lists);
							
							if($("#NoticeBoardSelectedFields").val() !='') {
								var jtmp = [];
								jtmp =  $("#NoticeBoardSelectedFields").val().split(",");
								
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
                    url: REQUEST_URL+"NoticeBoard/getUserbyRole"
                });
                return false; 
		
	
	
}
function test(){
	document.getElementById("users_list").innerHTML = "";
	$("#NoticeBoardCLASSID").removeAttr("disabled");
	$("#checkall").hide();
	var id = $("#NoticeBoardCLASSID").val();
	if(id==0){
		
		alert('Please Select Valid Academic Class');
		$("#checkall").hide();
		return false;
	}
	uncheck();
	$("#checkall").show();
	var data = 'id='+ id;
	 $.ajax({
        type:"POST",
		data:data,
        cache:false,
        url:"getUserbyClass",    // multiple data sent using ajax
        success: function (html) {

          
          $('#users_list').html(html);
        }
      });
      return false;
	
		
	
	
	
}
	
	


</script>