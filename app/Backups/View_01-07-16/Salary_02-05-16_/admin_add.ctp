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
                <a href="#">Salary</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Salary</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Add Salary
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('Salary', array('class' => 'form-horizontal add', 'id' => 'Roles')); ?>
            
                <div class="form-body">
                
                <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Full Nmae</label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $ro['User']['FIRST_NAME']." ".$ro['User']['MIDDLE_NAME']." ".$ro['User']['LAST_NAME'] ?>
                                </div>
                            </div>
                        </div>
                        
                       
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Base Salary</label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $ro['User']['BASE_SALARY'] ?>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                     </div>

                      
               
                                
               
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Select Month
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php
                                    $month = array(
                                        '01' => 'January','02' => 'February',
                                            '03' => 'March','04' => 'April',
                                            '05' => 'May','06' => 'June',
                                            '08' => 'July','07' => 'August',
                                            '09' => 'September','10' => 'October',
                                            '11' => 'November','12' => 'December',
                                            
                                        );
                                    ?>
                                    <?php
                                    echo $this->Form->input('month', array('options' => $month ,  'default' => '', 'class' => 'form-control select2me', 'label' => FALSE_VALUE,
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
                                <label class="control-label col-md-3"> Remark
                                </label>
                                <div class="col-md-9 tooltips">

                                     <?php
                                    echo $this->Form->input('REMARK', array('type' => 'text', 'default' => '', 'class' => 'form-control','label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE));
                                    ?>

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
            var data = 'id='+ vid + '&uid='+<?php echo $ro['User']['ID']?> + '&bsal='+ 
            <?php echo $ro['User']['BASE_SALARY']; ?>;
            alert(data);

            $.ajax({
            data:data,
            url:REQUEST_URL+"Salary/Calculation",
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