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
                <a href="#">Allowance</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Allowance</a>
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

   <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
   <!-- <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Allowance','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div> -->
<?php } ?>	

    <div class="caption">
        <span aria-hidden="true" class="icon-users"></span>  Allowance    </div>
</div>
<div class="portlet-body">

<?php echo $this->Form->create("User",array("type"=>"get")) ?>
	<div class="row">
    <?php
	$typ = array('0' => 'Select Type', '1' => 'Addition', '2' =>'Deduction')
	
	
    ?>
		<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Filter by Type</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                   <?php echo $this->Form->input('CLS', array('options' => $typ,
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' )); ?>	
										
                                </div>
                            </div>
                        </div>
						<div class="col-md-6">
                            <div class="col-md-3">
                                <button type="submit"  class="btn bg-blue-chambray">Search</button>
                            </div>
                        </div>
	</div>
	</form>

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    <th class="text-center">
        Allowance Type
    </th>
    <th class="text-center">
        Allowance Name
    </th>
     <th class="text-center">
        Allowance By
    </th>
    <th class="text-center">
        Percentage
    </th>
      <th class="text-center">
        Amount
    </th>
    
    <th class="text-center">
        Status
    </th>
	<?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
      <th class="text-center">
        Action
    </th>
    <?php } ?>
</tr>
</thead>
<tbody>

<?php
/*PR($StaffUploadDocument);
die;*/
?>
<?php if(count($Allowance) > 0):
    $i = 1;
    ?>
    <?php foreach($Allowance as $all) { ?>
        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center" ><?php if($all['Allowance']['ALLOWANCE_TYPE'] == 1)
			{
				echo 'Addition';	
			}else{
				echo 'Deduction';
			}
			 ?></td>
            <td class="text-center" ><?php echo $all['Allowance']['ALLOWANCE_NAME'] ?></td>
            <td class="text-center" ><?php if($all['Allowance']['BY_TYPE'] == 1)
			{
				echo 'Percentage';	
			}else{
				echo 'Amount';
			}
			 ?></td>
             <td class="text-center" ><?php echo $all['Allowance']['PERCENTAGE'] ?></td>
              <td class="text-center" ><?php echo $all['Allowance']['AMOUNT'] ?></td>
            <td class="text-center">
             <?php if($all['Allowance']['STATUS'] == 1)
			{
				echo 'Active';	
			}else{
				echo 'Inactive';
			}
			 ?>
            </td>
			<?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
            <td class="text-center">
            	<a href="<?php echo Router::url(array('controller' => 'Allowance',
                    'action' => 'edit', $all['Allowance']['ALLOWANCE_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>
                
                    <!--<a href="javascript::void(0);" onclick="remove_record('<?php echo Router::url(array('controller' => 'Allowance','action' => 'delete', $all['Allowance']['ALLOWANCE_ID']))?>')" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                       data-original-title="Delete">
                        <i class="fa fa-trash-o"></i></a> -->
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
<script>
function remove_record(x) {
	if(confirm("Are you sure want to remove this ?")) { 
		window.location.href = x;
	}
}
</script>