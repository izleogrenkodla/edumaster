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
                <a href="#">Album</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Album</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Album
    </div>
</div>
<div class="portlet-body">
<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
    <!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Album','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
	<a href="<?php echo Router::url(array('controller' => 'Album','action' => 'add')) ?>" class="btn
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
        Class Name
    </th>
    <th>
        Album Name
    </th>
    <th>
        Cover Image
    </th>
	<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
    <th style="width: 200px;">
        Action
    </th>
	<?php } ?>
</tr>
</thead>
<tbody>
<?php if(count($albums) > 0):
    $i = 1;
    ?>
    <?php foreach($albums as $album) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $album['AcademicClass']['CLASS_NAME']; ?></td>
            <td class="text-center">
			<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
			<a href="<?php echo Router::url(array('controller' => 'Album', 'action' => 'edit', $album['Album']['ALBUM_ID'],))?>">
			<?php } ?>
			<?php echo $album['Album']['ALBUM_NAME']; ?>
			<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
			</a>
			<?php } ?>
			</td>
            <td class="text-center">
				<!--<img src="<?php echo DOWNLOADURL.'upload_document/'.$album['Album']['COVER_IMAGE']; ?>" height="100" width="100"/>-->
				<div class="cover_img">
					<img src="<?php echo DOWNLOADURL.'upload_document/'.$album['Album']['COVER_IMAGE']; ?>" alt="<?php echo $album['Album']['ALBUM_NAME']; ?>" />
				</div>
			</td>
			<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
            <td class="text-center">
                <a href="<?php echo Router::url(array('controller' => 'Album',
                    'action' => 'edit', $album['Album']['ALBUM_ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-pencil"></i></a>
                    
                    <a href="<?php echo Router::url(array('controller' => 'Album',
                    'action' => 'gallery', $album['Album']['ALBUM_ID'],'albumlist'
                ))?>" class="tooltips btn" data-toggle="tooltip" title="Picture">
                    <i class="fa fa-picture-o"></i></a>

                    <a href="javascript:void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'Album','action' => 'delete', $album['Album']['ALBUM_ID']))?>')" class="tooltips btn" data-toggle="tooltip" title="Delete">
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