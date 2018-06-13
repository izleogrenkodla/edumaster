

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
                <a href="#">Departure Arrival</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Departure Arrival </a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Departure Arrival
    </div>
</div>
<div class="portlet-body">
<?php if(in_array($authUser["ROLE_ID"],array(TRANSPORTATION_ID))){?>
    <!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'DepartureArrival','action' => 'add')) ?>" class="btna
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
	<a href="<?php echo Router::url(array('controller' => 'DepartureArrival','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
	</a>
<?php }?>
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th style="width: 100px;">
        Sr. No.
    </th>
    <th>
       Vehicle Shift
    </th>
	<th>
       Vehicle Number
    </th>
	<th>
     Departure Time
    </th>
	<th>
      Arrival Time
    </th>
    <th>
        Date
    </th>
	<?php if(in_array($authUser["ROLE_ID"],array(TRANSPORTATION_ID))){?>
    <th>
        Action
    </th>
	<?php }?>
</tr>
</thead>
<tbody>
<?php if(count($data) > 0):
    $i = 1;
    ?>
    <?php foreach($data as $deparr) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $deparr['VehicleShift']['VEHICLE_SHIFT_TYPE']; ?></a></td>
            <td class="text-center"><?php echo $deparr['Vehicle']['VEHICLE_NUMBER']; ?></a></td>
            <td class="text-center"><?php echo $deparr['DepartureArrival']['DEPARTURE_TIME']; ?>
            <td class="text-center"><?php echo $deparr['DepartureArrival']['ARRIVAL_TIME']; ?>
            <td class="text-center"><?php echo $deparr['DepartureArrival']['DATE']; ?>
            
</a></td>
            
            <?php if(in_array($authUser["ROLE_ID"],array(TRANSPORTATION_ID))){?>
            <td class="text-center">
			<a href="<?php echo Router::url(array('controller' => 'DepartureArrival',
                    'action' => 'view', $deparr['DepartureArrival']['DEP_ARR_ID']
                ))?>" class="tooltips btn" data-placement="top" data-toggle="tooltip" title="View"><i class="fa fa-desktop"></i></a>
                <a href="<?php echo Router::url(array('controller' => 'DepartureArrival',
                    'action' => 'edit', $deparr['DepartureArrival']['DEP_ARR_ID'],
                ))?>" class="tooltips btn" data-placement="top" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-pencil"></i></a>
                
                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'DepartureArrival','action' => 'delete',  $deparr['DepartureArrival']['DEP_ARR_ID']))?>')" class="tooltips btn" data-placement="top" data-toggle="tooltip" title="Delete">
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