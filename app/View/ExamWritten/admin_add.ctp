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
                <a href="#">Exam Written</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Exam Written</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Add Exam Written Mark
             </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('ExamWritten', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
                <div class="form-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Exam Type<span class="required">
										* </span>
                                </label>
                              <div class="col-md-9 tooltips">
								<?php
								echo $this->Form->input('EXAM_TYPE_ID', array('options' => $EXAM_TYPE_ID, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,'div' => FALSE_VALUE));
								?>
							</div>
                            </div>
                        </div>
                
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Select Class<span class="required">
										* </span>
								</label>
								<div class="col-md-9 tooltips">
									<?php
									echo $this->Form->input('CLASS_ID', array('options' => $AcademicClass, 'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,'div' => FALSE_VALUE, 'onchange'=>'select(this)'));
									?>
								</div>
							</div>
						</div>	
					</div>
					
					 <div class="row">
					 
						<div id = 'test'>

                        </div>
                
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Exam Mark<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    echo $this->Form->input('MARK', array('type' => 'text', 'default' => '', 'class' => 'form-control', 'label' => FALSE_VALUE,'div' => FALSE_VALUE));
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
                                <button type="submit" class="btn bg-blue-chambray">Submit</button>
                                <button type="button" class="btn default" onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Cancel</button>
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
                alert('Please select Month');
            }else{
            var vid = $(data).val();
            var data = 'id='+ vid;
            //alert(data);

            $.ajax({
            data:data,
            url:REQUEST_URL+"TeacherTimeTables/GetSubjectByClass",
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