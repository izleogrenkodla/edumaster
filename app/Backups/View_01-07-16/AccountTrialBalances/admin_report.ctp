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
                <a href="#">Account Trial Balances</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Account Trial Balance</a>
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
        <span aria-hidden="true" class="icon-users"></span>View Account Trial Balance Report
    </div>
</div>
<div class="portlet-body form">
<!--<strong> Search Form:</strong>-->
				
			<!-- BEGIN FORM-->
		   <?php echo $this->Form->create('AccountTrialBalance', array('class' => 'form-horizontal add','type' => 'file', 'onload' => 'loading()','url' => array('controller' => 'AccountTrialBalances', 'action' => 'report'))); ?>
			
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
	$bs_title_content = "Account Trial Balance";	
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
								<table class="table table-striped table-bordered table-hover" style="width:90%;" align="center" id="detail_content_table">
									<tr>
										<td>
											<h5 class="cls_content_sub_title">Account Head</h5>
										</td>													
										<td>
											<h5 class="cls_content_sub_title"><?php echo ucwords($income_ag_title); ?></h5>
										</td>
										<td>
											<h5 class="cls_content_sub_title"><?php echo ucwords($expense_ag_title); ?></h5>
										</td>
									</tr>
		<?php
					$ATB_TOTAL_INCOME=0;
					$ATB_TOTAL_EXPENSE=0;
					foreach($data as $atb_arr)
					{	
		?>	
									<tr>
										<td style="width:50%;">
											<span class="cls_content_sub_title_1"><?php echo $atb_arr["AccountTrialBalance"]["ACCOUNT_HEAD"]; ?></span>
										</td>
										<?php
											$income_ag_val = "";														
											if($income_ag_id==$atb_arr["AccountTrialBalance"]["ACCOUNT_GROUP_ID"])
											{
											$income_ag_val = $atb_arr["AccountTrialBalance"]["AMOUNT"];
											}
											$expense_ag_val = "";
											if($expense_ag_id==$atb_arr["AccountTrialBalance"]["ACCOUNT_GROUP_ID"])
											{
											$expense_ag_val = $atb_arr["AccountTrialBalance"]["AMOUNT"];
											}
											$ATB_TOTAL_INCOME += $income_ag_val;
											$ATB_TOTAL_INCOME_FMT=number_format($ATB_TOTAL_INCOME,2,'.','');
											$ATB_TOTAL_EXPENSE += $expense_ag_val;
											$ATB_TOTAL_EXPENSE_FMT=number_format($ATB_TOTAL_EXPENSE,2,'.','');
										?>
										<td style="width:10%;">
											<span class="cls_content_sub_title_1"><?php echo $income_ag_val; ?></span>
										</td>
										<td style="width:10%;">
											<span class="cls_content_sub_title_1"><?php echo $expense_ag_val; ?></span>
										</td>										
									</tr>
		<?php		
					}
													
		?>			
									<tr>										
										<td style="text-align:right;">
											<span class="cls_content_sub_title_1"><?php echo "Total"; ?></span>
										</td>													
										<td>
											<span class="cls_content_sub_title_1"><?php echo $ATB_TOTAL_INCOME_FMT; ?></span>
										</td>
										<td>
											<span class="cls_content_sub_title_1"><?php echo $ATB_TOTAL_EXPENSE_FMT; ?></span>
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