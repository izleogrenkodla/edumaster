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
                <a href="#">Results</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Results</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View Results
    </div>
</div>
<div class="portlet-body">

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th width="100">
        Sr. No.
    </th>
    <th>
       Result type
    </th>
	<th>
       Student
    </th>
	<th>
       Publish on
    </th>
	<th>
       Class
    </th>
    <th style="width: 185px;">
        Action
    </th>
</tr>
</thead>
<tbody>
<?php if(count($results) > 0) {
    $i = 1;
    ?>
    <?php foreach($results as $result) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php  echo $result["Exam"]["ExamType"]["TITLE"]; ?></td>
			<td class="text-center"><?php  echo $result["Student"]["FIRST_NAME"].' '.$result["Student"]["MIDDLE_NAME"].' '.$result["Student"]["LAST_NAME"]; ?></td>
			<td class="text-center"><?php  echo $this->General->dbfordate($result["Result"]["PUBLISH_DATE"]); ?></td>
			<td class="text-center"><?php  echo $result["Exam"]["AcademicClass"]["CLASS_NAME"]; ?></td>
            <td class="text-center">
              <a href="<?php echo Router::url(array("action"=>"view",$result["Result"]["RS_ID"])); ?>"  class="tooltips btn" data-container="body" data-placement="top" data-html="true" title="View Result" 
                       data-original-title="Delete">
                        <i class="fa fa-eye"></i></a>
					  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>	
			  <a href="javascript:void(0)" onclick="remove_record('<?php echo Router::url(array('action' => 'delete'))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true" title="Delete Result" 
                       data-original-title="Delete">
                        <i class="fa fa-trash-o"></i></a>
				<?php } ?>		
            </td>
        </tr>
    <?php $i++; } ?>
<?php } ?>
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