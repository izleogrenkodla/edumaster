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
                <a href="#">Front About</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Front About</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Front About
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
       School Name
    </th>
    <th>
        Address
    </th>
    <th>
        Contact No
    </th>
    <th>
        Email
    </th>
    <th style="width: 185px;">
        Action
    </th>

</tr>
</thead>
<tbody>
<?php if(count($frontabout) > 0):
    $i = 1;
    ?>
    <?php foreach($frontabout as $f) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td><?php echo $f['FrontAbout']['SCHOOL_NAME']; ?></td>
            <td><?php echo $f['FrontAbout']['ADDRESS']; ?></td>
            <td><?php echo $f['FrontAbout']['EMAIL']; ?></td>
            <td><?php echo $f['FrontAbout']['CONTACT_NO']; ?></td>
           
            <td class="text-center">
                    <a href="<?php echo Router::url(array('controller' => 'FrontAbout',
                    'action' => 'view', $f['FrontAbout']['ABOUT_ID']
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true" title="View Expense"
                   data-original-title="Delete">
                    <i class="fa fa-desktop"></i></a>
                <a href="<?php echo Router::url(array('controller' => 'FrontAbout',
                    'action' => 'edit', $f['FrontAbout']['ABOUT_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>
                
                
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