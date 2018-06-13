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
                <a href="#">Time Table</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Time Table</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Time Table
    </div>
</div>
<div class="portlet-body">

   <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID))) { ?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'TeacherTimeTables','action' => 'add')) ?>" class="btn
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
    </th>
    <th>
       Teacher
    </th>
	<th>
       Week Of Day
    </th>
	<th>
       Start Time
    </th>
	<th>
       End Time
    </th>
    <th width="100">
        Class Name
    </th>
   
    <th style="width: 185px;">
        Action
    </th>
   
</tr>
</thead>
<tbody>
<?php if(count($lists) > 0):
        $i = 1;
	$weeks = array(
	'1' => 'Monday',
	'2' => 'Tuesday',
	'3' => 'Wednesday',
	'4' => 'Thursday',
	'5' => 'Friday',
	'6' => 'Saturday',
	);
    ?>
    <?php foreach($lists as $list) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"><?php echo $list['User']['FIRST_NAME'].' '.$list['User']['LAST_NAME']; ?></td>
			<td class="text-center"><?php echo $weeks[$list['TeacherTimeTable']['TT_DATE']]; ?></td>
			<td class="text-center"><?php echo date(TIMEFORMAT,strtotime($list['TeacherTimeTable']['START_TIME'])); ?></td>
			<td class="text-center"><?php echo date(TIMEFORMAT,strtotime($list['TeacherTimeTable']['END_TIME'])); ?></td>
            <td class="text-center"><?php echo $list['AcademicClass']['CLASS_NAME']; ?></td>
           
            <td class="text-center">
			<a href="<?php echo Router::url(array('controller' => 'TeacherTimeTables',
                    'action' => 'view', $list['TeacherTimeTable']['TT_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="View">
                    <i class="fa fa-eye"></i></a>
			  <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID))) { ?>
			    <a href="<?php echo Router::url(array('controller' => 'TeacherTimeTables',
                    'action' => 'edit', $list['TeacherTimeTable']['TT_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-edit"></i></a>
					
                    <a href="javascript:void(0)" onclick="remove_record('<?php echo Router::url(array('controller' => 'TeacherTimeTables','action' => 'delete', $list['TeacherTimeTable']['TT_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                       data-original-title="Delete">
                        <i class="fa fa-trash-o"></i></a>
				<?php  }?>		
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
	if(confirm("Are you sure want to remove this ?")) { 
		window.location.href = x;
	}
}
</script>