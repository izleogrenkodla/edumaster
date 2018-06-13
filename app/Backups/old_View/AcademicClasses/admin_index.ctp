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

    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'AcademicClasses','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    <th>
        Academic Class Name
    </th>
    <th>
        Status
    </th>
    <th style="width: 185px;">
        Action
    </th>
</tr>
</thead>
<tbody>
<?php if(count($AcademicClasses) > 0):
    $i = 1;
    ?>
    <?php foreach($AcademicClasses as $AcademicClass) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td> <a href="<?php echo Router::url(array('controller' => 'AcademicClasses', 'action' => 'edit', $AcademicClass['AcademicClass']['CLASS_ID'],
                ))?>"><?php echo $AcademicClass['AcademicClass']['CLASS_NAME']; ?></a></td>
            <td class="text-center">
                <?php if($AcademicClass['AcademicClass']['STATUS']) { ?>
                    Active
                <?php } else { ?>
                    Inactive
                <?php } ?>
            </td>
            <td class="text-center">
                <a href="<?php echo Router::url(array('controller' => 'AcademicClasses',
                    'action' => 'edit', $AcademicClass['AcademicClass']['CLASS_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-edit"></i></a>

                    <a href="<?php echo Router::url(array('controller' => 'AcademicClasses',
                        'action' => 'delete', $AcademicClass['AcademicClass']['CLASS_ID'],
                    ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                       data-original-title="Delete">
                        <i class="fa fa-trash-o"></i></a>

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