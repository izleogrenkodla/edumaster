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
                <a href="#">View Library Newpaper Item</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View Library Newpaper Item
    </div>
</div>
<div class="portlet-body">
<?php if(in_array($authUser["ROLE_ID"],array(LIBRARY_ID))){?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'LibraryNewsPaperItem','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
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
        NewsPaper Name
    </th>
    <th>
        magazine
    </th>
    <th>
        Date
    </th>
	<?php if(in_array($authUser["ROLE_ID"],array(LIBRARY_ID))){?>
    <th style="width: 185px;">
        Action
    </th>
	<?php } ?>
</tr>
</thead>
<tbody>
<?php //PR($LibraryNewsPaperItem); die();
 if(count($LibraryNewsPaperItem) > 0):
    $i = 1;
    ?>
    <?php foreach($LibraryNewsPaperItem as $NewsItem) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
             <td> <?php echo $NewsItem['LibraryNewsPaper']['PAPER_NAME']; ?></td>
             <td> <?php echo $NewsItem['LibraryNewsPaperItem']['MAGZINE']; ?></td>
             <td> <?php echo $NewsItem['LibraryNewsPaperItem']['Date']; ?></td>
             <?php if(in_array($authUser["ROLE_ID"],array(LIBRARY_ID))){?>
            <td class="text-center">
                <a href="<?php echo Router::url(array('controller' => 'LibraryNewsPaperItem',
                    'action' => 'edit', $NewsItem['LibraryNewsPaperItem']['NEWS_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>

                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'LibraryNewsPaperItem','action' => 'delete', $NewsItem['LibraryNewsPaperItem']['NEWS_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                       data-original-title="Delete">
                        <i class="fa fa-trash-o"></i></a>

						
            </td>
			 <?php }?>
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