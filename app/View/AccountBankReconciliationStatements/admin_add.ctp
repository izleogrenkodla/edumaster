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
                        <a href="<?php echo Router::url(array('controller' => 'AccountBankReconciliationStatements', 'action' => 'index')) ?>">View All Bank Reconciliation Statements</a>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'AccountBankReconciliationStatements', 'action' => 'add')) ?>">Add New Bank Reconciliation Statement</a>
                    </li>
                </ul>
            </li>
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
                <a href="#">Add Bank Reconciliation Statement</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Add Bank Reconciliation Statement
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('AccountBankReconciliationStatement', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
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
				
					<h3 class="form-section">Bank Statement Details</h3>
					
					<!--<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                              <div class="">
								<h3 class="form-section">Balance as per Bank Statement</h3>
                              </div>  
                            </div>
                        </div>
					</div>-->
				
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Balance as per Bank Statement<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('BALANCE_BANK', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( 12000, 15000 )')); ?>
                                </div>
                            </div>
                        </div>
					</div>	
					
					<div class="input_fields_wrap_bnk_aha">
						<!--<button class="add_field_button">Add More Fields</button>-->
						<button id="btn_add_bnk_aha" class="btn bg-blue-chambray" type="button">Add</button>
					
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Bank Addition Head<span class="required">
											* </span>
									</label>
									<div class="col-md-9 tooltips">
										<?php /*echo $this->Form->input('BANK_ADDITION_HEADS', array('type' => 'textarea','id' => 'textarea',
											'label' => FALSE_VALUE,
											'div' => FALSE_VALUE, 'data-required' => '1','class' => '8', 'rows' => '5' , 'data-error-container' => '#editor2_error','placeholder' => 'Example :- Deposit in Transit 1, Deposit in Transit 2'));//'maxlength' => '160' , */?>
										<input type="text" placeholder="Example :- ( Deposit in Transit 1, Deposit in Transit 2 )" class="form-control" data-required="1" name="data[BANK_ADDITION_HEADS][]">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="control-label col-md-3">Bank Addition Amount<span class="required">
											* </span>
									</label>
									<div class="col-md-9 tooltips">
										<?php /*echo $this->Form->input('BANK_ADDITION_AMOUNTS', array('type' => 'textarea','id' => 'textarea',
											'label' => FALSE_VALUE,
											'div' => FALSE_VALUE, 'data-required' => '1','class' => '8', 'rows' => '5' , 'data-error-container' => '#editor2_error','placeholder' => 'Example :- 5000, 6000'));//'maxlength' => '160' , */?>
										<input type="text" placeholder="Example :- ( 5000, 6000 )" class="form-control" data-required="1" name="data[BANK_ADDITION_AMOUNTS][]">	
									</div>
								</div>
							</div>
						</div>
					
					<!--<div><input type="text" name="mytext[]"></div>-->
					</div>
					
					
					<div class="input_fields_wrap_bnk_dha">						
						<button id="btn_add_bnk_dha" class="btn bg-blue-chambray" type="button">Add</button>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Bank Deduction Head<span class="required">
												* </span>
										</label>
										<div class="col-md-9 tooltips">
											<?php /*echo $this->Form->input('BANK_DEDUCTION_HEADS', array('type' => 'textarea','id' => 'textarea',
												'label' => FALSE_VALUE,
												'div' => FALSE_VALUE, 'data-required' => '1','class' => '8', 'rows' => '5' , 'data-error-container' => '#editor2_error','placeholder' => 'Example :- Outstanding Check 1, Outstanding Check 2'));//'maxlength' => '160' , */?>
											<input type="text" placeholder="Example :- ( Outstanding Check 1, Outstanding Check 2 )" class="form-control" data-required="1" name="data[BANK_DEDUCTION_HEADS][]">
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Bank Deduction Amount<span class="required">
												* </span>
										</label>
										<div class="col-md-9 tooltips">
											<?php /*echo $this->Form->input('BANK_DEDUCTION_AMOUNTS', array('type' => 'textarea','id' => 'textarea',
												'label' => FALSE_VALUE,
												'div' => FALSE_VALUE, 'data-required' => '1','class' => '8', 'rows' => '5' , 'data-error-container' => '#editor2_error','placeholder' => 'Example :- 3000, 4000'));//'maxlength' => '160' , */?>
											<input type="text" placeholder="Example :- ( 3000, 4000 )" class="form-control" data-required="1" name="data[BANK_DEDUCTION_AMOUNTS][]">	
										</div>
									</div>
								</div>
							</div>					
					</div>
					
					<h3 class="form-section">Book Details</h3>
					
					<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Balance as per Book<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('BALANCE_BOOK', array('type' => 'text', 'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control','placeholder' => 'Example :- ( 12000, 15000 )')); ?>
                                </div>
                            </div>
                        </div>
					</div>	
					
					<div class="input_fields_wrap_bk_aha">
						<button id="btn_add_bk_aha" class="btn bg-blue-chambray" type="button">Add</button>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Book Addition Head<span class="required">
												* </span>
										</label>
										<div class="col-md-9 tooltips">
											<?php /*echo $this->Form->input('BOOK_ADDITION_HEADS', array('type' => 'textarea','id' => 'textarea',
												'label' => FALSE_VALUE,
												'div' => FALSE_VALUE, 'data-required' => '1','class' => '8', 'rows' => '5' , 'data-error-container' => '#editor2_error','placeholder' => 'Example :- Income not recorded on Books, Bank Interest Income'));//'maxlength' => '160' , */?>
											<input type="text" placeholder="Example :- ( Income not recorded on Books, Bank Interest Income )" class="form-control" data-required="1" name="data[BOOK_ADDITION_HEADS][]">	
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Book Addition Amount<span class="required">
												* </span>
										</label>
										<div class="col-md-9 tooltips">
											<?php /*echo $this->Form->input('BOOK_ADDITION_AMOUNTS', array('type' => 'textarea','id' => 'textarea',
												'label' => FALSE_VALUE,
												'div' => FALSE_VALUE, 'data-required' => '1','class' => '8', 'rows' => '5' , 'data-error-container' => '#editor2_error','placeholder' => 'Example :- 500, 600'));//'maxlength' => '160' , */?>
											<input type="text" placeholder="Example :- ( 500, 600 )" class="form-control" data-required="1" name="data[BOOK_ADDITION_AMOUNTS][]">	
										</div>
									</div>
								</div>
							</div>
					</div>
					
					<div class="input_fields_wrap_bk_dha">
						<button id="btn_add_bk_dha" class="btn bg-blue-chambray" type="button">Add</button>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Book Deduction Head<span class="required">
												* </span>
										</label>
										<div class="col-md-9 tooltips">
											<?php /*echo $this->Form->input('BOOK_DEDUCTION_HEADS', array('type' => 'textarea','id' => 'textarea',
												'label' => FALSE_VALUE,
												'div' => FALSE_VALUE, 'data-required' => '1','class' => '8', 'rows' => '5' , 'data-error-container' => '#editor2_error','placeholder' => 'Example :- Expenses not recorded on Books, Bank Account Charges'));//'maxlength' => '160' , */?>
											<input type="text" placeholder="Example :- ( Expenses not recorded on Books, Bank Account Charges )" class="form-control" data-required="1" name="data[BOOK_DEDUCTION_HEADS][]">		
										</div>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label class="control-label col-md-3">Book Deduction Amount<span class="required">
												* </span>
										</label>
										<div class="col-md-9 tooltips">
											<?php /*echo $this->Form->input('BOOK_DEDUCTION_AMOUNTS', array('type' => 'textarea','id' => 'textarea',
												'label' => FALSE_VALUE,
												'div' => FALSE_VALUE, 'data-required' => '1','class' => '8', 'rows' => '5' , 'data-error-container' => '#editor2_error','placeholder' => 'Example :- 300, 400'));//'maxlength' => '160' , */?>
											<input type="text" placeholder="Example :- ( 300, 400 )" class="form-control" data-required="1" name="data[BOOK_DEDUCTION_AMOUNTS][]">
										</div>
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
                                <label class="control-label col-md-3">Upload Bank Statement Document<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Upload Bank Statement Document">
                                    <?php echo $this->Form->input('BANK_STATEMENT_DOCUMENT', array('id'=>'upload_doc','type' => 'file', 'label' => FALSE_VALUE,
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
                                            <input type="radio" name="data[AccountBankReconciliationStatement][STATUS]" value="1" checked/>
                                            Active </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[AccountBankReconciliationStatement][STATUS]" value="0" />
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

$(document).ready(function() {
    var max_fields      = 50; //maximum input boxes allowed
	
	
    //var wrapper         = $(".input_fields_wrap"); //Fields wrapper
	var wrapper_bnk_aha         = $(".input_fields_wrap_bnk_aha"); //Fields wrapper
    //var add_button      = $(".add_field_button"); //Add button ID
	var add_button_bnk_aha      = $("#btn_add_bnk_aha"); //Add button ID
   
    var x_bnk_aha = 1; //initlal text box count
    $(add_button_bnk_aha).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_bnk_aha < max_fields){ //max input box allowed
            x_bnk_aha++; //text box increment
            //$(wrapper).append('<div><input type="text" name="mytext[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
			
			var inp_bnk_aha = '';
			inp_bnk_aha += '<div class="row">';
			inp_bnk_aha += '<div class="col-md-6">';			
			inp_bnk_aha += '<div class="form-group">';
			inp_bnk_aha += '<label class="control-label col-md-3">Bank Addition Head<span class="required">* </span></label>';			
			inp_bnk_aha += '<div class="col-md-9 tooltips">';
			inp_bnk_aha += '<input type="text" placeholder="Example :- ( Deposit in Transit 1, Deposit in Transit 2 )" class="form-control" data-required="1" name="data[BANK_ADDITION_HEADS][]">';
			inp_bnk_aha += '</div>';
			inp_bnk_aha += '</div>';
			inp_bnk_aha += '</div>';
			inp_bnk_aha += '<div class="col-md-6">';
			inp_bnk_aha += '<div class="form-group">';
			inp_bnk_aha += '<label class="control-label col-md-3">Bank Addition Amount<span class="required">* </span></label>';
			inp_bnk_aha += '<div class="col-md-9 tooltips">';
			inp_bnk_aha += '<input type="text" placeholder="Example :- ( 5000, 6000 )" class="form-control" data-required="1" name="data[BANK_ADDITION_AMOUNTS][]">';
			inp_bnk_aha += '</div>';
			inp_bnk_aha += '</div>';
			inp_bnk_aha += '</div>';			
			//inp_bank_ah += '<a href="#" class="remove_field">Remove</a>';
			inp_bnk_aha += '<button id="btn_rmv_bnk_aha" class="btn bg-blue-chambray" type="button" style="float: right; margin-right: 1.5%;">Remove</button>';
			inp_bnk_aha += '</div>';
			$(wrapper_bnk_aha).append(inp_bnk_aha);
        }
    });   
    /*$(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })*/
	$(wrapper_bnk_aha).on("click","#btn_rmv_bnk_aha", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_bnk_aha--;
    })
	
	//---------------------------------------------------------------------------------------------	
		
	var wrapper_bnk_dha         = $(".input_fields_wrap_bnk_dha"); //Fields wrapper    
	var add_button_bnk_dha      = $("#btn_add_bnk_dha"); //Add button ID
   
    var x_bnk_dha = 1; //initlal text box count
    $(add_button_bnk_dha).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_bnk_dha < max_fields){ //max input box allowed
            x_bnk_dha++; //text box increment            
			
			var inp_bnk_dha = '';
			inp_bnk_dha += '<div class="row">';
			inp_bnk_dha += '<div class="col-md-6">';			
			inp_bnk_dha += '<div class="form-group">';
			inp_bnk_dha += '<label class="control-label col-md-3">Bank Deduction Head<span class="required">* </span></label>';			
			inp_bnk_dha += '<div class="col-md-9 tooltips">';
			inp_bnk_dha += '<input type="text" placeholder="Example :- ( Outstanding Check 1, Outstanding Check 2 )" class="form-control" data-required="1" name="data[BANK_DEDUCTION_HEADS][]">';
			inp_bnk_dha += '</div>';
			inp_bnk_dha += '</div>';
			inp_bnk_dha += '</div>';
			inp_bnk_dha += '<div class="col-md-6">';
			inp_bnk_dha += '<div class="form-group">';
			inp_bnk_dha += '<label class="control-label col-md-3">Bank Deduction Amount<span class="required">* </span></label>';
			inp_bnk_dha += '<div class="col-md-9 tooltips">';
			inp_bnk_dha += '<input type="text" placeholder="Example :- ( 3000, 4000 )" class="form-control" data-required="1" name="data[BANK_DEDUCTION_AMOUNTS][]">';
			inp_bnk_dha += '</div>';
			inp_bnk_dha += '</div>';
			inp_bnk_dha += '</div>';						
			inp_bnk_dha += '<button id="btn_rmv_bnk_dha" class="btn bg-blue-chambray" type="button" style="float: right; margin-right: 1.5%;">Remove</button>';
			inp_bnk_dha += '</div>';
			$(wrapper_bnk_dha).append(inp_bnk_dha);
        }
    });       
	$(wrapper_bnk_dha).on("click","#btn_rmv_bnk_dha", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_bnk_dha--;
    })
	
	//---------------------------------------------------------------------------------------------	
	//---------------------------------------------------------------------------------------------	
		
	var wrapper_bk_aha         = $(".input_fields_wrap_bk_aha"); //Fields wrapper    
	var add_button_bk_aha      = $("#btn_add_bk_aha"); //Add button ID
   
    var x_bk_aha = 1; //initlal text box count
    $(add_button_bk_aha).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_bk_aha < max_fields){ //max input box allowed
            x_bk_aha++; //text box increment            
			
			var inp_bk_aha = '';
			inp_bk_aha += '<div class="row">';
			inp_bk_aha += '<div class="col-md-6">';			
			inp_bk_aha += '<div class="form-group">';
			inp_bk_aha += '<label class="control-label col-md-3">Book Addition Head<span class="required">* </span></label>';			
			inp_bk_aha += '<div class="col-md-9 tooltips">';
			inp_bk_aha += '<input type="text" placeholder="Example :- ( Income not recorded on Books, Bank Interest Income )" class="form-control" data-required="1" name="data[BOOK_ADDITION_HEADS][]">';
			inp_bk_aha += '</div>';
			inp_bk_aha += '</div>';
			inp_bk_aha += '</div>';
			inp_bk_aha += '<div class="col-md-6">';
			inp_bk_aha += '<div class="form-group">';
			inp_bk_aha += '<label class="control-label col-md-3">Book Addition Amount<span class="required">* </span></label>';
			inp_bk_aha += '<div class="col-md-9 tooltips">';
			inp_bk_aha += '<input type="text" placeholder="Example :- ( 500, 600 )" class="form-control" data-required="1" name="data[BOOK_ADDITION_AMOUNTS][]">';
			inp_bk_aha += '</div>';
			inp_bk_aha += '</div>';
			inp_bk_aha += '</div>';						
			inp_bk_aha += '<button id="btn_rmv_bk_aha" class="btn bg-blue-chambray" type="button" style="float: right; margin-right: 1.5%;">Remove</button>';
			inp_bk_aha += '</div>';
			$(wrapper_bk_aha).append(inp_bk_aha);
        }
    });
	$(wrapper_bk_aha).on("click","#btn_rmv_bk_aha", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_bk_aha--;
    })
	
	//---------------------------------------------------------------------------------------------
	
	var wrapper_bk_dha         = $(".input_fields_wrap_bk_dha"); //Fields wrapper    
	var add_button_bk_dha      = $("#btn_add_bk_dha"); //Add button ID
   
    var x_bk_dha = 1; //initlal text box count
    $(add_button_bk_dha).click(function(e){ //on add input button click
        e.preventDefault();
        if(x_bk_dha < max_fields){ //max input box allowed
            x_bk_dha++; //text box increment            
			
			var inp_bk_dha = '';
			inp_bk_dha += '<div class="row">';
			inp_bk_dha += '<div class="col-md-6">';			
			inp_bk_dha += '<div class="form-group">';
			inp_bk_dha += '<label class="control-label col-md-3">Book Deduction Head<span class="required">* </span></label>';			
			inp_bk_dha += '<div class="col-md-9 tooltips">';
			inp_bk_dha += '<input type="text" placeholder="Example :- ( Expenses not recorded on Books, Bank Account Charges )" class="form-control" data-required="1" name="data[BOOK_DEDUCTION_HEADS][]">';
			inp_bk_dha += '</div>';
			inp_bk_dha += '</div>';
			inp_bk_dha += '</div>';
			inp_bk_dha += '<div class="col-md-6">';
			inp_bk_dha += '<div class="form-group">';
			inp_bk_dha += '<label class="control-label col-md-3">Book Deduction Amount<span class="required">* </span></label>';
			inp_bk_dha += '<div class="col-md-9 tooltips">';
			inp_bk_dha += '<input type="text" placeholder="Example :- ( 300, 400 )" class="form-control" data-required="1" name="data[BOOK_DEDUCTION_AMOUNTS][]">';
			inp_bk_dha += '</div>';
			inp_bk_dha += '</div>';
			inp_bk_dha += '</div>';						
			inp_bk_dha += '<button id="btn_rmv_bk_dha" class="btn bg-blue-chambray" type="button" style="float: right; margin-right: 1.5%;">Remove</button>';
			inp_bk_dha += '</div>';
			$(wrapper_bk_dha).append(inp_bk_dha);
        }
    });       
	$(wrapper_bk_dha).on("click","#btn_rmv_bk_dha", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x_bk_dha--;
    })
	
});
</script>
