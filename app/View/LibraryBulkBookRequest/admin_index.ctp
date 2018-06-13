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
                <a href="#">Library </a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Excel Imported Data</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Excel Imported Data
    </div>
</div>
<div class="portlet-body">

    <div class="table-toolbar">
	<?php if(in_array($authUser["ROLE_ID"],array(LIBRARY_ID))){?>
        <div class="btn-group">
        <a href="<?php echo Router::url(array('controller' => 'LibraryBulkBookRequest','action' => 'download')) ?>" class="btn
        green bg-green"> Download Sample Excel Format <i class="fa "></i> 
            </a>
            
        	<div class="col-md-9 tooltips">
                               

            <a href="<?php echo Router::url(array('controller' => 'LibraryBulkBookRequest','action' => 'import')) ?>" class="btn
        green bg-green"> Import Excel <i class="fa fa-plus"></i> 
            </a> 
            
        </div>
    </div>
	<?php }?>
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    <th>
        Book Name
    </th>
    <th>
        Publisher
    </th>
    <th>
        Author
    </th>
    <th>
        Quantity
    </th>
   
</tr>
</thead>
<tbody>
<?php if(count($LibraryBulkBookRequest) > 0):
    $i = 1;
    ?>
    <?php foreach($LibraryBulkBookRequest as $lib) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td><?php echo $lib['LibraryBulkBookRequest']['BOOK_NAME'];?></td>
            <td><?php echo $lib['LibraryBulkBookRequest']['PUBLISHER'];?></td>
            <td><?php echo $lib['LibraryBulkBookRequest']['AUTHOR'];?></td>
            <td><?php echo $lib['LibraryBulkBookRequest']['QUANTITY'];?></td>
           
           
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