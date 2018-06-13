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
                        <a href="#">Admission Inquiry</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">View Admission Inquiry</a>
                    </li>
                </ul>
                <!-- END PAGE TITLE & BREADCRUMB-->
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth'); ?>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->

        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <span aria-hidden="true" class="icon-users"></span>  View All Inquiry
                        </div>
                    </div>
                    <div class="portlet-body form">

<?php echo $this->Form->create('AppAdmission', 
array('class' => 'form-horizontal add custom_form','type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'get')); ?>

                        <div class="form-body">

                            <div class="row custom_search_filter">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 flef">Class</label>
                                        <div class="col-md-9 tooltips">
                                                <?php echo $this->Form->input('CLS', array('options' => $classes,
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control',
                                        'value' => isset($this->request->query['data']['AppAdmission']['CLS']) ? $this->request->query['data']['AppAdmission']['CLS']: '')); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 flef">Medium</label>
                                        <div class="col-md-9 tooltips">
                                                <?php echo $this->Form->input('MED', array('options' => $medium,
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control',
                                        'value' => isset($this->request->query['data']['AppAdmission']['MED']) ? $this->request->query['data']['AppAdmission']['MED']: '')); ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 flef">Status</label>
                                        <div class="col-md-9 tooltips">
                                                <?php echo $this->Form->input('STA', array('options' => $st1,
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control',
                                        'value' => isset($this->request->query['data']['AppAdmission']['STA']) ? $this->request->query['data']['AppAdmission']['STA']: '')); ?>
                                        </div>
                                    </div>
                                </div>
                                                                
                                <!--<div style="display: table; width: 100%; clear: both;"></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3"></label>
                                        <div class="col-md-9 no_bg">
                                            <button type="submit"  class="btn bg-blue-chambray">Search</button> OR
                                            <a class="link_row" href="<?php echo Router::url(array("action"=>"index")); ?>">RESET</a>
                                        </div>
                                    </div>
                                </div>-->
								<div class="col-md-6">
									<div class="form-group">
										<div class="btn_block">
											<button type="submit" class="btn bg-blue-chambray">Search</button>
											<button type="reset" class="btn bg-blue-chambray" onclick="window.location='<?php echo Router::url(array("action"=>"index")); ?>'">Reset</button>
										</div>
									</div>
                                </div>

                            </div>

                        </div>

                        </form>
						<?php if(in_array($authUser["ROLE_ID"],array(SUPERVISOR_ID))) { ?>
                        <!--<div class="table-toolbar">
                            <div class="btn-group">
                                <a href="<?php echo Router::url(array('controller' => 'AppAdmission','action' => 'add')) ?>" class="btn
                                   green bg-green"> ADD NEW <i class="fa fa-plus"></i>
                                </a>
                            </div>
                        </div>-->
						<a href="<?php echo Router::url(array('controller' => 'AppAdmission','action' => 'add')) ?>" class="btn
                                   green bg-green add_btn"> ADD NEW <i class="fa fa-plus"></i>
                        </a>
						
						<?php } ?>

                        <table class="table table-striped table-bordered table-hover" id="user_table">
                            <thead>
                                <tr role="row" class="heading">
                                    <th>
                                        Sr. No.
                                    </th>
                                    <th>
                                        Student Name
                                    </th>
                                    <th>
                                        Father Name
                                    </th>
                                    <th>
                                        Mother Name
                                    </th>
                                    <th>
                                        Class
                                    </th>
                                    <th>
                                        Medium
                                    </th>
                                    <th>
                                        Status
                                    </th>
									
                                    <th>
                                        Action
                                    </th>
									

                                </tr>
                            </thead>
                            <tbody>


<?php if(count($inquiries) > 0):
    $i = 1;
    ?>
    <?php foreach($inquiries as $inquiry) { ?>


                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td class=""><?php echo $inquiry['AppAdmission']['STUDENT_NAME']; ?></td>
                                    <td class=""><?php echo $inquiry['AppAdmission']['FATHER_NAME']; ?></td>
                                    <td class=""><?php echo $inquiry['AppAdmission']['MOTHER_NAME']; ?></td>
                                    <td class="text-center"><?php echo $inquiry['AcademicClass']['CLASS_NAME'];	?></td>
                                    <td class="text-center"><?php echo $inquiry['Medium']['MEDIUM_NAME']; ?></td>
                                    <td class="text-center"><?php //echo $inquiry['Medium']['MEDIUM_NAME']; 
			  $status='';
				if($inquiry['AppAdmission']['INQ_STATUS'] == 0)
            	{
            		$status = 'Pending';
            	}
            	elseif($inquiry['AppAdmission']['INQ_STATUS'] == 1)
            	{
            		$status = 'Approved';
            	}
				elseif($inquiry['AppAdmission']['INQ_STATUS'] == 2)
				{
					$status = 'Reject';
				}
				
				echo $status;
				?>
                                    </td>
									

                                    <td class="text-center">
                                        <a href="<?php echo Router::url(array('controller' => 'AppAdmission',
                    'action' => 'view_inquiry', $inquiry['AppAdmission']['INQUIRY_ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" title="View">
                                            <i class="fa fa-desktop"></i></a>
											
										<?php if(in_array($authUser["ROLE_ID"],array(SUPERVISOR_ID))) { ?>
                                        <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'AppAdmission','action' => 'delete', $inquiry['AppAdmission']['INQUIRY_ID']))?>')"class="tooltips btn" data-toggle="tooltip" title="Delete">
                                            <i class="fa fa-trash-o"></i></a>
                        <?php
                    if(($inquiry['AppAdmission']['INQ_STATUS'] == 0) || ($inquiry['AppAdmission']['INQ_STATUS'] == 2)){
					?>
                                        <a href="javascript:void(0)" onclick="ch_status('<?php echo Router::url(array('controller' => 'AppAdmission','action' => 'stactive', $inquiry['AppAdmission']['INQUIRY_ID']))?>')" class="tooltips btn"  data-toggle="tooltip" title="Approve">


                                            <span class="fa fa-check" style="text-decoration:none;"></span></a>


                                        <a href="javascript:void(0)" onclick="ch_status('<?php echo Router::url(array('controller' => 'AppAdmission','action' => 'streject', $inquiry['AppAdmission']['INQUIRY_ID']))?>')" class="tooltips btn" data-toggle="tooltip" title="Reject">

                                            <span  class="fa fa-times" style="text-decoration:none;"></span></a>
                    <?php } ?>

										<?php } ?>
										
                                    </td>
									
                                </tr>
    <?php $i++; } ?>
<?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
</div>
<script>
    function remove_record(x) {
        if (confirm("Are you sure want to remove this ?")) {
            window.location.href = x;
        }
    }
</script>

<script>
    function ch_status(x) {
        if (confirm("Are you sure want to proceed this ?")) {
            window.location.href = x;
        }
    }
</script>