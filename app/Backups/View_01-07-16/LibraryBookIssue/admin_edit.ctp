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
                        <a href="<?php echo Router::url(array('controller' => 'LibraryBookIssue', 'action' => 'index')) ?>">View Issued Book</a>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'LibraryBookIssue', 'action' => 'add')) ?>">Issue New Book</a>
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
                <a href="#">Edit Issue Book</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Edit Issue Book
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('LibraryBookIssue', array('class' => 'form-horizontal add', 'id' => 'LibraryBookIssue')); ?>
			<?php echo $this->Form->input("BOOK_ISSUE_ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?><?php echo $this->Form->input("BOOK_ISSUE_ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?><?php echo $this->Form->input("BOOK_ISSUE_ID", array('type' => 'hidden', 'label' => false, 'div' => false)) ?>
			
                <div class="form-body">
                    
                    
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Category<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
									
                                    <?php echo $this->Form->input('GROUP_ID', array('options' => $LibraryGroup,
                                       'default' => 'Select', 'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' ,'onchange' => 'fn_getBooks(this)','id'=>'role')); ?>	
                                </div>
                            </div>
                        </div>
						<div id="books">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Book Name<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                     <?php echo $this->Form->input('BOOK_ID', array('options' => $books,
                                       'default' => 'Select', 'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' ,'id'=>'books')); ?>	
                                </div>
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
                                <label class="control-label col-md-3">Select User<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                     <?php echo $this->Form->input('ROLE_ID', array('options' => $roles,
                                       'default' => '', 'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me','onchange'=> 'fn_getUsers(this)')); ?>	
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Academic Class<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                     <?php
										
										if($croles == STUDENT_ID){
											$disable = '';
											
										}else{$disable = 'disabled';}		
										echo $this->Form->input('CLASS_ID', array('options' => $class,$disable,
                                       'default' => 'Select', 'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' ,'id' => 'select_cls','onchange'=>'fn_getStudents(this)')); ?>	
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="row">
                    <div id="students">
					
                    	<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select User<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                     <?php echo $this->Form->input('USER_ID', array('options' => $users,
                                       'default' => '', 'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me')); ?>	
                                </div>
                            </div>
                        </div>
                                        <!--/row-->
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
	function fn_getBooks(data){
			var bid = $(data).val();
			var data = 'bid='+bid;
			$.ajax({
			data:data,
			url:"getBooks",
			type:"POST",
			cache:false,
			success: function (html) {
          $('#books').html(html);
        }

			});
	}

	function fn_getUsers(data){
		
		var id = $(data).val();
		if (id == <?php echo STUDENT_ID;?>) {
         $("#select_cls").removeAttr("disabled");
		 
     } else {
			
           $("#select_cls").attr('disabled', 'disabled');
			
			var data = 'id='+id;
			$.ajax({
			data:data,
			url:REQUEST_URL+"LibraryBookIssue/getOthers",
			type:"POST",
			cache:false,
			success: function (html) {
          $('#students').html(html);
        }

			});
		
			
     }
	}
	
	function fn_getStudents(data){
		var sid = $(data).val();
			var data = 'sid='+sid;
			$.ajax({
			data:data,
			url:REQUEST_URL+"LibraryBookIssue/getStudents",
			type:"POST",
			cache:false,
			success: function (html) {
          $('#students').html(html);
        }

			});
	}
</script>