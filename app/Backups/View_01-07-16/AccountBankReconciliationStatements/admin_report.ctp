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
                <a href="#">Bank Reconciliation Statements</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Bank Reconciliation Statement</a>
            </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth');?>
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
        <span aria-hidden="true" class="icon-users"></span>View Bank Reconciliation Statement Report
    </div>
</div>
<div class="portlet-body form">
<!--<strong> Search Form:</strong>-->
				
			<!-- BEGIN FORM-->
		   <?php echo $this->Form->create('AccountBankReconciliationStatement', array('class' => 'form-horizontal add','type' => 'file', 'onload' => 'loading()','url' => array('controller' => 'AccountBankReconciliationStatements', 'action' => 'report'))); ?>
			
			<div class="form-body">
			
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3">Date<span class="required">
									* </span>
							</label>
							<div class="col-md-9 tooltips">
								 <?php
								echo $this->Form->input('DATE', array('type' => 'text', 'default' => '', 'class' => 'form-control date-picker','readonly'=>"readonly", 'label' => FALSE_VALUE,'div' => FALSE_VALUE));
								?>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3">Account Department<span class="required">
									* </span>
							</label>
							<div class="col-md-9 tooltips">									
								<?php echo $this->Form->input('ACCOUNT_DEPARTMENT_ID', array('options' => $account_departments,
									'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' , 'onchange' => 'get_acc_names(this)' ,'id'=>'id_acc_dept')); //,'onchange' => 'showOptions(this)' ?>	
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3">Account Name [Account Number]<span class="required">
									* </span>
							</label>
							<div id="ID_ACCOUNT_NAME" class="col-md-9 tooltips">									
								<?php echo $this->Form->input('ACCOUNT_NAME_ID', array('options' => $account_names,
									'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' , 'onchange' => 'select()' ,'id'=>'role','onchange' => 'showOptions(this)')); ?>	
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
							<button type="submit" class="btn bg-blue-chambray">Search</button>
							<button type="button" class="btn default" onclick="window.location.href='<?php echo Router::url(array("action"=>"report")); ?>'">Reset</button>
						</div>
					</div>
					<div class="col-md-6">
					</div>
				</div>
			</div>
			
			</form>
			<!-- END FORM-->
						<?php //echo $this->Form->create('Mailer', array('class' => 'form-horizontal add', 'onsubmit'=>'','type' => 'file','url' => array('controller' => 'Mailer', 'action' => 'list'))); ?>

	<?php	
		if(!empty($data))
		{	
	?>					
						
	<div class="form-actions fluid"><div>
						
<div id="content_block_id">
	
<table class="table table-striped table-bordered table-hover" style="border:2px solid;width:100%;" align="center" id="content_table">

<?php
	$bs_title_content = "Bank Reconciliation";
	$school_name = $school['School']['SCHOOL_NAME'];
	$bs_title = $school_name." ".$bs_title_content;
	$bs_date_disp = $disp_req_date;
	$bs_date = $req_date;
?>

<thead>
<!--<tr role="row" class="heading">
	<th>
       Col 1
    </th>
    <th>
       Col 2
    </th>    
    <th>
       Col 3
    </th>
    <th>
       Col 4
    </th>
</tr>-->
</thead>
<tbody>
	
			<tr>
				<td>
					<table class="table table-striped table-bordered table-hover" style="width:70%;" align="center" id="head_content_table">
						<tr>
							<td>
								<h3 class="cls_head_title" style="text-align:center;"><?php echo $bs_title_content; ?></h3>
								<h4 class="cls_head_sub_title" style="text-align:center;"><?php echo $school_name; ?></h4>
								<h5 class="cls_head_sub_title_1"><?php echo $bs_date_disp; ?></h5>								
							</td>
						</tr>
					</table>			
				</td>
			</tr>
			<tr>
				<td>
					<table class="table table-striped table-bordered table-hover" style="width:90%;" align="left" id="sub_head_content_table">
						<tr>
							<td style="padding-left: 6%;">
								<h5 class="cls_content_sub_title_2">Department: <span class="cls_head_sub_title_2"><?php echo $data['AccountDepartment']['ACCOUNT_DEPARTMENT_TITLE']; ?></span></h5>
								<h5 class="cls_content_sub_title_3">Account Name: <span class="cls_head_sub_title_3"><?php echo ucwords($data['AccountName']['ACCOUNT_NAME']); ?></span></h5>
								<h5 class="cls_content_sub_title_4">Account Number: <span class="cls_head_sub_title_4"><?php echo $data['AccountName']['ACCOUNT_NUMBER']; ?></span></h5>
							</td>
						</tr>
					</table>			
				</td>
			</tr>
	
					<tr>
						<td>
							<table class="table table-striped table-bordered table-hover" style="width:90%;" align="left" id="sub_head_content_table">
								<tr>
									<td style="width:80%;text-align:left;">
										<h4 class="cls_content_title_1">Balance as per Bank Statement</h4>
									</td>																						
									<td style="width:10%;">
										<h4 class="cls_content_title_1"><?php echo $data['AccountBankReconciliationStatement']['BALANCE_BANK']; ?></h4>
									</td>
								</tr>
							</table>
						</td>
					</tr>										
					<?php
							if($BANK_ADDITION_HEADS_CNT > 0 && !empty($BANK_ADDITION_HEADS_ARR))
							{
					?>
									<tr>
										<td>
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="center" id="sub_head_1_content_table">
												<tr>
													<td>
														<h5 class="cls_content_sub_title">Additions</h5>
													</td>
												</tr>
											</table>
										</td>
									</tr>
					<?php
								$BANK_ADDITION_AMOUNTS_TOTAL=0;
								for($i=0;$i<$BANK_ADDITION_HEADS_CNT;$i++)
								{								
									$BANK_ADDITION_HEADS_VAL = $BANK_ADDITION_HEADS_ARR[$i];
									$BANK_ADDITION_AMOUNTS_VAL = $BANK_ADDITION_AMOUNTS_ARR[$i];
									$BANK_ADDITION_AMOUNTS_TOTAL+=$BANK_ADDITION_AMOUNTS_VAL;
								
					?>				
									<tr>
										<td>										
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="right" id="detail_content_table">
												<tr>
													<td style="width:70%;">
														<span class="cls_content_sub_title_1"><?php echo $BANK_ADDITION_HEADS_VAL; ?></span>
													</td>
													<td style="width:20%;">
														<span class="cls_content_sub_title_1"><?php echo $BANK_ADDITION_AMOUNTS_VAL; ?></span>
													</td>
												</tr>
											</table>
										</td>
									</tr>
					<?php		
								}
																
					?>						
									<tr>
										<td>										
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="right" id="detail_1_content_table">
												<tr>
													<td style="width:70%;text-align:right;">
														<span class="cls_content_sub_title_1"><?php echo "Total Additions"; ?></span>
													</td>
													<?php $BANK_ADDITION_AMOUNTS_TOTAL_FMT=number_format($BANK_ADDITION_AMOUNTS_TOTAL,2,'.',''); ?>
													<td style="width:20%;">
														<span class="cls_content_sub_title_1"><?php echo $BANK_ADDITION_AMOUNTS_TOTAL_FMT; ?></span>
													</td>
												</tr>
											</table>
										</td>
									</tr>
					<?php										
							}						
					?>

					<?php
							if($BANK_DEDUCTION_HEADS_CNT > 0 && !empty($BANK_DEDUCTION_HEADS_ARR))
							{
					?>
									<tr>
										<td>
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="center" id="sub_head_1_content_table">
												<tr>
													<td>
														<h5 class="cls_content_sub_title">Deductions</h5>
													</td>
												</tr>
											</table>
										</td>
									</tr>	
					<?php
								$BANK_DEDUCTION_AMOUNTS_TOTAL=0;
								for($i=0;$i<$BANK_DEDUCTION_HEADS_CNT;$i++)
								{								
									$BANK_DEDUCTION_HEADS_VAL = $BANK_DEDUCTION_HEADS_ARR[$i];
									$BANK_DEDUCTION_AMOUNTS_VAL = $BANK_DEDUCTION_AMOUNTS_ARR[$i];
									$BANK_DEDUCTION_AMOUNTS_TOTAL+=$BANK_DEDUCTION_AMOUNTS_VAL;
								
					?>				
									<tr>
										<td>										
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="right" id="detail_content_table">
												<tr>
													<td style="width:70%;">
														<span class="cls_content_sub_title_1"><?php echo $BANK_DEDUCTION_HEADS_VAL; ?></span>
													</td>
													<td style="width:20%;">
														<span class="cls_content_sub_title_1"><?php echo $BANK_DEDUCTION_AMOUNTS_VAL; ?></span>
													</td>
												</tr>
											</table>
										</td>
									</tr>
					<?php		
								}
																
					?>						
									<tr>
										<td>										
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="right" id="detail_1_content_table">
												<tr>
													<td style="width:70%;text-align:right;">
														<span class="cls_content_sub_title_1"><?php echo "Total Deductions"; ?></span>
													</td>
													<?php $BANK_DEDUCTION_AMOUNTS_TOTAL_FMT=number_format($BANK_DEDUCTION_AMOUNTS_TOTAL,2,'.',''); ?>
													<td style="width:20%;">
														<span class="cls_content_sub_title_1"><?php echo $BANK_DEDUCTION_AMOUNTS_TOTAL_FMT; ?></span>
													</td>
												</tr>
											</table>
										</td>
									</tr>
					<?php										
							}
					?>						
									<tr>
										<td>										
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="left" id="sub_head_content_table_1">
												<tr>
													<td style="width:80%;text-align:left;">
														<h4 class="cls_content_title_1"><?php echo "Adjusted Bank Balance"; ?></h4>
													</td>																										
													<td style="width:10%;">
														<h4 class="cls_content_title_1"><?php echo $data['AccountBankReconciliationStatement']['ADJUSTED_BALANCE_BANK']; ?></h4>
													</td>
												</tr>
											</table>
										</td>
									</tr>

					<tr>
						<td>
							<table class="table table-striped table-bordered table-hover" style="width:90%;" align="left" id="sub_head_content_table">
								<tr>
									<td style="width:80%;text-align:left;">
										<h4 class="cls_content_title_1">Balance as per Book</h4>
									</td>																						
									<td style="width:10%;">
										<h4 class="cls_content_title_1"><?php echo $data['AccountBankReconciliationStatement']['BALANCE_BOOK']; ?></h4>
									</td>
								</tr>
							</table>
						</td>
					</tr>										
					<?php
							if($BOOK_ADDITION_HEADS_CNT > 0 && !empty($BOOK_ADDITION_HEADS_ARR))
							{
					?>
									<tr>
										<td>
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="center" id="sub_head_1_content_table">
												<tr>
													<td>
														<h5 class="cls_content_sub_title">Additions</h5>
													</td>
												</tr>
											</table>
										</td>
									</tr>
					<?php
								$BOOK_ADDITION_AMOUNTS_TOTAL=0;
								for($i=0;$i<$BOOK_ADDITION_HEADS_CNT;$i++)
								{								
									$BOOK_ADDITION_HEADS_VAL = $BOOK_ADDITION_HEADS_ARR[$i];
									$BOOK_ADDITION_AMOUNTS_VAL = $BOOK_ADDITION_AMOUNTS_ARR[$i];
									$BOOK_ADDITION_AMOUNTS_TOTAL+=$BOOK_ADDITION_AMOUNTS_VAL;
								
					?>				
									<tr>
										<td>										
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="right" id="detail_content_table">
												<tr>
													<td style="width:70%;">
														<span class="cls_content_sub_title_1"><?php echo $BOOK_ADDITION_HEADS_VAL; ?></span>
													</td>
													<td style="width:20%;">
														<span class="cls_content_sub_title_1"><?php echo $BOOK_ADDITION_AMOUNTS_VAL; ?></span>
													</td>
												</tr>
											</table>
										</td>
									</tr>
					<?php		
								}
																
					?>						
									<tr>
										<td>										
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="right" id="detail_1_content_table">
												<tr>
													<td style="width:70%;text-align:right;">
														<span class="cls_content_sub_title_1"><?php echo "Total Additions"; ?></span>
													</td>
													<?php $BOOK_ADDITION_AMOUNTS_TOTAL_FMT=number_format($BOOK_ADDITION_AMOUNTS_TOTAL,2,'.',''); ?>
													<td style="width:20%;">
														<span class="cls_content_sub_title_1"><?php echo $BOOK_ADDITION_AMOUNTS_TOTAL_FMT; ?></span>
													</td>
												</tr>
											</table>
										</td>
									</tr>
					<?php										
							}						
					?>

					<?php
							if($BOOK_DEDUCTION_HEADS_CNT > 0 && !empty($BOOK_DEDUCTION_HEADS_ARR))
							{
					?>			
									<tr>
										<td>
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="center" id="sub_head_1_content_table">
												<tr>
													<td>
														<h5 class="cls_content_sub_title">Deductions</h5>
													</td>
												</tr>
											</table>
										</td>
									</tr>
					<?php
								$BOOK_DEDUCTION_AMOUNTS_TOTAL=0;
								for($i=0;$i<$BOOK_DEDUCTION_HEADS_CNT;$i++)
								{								
									$BOOK_DEDUCTION_HEADS_VAL = $BOOK_DEDUCTION_HEADS_ARR[$i];
									$BOOK_DEDUCTION_AMOUNTS_VAL = $BOOK_DEDUCTION_AMOUNTS_ARR[$i];
									$BOOK_DEDUCTION_AMOUNTS_TOTAL+=$BOOK_DEDUCTION_AMOUNTS_VAL;
								
					?>				
									<tr>
										<td>										
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="right" id="detail_content_table">
												<tr>
													<td style="width:70%;">
														<span class="cls_content_sub_title_1"><?php echo $BOOK_DEDUCTION_HEADS_VAL; ?></span>
													</td>
													<td style="width:20%;">
														<span class="cls_content_sub_title_1"><?php echo $BOOK_DEDUCTION_AMOUNTS_VAL; ?></span>
													</td>
												</tr>
											</table>
										</td>
									</tr>
					<?php		
								}
																
					?>						
									<tr>
										<td>										
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="right" id="detail_1_content_table">
												<tr>
													<td style="width:70%;text-align:right;">
														<span class="cls_content_sub_title_1"><?php echo "Total Deductions"; ?></span>
													</td>
													<?php $BOOK_DEDUCTION_AMOUNTS_TOTAL_FMT=number_format($BOOK_DEDUCTION_AMOUNTS_TOTAL,2,'.',''); ?>
													<td style="width:20%;">
														<span class="cls_content_sub_title_1"><?php echo $BOOK_DEDUCTION_AMOUNTS_TOTAL_FMT; ?></span>
													</td>
												</tr>
											</table>
										</td>
									</tr>
					<?php										
							}						
					?>
					
					
									<tr>
										<td>										
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="left" id="sub_head_content_table_1">
												<tr>
													<td style="width:80%;text-align:left;">
														<h4 class="cls_content_title_1"><?php echo "Adjusted Book Balance"; ?></h4>
													</td>																										
													<td style="width:10%;">
														<h4 class="cls_content_title_1"><?php echo $data['AccountBankReconciliationStatement']['ADJUSTED_BALANCE_BOOK']; ?></h4>
													</td>
												</tr>
											</table>
										</td>
									</tr>
					<?php
				//}
				?>
</tbody>
</table>
				<div class="form-actions fluid">
					<div class="row">
						<div class="col-md-6">
							<div class="col-md-offset-3 col-md-9">
								<!--<button type="submit" class="btn bg-blue-chambray">Search</button>-->
								<button type="button" class="btn default" onclick="return printme('content_table');">Print</button>
							</div>
						</div>
						<div class="col-md-6">
						</div>
					</div>
				</div>			
		
</div>

			<?php
		}
	?>

</div>
</div>

</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>

<script>
function get_acc_names(){
	var dept_id = $("#id_acc_dept").val();		
	var data = 'id='+ dept_id;
	 $.ajax({
        type:"POST",
		data:data,
        cache:false,
        url:"ajax_getAccountNamesbyDept",    // multiple data sent using ajax
        success: function (html) {          
          $('#ID_ACCOUNT_NAME').html(html);
        }
      });
	
    if(dept_id==0){
		alert('Please Select Valid Account Department');
		return false;
	}	
	 
      return false;
}
</script>		
