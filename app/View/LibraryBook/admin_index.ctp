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
                <a href="#">View Library Books</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All LibraryBook
    </div>
</div>
<div class="portlet-body">
<?php if(in_array($authUser["ROLE_ID"],array(LIBRARY_ID))){?>
    <!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'LibraryBook','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
	<a href="<?php echo Router::url(array('controller' => 'LibraryBook','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
	</a>
<?php } ?>
	<?php echo $this->Form->create('LibraryBook', 
array('class' => 'form-horizontal add custom_form','type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'post')); ?>
	
	<div class="row custom_search_filter">
    <div class="col-md-12 custom_block">
    	<div class="col-md-8 custom_block">
        <label class="control-label flef">Select Book Group Name</label>
            <?php echo $this->Form->input('GROUP_ID', array('options' => $group,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['LibraryBook']['GROUP_ID']) ? $this->request->query['data']['LibraryBook']['GROUP_ID']: '')); ?>
               
		
		
        <label class="control-label flef">Select Publisher</label>
            <?php echo $this->Form->input('PUBLISHER_ID', array('options' => $publisher,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['LibraryBook']['PUBLISHER_ID']) ? $this->request->query['data']['LibraryBook']['PUBLISHER_ID']: '')); ?><label class="control-label flef">Select Class</label>
            
			<?php echo $this->Form->input('CLASS_ID', array('options' => $classes,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['LibraryBook']['CLASS_ID']) ? $this->request->query['data']['LibraryBook']['CLASS_ID']: '')); ?>
               
		
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
    <th style="width: 100px;">
        Sr. No.
    </th>
    <th>
        Book Name
    </th>
    <th>
        Group Name
    </th>
    <th>
        Publisher Name
    </th>
    <th>
        Author
    </th>
	<th>
        Academic Class
    </th>
    <th>
        Date
    </th>
    <th>
        Book From
    </th>
    <th>
        Quantity
    </th>
    <th style="width: 200px;">
        Status
    </th>
	<?php if(in_array($authUser["ROLE_ID"],array(LIBRARY_ID))){?>
    <th style="width: 200px;">
        Action
    </th><?php } ?>
</tr>
</thead>
<tbody>
<?php if(count($LibraryBook) > 0):
    $i = 1;
    ?>
    <?php foreach($LibraryBook as $book) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td> <?php echo $book['LibraryBook']['BOOK_NAME']; ?></td>
            <td> <?php echo $book['LibraryGroup']['GROUP_NAME']; ?></td>
            <td> <?php echo $book['LibraryPublisher']['PUBLISHER_NAME']; ?></td>
            <td> <?php echo $book['LibraryBook']['AUTHOR']; ?></td>
            <td> <?php echo $book['AcademicClass']['CLASS_NAME']; ?></td>
            <td> <?php echo $book['LibraryBook']['created']; ?></td>
            <td> <?php echo $book['LibraryBook']['BOOK_FROM']; ?></td>
            <td> <?php echo $book['LibraryBook']['QUANTITY']; ?></td>
            <td class="text-center">
                <?php if($book['LibraryBook']['STATUS']) { ?>
                    Active
                <?php } else { ?>
                    Inactive
                <?php } ?>
            </td><?php if(in_array($authUser["ROLE_ID"],array(LIBRARY_ID))){?>
            <td class="text-center">
                <a href="<?php echo Router::url(array('controller' => 'LibraryBook',
                    'action' => 'edit', $book['LibraryBook']['BOOK_ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Edit">
                    <i class="fa fa-pencil"></i></a>

                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'LibraryBook','action' => 'delete', $book['LibraryBook']['BOOK_ID']))?>')" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Delete">
                        <i class="fa fa-trash-o"></i></a>

            </td><?php } ?>
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