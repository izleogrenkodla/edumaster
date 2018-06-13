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
                        <a href="<?php echo Router::url(array('controller' => 'AccountLedgerDetails', 'action' => 'index')) ?>">View All Account Ledger Details</a>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'AccountLedgerDetails', 'action' => 'add')) ?>">Add New Account Ledger Detail</a>
                    </li>
                </ul>
            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Account Ledger Details</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Account Ledger Detail</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Add Account Ledger Detail
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('AccountLedgerDetail', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
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
					
					<div class="row">
                        <div class="col-md-6">
							<div class="form-group">
								<label class="control-label col-md-3">Account Group<span class="required">
										* </span>
								</label>
								<div class="col-md-9 tooltips">									
									<?php echo $this->Form->input('ACCOUNT_GROUP_ID', array('options' => $account_groups,
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
                                <label class="control-label col-md-3">Account Head<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('ACCOUNT_HEAD', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( Fees Revenue, Office Supplies )')); ?>
                                </div>
                            </div>
                        </div>
					</div>	
					
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Voucher Number<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('VOUCHER_NUMBER', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( 12543, 65433 )')); ?>
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Cheque Number<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('CHEQUE_NUMBER', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( 1254356, 6543344 )')); ?>
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">DD Number<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('DD_NUMBER', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( 1254356772, 6543344541 )')); ?>
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Bank Name<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('BANK_NAME', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( State Bank of India, ICICI )')); ?>
                                </div>
                            </div>
                        </div>
					</div>
					
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Bank Branch<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('BANK_BRANCH', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( Bank Branch 1, Bank Branch 2 )')); ?>
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
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( 5000, 6000 )')); ?>
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
                                        'div' => FALSE_VALUE, 'data-required' => '1','class' => '8', 'rows' => '5' , 'data-error-container' => '#editor2_error'));//,'maxlength' => '160'  ?>
                                </div>
                            </div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
                                <label class="control-label col-md-3">Upload Account Ledger Document<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Upload Account Ledger Document">
                                    <?php echo $this->Form->input('ACCOUNT_LEDGER_DOCUMENT', array('id'=>'upload_doc','type' => 'file', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control')); ?>
									<?php echo $this->General->uploadfilenotesUPLOADDOC(); ?>
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
                                            <input type="radio" name="data[AccountLedgerDetail][STATUS]" value="1" checked/>
                                            Active </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[AccountLedgerDetail][STATUS]" value="0" />
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

document.getElementById('upload_doc').addEventListener('change', checkFile, false);
function checkFile(e) {

    var file_list = e.target.files;

    for (var i = 0, file; file = file_list[i]; i++) {
        var sFileName = file.name;
        var sFileExtension = sFileName.split('.')[sFileName.split('.').length - 1].toLowerCase();
        var iFileSize = file.size;
       var iConvert = (file.size / 2000000).toFixed(2);
		//alert(iFileSize);
        if (iFileSize > 2000000) {
            txt = "Please make sure your file is less than <?php echo UPLOAD_ALLOWED_SIZE;?> MB.";
			alert(txt)
            
			//alert('hii')
			document.getElementById("upload_doc").value = "";
			
        }
    }
}
</script>
