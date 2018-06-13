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
                <a href="#">FrontSlider</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View FrontSlider</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Front Slider
    </div>
</div>
<div class="portlet-body">

    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'FrontSlider','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    <th>
        Slider Name
    </th>
    <th>
        Image
    </th>
	<th>
        Status
    </th>
    <th style="width: 185px;">
        Action
    </th>
</tr>
</thead>
<tbody>
<?php if(count($frontslider) > 0):
    $i = 1;
    ?>
    <?php foreach($frontslider as $album) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $album['FrontSlider']['Slider_Name']; ?></td>
			
            <td class="text-center"><img src="<?php echo DOWNLOADURL.'upload_slider/'.$album['FrontSlider']['Slider_img']; ?>" height="100" width="200"/></td>
			<td class="text-center"><?php 
				if($album['FrontSlider']['Status'] == 0){
					echo 'Inactive';
				}else{
					echo 'Active'; 
				} 
				?></td>
            <td class="text-center">
                <a href="<?php echo Router::url(array('controller' => 'FrontSlider',
                    'action' => 'edit', $album['FrontSlider']['Slider_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>

                   <a href="<?php echo Router::url(array('controller' => 'FrontSlider',
                    'action' => 'delete', $album['FrontSlider']['Slider_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                       data-original-title="Delete">
                        <i class="fa fa-trash-o"></i></a>

            </td>
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