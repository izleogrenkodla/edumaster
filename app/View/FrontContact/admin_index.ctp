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
                <a href="#">Front Contact</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Front Contact</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Front Contact
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
        Subject
    </th>
	<th>
       Message
    </th>
    <th>
       Created Date
    </th>
	
    
</tr>
</thead>
<tbody>
<?php if(count($frontcontact) > 0):
    $i = 1;
    ?>
    <?php foreach($frontcontact as $f) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td><?php echo $f['FrontContact']['Name']; ?></td>
            <td><?php echo $f['FrontContact']['Email']; ?></td>
            <td><?php echo $f['FrontContact']['Subject']; ?></td>
            <td><?php echo $f['FrontContact']['Message']; ?></td>
            <td><?php echo $f['FrontContact']['Created_date']; ?></td>
           
           
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