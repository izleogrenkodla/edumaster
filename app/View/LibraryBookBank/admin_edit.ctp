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
                        <a href="<?php echo Router::url(array('controller' => 'LibraryBookBank', 'action' => 'index')) ?>">View All Book Bank</a>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('controller' => 'LibraryBookBank', 'action' => 'add')) ?>">Add New Book Bank</a>
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
                <a href="#">Add Book Bank</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Add Book Bank
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('LibraryBookBank', array('class' => 'form-horizontal add', 
'id' => 'LibraryBookBank')); ?>
                <div class="form-body">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Class<span class="required">
										* </span>
                                </label>
                                <div class="col-md-9 tooltips">
                                    <?php echo $this->Form->input('CLASS_ID', array('options' => $class,
                                       'default' => 'Select', 'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' ,'onchange' => 'fn_getBooks(this)','id'=>'role')); ?>	
                                </div>
                            </div>
                        </div>

                       <div class="col-md-6">
                            <div class="form-group" id="wrapper_user" >
                                <label class="control-label col-md-3">Select Books<span class="required">
										* </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                     <div id="books_list" style="height:150px;overflow:scroll;">
									<?php echo $checkbox?>	
  
									 </div>
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
                                            <input type="radio" name="data[LibraryBookBank][STATUS]" value="1" <?php echo $this->request->data['LibraryBookBank']['STATUS'] == 1 ? "checked" : ""; ?>/>
                                            Active </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[LibraryBookBank][STATUS]" value="0" <?php echo $this->request->data['LibraryBookBank']['STATUS'] == 0 ? "checked" : ""; ?>/>
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
function fn_getBooks(data){
		var cid = $(data).val();
			var data = 'cid='+cid;
			$.ajax({
			data:data,
			url:REQUEST_URL+"LibraryBookBank/getBooks",
			type:"POST",
			cache:false,
			success: function (html) {
          $('#books_list').html(html);
        }

			});
	}
</script>