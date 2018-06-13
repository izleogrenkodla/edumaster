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
                <a href="#">Academic Class</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Academic Class</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Academic Classes
    </div>
</div>
<div class="portlet-body">
<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
    <!--<div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'AcademicClasses','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>-->
	<a href="<?php echo Router::url(array('controller' => 'AcademicClasses','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
	</a>
<?php } ?>
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th style="width: 100px;">
        Sr. No.
    </th>
    <th>
        Section
    </th>
	<th>
        Academic Class Name
    </th>
    <th style="width: 200px;">
        Status
    </th>
	<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
    <th style="width: 200px;">
        Action
    </th>
	<?php } ?>
</tr>
</thead>
<tbody>
<?php if(count($AcademicClasses) > 0):
    $i = 1;
    ?>
    <?php foreach($AcademicClasses as $AcademicClass) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
			
            <td class="text-center"><?php echo $AcademicClass['Section']['SECTION']; ?></td>
            <td class="text-center">
			<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
			<a href="<?php echo Router::url(array('controller' => 'AcademicClasses', 'action' => 'edit', $AcademicClass['AcademicClass']['CLASS_ID'],))?>">
			<?php } ?>
			
			<?php echo $AcademicClass['AcademicClass']['CLASS_NAME']; ?>
			<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
			</a>
			<?php } ?>
			</td>
            <td class="text-center">
                <?php if($AcademicClass['AcademicClass']['STATUS']) { ?>
                    Active
                <?php } else { ?>
                    Inactive
                <?php } ?>
            </td>
			<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
            <td class="text-center">
                <a href="<?php echo Router::url(array('controller' => 'AcademicClasses',
                    'action' => 'edit', $AcademicClass['AcademicClass']['CLASS_ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Edit">
                    <i class="fa fa-pencil"></i></a>

                    <a href="<?php echo Router::url(array('controller' => 'AcademicClasses',
                        'action' => 'delete', $AcademicClass['AcademicClass']['CLASS_ID'],
                    ))?>" class="tooltips btn" data-toggle="tooltip" data-placement="top" title="Delete">
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