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
                <a href="#">Vacancy</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Vacancy</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Vacancy
    </div>
</div>
<div class="portlet-body">
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th style="width: 85px;">
        Sr. No.
    </th>
    <th>
        Title
    </th>
	<th>
        Email
    </th>

    <th>
        Applied For
    </th>
    <th style="width: 100px;">
        Action
    </th>
</tr>
</thead>
<tbody>
<?php if(count($Vacancy) > 0):
    $i = 1;
    ?>
    <?php foreach($Vacancy as $v) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
			<td> <?php echo $v['Vacancy']['TITLE']; ?></td>
            <td> <?php echo $v['Vacancy']['EMAIL']; ?></td>
			<td> <?php echo $v['Vacancy']['APPLY_FOR']; ?></td>            
            <td class="text-center">
              <a  href="<?php echo Router::url(array('action' => 'view', $v['Vacancy']['V_ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" title="View">
                        <i class="fa fa-desktop"></i></a>
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