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
                <a href="#">Blog</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Blog</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Blog
    </div>
</div>
<div class="portlet-body">

    <?php //if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==TEACHER_ID) {
		if($authUser["ROLE_ID"]==ADMIN_ID) {
	?>
    <!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Blog','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
	<a href="<?php echo Router::url(array('controller' => 'Blog','action' => 'add')) ?>" class="btn
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
        User Type
    </th>
    <th>
        User Name
    </th>
    <th>
        Category Name
    </th>
    <th>
        Blog Title
    </th>
    <th>
        Blog Image
    </th>
	<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
    <th style="width: 200px;">
        Action
    </th>
	<?php } ?>
</tr>
</thead>
<tbody>
<?php if(count($blogs) > 0):
    $i = 1;
    ?>
    <?php foreach($blogs as $blog) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $blog['Role']['ROLE_NAME']; ?></td>
            <td class="text-center"><?php echo $blog['User']['FIRST_NAME'].' '.$blog['User']['MIDDLE_NAME'].' '.$blog['User']['LAST_NAME']; ?></td>
            <td class="text-center"><?php echo $blog['Category']['CATEGORY_NAME']; ?></td>
            <td> <?php echo $blog['Blog']['BLOG_TITLE']; ?></td>
            <td class="text-center"><img src="<?php echo DOWNLOADURL.'upload_document/'.$blog['Blog']['BLOG_IMAGE']; ?>" height="100" width="100"/></td>
			<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
            <td class="text-center">
                <?php //if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==TEACHER_ID) { ?>
                <a href="<?php echo Router::url(array('controller' => 'Blog',
                    'action' => 'edit', $blog['Blog']['BLOG_ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Edit">
                    <i class="fa fa-pencil"></i></a>

                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'Blog','action' => 'delete', $blog['Blog']['BLOG_ID']))?>')" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Delete">
                        <i class="fa fa-trash-o"></i></a>
                        <?php //} ?>
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