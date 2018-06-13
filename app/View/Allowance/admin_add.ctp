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
            <li class="btn-group">
                <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                    <span>Actions</span><i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'Allowance', 'action' => 'index')) ?>">View All Allowance</a>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'Allowance', 'action' => 'add')) ?>">Add New Allowance</a>
                    </li>
                </ul>
            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Allowance</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Allowance</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Add Allowance
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('Allowance', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
                <div class="form-body">

                    <div class="row">
                    	  <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Type<span class="required">
										* </span>
                                </label>
                                 <div class="col-md-9 tooltips"  data-container="body" data-placement='bottom'
                                     data-html='true' data-original-title="Select Gender">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio"
                                             name="data[Allowance][ALLOWANCE_TYPE]" value="1" checked/>
                                             Addition</label>
                                        <label class="radio-inline">
                                            <input type="radio" 
                                            name="data[Allowance][ALLOWANCE_TYPE]" value="2" />
                                            Deduction </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Name<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $this->Form->input('ALLOWANCE_NAME', array('type' => 'text', 'default' => '', 'class' => 'form-control', 'placeholder' => 'Example :- ( Maths, English )','label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>
                                </div>
                            </div>
                        </div>
                      

                    </div>
                    
                    <div class="row">
                          <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">By<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                              
                                
                                    <?php
                                    echo $this->Form->input('BY_TYPE', array('options' => $by ,  'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE,'onchange'=>'select(this)'));
                                    ?>
                                </div>
                            </div>
                        </div>
                       
                      <div id = 'test'>
                      
                      </div>
                      

                    </div> 
                    <div class="row">
                    
                     <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Status</label>
                                <div class="col-md-9 tooltips">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="data[Allowance][STATUS]" value="1" checked/>
                                            Active </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[Allowance][STATUS]" value="0" />
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
                                <button type="button" class="btn default" onclick="window.location.href='<?php echo Router::url(array("controller"=>"Subjects","action"=>"index")); ?>'">Cancel</button>
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

function select(data){
			var vid = $(data).val();
			//alert (vid);
			
			if(vid==0){
				//$("#test").remove();
				alert('Please select Allowance By');
			}else{
			var vid = $(data).val();
			var data = 'id='+ vid;
			//alert(data);
			$.ajax({
			data:data,
			url:REQUEST_URL+"Allowance/GetBox",
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
        $(document).ready(function(){
            $("#AllowanceALLOWANCETYPE").bind("change",
            function(event){
                $.ajax({
					
                    async: true,
                    beforeSend: function(XMLHttpRequest){
                        // $('#UserAMOUNT').attr('readonly',true);
                    },
                    complete: function(XMLHttpRequest,
                    textStatus){
                        // $('#UserAMOUNT').attr('readonly', true);
                    },
					
                    data: $("#AllowanceALLOWANCETYPE").closest("form").serialize(),
                    dataType: "html",
                    success: function(data,
                    textStatus){
                        $("#AllowanceALLOWANCETYPE").html(data);
                    },
                    type: "post",
                    url: REQUEST_URL+"Allowance/GetBox"
                });
                return false;
            });
        });
</script>