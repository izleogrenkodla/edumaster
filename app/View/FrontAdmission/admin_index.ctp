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
                <a href="#">Front Admission Inquiry</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Front Admission Inquiry</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Front Admission Inquiry
    </div>
</div>
<div class="portlet-body">

   

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th style="width: 100px;">
        Sr. No.
    </th>
    <th>
        Name
    </th>
    <th>
       Email
    </th>
    <th>
        Age
    </th>
	<th>
       Class
    </th>
	<th>
       Medium
    </th>
	<th>
       Contact Number
    </th>
	<th>
       Description
    </th>
    <th>
       Created Date
    </th>
	
    
</tr>
</thead>
<tbody>
<?php if(count($frontadmission) > 0):
    $i = 1;
    ?>
    <?php foreach($frontadmission as $f) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td><?php echo $f['FrontAdmission']['Name']; ?></td>
            <td><?php echo $f['FrontAdmission']['Mail_ID']; ?></td>
            <td><?php echo $f['FrontAdmission']['Age']; ?></td>
            <td><?php echo $f['FrontAdmission']['Class']; ?></td>
            <td><?php echo $f['FrontAdmission']['Medium']; ?></td>
            <td><?php echo $f['FrontAdmission']['Contact_No']; ?></td>
            <td><?php echo $f['FrontAdmission']['Description']; ?></td>
            <td><?php echo $f['FrontAdmission']['Create_Date']; ?></td>
           
           
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