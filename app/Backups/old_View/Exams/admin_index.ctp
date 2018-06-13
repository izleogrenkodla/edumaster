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
                <a href="#">Exams</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Exams</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View Exams
    </div>
</div>
<div class="portlet-body">
<strong>User Search Form: </strong>
<?php echo $this->Form->create('Exam', array('class' => 'form-horizontal add custom_form',
    'type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'get')); ?>
<div class="row custom_search_filter">

    <div class="col-md-12 custom_block">
    <div class="col-md-7 custom_block">
        <label class="control-label flef">Select Class</label>
            <?php echo $this->Form->input('CLASS_ID', array('options' => $AcademicClass,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['Exam']['CLASS_ID']) ? $this->request->query['data']['Exam']['CLASS_ID']: '')); ?>
				
		    <label class="control-label flef">Select Month</label>
            <?php echo $this->Form->input('MONTH', array('options' => $months,
                'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control input-small select2me',
                'value' => isset($this->request->query['data']['Exam']['MONTH']) ? $this->request->query['data']['Exam']['MONTH']: '')); ?>
	
       
				</div>	   
        <button type="submit" class="btn bg-blue-chambray">Search</button> OR
		<a href="<?php echo Router::url(array("action"=>"index")); ?>">RESET</a> OR
		<a href="<?php echo Router::url(array("action"=>"export_exams")); ?>"><i class="fa-file-excel-o"></i> Export</a>
		OR
		<a href="javascript:void(0)"  onclick="return printme('user_table');"><i class="fa fa-print"></i> Print</a>
    </div>
</div>
</form>

    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Exams','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>


<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th width="100">
        Sr. No.
    </th>
    <th>
       Class
    </th>
	<th>
       Supervisor
    </th>
	<th>
       Start Date
    </th>
		<th>
       End Date
    </th>
    <th style="width: 185px;">
        Action
    </th>
</tr>
</thead>
<tbody>
<?php if(count($exams) > 0) {
    $i = 1;
    ?>
    <?php foreach($exams as $exm) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $exm['AcademicClass']['CLASS_NAME']; ?></td>
			<td class="text-center"><?php echo $exm['Supervisor']['FIRST_NAME'].' '.$exm['Supervisor']['LAST_NAME']; ?></td>
			<td class="text-center"><?php echo $this->General->dbfordate($exm['Exam']['START_DATE']); ?></td>
			<td class="text-center"><?php echo $this->General->dbfordate($exm['Exam']['END_DATE']); ?></td>
            <td class="text-center">
			    <a href="<?php echo Router::url(array('action' => 'result', $exm['Exam']['EX_ID'],
                ))?>" class="tooltips btn" title="Assing Result to <?php echo $exm['AcademicClass']['CLASS_NAME']; ?>" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Assing Result">
                    <i class="fa fa-check-square"></i></a>
					  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
					<a href="<?php echo Router::url(array('action' => 'edit', $exm['Exam']['EX_ID'],
					))?>" class="tooltips btn" data-container="body" title="Edit Result"  data-placement="top" data-html="true"
					   data-original-title="Edit">
						<i class="fa fa-edit"></i></a>
					<a href="javascript:void(0)" onclick="remove_record('<?php echo Router::url(array('action' => 'delete', $exm['Exam']['EX_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true" title="Delete Result" 
						   data-original-title="Delete">
							<i class="fa fa-trash-o"></i></a>
							<?php  } ?>
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