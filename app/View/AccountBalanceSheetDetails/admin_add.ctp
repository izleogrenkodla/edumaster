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
                <button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
                    <span>Actions</span><i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'AccountBalanceSheetDetails', 'action' => 'index')) ?>">View All Account Balance Sheet Details</a>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'AccountBalanceSheetDetails', 'action' => 'add')) ?>">Add New Account Balance Sheet Detail</a>
                    </li>
                </ul>
            </li>
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
                <a href="#">Add Account Balance Sheet Detail</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Add Account Balance Sheet Detail
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('AccountBalanceSheetDetail', array('class' => 'form-horizontal add', 'id' => 'Roles')); ?>
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
								<label class="control-label col-md-3">Account Balance Sheet Head<span class="required">
										* </span>
								</label>
								<div class="col-md-9 tooltips">									
									<?php echo $this->Form->input('ACCOUNT_BALANCE_SHEET_HEAD_ID', array('options' => $account_balance_sheet_heads,
										'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' , 'onchange' => 'get_bs_sub_heads(this)' ,'id'=>'id_acc_bs_head')); //,'onchange' => 'showOptions(this)' ?>	
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
                        <div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Account Balance Sheet Sub Head<span class="required">
										* </span>
								</label>
								<div id="ID_ABS_SUB_HEAD" class="col-md-9 tooltips">									
									<?php echo $this->Form->input('ACCOUNT_BALANCE_SHEET_SUB_HEAD_ID', array('options' => $account_balance_sheet_sub_heads,
										'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' , 'onchange' => 'select()' ,'id'=>'role','onchange' => 'showOptions(this)')); ?>	
								</div>
							</div>
						</div>
					</div>
				
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Account Balance Sheet Head Category<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('ACCOUNT_BALANCE_SHEET_HEAD_CATEGORY', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( Cash, Short-term Loans )')); ?>
                                </div>
                            </div>
                        </div>
					</div>	
					
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Amount<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('AMOUNT', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( 1000, 2000 )')); ?>
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
                                <label class="control-label col-md-3">Description<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('DESCRIPTION', array('type' => 'textarea','id' => 'textarea',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1','class' => '8', 'rows' => '5' , 'data-error-container' => '#editor2_error'));//'maxlength' => '160' , ?>
                                </div>
                            </div>
						</div>
					</div>						
					
					<div class="row">	
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Sort Order<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('SORT_ORDER', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( 1, 2 )')); ?>
                                </div>
                            </div>
                        </div>
					</div>	
						
					<div class="row">	
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Status</label>
                                <div class="col-md-9 tooltips">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="data[AccountBalanceSheetDetail][STATUS]" value="1" checked/>
                                            Active </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[AccountBalanceSheetDetail][STATUS]" value="0" />
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
function get_bs_sub_heads(){
	var bal_sheet_head_id = $("#id_acc_bs_head").val();		
	var data = 'id='+ bal_sheet_head_id;
	 $.ajax({
        type:"POST",
		data:data,
        cache:false,
        url:"ajax_getSubHeadsbyHead",    // multiple data sent using ajax
        success: function (html) {          
          $('#ID_ABS_SUB_HEAD').html(html);
        }
      });
	
    if(bal_sheet_head_id==0){
		alert('Please Select Valid Account Balance Sheet Head');
		return false;
	}	
	 
      return false;
}
</script>
