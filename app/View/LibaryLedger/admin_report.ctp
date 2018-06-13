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
                <a href="#">View Book Ledger</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Library Ledger
    </div>
</div>
<div class="portlet-body">

	
	
	
	<?php echo $this->Form->create('LibraryBookIssue', 
array('class' => 'form-horizontal add custom_form','type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'post')); ?>
	
	<div class="row custom_search_filter">
    <div class="col-md-12 custom_block">
       
        
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
	<th>
        No oF Days Late
    </th> 
	<th>
       Fine Per Day
    </th>
	<th>
       Total Amount Fined
    </th> 
	<th>
        Status
    </th> 
	
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
            <td> <?php echo $i['LibraryFine']['NO_OF_DAYS']; ?></td>
            <td> <?php echo $i['LibraryFine']['FINE_PER_DAY']; ?></td>
            <td> <?php echo $i['LibraryFine']['TOTAL_AMOUNT']; ?></td>
            <td> <?php echo $i['LibraryBookIssue']['Status']; ?></td>
          
        </tr>
    <?php $i++; } ?>
<?php endif; ?>
</tbody>
</table>
<div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                
                                <button type="button" class="btn default" onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Back</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
</div>
</div>
<!-- END EXAMPLE TABLE PORTLET-->
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
