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
                <a href="#">Promotion</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Promotion</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Promotion
    </div>
</div>
<div class="portlet-body">

   

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th class="text-center">
        Sr. No.
    </th>
    <th class="text-center">
        User
    </th>
    <th class="text-center">
       	Old Role
    </th>
    <th class="text-center">
       	New Role
    </th>
    <th class="text-center">
       	Old Salary
    </th>
    <th class="text-center">
       	New Salary
    </th>
    <th class="text-center">
        Promotion Date
    </th>
    <th class="text-center">
        Remark
    </th>
    
</tr>
</thead>
<tbody>
<?php if(count($Promotion) > 0):
    $i = 1;
    ?>
    <?php foreach($Promotion as $pro) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $pro['Name']['FIRST_NAME'].' '. $pro['Name']['MIDDLE_NAME'].' ' .$pro['Name']['LAST_NAME']; ?></td>
            <td class="text-center"><?php echo $pro['Role']['ROLE_NAME']; ?></td>
            <td class="text-center"><?php echo $pro['NewRole']['ROLE_NAME']; ?></td>
            <td class="text-center"><?php echo $pro['Promotion']['OLD_SALARY']; ?></td>
            <td class="text-center"><?php echo $pro['Promotion']['NEW_SALARY']; ?></td>
            <td class="text-center"><?php echo $pro['Promotion']['PRO_DATE']; ?></td>
            <td class="text-center"><?php echo $pro['Promotion']['REMARK']; ?></td>
            
            
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