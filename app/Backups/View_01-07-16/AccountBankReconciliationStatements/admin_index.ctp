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
                <a href="#">Bank Reconciliation Statements</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Bank Reconciliation Statements</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Bank Reconciliation Statements 
    </div>
</div>
<div class="portlet-body">
<?php if($authUser["ROLE_ID"]==ACCOUNT_ID) { ?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'AccountBankReconciliationStatements','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
<?php } ?>
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
	<th>
		Date
    </th>
    <th>
        Account Department
    </th>
	<th>
        Account Name [Account Number]
    </th>
	<th>
        Bank Statement Balance
    </th>
	<th>
        Adjusted Bank Balance
    </th>
	<th>
		Book Balance
    </th>	
	<th>
		Adjusted Book Balance
    </th>
	<!--<th>
		Description
    </th>-->
	<th>
        Sort Order
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
<?php if(count($data) > 0):
    $i = 1;
    ?>
    <?php foreach($data as $act_grp) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
			<?php
				if(isset($act_grp['AccountBankReconciliationStatement']['DATE']) && $act_grp['AccountBankReconciliationStatement']['DATE']!="")
				{
					$act_grp['AccountBankReconciliationStatement']['DATE'] = Date('d/m/Y',strtotime($act_grp['AccountBankReconciliationStatement']['DATE']));
				}
				else
				{
					$act_grp['AccountBankReconciliationStatement']['DATE'] = "";
				}
			?>			
			<td><?php echo $act_grp['AccountBankReconciliationStatement']['DATE']; ?></td>
			<td><?php echo $act_grp['AccountDepartment']['ACCOUNT_DEPARTMENT_TITLE']; ?></td>
			<td><?php
					if(isset($act_grp['AccountName']['ACCOUNT_NUMBER']) && $act_grp['AccountName']['ACCOUNT_NUMBER']!="")
					{
						echo ucwords($act_grp['AccountName']['ACCOUNT_NAME'])." [ ".$act_grp['AccountName']['ACCOUNT_NUMBER']." ]";
					}
					else
					{
						echo ucwords($act_grp['AccountName']['ACCOUNT_NAME']);
					}
						//echo $act_grp['AccountName']['ACCOUNT_NAME'];
				?></td>
			<td><?php echo $act_grp['AccountBankReconciliationStatement']['BALANCE_BANK']; ?></td>
			<td><?php echo $act_grp['AccountBankReconciliationStatement']['ADJUSTED_BALANCE_BANK']; ?></td>
            <td><?php echo $act_grp['AccountBankReconciliationStatement']['BALANCE_BOOK']; ?></td>
			<td><?php echo $act_grp['AccountBankReconciliationStatement']['ADJUSTED_BALANCE_BOOK']; ?></td>
			<!--<td><?php echo $act_grp['AccountBankReconciliationStatement']['DESCRIPTION']; ?></td>-->
			<td><?php echo $act_grp['AccountBankReconciliationStatement']['SORT_ORDER']; ?></td>
            <td class="text-center">
                <?php if($act_grp['AccountBankReconciliationStatement']['STATUS']) { ?>
                    Active
                <?php } else { ?>
                    Inactive
                <?php } ?>
            </td>
            <td class="text-center">
			
				<a href="<?php echo Router::url(array('controller' => 'AccountBankReconciliationStatements',
                    'action' => 'view', $act_grp['AccountBankReconciliationStatement']['ACCOUNT_BANK_RECONCILIATION_STAT_ID']
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true" title="View Bank Reconciliation Statement"
                   data-original-title="View">
                    <i class="fa fa-desktop"></i></a>
			<?php if($authUser["ROLE_ID"]==ACCOUNT_ID) { ?>		
                <a href="<?php echo Router::url(array('controller' => 'AccountBankReconciliationStatements',
                    'action' => 'edit', $act_grp['AccountBankReconciliationStatement']['ACCOUNT_BANK_RECONCILIATION_STAT_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>
                
                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'AccountBankReconciliationStatements','action' => 'delete', $act_grp['AccountBankReconciliationStatement']['ACCOUNT_BANK_RECONCILIATION_STAT_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
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
	if(confirm("Are you sure want to remove this record?")) { 
		window.location.href = x;
	}
}
</script>