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
                <a href="#">School</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View School</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All School
    </div>
</div>
<div class="portlet-body">

    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'School','action' => 'add')) ?>" class="btn
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
        School Name
    </th>
    <th>
        Tag Line
    </th>
    <th>
        Address
    </th>
    <th>
        Phone No
    </th>
    <th>
        Email
    </th>
    <th>
        Website Url
    </th>
    <th>
        School Logo
    </th>
    <th style="width: 185px;">
        Action
    </th>
</tr>
</thead>
<tbody>
<?php if(count($schools) > 0):
    $i = 1;
    ?>
    <?php foreach($schools as $school) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td> <a href="<?php echo Router::url(array('controller' => 'School', 'action' => 'edit', $school['School']['SCHOOL_ID'],
                ))?>"><?php echo $school['School']['SCHOOL_NAME']; ?></a></td>
            <td class="text-center"><?php echo $school['School']['SCHOOL_TAGLINE']; ?></td>
            <td class="text-center"><?php echo $school['School']['ADDRESS']; ?></td>
            <td class="text-center"><?php echo $school['School']['PHONE_NO']; ?></td>
            <td class="text-center"><?php echo $school['School']['EMAIL']; ?></td>
            <td class="text-center"><?php echo $school['School']['WEBSITE_URL']; ?></td>
            <td class="text-center"><img src="<?php echo DOWNLOADURL.'upload_document/'.$school['School']['LOGO_IMAGE']; ?>" height="100" width="100"/></td>
            <td class="text-center">
                <a href="<?php echo Router::url(array('controller' => 'School',
                    'action' => 'edit', $school['School']['SCHOOL_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>

                    <a href="<?php echo Router::url(array('controller' => 'School',
                        'action' => 'delete', $school['School']['SCHOOL_ID'],
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