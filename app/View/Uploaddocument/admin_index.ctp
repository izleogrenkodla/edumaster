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


<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    <th>
        STUDENT NAME
    </th>
    <th>
        STUDENT DOCUMENT
    </th>
    <th>
        Status
    </th>
    <?php if(in_array($authUser["ROLE_ID"],array(SUPERVISOR_ID))) { ?>
    <th style="width: 185px;">
        Action
    </th>
    <?php } ?>
</tr>
</thead>
<tbody>
<?php if(count($udocumaent) > 0):
    $i = 1;
    ?>
    <?php foreach($udocumaent as $udoc) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center" ><?php echo $udoc['AppAdmission']['STUDENT_NAME']?></td>
			
			<?php if(in_array($authUser["ROLE_ID"],array(SUPERVISOR_ID))) { ?>
			<td class="text-center" >
			 <a target="#" href="<?php echo DOWNLOADURL.UPLOAD_STUDENT_DOCUMENT.'/'.$udoc['Uploaddocument']['DOC_NAME'];?>"><?php echo $udoc['Uploaddocument']['DOC_NAME']; ?></a></td>
			<?php } elseif(in_array($authUser["ROLE_ID"],array(ADMIN_ID))){ ?>
			<td class="text-center" >
             <a target="#" href="<?php echo DOWNLOADURL.UPLOAD_STUDENT_DOCUMENT.'/'.$udoc['Uploaddocument']['DOC_NAME'];?>"><?php echo $udoc['Uploaddocument']['DOC_NAME']; ?></a></td>
			<?php }else {   ?> 
			 <td class="text-center" >
             <?php echo $udoc['Uploaddocument']['DOC_NAME']; ?></td>
			<?php }  ?>
            <td class="text-center">
                <?php if($udoc['Uploaddocument']['STATUS']) { ?>
                    Active
                <?php } else { ?>
                    Inactive
                <?php } ?>
            </td>
            <?php if(in_array($authUser["ROLE_ID"],array(SUPERVISOR_ID))) { ?>
            <td class="text-center">
                <a href="<?php echo Router::url(array('controller' => 'Uploaddocument',
                    'action' => 'edit', $udoc['Uploaddocument']['UPLOAD_DOC_ID'],
                ))?>" class="tooltips btn" data-placement="top" data-toggle="tooltip" title="Edit">
                    <i class="fa fa-pencil"></i></a>
                
                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'Uploaddocument','action' => 'delete', $udoc['Uploaddocument']['UPLOAD_DOC_ID']))?>')" class="tooltips btn"  data-placement="top" data-toggle="tooltip" title="Delete">
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