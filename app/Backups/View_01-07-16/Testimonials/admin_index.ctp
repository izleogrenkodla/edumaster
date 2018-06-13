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
                <a href="#">Testimonials</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Testimonial</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Testimonials
    </div>
</div>
<div class="portlet-body">

    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Testimonials','action' => 'add')) ?>" class="btn
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
        Name
    </th>

    <th>
        Designation
    </th>

    <th>
        Profile Image
    </th>
 
    <th style="width: 185px;">
        Action
    </th>
</tr>
</thead>
<tbody>
<?php if(count($testimonials) > 0):
    $i = 1;
    ?>
    <?php foreach($testimonials as $testimonial) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><a href="<?php echo Router::url(array('controller' => 'Testimonials', 'action' => 'edit', $testimonial['Testimonial']['TESTIMONIAL_ID'],
                ))?>"><?php echo $testimonial['Testimonial']['NAME']; ?></a></td>
            <td class="text-center"><?php echo $testimonial['Testimonial']['DESIGNATION']; ?></td>
            <td class="text-center"><img src="<?php echo DOWNLOADURL.'upload_document/'.$testimonial['Testimonial']['PROFILE_IMAGE']; ?>" height="100" width="100"/></td>
            <td class="text-center">
			
                <a href="<?php echo Router::url(array('controller' => 'Testimonials',
                    'action' => 'view', $testimonial['Testimonial']['TESTIMONIAL_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-desktop"></i></a>
			   
			    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
			    <a href="<?php echo Router::url(array('controller' => 'Testimonials',
                    'action' => 'edit', $testimonial['Testimonial']['TESTIMONIAL_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>

                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'Testimonials','action' => 'delete', $testimonial['Testimonial']['TESTIMONIAL_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                       data-original-title="Delete">
                        <i class="fa fa-trash-o"></i></a>
						
				<?php } ?>		

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