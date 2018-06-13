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
                        <a href="<?php echo Router::url(array('controller' => 'AcademicClasses', 'action' => 'index')) ?>">View All Academic Classes</a>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'AcademicClasses', 'action' => 'add')) ?>">Add New Academic Class</a>
                    </li>
                </ul>
            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Academic Class</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Academic Class</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Add Exam Syllabus
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('ExamSyllabus', array('class' => 'form-horizontal add', 'id' => 'AcademicClass')); ?>
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
                                <label class="control-label col-md-3">Syllabus<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                     <?php echo $this->Form->input('DESCRIPTION', array('type' => 'textarea','id' => 'textarea','label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => '12', 'rows' => '5' ,'data-error-container' => '#editor2_error')); ?>
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