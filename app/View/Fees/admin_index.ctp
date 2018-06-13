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
                <a href="#">Fees</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Subjects</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Fees
    </div>
</div>
<div class="portlet-body">

   <?php if($authUser["ROLE_ID"]==SUPERVISOR_ID) { ?>
    <!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Fees','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
	<a href="<?php echo Router::url(array('controller' => 'Fees','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
	</a>
<?php } ?>	

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th width="100">
        Sr. No.
    </th>
    <th>
        Class Name
    </th>
	<th>
       Fees Type
    </th>
	<th>
       Payment Terms
    </th>
    <th>
       Amount
    </th>
    <?php if($authUser["ROLE_ID"]==SUPERVISOR_ID) { ?>
    <th>
        Action
    </th>
    <?php } ?>
</tr>
</thead>
<tbody>
<?php if(count($fees) > 0):
    $i = 1;
    ?>
    <?php 
	foreach($fees as $fee) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $fee['AcademicClass']['CLASS_NAME']; ?></td>
			<td class="text-center"><?php echo $fee['FeeType']['TITLE']; ?></td>
			<td class="text-center"><?php echo $fee['PaymentType']['TITLE']; ?></td>
            <td class="text-center"><?php echo $fee['Fee']['FEE']; ?></td>
            <?php if($authUser["ROLE_ID"]==SUPERVISOR_ID) { ?>
            <td class="text-center">
			    <a href="<?php echo Router::url(array('controller' => 'Fees',
                    'action' => 'edit', $fee['Fee']['FEE_ID'],
                ))?>" class="tooltips btn" data-placement="top" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-pencil"></i></a>

                    <a href="javascript:void(0)" onclick="remove_record('<?php echo Router::url(array('controller' => 'Fees','action' => 'delete', $fee['Fee']['FEE_ID']))?>')" class="tooltips btn" data-placement="top" data-toggle="tooltip" title="Delete">
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