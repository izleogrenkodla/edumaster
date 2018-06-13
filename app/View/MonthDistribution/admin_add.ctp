
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
               
            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Month Distribution</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Month Distribution</a>
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
                <span aria-hidden="true" class="icon-user"></span>Add Month Distribution
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
		
		 <?php echo $this->Form->create('MonthDistribution', array('class' => 'form-horizontal add', 'id' => 'Roles')); ?>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php //echo $this->Form->create('AdmissionConfirm', array('class' => 'form-horizontal add', 'id' => 'Roles')); ?>
           <?php echo $this->Form->input("FORM_NO", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
                <div class="form-body">
                <div class="row">		

						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Payment Term<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
								<?php 
									echo $this->Form->input("PAYMENT_TERM",array('options'=>$payment_terms,"label"=>false,"div"=>false,'class'=>'form-control select2me','onchange'=>'getfee(this)'));
								 ?>
                                    
                                </div>
                            </div>
                        </div>
						
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Title<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
								<?php 
									 echo $this->Form->input('TITLE', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); 
								 ?>
                                    
                                </div>
                            </div>
                        </div>

                </div>		
				
					<div class="row">
					
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Month<span class="required">
										* </span>
                                </label>
                               <div class="col-md-9 tooltips">
								<?php
								$weeks = array(
								'January' => 'January',
								'February' => 'February',
								'March' => 'March',
								'April' => 'April',
								'May' => 'May',
								'June' => 'June',
								'July' => 'July',
								'August' => 'August',
								'September' => 'September',
								'October' => 'October',
								'November' => 'November',
								'December' => 'December',
								);
								
								foreach($weeks as $key=>$vel)
								{
								echo '<li><input type="checkbox" name=TT_DATE[] 
								value='.$key.' </li>';
                              // echo $this->Form->input('TT_DATE[]', array('type' => 'checkbox','default' => '', 'label' => FALSE_VALUE, 'value' => $key,'div' => FALSE_VALUE));
									echo $vel.'<br>';
								}
                                ?>                    
                            </div>
                        </div>
                    </div>
					
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Status</label>
                                <div class="col-md-9 tooltips">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="data[MonthDistribution][Status]" value="1" checked/>
                                            Active </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[MonthDistribution][Status]" value="0" />
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
function getfee(data){
            var vid = $(data).val();
            //alert (vid);
            
            if(vid==0){
                //$("#test").remove();
                //alert('Please select  By');
            }else{
            var vid = $(data).val();
            var data = 'id='+ vid+ '&total='+<?php echo $total_fee?>;
            //alert(data);
            $.ajax({
            data:data,
            url:REQUEST_URL+"AdmissionConfirm/GetFee",
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