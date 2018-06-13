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
                <a href="#">Account Ledger Details</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Account Ledger Details</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Account Ledger Details
    </div>
</div>
<div class="portlet-body">
<?php if($authUser["ROLE_ID"]==ACCOUNT_ID) { ?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'AccountLedgerDetails','action' => 'add')) ?>" class="btn
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
        Account Group
    </th>
	<th>
		Account Payment Type
    </th>
	<th>
        Account Head
    </th>		
	<th>
		Voucher Number
    </th>
	<th>
		Cheque Number
    </th>
	<th>
		DD Number
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
				if(isset($act_grp['AccountLedgerDetail']['DATE']) && $act_grp['AccountLedgerDetail']['DATE']!="")
				{
					$act_grp['AccountLedgerDetail']['DATE'] = Date('d/m/Y',strtotime($act_grp['AccountLedgerDetail']['DATE']));
				}
				else
				{
					$act_grp['AccountLedgerDetail']['DATE'] = "";
				}
			?>			
			<td><?php echo $act_grp['AccountLedgerDetail']['DATE']; ?></td>
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
			<td><?php echo $act_grp['AccountGroup']['ACCOUNT_GROUP_TITLE']; ?></td>
			<td><?php echo $act_grp['AccountPaymentType']['ACCOUNT_PAYMENT_TYPE']; ?></td>
            <td><?php echo $act_grp['AccountLedgerDetail']['ACCOUNT_HEAD']; ?></td>
			<td><?php echo $act_grp['AccountLedgerDetail']['VOUCHER_NUMBER']; ?></td>
			<td><?php echo $act_grp['AccountLedgerDetail']['CHEQUE_NUMBER']; ?></td>
			<td><?php echo $act_grp['AccountLedgerDetail']['DD_NUMBER']; ?></td>
			<td><?php echo $act_grp['AccountLedgerDetail']['AMOUNT']; ?></td>
			<!--<td><?php echo $act_grp['AccountLedgerDetail']['DESCRIPTION']; ?></td>-->
			<td><?php echo $act_grp['AccountLedgerDetail']['SORT_ORDER']; ?></td>
            <td class="text-center">
                <?php if($act_grp['AccountLedgerDetail']['STATUS']) { ?>
                    Active
                <?php } else { ?>
                    Inactive
                <?php } ?>
            </td>
            <td class="text-center">
			
				<a href="<?php echo Router::url(array('controller' => 'AccountLedgerDetails',
                    'action' => 'view', $act_grp['AccountLedgerDetail']['ACCOUNT_LEDGER_DET_ID']
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true" title="View Account Ledger Detail"
                   data-original-title="View">
                    <i class="fa fa-desktop"></i></a>
			<?php if($authUser["ROLE_ID"]==ACCOUNT_ID) { ?>	
                <a href="<?php echo Router::url(array('controller' => 'AccountLedgerDetails',
                    'action' => 'edit', $act_grp['AccountLedgerDetail']['ACCOUNT_LEDGER_DET_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>
                
                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'AccountLedgerDetails','action' => 'delete', $act_grp['AccountLedgerDetail']['ACCOUNT_LEDGER_DET_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
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