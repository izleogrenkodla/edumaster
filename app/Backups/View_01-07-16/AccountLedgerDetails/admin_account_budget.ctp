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
                <a href="#">Account Budget</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Account Budget</a>
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
        <span aria-hidden="true" class="icon-users"></span>View Account Budget
    </div>
</div>
<div class="portlet-body form">
<!--<strong> Search Form:</strong>-->
				
			<!-- BEGIN FORM-->
		   <?php echo $this->Form->create('AccountLedgerDetail', array('class' => 'form-horizontal add','type' => 'file', 'onload' => 'loading()','url' => array('controller' => 'AccountLedgerDetails', 'action' => 'account_budget'))); ?>
			
			<div class="form-body">
			
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3">From Date<span class="required">
									* </span>
							</label>
							<div class="col-md-9 tooltips">
								 <?php
								echo $this->Form->input('FROM_DATE', array('type' => 'text', 'default' => '', 'class' => 'form-control date-picker','readonly'=>"readonly", 'label' => FALSE_VALUE,'div' => FALSE_VALUE));
								?>
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3">To Date<span class="required">
									* </span>
							</label>
							<div class="col-md-9 tooltips">
								 <?php
								echo $this->Form->input('TO_DATE', array('type' => 'text', 'default' => '', 'class' => 'form-control date-picker','readonly'=>"readonly", 'label' => FALSE_VALUE,'div' => FALSE_VALUE));
								?>
							</div>
						</div>
					</div>
				</div>

				<!--<div class="row">
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

				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3">Account Payment Type<span class="required">
									* </span>
							</label>
							<div class="col-md-9 tooltips">
								<?php echo $this->Form->input('ACCOUNT_PAYMENT_TYPE_ID', array('options' => $account_payment_types,
									'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' , 'onchange' => 'select()' ,'id'=>'role','onchange' => 'showOptions(this)')); ?>	
							</div>
						</div>
					</div>
				</div>
				
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label class="control-label col-md-3">Report Title<span class="required">
									* </span>
							</label>
							<div class="col-md-9 tooltips">
								<?php echo $this->Form->input('REPORT_TITLE', array('type' => 'text', 'label' => FALSE_VALUE,
									'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( Cash Book Report, Bank Book Report )')); ?>
							</div>
						</div>
					</div>
				</div>-->
			
			<!--/row-->
			</div>
			<div class="form-actions fluid">
				<div class="row">
					<div class="col-md-6">
						<div class="col-md-offset-3 col-md-9">
							<button type="submit" class="btn bg-blue-chambray">Search</button>
							<button type="button" class="btn default" onclick="window.location.href='<?php echo Router::url(array("action"=>"account_budget")); ?>'">Reset</button>
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
		if($data_income != "" && $data_expense != "")
		{	
	?>					
						
	<div class="form-actions fluid"><div>
						
<div id="content_block_id">
	
<table class="table table-striped table-bordered table-hover" style="border:2px solid;width:100%;" align="center" id="content_table">

<?php	
	$bs_title_content = "Account Budget";
	if(isset($account_report_title) && $account_report_title != "")
	{
	$bs_title_content = $account_report_title;
	}
	$school_name = $school['School']['SCHOOL_NAME'];
	$bs_title = $school_name." ".$bs_title_content;
	$bs_from_date_disp = $disp_req_from_date;
	$bs_from_date = $req_from_date;
	$bs_to_date_disp = $disp_req_to_date;
	$bs_to_date = $req_to_date;
	$ald_date_str = $bs_from_date_disp." to ".$bs_to_date_disp;
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
								<h5 class="cls_head_sub_title_1"><?php echo $ald_date_str; ?></h5>								
							</td>
						</tr>
					</table>			
				</td>
			</tr>
			<!--<tr>
				<td>
					<table class="table table-striped table-bordered table-hover" style="width:90%;" align="left" id="sub_head_content_table">
						<tr>
							<td style="padding-left: 6%;">
								<h5 class="cls_content_sub_title_2">Department: <span class="cls_head_sub_title_2"><?php echo $account_department; ?></span></h5>
								<h5 class="cls_content_sub_title_3">Account Name: <span class="cls_head_sub_title_3"><?php echo ucwords($account_name); ?></span></h5>
								<h5 class="cls_content_sub_title_4">Account Number: <span class="cls_head_sub_title_4"><?php echo $account_number; ?></span></h5>
								<?php
									if($account_payment_type != "")
									{
								?>
								<h5 class="cls_content_sub_title_4">Account Payment Type: <span class="cls_head_sub_title_4"><?php echo $account_payment_type; ?></span></h5>
								<?php
									}
								?>
							</td>
						</tr>
					</table>			
				</td>
			</tr>-->
				
						<tr>
							<td>										
								<table class="table table-striped table-bordered table-hover" style="width:90%;" align="center" id="detail_content_table">
									<tr style="text-align:center;">
										<td>
											<h5 class="cls_content_sub_title">Income</h5>
										</td>
										<td>
											<h5 class="cls_content_sub_title">Expenses</h5>
										</td>
										<td>
											<h5 class="cls_content_sub_title">Balance</h5>
										</td>
									</tr>
		
									<tr style="text-align:center;">
										<td style="width:30%;">
											<span class="cls_content_sub_title_1"><?php echo $data_income; ?></span>
										</td>
										<td style="width:30%;">
											<span class="cls_content_sub_title_1"><?php echo $data_expense; ?></span>
										</td>
										<td style="width:30%;">
											<span class="cls_content_sub_title_1"><?php echo $account_budget_balance_fmt; ?></span>
										</td>
									</tr>
										
								</table>
							</td>
						</tr>
					
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