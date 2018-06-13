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
                <a href="#">View Library</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Library
    </div>
</div>
<div class="portlet-body">
<?php if($authUser["ROLE_ID"]==LIBRARY_ID) { ?>
    <!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
	<a href="<?php echo Router::url(array('action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
	</a>
<?php } ?>
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
        Book
    </th>
	 <th>
        From Date
    </th>
	 <th>
        Revert Date
    </th>
	 <th style="width: 200px;">
        Status
    </th>
	<?php if($authUser["ROLE_ID"]==LIBRARY_ID) { ?>
    <th style="width: 200px;">
        Action
    </th>
	<?php } ?>
</tr>
</thead>
<tbody>
<?php if(count($Library) > 0):
    $i = 1;
	?>
    <?php foreach($Library as $book) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
			<td> <?php echo $book['User']['FIRST_NAME'].' '.$book['User']['MIDDLE_NAME'].' '.$book['User']['LAST_NAME']; ?></td>
            <td> <?php echo $book['Book']['BOOK_NAME']; ?></td>
			<td> <?php echo $this->General->dbfordate($book['Library']['START_DATE']); ?></td>
			<td> <?php echo $this->General->dbfordate($book['Library']['END_DATE']); ?></td>
			<td> <?php echo $this->General->getBookStatus($book['Library']['STATUS']); ?></td>
            <?php if($authUser["ROLE_ID"]==LIBRARY_ID) { ?>
            <td class="text-center">
                <a href="<?php echo Router::url(array('action' => 'edit', $book['Library']['LIB_ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Edit">
                    <i class="fa fa-pencil"></i></a>

                   <!-- <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('action' => 'delete', $book['Library']['LIB_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                       data-original-title="Delete">
                        <i class="fa fa-trash-o"></i></a>-->

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