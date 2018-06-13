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
                <a href="#">Store</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Store Report</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Store Report
    </div>
</div>
<div class="portlet-body">
<?php if(in_array($authUser["ROLE_ID"],array(STORE_ID))){?>
    <!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'StoreReport','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
<?php }?>
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th style="width: 100px;">
        Sr. No.
    </th>
    <th>
        Department Name
    </th>
    <th>
        Category
    </th><th>
        Item
    </th>
	<th>
     Purchase Quantity
    </th>
    <th>
     Distibuted Quantity
    </th>
	<th>
     Remaining Quantity
    </th>
	<th>
     Date
    </th>
    <th>
        Description
    </th>
	
</tr>
</thead>
<tbody>
<?php if(count($StoreReport) > 0):
    $i = 1;
    ?>
    <?php foreach($StoreReport as $lg) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td><?php echo $lg['Role']['ROLE_NAME']; ?></a></td>
            <td><?php echo $lg['StoreCategory']['CATEGORY_NAME']; ?></a></td>
            <td><?php echo $lg['StoreItemMstr']['ITEM_NAME']; ?></a></td>
            <td><?php echo $lg['StoreReport']['PURCHASE_QUANTITY']; ?></a></td>
            <td><?php echo $lg['StoreReport']['QUANTITY']; ?></a></td>
            <td><?php echo $lg['StoreReport']['REMAINING_QUANTITY']; ?></a></td>
            <td><?php echo $lg['StoreReport']['DATE']; ?></a></td>
            <td><?php echo $lg['StoreReport']['DESCRIPTION']; ?></a></td>
            
            
			
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