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
								<a href="#">Mail</a>
								<i class="fa fa-angle-right"></i>
							</li>
							<li>
								<a href="#">Select Users</a>
							</li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
						<?php echo $this->Session->flash(); ?>
						<?php echo $this->Session->flash('auth'); 
						
							
						?>
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
										<span aria-hidden="true" class="icon-users"></span>Search
									</div>
								</div>
								
								<div class="portlet-body form">
					<!--<strong> Search Form:</strong>-->
								<div class="form-body">

									
										
										   <?php echo $this->Form->create('Mailer', array('class' => 'form-horizontal add','type' => 'file', 'onload' => 'loading()')); ?>
											<!--<h3 class="form-section">Search Form:</h3>-->
											
											<?php /* ?>
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
											
											<?php */ ?>
											
											<div class="row">
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<label class="control-label col-md-3">Select Role</label>
										<div class="col-md-9">
										   <?php echo $this->Form->input('ROLE', array('options' => $user_roles,
											'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' , 'onchange' => 'select()' ,'id'=>'role','onchange' => 'select()')); ?>	
												
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<label class="control-label col-md-3">Select Class</label>
										<div class="col-md-9">
										   <?php echo $this->Form->input('CLS', array('options' => $classes,
											'label' => FALSE_VALUE,'div' => FALSE_VALUE, 'data-required' => '1', 'disabled' ,'class' => 'form-control select2me', 'id' => 'select_cls'  )); ?>	
												
										</div>
									</div>
								</div>
								<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
									<div class="form-group">
										<div class="btn_block">
											<button type="submit" class="btn bg-blue-chambray">Search</button>
											<button type="reset" class="btn bg-blue-chambray" onclick="window.location='<?php echo Router::url(array("action"=>"index")); ?>'">Reset</button>
										</div>
									</div>
								</div>
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
											
											</form>
											<?php echo $this->Form->create('Mailer', array('class' => 'form-horizontal add', 'onsubmit'=>'','type' => 'file','url' => array('controller' => 'Mailer', 'action' => 'list'))); ?>

											<div id="users_list">
													<table class="table table-striped table-bordered table-hover" id="user_table">

													<thead>
													<tr role="row" class="heading">
														<th>
													   <div id="SelectAll"><input type="checkbox" id="allcb" onchange="checkall(this)" name="allcb"/></div>
														</th> 
														<th>
															Sr. No.
														</th>
														<th>
														   Full Name
														</th>
														
														<th>
															Email Address
														</th>
													   
														<th>
															Mobile No
														</th>
													</tr>
													</thead>
													<tbody>

													<?php if(count($users) > 0): ?>
														<?php foreach($users as $key=>$user) { ?>
															<tr> 
															
																
																<td><input  id="check"  class="mail_checkbox" type="checkbox" name="selected_users[]" value =<?php echo $user['User']['ID']; ?> ></td>
																<td><?php echo $key+1; ?></td>
																<td><?php echo $user['User']['FIRST_NAME'].' '.$user['User']['MIDDLE_NAME'].' '.$user['User']['LAST_NAME']; ?></td>
																
																<td><?php echo $user['User']['EMAIL_ID']; ?></td>


																<td class="text-center"><?php echo $user['User']['MOBILE_NO']; ?></td>
																
															  
															</tr>
														<?php } ?>
													<?php endif; ?>
													</tbody>
													</table>
											</div>
					<?php $htmlString= 'testing'; ?>
							<button type="submit" class="btn bg-blue-chambray add_btn">Submit</button> 
							</form>
					</div>
			</div>
		</div>
	</div>
</div>

		
<script>
//Check all checkbox script
function checkall(obj) {
	
	
	$(".mail_checkbox").each(function(){
		$(this).prop('checked',obj.checked);
		if($(this).attr('checked')== 'checked'){
			$(this).parent('span').prop('class','checked');
		}else if( $(this).attr('checked')== undefined){
			$(this).parent('span').prop('class','');	
		}
		else{		
		$(this).parent('span').prop('class','');
		}
	});	
}

//ajax script 
	// function test(){
	// var text = document.querySelector('.select2me').textContent;
	// var text = text.replace(/^\s+|\s+$/g,'');
	// if(text == 'Student'){
	// var data = 'id='+ text;
	 // $.ajax({
        // type:"POST",
        // cache:false,
        // url:"get",    // multiple data sent using ajax
        // success: function (html) {

          
          // $('#test').html(html);
        // }
      // });
      // return false;
    // }
	
	
// }

//On change disable enable script
function  select(){
	
	var text = document.getElementById('role').value;
	if (text == <?php echo STUDENT_ID;?>) {
         $("#select_cls").removeAttr("disabled");
     } else {
           $("#select_cls").attr('disabled', 'disabled');
     }
}


</script>