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
                <a href="#">Teacher Time Table</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Teacher Time Table</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Add Teacher Time Table
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <?php echo $this->Form->create('TeacherTimeTable', array('class' => 'form-horizontal add','type' => 'file')); ?>
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Select Class<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('CLASS_ID', array('options' => $GetAcademicClasses, 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me', 'onchange'=>'select(this)')); ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Teacher<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('TEACHER_ID', array('options' => $teacher_lists, 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me')); ?>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
					
						<div id = 'test'>

                        </div>
					
					
                       <!-- <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Select Subject<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('SUBJECT_ID', array('options' => $subjects, 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me')); ?>
                                </div>
                            </div>
                        </div> -->
                        
                         
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Week Of Day<span class="required">
										* </span>
                                </label>
                               <div class="col-md-9 tooltips">
							   <ul class="week_container">
								<?php
								$weeks = array(
								
								'1' => 'Monday',
								'2' => 'Tuesday',
								'3' => 'Wednesday',
								'4' => 'Thursday',
								'5' => 'Friday',
								'6' => 'Saturday'
								);
								
								foreach($weeks as $key=>$vel)
								{
								echo '<li><input type="checkbox" name=TT_DATE[] 
								value='.$key.' </li>';
                              // echo $this->Form->input('TT_DATE[]', array('type' => 'checkbox','default' => '', 'label' => FALSE_VALUE, 'value' => $key,'div' => FALSE_VALUE));
									echo $vel.'<br>';
								}
                                ?>     
								</ul>	
                            </div>
                        </div>
                    </div>
					
                </div>
				<div class="row">
                       <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Start Time<span class="required"> * </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('START_TIME', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">End Time<span class="required"> * </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('END_TIME', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                        </div>
                        
                    </div>

                    <div class="row">
           
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Narration  </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('NARRATION',
									 array('type' => 'textarea','label' => FALSE_VALUE,
										'rows'=>2,'div' => FALSE_VALUE,
										 'data-required' => '1', 'class' => 'form-control')); ?>
                                </div>
                            </div>
                        </div>

                        
                    </div>
                    <!--/row-->
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9 no_bg">
                                <button type="submit" class="btn bg-blue-chambray">Submit</button>
								<a href="<?php echo Router::url(array("action"=>"index")); ?>" class="btn default">Cancel</a>
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
$(document).ready(function(){
	$('#TeacherTimeTableENDTIME,#TeacherTimeTableSTARTTIME').timepicker({ 'step': 15 });
});
</script>
<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>-->
<script type="text/javascript">
$(document).ready(function(){
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.checkbox').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkbox').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkbox').on('click',function(){
        if($('.checkbox:checked').length == $('.checkbox').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
});
</script>

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