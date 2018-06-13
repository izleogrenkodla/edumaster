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
                <a href="#">Route</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Route </a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Route 
    </div>
</div>
<div class="portlet-body">
<?php if(in_array($authUser["ROLE_ID"],array(TRANSPORTATION_ID))){?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Route','action' => 'add')) ?>" class="btna
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
		<?php } ?>
    </div>

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    <th>
        Route   Name
    </th>
	<th>
        From Place
    </th>
	<th>
       To Place
    </th>
	<th>
       Total Time
    </th>
	<th>
      Route Fee
    </th>
    <th>
        Status
    </th>
	<?php if(in_array($authUser["ROLE_ID"],array(TRANSPORTATION_ID))){?>
    <th style="width: 185px;">
        Action
    </th>
	<?php } ?> 
</tr>
</thead>
<tbody>
<?php if(count($route) > 0):
    $i = 1;
    ?>
    <?php foreach($route as $routes) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td><?php echo $routes['Route']['ROUTE_NAME']; ?></a></td>
            <td><?php echo $routes['Route']['FROM_PLACE']; ?></a></td>
			<td><?php echo $routes['Route']['TO_PLACE']; ?></a></td>
            <td><?php echo $routes['Route']['TIMING']; ?></a></td>
            
            <td><?php echo $routes['Route']['ROUTE_FEE']; ?></a></td>
        
            <td class="text-center">
                <?php if($routes['Route']['STATUS']) { ?>
                    Active
                <?php } else { ?>
                    Inactive
                <?php } ?>
            </td>
			<?php if(in_array($authUser["ROLE_ID"],array(TRANSPORTATION_ID))){?>
            <td class="text-center">
                <a href="<?php echo Router::url(array('controller' => 'Route',
                    'action' => 'edit', $routes['Route']['ROUTE_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>
                
                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'Route','action' => 'delete', $routes['Route']['ROUTE_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                       data-original-title="Delete">
                        <i class="fa fa-trash-o"></i></a>
                
            </td><?php }?>
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