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
                <a href="#">Users</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Fee Structure</a>
            </li>
        </ul>
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth'); ?>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<div class="portlet box blue-madison">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>My Fees 
                </div>
                <div class="tools">
                    <a href="javascript:;" class="collapse"></a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                    <div class="form-body">
					<div class="row">
					<?php 
					 if(is_array($fees) && sizeof($fees)>0) { 
					 	$srr = 0;
					 	foreach($fees as $f) { $srr++;
					 ?>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"><?php echo $f["FeeType"]["TITLE"]; ?> :</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                    
									<?php echo number_format($f["Fee"]["FEE"],2); ?>
                                </div>
                            </div>
                        </div>
					<?php  
							if($srr==2) { 
							?>
								</div>
								<div class="row">
							<?php 
							$srr=0;
							}
						}
					}
					
					?>
                    </div>
					<br />
                    <div class="row">
					<div class="col-md-6">
					<div class="portlet box blue-madison">

						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-gift"></i>Paid Fees
							</div>
							<div class="tools">
								<a href="javascript:;" class="collapse">
								</a>
							</div>
						</div>
						<div class="portlet-body" style="min-height:150px;">
    						<div class="row">
					<?php 
					$total_paid = 0;
					 if(is_array($fees) && sizeof($fees)>0) { 
					 	$srr_paid = 0;
					 	foreach($paid_fees as $paid_f) { $srr_paid++; $total_paid = $total_paid+$paid_f["LedgerXref"]["AMOUNT"];
					 ?>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-4"><?php echo $paid_f["FeeType"]["TITLE"]; ?> :</label>
                                <div class="col-md-8 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
									<?php echo number_format($paid_f["LedgerXref"]["AMOUNT"],2); ?> 
									<span class="label label-sm label-success">on: <?php echo $this->General->dbfordate($paid_f["LedgerXref"]["created"]) ?></span>
                                </div>
                            </div>
                        </div>
					<?php  
							if($srr_paid==2) { 
							?>
								</div>
								<div class="row">
							<?php 
							$srr_paid=0;
							}
						}
					}
					?>
					<br />
					 <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label col-md-4">Total :</label>
                                <div class="col-md-8 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="First Name">
                                    
									<strong><?php echo number_format($total_paid,2); ?></strong>
                                </div>
                            </div>
                        </div>
                    </div>
						</div>
					</div>
					<!-- END BASIC PORTLET-->
				</div>
				<div class="col-md-6">
				
					<div class="portlet box blue-madison">
					
											<div class="portlet-title">
												<div class="caption">
													<i class="fa fa-gift"></i>Remain Fees
												</div>
												<div class="tools">
													<a href="javascript:;" class="collapse">
													</a>
												</div>
											</div>
											<div class="portlet-body" style="min-height:150px;">
												<div class="row">
					<?php 
					$total_unpaid = 0;
					 if(is_array($unpaid) && sizeof($unpaid)>0) { 
					 	$srr_up = 0;

					 	foreach($unpaid as $up) { $srr_up++;
							if(isset($up["FEE"]) && $up["FEE"]!='') { $total_unpaid = $total_unpaid+$up["AMOUNT"];
							 ?>
								<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-4"><?php echo $up["FEE"]; ?> :</label>
										<div class="col-md-8 tooltips" data-container='body' data-placement='bottom'
											 data-html='true' data-original-title="First Name">
											
											<?php echo number_format($up["AMOUNT"],2); ?>
										</div>
									</div>
								</div>
							<?php  
								if($srr_up==2) { 
							?>
								</div>
								<div class="row">
							<?php 
							$srr_up=0;
							}
							}
						}
					}
					
					?>
					<br />
					<div class="col-md-12">
									<div class="form-group">
										<label class="control-label col-md-4">Total  (to be pay):</label>
										<div class="col-md-8 tooltips" data-container='body' data-placement='bottom'
											 data-html='true' data-original-title="First Name">
											
											<strong><?php echo number_format($total_unpaid,2); ?></strong>
										</div>
									</div>
								</div>
                    </div>
											</div>
										</div>


				</div>
			</div>
                    </div>
                    
                <!-- END FORM-->
            </div>
        </div>
<!-- END PAGE CONTENT-->
</div>
</div>
<style>
table.gridtable {
    font-family: verdana,arial,sans-serif;
    font-size: 11px;
    color: #333333;
    border-width: 1px;
    border-color: #666666;
    border-collapse: collapse;
}
</style>
<script type="text/javascript">

        $(document).ready(function(){
            $("#UserPAYMENTTERM,#UserFEESTYPE").bind("change",
            function(event){
                $.ajax({
                    async: true,
                    beforeSend: function(XMLHttpRequest){
                        $('#StudentFee').html('Wait..');
                    },
                    complete: function(XMLHttpRequest,
                    textStatus){
                        $('#StudentFee').attr('disabled',
                        true);
                    },
                    data: $("#UserPAYMENTTERM").closest("form").serialize(),
                    dataType: "html",
                    success: function(data,textStatus){
						var tmp = jQuery.parseJSON(data);
                        $("#StudentFee").html(tmp.status=='success'?tmp.msg+' Rs.':tmp.msg);
                    },
                    type: "post",
                    url: REQUEST_URL+"Users/GetFeeByTerms"
                });
                return false;
            });
        });
</script>