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
                <span aria-hidden="true" class="icon-user"></span>  Add Group
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('Group', array('class' => 'form-horizontal add', 'id' => 'Form',
            'type' => 'file')); 
			 echo $this->Form->input('selected_fields', array('type' => 'hidden', 'default' => '', 'class' => 'form-control','label' => FALSE_VALUE,'div' => FALSE_VALUE));
			?>
                <div class="form-body">
                    <h3 class="form-section">Group</h3>

                    <div class="row">
						
						
						<?php //if(in_array($user_role,array(TEACHER_ID,ADMIN_ID,HR_ID,ACCOUNT_ID,SUPERVISOR_ID))) {  ?>
                        
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Class<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
									<?php
                                   
                                    echo $this->Form->input('Class_ID', array('options' => $classes, 'default' => '', 'class' => 'form-control select2me','label' => FALSE_VALUE,'div' => FALSE_VALUE));
                                    ?>
                                   
									<div id="checkall" style="display:none;"><input type="checkbox"   onclick="checkall(this)"  />Check All</div>
                                </div>
                            </div>
                        </div>
						
						<?php// } ?>
						


                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Group Name<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                    <?php echo $this->Form->input('GROUP_NAME', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group" id="wrapper_user" >
                                <label class="control-label col-md-3">Select Subject<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <div id="users_list" style="height:150px;overflow:scroll;"></div>
                                </div>
                            </div>
                        </div>
					
                     <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Status</label>
                                <div class="col-md-9 tooltips">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="data[Group][STATUS]" value="1" checked/>
                                            Active </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[Group][STATUS]" value="0" />
                                            Inactive </label>
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

$(document).ready(function(){
	if($("#GroupClassID").val()>0) { 
		subject();
	}
	
	$("#GroupClassID").change(function(){
		subject();
	});	
	
	$("#Form").submit(function(){
		var tmp = [];
		$("input[type=checkbox]:checked").each(function(){
			tmp[tmp.length] = $(this).val();
		});
		
		$("#GroupSelectedFields").val(tmp.join(","));
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
							
							if($("#GroupSelectedFields").val() !='') {
								var jtmp = [];
								jtmp =  $("#GroupSelectedFields").val().split(",");
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
                    url: REQUEST_URL+"Group/getsubject"
                });
                return false;
		
	
	
}
</script>
