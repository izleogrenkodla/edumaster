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
                <a href="#">Account Balance Sheet Details</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Account Balance Sheet Details</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Account Balance Sheet Details 
    </div>
</div>
<div class="portlet-body">

<?php if($authUser["ROLE_ID"]==ACCOUNT_ID) { ?>
    <!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'AccountBalanceSheetDetails','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
	<a href="<?php echo Router::url(array('controller' => 'AccountBalanceSheetDetails','action' => 'add')) ?>" class="btn
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
		Date
    </th>
    <th>
        Account Balance Sheet Head
    </th>
	<th>
        Account Balance Sheet Sub Head
    </th>
	<th>
        Account Balance Sheet Head Category
    </th>
	<th>
		Amount
    </th>
	<!--<th>
		Description
    </th>-->
	<th>
        Sort Order
    </th>
    <th style="width: 200px;">
        Status
    </th>
    <th style="width: 200px;">
        Action
    </th>
</tr>
</thead>
<tbody>
<?php if(count($data) > 0):
    $i = 1;
    ?>
    <?php foreach($data as $act_grp) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
			<?php
				if(isset($act_grp['AccountBalanceSheetDetail']['DATE']) && $act_grp['AccountBalanceSheetDetail']['DATE']!="")
				{
					$act_grp['AccountBalanceSheetDetail']['DATE'] = Date('d/m/Y',strtotime($act_grp['AccountBalanceSheetDetail']['DATE']));
				}
				else
				{
					$act_grp['AccountBalanceSheetDetail']['DATE'] = "";
				}
			?>			
			<td class="text-center"><?php echo $act_grp['AccountBalanceSheetDetail']['DATE']; ?></td>
			<td><?php echo $act_grp['AccountBalanceSheetHead']['ACCOUNT_BALANCE_SHEET_HEAD']; ?></td>
			<td><?php echo $act_grp['AccountBalanceSheetSubHead']['ACCOUNT_BALANCE_SHEET_SUB_HEAD']; ?></td>
			<td><?php echo $act_grp['AccountBalanceSheetDetail']['ACCOUNT_BALANCE_SHEET_HEAD_CATEGORY']; ?></td>
            <td><?php echo $act_grp['AccountBalanceSheetDetail']['AMOUNT']; ?></td>
			<!--<td><?php echo $act_grp['AccountBalanceSheetDetail']['DESCRIPTION']; ?></td>-->
			<td class="text-center"><?php echo $act_grp['AccountBalanceSheetDetail']['SORT_ORDER']; ?></td>
            <td class="text-center">
                <?php if($act_grp['AccountBalanceSheetDetail']['STATUS']) { ?>
                    Active
                <?php } else { ?>
                    Inactive
                <?php } ?>
            </td>
            <td class="text-center">
			
				<a href="<?php echo Router::url(array('controller' => 'AccountBalanceSheetDetails',
                    'action' => 'view', $act_grp['AccountBalanceSheetDetail']['ACCOUNT_BALANCE_SHEET_DET_ID']
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="View">
                    <i class="fa fa-desktop"></i></a>
				<?php if($authUser["ROLE_ID"]==ACCOUNT_ID) { ?>
                <a href="<?php echo Router::url(array('controller' => 'AccountBalanceSheetDetails',
                    'action' => 'edit', $act_grp['AccountBalanceSheetDetail']['ACCOUNT_BALANCE_SHEET_DET_ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Edit">
                    <i class="fa fa-pencil"></i></a>
                
                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'AccountBalanceSheetDetails','action' => 'delete', $act_grp['AccountBalanceSheetDetail']['ACCOUNT_BALANCE_SHEET_DET_ID']))?>')" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Delete">
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
	if(confirm("Are you sure want to remove this record?")) { 
		window.location.href = x;
	}
}
</script>