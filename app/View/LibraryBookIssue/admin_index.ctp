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
                <a href="#">View Book Issued</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Library Books Issued
    </div>
</div>
<div class="portlet-body">
<?php if(in_array($authUser["ROLE_ID"],array(LIBRARY_ID))){?>
    <!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'LibraryBookIssue','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
	<a href="<?php echo Router::url(array('controller' => 'LibraryBookIssue','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
	</a>
<?php  } ?>
	
	
	<?php echo $this->Form->create('LibraryBookIssue', 
array('class' => 'form-horizontal add custom_form','type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'post')); ?>
	
	<div class="row custom_search_filter">
    <div class="col-md-12 custom_block">
    	<div class="col-md-8 custom_block">
		
		 <label class="control-label flef">Select Book Category</label>
            <?php echo $this->Form->input('GROUP_ID', array('options' => $LibraryGroup,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['LibraryBookIssue']['GROUP_ID']) ? $this->request->query['data']['LibraryBookIssue']['GROUP_ID']: '')); ?>
               
		
        <label class="control-label flef">Select Role</label>
            <?php echo $this->Form->input('ROLE_ID', array('options' => $roles,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['LibraryBookIssue']['ROLE_ID']) ? $this->request->query['data']['LibraryBookIssue']['ROLE_ID']: '')); ?>
               
		<label class="control-label flef">Select Class</label>
            <?php echo $this->Form->input('CLASS_ID', array('options' => $class,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['LibraryBookIssue']['CLASS_ID']) ? $this->request->query['data']['LibraryBookIssue']['CLASS_ID']: '')); ?>
				
		
		
		
        
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
        Book Holder
    </th>
	<th>
        Role
    </th>
	<th>
        Class
    </th>
    <th>
        Group Name
    </th>
    <th>
        Book Name
    </th>
    <th>
        Issue Date
    </th>
    <th>
        Return Date
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
<?php if(count($IssueBook) > 0):
    $s = 1;
    ?>
    <?php foreach($IssueBook as $i) { ?>
        <tr>
            <td class="text-center"><?php echo $s++; ?></td>
            <td> <?php echo $i['Users']['FIRST_NAME']." ".$i['Users']['LAST_NAME']; ?></td>
            <td> <?php echo $i['Role']['ROLE_NAME']; ?></td>
            
			 <td> <?php if($i['AcademicClass']['CLASS_ID']== "")
			{
				echo "N.A";
				}
				else {
					echo $i['AcademicClass']['CLASS_NAME'];
					}
					?></td>
            <td> <?php echo $i['LibraryGroup']['GROUP_NAME']; ?></td>
            <td> <?php echo $i['LibraryBook']['BOOK_NAME']; ?></td>
            <td> <?php echo $i['LibraryBookIssue']['ISSUE_DATE']; ?></td>
            <td> <?php echo $i['LibraryBookIssue']['RETURN_DATE']; ?></td>
            <td> <?php echo $i['LibraryBookIssue']['Status']; ?></td>
            <?php if(in_array($authUser["ROLE_ID"],array(LIBRARY_ID))){?>
            <td class="text-center">
			<?php if($i['LibraryBookIssue']['Status'] == "Pending"){ ?>
                <a href="javascript::void(0);" onclick="return_book('<?php echo Router::url(array('controller' => 'LibraryBookIssue','action' => 'Return', $i['LibraryBookIssue']['BOOK_ISSUE_ID']))?>')" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Return">
                        <i class="fa fa-check"></i></a>
			<?php }else{
				
			}?>

                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'LibraryBookIssue','action' => 'delete', $i['LibraryBookIssue']['BOOK_ISSUE_ID']))?>')" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Delete">
                        <i class="fa fa-trash-o"></i></a>

            </td> <?php } ?>
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