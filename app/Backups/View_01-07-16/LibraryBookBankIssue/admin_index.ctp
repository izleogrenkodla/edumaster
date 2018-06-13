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
                <a href="#">Library</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Library BookBank Issue</a>
            </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth'); ?>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Library BookBank Issue
    </div>
</div>
<div class="portlet-body">
<?php if(in_array($authUser["ROLE_ID"],array(LIBRARY_ID))){?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'LibraryBookBankIssue','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
<?php } ?>
<?php echo $this->Form->create('LibraryBookBankIssue', 
array('class' => 'form-horizontal add custom_form','type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'post')); ?>
	
	<div class="row custom_search_filter">
    <div class="col-md-12 custom_block">
    	<div class="col-md-8 custom_block">
		
		
			<label class="control-label flef">Select Class</label>
            <?php echo $this->Form->input('CLASS_ID', array('options' => $class,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['LibraryBookBankIssue']['CLASS_ID']) ? $this->request->query['data']['LibraryBookBankIssue']['CLASS_ID']: '')); ?>
				
		
		
		
		</div>	   
        <button type="submit" class="btn bg-blue-chambray">Search</button> OR
		<a href="<?php echo Router::url(array("action"=>"index")); ?>">RESET</a> OR
		
		OR
		<a href="javascript:void(0)"  onclick="return printme('user_table');"><i class="fa fa-print"></i> Print</a>
    </div>
</div>

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    <th>
        Book Holder
    </th>
    <th>
        Class
    </th>
    <th>
        Books
    </th>
    <th>
        Issue Date 
    </th>
    <th>
        Return Date
    </th>
	<th>
        Status
    </th>
    <?php if(in_array($authUser["ROLE_ID"],array(LIBRARY_ID))){?>
    <th>
        Action
    </th>
	<?php } ?>
</tr>
</thead>
<tbody>
<?php if(count($LibraryBookBankIssue) > 0):
    $i = 1;
    ?>
    <?php foreach($LibraryBookBankIssue as $lib) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td><?php echo $lib['Users']['FIRST_NAME']." ".$lib['Users']['LAST_NAME']; ?></td>
            <td><?php echo $lib['AcademicClass']['CLASS_NAME']; ?></td>
            <td><?php echo $lib['LibraryBookBank']['BOOK_NAME']; ?></td>
            <td><?php echo $lib['LibraryBookBankIssue']['ISSUE_DATE']; ?></td>
            <td><?php echo $lib['LibraryBookBankIssue']['RETURN_DATE']; ?></td>
            <td><?php echo $lib['LibraryBookBankIssue']['Status']; ?></td>
            
            <?php if(in_array($authUser["ROLE_ID"],array(LIBRARY_ID))){?>
            
            <td class="text-center">
			<?php if($lib['LibraryBookBankIssue']['Status'] == "Pending"){  ?>
			
                <a href="javascript::void(0);" onclick="return_book('<?php echo Router::url(array('controller' => 'LibraryBookBankIssue','action' => 'Return', $lib['LibraryBookBankIssue']['BOOK_BANK_ISSUE_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                       data-original-title="Return">
                        <i class="fa fa-check"></i></a>
			<?php }else{
				
			}?>
            

                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'LibraryBookBankIssue','action' => 'delete', $lib['LibraryBookBankIssue']['BOOK_BANK_ISSUE_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                       data-original-title="Delete">
                        <i class="fa fa-trash-o"></i></a>

            </td> <?php }?>
        </tr>
    <?php $i++; } ?>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<script>
function remove_record(x) {
	if(confirm("Are you sure want to remove this ?")) { 
		window.location.href = x;
	}
}
</script>
<script>
function return_book(x) {
	if(confirm("Are you sure want to return this book?")) { 
		window.location.href = x;
	}
}
</script>