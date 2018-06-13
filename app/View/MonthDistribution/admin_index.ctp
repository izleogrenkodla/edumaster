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
                <a href="#">Month Distribution</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Month Distribution</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Month Distribution
    </div>
</div>
<div class="portlet-body">
<?php if(in_array($authUser["ROLE_ID"],array(SUPERVISOR_ID))) { ?>
	<!--<div class="table-toolbar">
			<div class="btn-group">
				<a href="<?php echo Router::url(array('controller' => 'MonthDistribution','action' => 'add')) ?>" class="btn
			green bg-green"> ADD NEW <i class="fa fa-plus"></i>
				</a>
			</div>
	</div>-->
	<a href="<?php echo Router::url(array('controller' => 'MonthDistribution','action' => 'add')) ?>" class="btn
			green bg-green"> ADD NEW <i class="fa fa-plus"></i>
	</a>
<?php } ?>
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th style="width: 100px;" class="text-center">
        Sr. No.
    </th>
    <th class="text-center">
        Payment Type
    </th>
    <th class="text-center">
       Title
    </th>
    <th class="text-center">
		Month
    </th>
	<th style="width: 200px;" class="text-center">
		Status
    </th>
	<?php if(in_array($authUser["ROLE_ID"],array(SUPERVISOR_ID))) { ?>
    <th style="width: 200px;" class="text-center">
        Action
    </th>
	<?php } ?>
    
</tr>
</thead>
<tbody>
<?php if(count($MonthDistribution) > 0):
    $i = 1;
    ?>
    <?php foreach($MonthDistribution as $pro) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $pro['PaymentType']['TITLE']; ?></td>
			<td class="text-center"><?php echo $pro['MonthDistribution']['title']; ?></td>
			<td class="text-center"><?php
				/*if($pro['MonthDistribution']['month'] == 6){
					$month = 'June';
				}elseif($pro['MonthDistribution']['month'] == 7){
					$month = 'July';
				}elseif($pro['MonthDistribution']['month'] == 8){
					$month = 'August';
				}elseif($pro['MonthDistribution']['month'] == 9){
					$month = 'September';
				}elseif($pro['MonthDistribution']['month'] == 10){
					$month = 'October';
				}elseif($pro['MonthDistribution']['month'] == 11){
					$month = 'November';
				}elseif($pro['MonthDistribution']['month'] == 12){
					$month = 'December';
				}elseif($pro['MonthDistribution']['month'] == 1){
					$month = 'January';
				}elseif($pro['MonthDistribution']['month'] == 2){
					$month = 'February';
				}elseif($pro['MonthDistribution']['month'] == 3){
					$month = 'March';
				}elseif($pro['MonthDistribution']['month'] == 4){
					$month = 'April';
				}elseif($pro['MonthDistribution']['month'] == 5){
					$month = 'May';
				}*/
			
				echo $pro['MonthDistribution']['month'];
			?></td>
          
            <td class="text-center"><?php 
			if($pro['MonthDistribution']['Status'] == 0){
				echo 'Inactive';
			}elseif($pro['MonthDistribution']['Status'] == 1){
				echo 'Active';
			}
			
			?></td>
			<?php if(in_array($authUser["ROLE_ID"],array(SUPERVISOR_ID))) { ?>
            <td class="text-center">
			<!--<a href="<?php echo Router::url(array('controller' => 'MonthDistribution',
                    'action' => 'view', $pro['MonthDistribution']['DISTRI_ID']
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true" title="View News"
                   data-original-title="Delete">
                    <i class="fa fa-pencil"></i></a>-->
					
					 <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'MonthDistribution','action' => 'delete',$pro['MonthDistribution']['DISTRI_ID']))?>')" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Delete">
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