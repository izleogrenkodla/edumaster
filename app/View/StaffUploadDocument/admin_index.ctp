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
                <a href="#">Admission</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Upload Document</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Upload Document
    </div>
</div>
<div class="portlet-body">

<?php echo $this->Form->create('StaffRegistration', array('class' => 'form-horizontal add custom_form',
                            'type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'get')); ?>          


<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th style="width: 100px;">
        Sr. No.
    </th>
    <th class="text-center">
        User Name
    </th>
    <th class="text-center">
        Role
    </th>
     <th class="text-center">
        Document Type
    </th>
    <th class="text-center">
        User Document Name
    </th>
    
    <th style="width: 200px;" class="text-center">
        Status
    </th>
	<?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
      <th style="width: 200px;" class="text-center">
        Action
    </th>
	<?php } ?>
    
</tr>
</thead>
<tbody>


<?php if(count($StaffUploadDocument) > 0):
    $i = 1;
    ?>
    <?php foreach($StaffUploadDocument as $udoc) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center" ><?php 
			echo $udoc['Name']['FIRST_NAME'].' ' .$udoc['Name']['MIDDLE_NAME'].' '.$udoc['Name']['LAST_NAME']?></td>
            <td class="text-center" ><?php echo $udoc['Role']['ROLE_NAME']?></td>
            <td class="text-center" ><?php echo $udoc['Document']['PROOF_NAME']?></td>
			<?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
             <td class="text-center" ><a target="#" href="<?php echo DOWNLOADURL.UPLOAD_STAFF_DOCUMENT.'/'.$udoc['StaffUploadDocument']['DOC_NAME'];?>"><?php echo $udoc['StaffUploadDocument']['DOC_NAME']; ?></a></td>
            <?php } elseif(in_array($authUser["ROLE_ID"],array(ADMIN_ID))) {  ?>
			<td class="text-center" ><a target="#" href="<?php echo DOWNLOADURL.UPLOAD_STAFF_DOCUMENT.'/'.$udoc['StaffUploadDocument']['DOC_NAME'];?>"><?php echo $udoc['StaffUploadDocument']['DOC_NAME']; ?></a></td>
			<?php } else { ?>
			<td class="text-center" ><?php echo $udoc['StaffUploadDocument']['DOC_NAME']; ?></td>
			<?php } ?>
			<td class="text-center">
                <?php if($udoc['StaffUploadDocument']['STATUS']) { ?>
                    Active
                <?php } else { ?>
                    Inactive
                <?php } ?>
            </td>
			<?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
            <td class="text-center">
            	<a href="javascript:void(0)" onclick="remove_record('<?php echo Router::url(array('controller' => 'StaffUploadDocument','action' => 'delete', $udoc['StaffUploadDocument']['UPL_DOC_ID']))?>')" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Delete">
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
</script>ss