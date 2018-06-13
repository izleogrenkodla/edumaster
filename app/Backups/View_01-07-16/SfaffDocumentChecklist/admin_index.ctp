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
                <a href="#">Document Checklist</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Document Checklist</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View Document Checklist
    </div>
</div>
<div class="portlet-body">

   <?php if($authUser["ROLE_ID"]==HR_ID) { ?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'SfaffDocumentChecklist','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
<?php } ?>	

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th width="100">
        Sr. No.
    </th class="text-center">
    <th class="text-center">
      Role Name
    </th>
    <th class="text-center">
      Proof Name
    </th>
    <th class="text-center">
      Remark
    </th>
    <th class="text-center">
    	Status  
    </th>
  <?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
    <th class="text-center">
        Action
    </th>
  <?php } ?>
</tr>
</thead>
<tbody>

<?php if(count($SfaffDocumentChecklist) > 0):
    $i = 1;
    ?>
    <?php foreach($SfaffDocumentChecklist as $SCL) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $SCL['Role']['ROLE_NAME']; ?></td>
            <td class="text-center"><?php echo $SCL['SfaffDocumentChecklist']['PROOF_NAME']; ?></td>
             <td class="text-center"><?php echo $SCL['SfaffDocumentChecklist']['REMARK']; ?></td>
             <td class="text-center">
			 <?php  if($SCL['SfaffDocumentChecklist']['STATUS'] == 1)
			 {
				 echo 'Active';
			 }else{
				 echo 'Inactive';
			 }
			  ?></td>
            <?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
            <td class="text-center">
			    <a href="<?php echo Router::url(array('controller' => 'SfaffDocumentChecklist',
                    'action' => 'edit', $SCL['SfaffDocumentChecklist']['DOC_CHE_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>

                    <a href="javascript:void(0)" onclick="remove_record('<?php echo Router::url(array('controller' => 'SfaffDocumentChecklist','action' => 'delete', $SCL['SfaffDocumentChecklist']['DOC_CHE_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                       data-original-title="Delete">
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