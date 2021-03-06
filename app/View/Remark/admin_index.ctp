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
                <a href="#">Remark</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Remark</a>
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
				<span aria-hidden="true" class="icon-users"></span> Remark
			</div>
		</div>
		<div class="portlet-body">
	
			 <?php echo $this->Form->create('Mailer', array('class' => 'form-horizontal add','type' => 'file')); ?>
                        <div 
						<div class="row custom_search_filter">

                            <div class="col-md-12 custom_block">
                                	<div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Role</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                   <?php echo $this->Form->input('ROLE', array('options' => $user_roles,
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' , 'onchange' => 'select()' ,'id'=>'role','onchange' => 'select()')); ?>	
										
                                </div>
								
								<?php ?>
							 <label class="control-label col-md-3">Select Class</label>
								<div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                      <?php echo $this->Form->input('CLS', array('options' => $classes,
                                        'label' => FALSE_VALUE,'div' => FALSE_VALUE, 'data-required' => '1', 'disabled' ,'class' => 'form-control select2me', 'id' => 'select_cls'  )); ?>	
										
                                </div>
                            </div>
                        </div>
                                <button type="submit" class="btn bg-blue-chambray">Search</button> OR
                                <a href="<?php echo Router::url(array("action"=>"index")); ?>">RESET</a>
                                
							
						
                            </div>
								<script>
								function  select2(){
					
								var text = document.getElementById('role').value;
								if (text == <?php echo STUDENT_ID;?>) {
									 $("#select_cls").removeAttr("disabled");
								 } else {
										$("#select_cls").attr('disabled', 'disabled');
								 }
							}
							select2();
						</script>

                        </div>
                        </form>
                    
                        <?php echo $this->Form->create('AcademicHistory', array('class' => 'form-horizontal add','type' => 'file')); ?>
							<table class="table table-striped table-bordered table-hover" id="user_table">
							<thead>
							<tr role="row" class="heading">
							   
								<th>
									Sr. No.
								</th>
								<th>
								   Full Name
								</th>
								<!--<th>
								   Last School Name
								</th>
								<th>
								   Last Board Name
								</th>
								<th>
								  Last Medium Name
								</th>-->
								<th>
								   Class Name
								</th>								
								 <th>
								  Action
								</th>
							   
							</tr>
							</thead>
							<tbody>

							<?php if(count($AcademicHistory) > 0): ?>
								<?php foreach($AcademicHistory as $key=>$AH) { ?>
									<tr>
										<td><?php echo $key+1; ?></td>
										<td><?php echo $AH['User']['FIRST_NAME']." ".$AH['User']['MIDDLE_NAME']." ".$AH['User']['LAST_NAME'] ?></td>
										<!--<td><?php echo $AH['User']['LAST_SCHOOL_NAME']; ?></td>
										<td><?php echo $AH['User']['LAST_BOARD']; ?></td>
										<td><?php echo $AH['User']['LAST_MEDIUM_ID']; ?></td>-->
										 <td><?php echo $AH['AcademicClass']['CLASS_NAME']; ?></td>										
										<td class="text-center"> 
										<a href="<?php echo Router::url(array('controller' => 'Remark',
												'action' => 'add', $AH['User']['ID'],
											))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Edit">
												<i class="fa fa-pencil"></i></a>
										</td>
									</tr>
								<?php } ?>
							<?php endif; ?>
							</tbody>
							</table>
						</form>

		</div>
</div>
</div>
 
<script>

        $(document).ready(function(){
            $("#AcademicHistoryROLE").bind("change",
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
					
                    data: $("#AcademicHistoryROLE").closest("form").serialize(),
                    dataType: "html",
                    success: function(data,
                    textStatus){
                        $("#test").html(data);
                    },
                    type: "post",
                    url: REQUEST_URL+"AcademicHistory/GetClassByUser"
                });
                return false;
            });
        });
</script>

<script>
function  select(){
	
	var text = document.getElementById('role').value;
	if (text == <?php echo STUDENT_ID;?>) {
         $("#select_cls").removeAttr("disabled");
     } else {
           $("#select_cls").attr('disabled', 'disabled');
     }
}
</script>