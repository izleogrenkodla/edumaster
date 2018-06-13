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
                        <a href="<?php echo Router::url(array('controller' => 'LibraryBookBankIssue', 'action' => 'index')) ?>">View All Issued BookBank</a>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'LibraryBookBankIssue', 'action' => 'add')) ?>">Issue New BookBank</a>
                    </li>
                </ul>
            </li>
            <li>
                <i class="fa fa-home"></i>
                <a href="#">Home</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Library</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Issue BookBank</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Issue BookBank
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('LibraryBookBankIssue', array('class' => 'form-horizontal add', 'id' => 'LibraryBookBankIssue')); ?>
                <div class="form-body">
                    
                    <div class="row">
                        <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Select Class<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
<?php echo $this->Form->input('CLASS_ID', array('options' => $class,
                                       'default' => 'Select', 'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' ,'onchange' => 'fn_getStudent(this)','id'=>'role')); ?>	
                                </div>
                            </div>
                        </div>

                         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Select Students<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
								<div id="students">
<?php echo $this->Form->input('USER_ID', array('options' => $stu,
                                       'default' => 'Select', 'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' ,'onchange' => 'fn_getStudent(this)','id'=>'role')); ?>	
									   
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    	<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3"> Issue Date<span class="required">
										* </span>
                                </label>
                                  <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('ISSUE_DATE', array('type' => 'text', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control date-picker','readonly'=>"readonly", 'placeholder' => 'Example :- ( 25/12/2016 )')); ?>
                                        </div>
                            </div>
                        </div>
						 <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Return Date<span class="required">
										* </span>
                                </label>
								<input type="hidden" name="data[LibraryBookBankIssue][Status]" value="Issued"/>
                                <div class="col-md-9 tooltips">
                                            <?php echo $this->Form->input('RETURN_DATE', array('type' => 'text', 'label' => FALSE_VALUE,
                                                'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control date-picker','readonly'=>"readonly", 'placeholder' => 'Example :- ( 25/12/2016 )')); ?>
                                        </div>
                            </div>
                        </div>
                       
                    </div>
                    
                        <div class="row">
                           
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label col-md-3">CheckList For BookBank<span class="required">
                                            * </span>
                                    </label>
									<div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <div id="books_list" style="height:150px;overflow:scroll;"></div>
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
function fn_getStudent(data){
		var cid = $(data).val();
		fn_getBookbank(cid);	
			var data = 'cid='+cid;
			$.ajax({
			data:data,
			url:"getStudent",
			type:"POST",
			cache:false,
			success: function (html) {
          $('#students').html(html);
        }

			});
			
		
	}
	function fn_getBookbank(data){
		
			var data = 'cid='+data;
			$.ajax({
			data:data,
			url:"getBooks",
			type:"POST",
			cache:false,
			success: function (html) {
          $('#books_list').html(html);
        }

			});
			
		
	}
</script>