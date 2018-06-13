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
                <a href="#">Account Balance Sheet Details</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Account Balance Sheet Report</a>
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
        <span aria-hidden="true" class="icon-users"></span>View Account Balance Sheet Report
    </div>
</div>
<div class="portlet-body form">
<!--<strong> Search Form:</strong>-->
				
			<!-- BEGIN FORM-->
		   <?php echo $this->Form->create('AccountBalanceSheetDetail', array('class' => 'form-horizontal add','type' => 'file', 'onload' => 'loading()','url' => array('controller' => 'AccountBalanceSheetDetails', 'action' => 'report'))); ?>
			
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
	$bs_title_content = "Balance Sheet";
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
	<?php		
			$this->AccountBalanceSheetDetail = ClassRegistry::init('AccountBalanceSheetDetail');
			$this->AccountBalanceSheetHead = ClassRegistry::init('AccountBalanceSheetHead');
			$this->AccountBalanceSheetSubHead = ClassRegistry::init('AccountBalanceSheetSubHead');
			
			foreach($data as $key=>$val) //Heads
				{					
					$total_head_wise_amount = 0;
					$head_id = $val['AccountBalanceSheetDetail']['ACCOUNT_BALANCE_SHEET_HEAD_ID'];
					$head_detail = $this->AccountBalanceSheetHead->GetAccountBalanceSheetHeadById($head_id);
					$head_title = $head_detail['AccountBalanceSheetHead']['ACCOUNT_BALANCE_SHEET_HEAD'];
					?>
					<tr>
						<td>
							<table class="table table-striped table-bordered table-hover" style="width:90%;" align="left" id="sub_head_content_table">
								<tr>
									<td>
										<h4 class="cls_content_title"><?php echo $head_title; ?></h4>							
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<?php
					$sub_head_ids_arr = $this->AccountBalanceSheetDetail->GetABSDSubHeads($bs_date,$head_id);
			
					if(!empty($sub_head_ids_arr)) 
					{
						foreach($sub_head_ids_arr as $shi_key=>$shi_val) //Sub Heads
						{							
							$sub_head_id = $shi_val['AccountBalanceSheetDetail']['ACCOUNT_BALANCE_SHEET_SUB_HEAD_ID'];
							$sub_head_detail = $this->AccountBalanceSheetSubHead->GetAccountBalanceSheetSubHeadById($sub_head_id);
							$sub_head_title="";
							if(!empty($sub_head_detail))
							{
							$sub_head_title = $sub_head_detail['AccountBalanceSheetSubHead']['ACCOUNT_BALANCE_SHEET_SUB_HEAD'];
							}
						if($sub_head_id != "" && $sub_head_id != 0)
						{
					?>
					<tr>
						<td>
							<table class="table table-striped table-bordered table-hover" style="width:90%;" align="center" id="sub_head_1_content_table">
								<tr>
									<td>
										<h5 class="cls_content_sub_title"><?php echo $sub_head_title; ?></h5>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<?php		
						}
							$head_categories_arr = $this->AccountBalanceSheetDetail->GetABSDHeadCategories($bs_date,$head_id,$sub_head_id);
							
							if(!empty($head_categories_arr))
							{
								$total_sub_head_wise_amount = 0;
								foreach($head_categories_arr as $hc_key=>$hc_val) //Head Categories
								{
									$head_category = $hc_val['AccountBalanceSheetDetail']['ACCOUNT_BALANCE_SHEET_HEAD_CATEGORY'];
									$abd_amount = $hc_val['AccountBalanceSheetDetail']['AMOUNT'];
									$total_sub_head_wise_amount += $abd_amount;
									$total_head_wise_amount += $abd_amount;
									
									if($sub_head_id != "" && $sub_head_id != 0)
									{									
					?>						
									<tr>
										<td>										
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="right" id="detail_content_table">
												<tr>
													<td style="width:70%;">
														<span class="cls_content_sub_title_1"><?php echo $head_category; ?></span>
													</td>
													<td style="width:20%;">
														<span class="cls_content_sub_title_1"><?php echo $abd_amount; ?></span>
													</td>
												</tr>
											</table>
										</td>
									</tr>
					<?php									
									/*echo "<pre>";
									//print_r($hc_val);
									echo $abd_amount."=>abd_amount<br/>";*/
									}
									else
									{
					?>						
									<tr>
										<td>
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="center" id="sub_head_2_content_table">
												<tr>
													<td style="width:80%;">
														<span class="cls_content_sub_title_1"><?php echo $head_category; ?></span>
													</td>
													<td style="width:16%;">
														<span class="cls_content_sub_title_1"><?php echo $abd_amount; ?></span>
													</td>
												</tr>
											</table>
										</td>
									</tr>
					<?php					
									}
								}
								
								if($sub_head_id != "" && $sub_head_id != 0)
								{
					?>						
									<tr>
										<td>										
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="right" id="detail_1_content_table">
												<tr>
													<td style="width:70%;text-align:right;">
														<span class="cls_content_sub_title_1"><?php echo "Total ".$sub_head_title; ?></span>
													</td>
													<?php $total_sub_head_wise_amount_fmt=number_format($total_sub_head_wise_amount,2,'.',''); ?>
													<td style="width:20%;">
														<span class="cls_content_sub_title_1"><?php echo $total_sub_head_wise_amount_fmt; ?></span>
													</td>
												</tr>
											</table>
										</td>
									</tr>
					<?php		
								}
							}
						}
					}
					
					?>						
									<tr>
										<td>										
											<table class="table table-striped table-bordered table-hover" style="width:90%;" align="left" id="sub_head_content_table_1">
												<tr>
													<td style="width:80%;text-align:left;">
														<h4 class="cls_content_title_1"><?php echo "Total ".$head_title; ?></h4>
													</td>													
													<?php $total_head_wise_amount_fmt=number_format($total_head_wise_amount,2,'.',''); ?>
													<td style="width:10%;">
														<h4 class="cls_content_title_1"><?php echo $total_head_wise_amount_fmt; ?></h4>
													</td>
												</tr>
											</table>
										</td>
									</tr>
					<?php
				}
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
