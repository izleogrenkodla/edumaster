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
                <a href="#">View Library Fine Collection</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Library Fine Collection
    </div>
</div>
<div class="portlet-body">
<?php echo $this->Form->create('LibraryFine', 
array('class' => 'form-horizontal add custom_form','type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'post')); ?>
	<div class="row custom_search_filter">
    <div class="col-md-12 custom_block">
    	<div class="col-md-8 custom_block">
		
		
			<label class="control-label flef">Select Status: </label>
            <?php echo $this->Form->input('Status', array('options' => $status,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['LibraryFine']['Status']) ? $this->request->query['data']['LibraryFine']['Status']: '')); ?>
				
		
		
		
		</div>	   
        <button type="submit" class="btn bg-blue-chambray">Search</button> OR
		<a href="<?php echo Router::url(array("action"=>"index")); ?>">RESET</a> OR
		
		OR
		<a href="javascript:void(0)"  onclick="return printme('user_table');"><i class="fa fa-print"></i> Print</a>
    </div>
</div>
    <div class="table-toolbar">
       
    </div>

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    <th>
        Holder Name
    </th>
    <th>
        Issue_Type
    </th>
    <th>
        Books
    </th>
    <th>
        No Of Days
    </th>
    <th>
        Fine Per Day
    </th>
    <th>
        Total Amount
    </th>
    <th>
        Status
    </th>
	<?php if(in_array($authUser["ROLE_ID"],array(LIBRARY_ID))){?>
    <th style="width: 185px;">
        Action
    </th> <?php } ?>
</tr>
</thead>
<tbody>
<?php if(count($LibraryFine) > 0):
    $i = 1;
    ?>
    <?php foreach($LibraryFine as $fine) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $fine['Users']['FIRST_NAME']." ".$fine['Users']['LAST_NAME']; ?></td>
            <td class="text-center"><?php echo $fine['LibraryFine']['ISSUETYPE']; ?></td>
            <td class="text-center"><?php if($fine['LibraryFine']['ISSUETYPE'] == "BOOK" ){ echo $fine['LibraryBook']['BOOK_NAME'];}else{
				echo $fine['LibraryFine']['BOOK_NAME'];
			} ?></td>
            <td class="text-center"><?php echo $fine['LibraryFine']['NO_OF_DAYS']; ?></td>
            <td class="text-center"><?php echo $fine['LibraryFine']['FINE_PER_DAY']; ?></td>
            <td class="text-center"><?php echo $fine['LibraryFine']['TOTAL_AMOUNT']; ?></td>
            <td class="text-center"><?php echo $fine['LibraryFine']['STATUS']; ?></td>
            
			<?php if(in_array($authUser["ROLE_ID"],array(LIBRARY_ID))){?>
            <td class="text-center">
				<?php if($fine['LibraryFine']['STATUS'] == "Pending"){?>
			   <a href="javascript::void(0);" onclick="change_status('<?php echo Router::url(array('controller' => 'LibraryFine','action' => 'action', $fine['LibraryFine']['FINE_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                       data-original-title="Delete">
                        <i class="fa fa-check"></i></a>
				<?php } ?>
                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'LibraryFine','action' => 'delete', $fine['LibraryFine']['FINE_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                       data-original-title="Delete">
                        <i class="fa fa-trash-o"></i></a>
			
            </td> 
			<?php } ?>
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
function change_status(x) {
	if(confirm("Are you sure want to return book with fine ?")) { 
		window.location.href = x;
	}
}
</script>