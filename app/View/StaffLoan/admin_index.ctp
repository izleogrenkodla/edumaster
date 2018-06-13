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
                <a href="#">Loan</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Loan</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View All Loan
    </div>
</div>
<div class="portlet-body">


<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th class="text-center">
        Sr. No.
    </th>
    <th class="text-center">
        User Name
    </th>
     <th class="text-center">
       Role
    </th>
    <th class="text-center">
       OUTSTANDING_AMOUNT
    </th>
     <th class="text-center">
      Loan Amount
    </th>
     <th class="text-center">
      Loan Date
    </th>
    <th class="text-center">
     Remark
    </th>
    <th class="text-center">
        Action
    </th>
</tr>
</thead>
<tbody>
<?php if(count($StaffLoan) > 0):
    $i = 1;
    ?>
    <?php foreach($StaffLoan as $sl) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center"> <?php echo $sl['Name']['FIRST_NAME'].' '.$sl['Name']['MIDDLE_NAME'].' '.$sl['Name']['LAST_NAME'] ;?></td>
             <td class="text-center"> <?php echo $sl['Role']['ROLE_NAME']; ?></td>
              <td class="text-center"> <?php echo $sl['StaffLoan']['OUTSTANDING_AMOUNT']; ?></td>
               <td class="text-center"> <?php echo $sl['StaffLoan']['LOAN_AMOUNT']; ?></td>
               <td class="text-center"> <?php echo $sl['StaffLoan']['LOAN_DATE']; ?></td>
               <td class="text-center"> <?php echo $sl['StaffLoan']['REMARK']; ?></td>
               
           
            <td class="text-center">
                
                    <a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'StaffLoan','action' => 'delete', $sl['StaffLoan']['LOAN_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
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
<script>
function remove_record(x) {
	if(confirm("Are you sure want to remove this ?")) { 
		window.location.href = x;
	}
}
</script>