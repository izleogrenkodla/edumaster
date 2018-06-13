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
                <a href="#">Drivers</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View All Drivers</a>
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
        <span aria-hidden="true" class="icon-users"></span>View All Driver
    </div>
</div>
<div class="portlet-body">
<?php if(in_array($authUser["ROLE_ID"],array(TRANSPORTATION_ID))){?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Drivers','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
<?php }?>
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    <th>
        Profile Photo
    </th>
    <th>
        Full Name
    </th>
    <th>
        Mobile No.
    </th>
    <th>
        Address
    </th>
    <th>
        Status
    </th>
	<?php if(in_array($authUser["ROLE_ID"],array(TRANSPORTATION_ID))){?>
    <th style="width: 185px;">
        Action
    </th>
	<?php }?>
</tr>
</thead>
<tbody>
<?php if(count($drivers) > 0): ?>
    <?php foreach($drivers as $key=>$driver) { ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td class="text-center"><img src="<?php echo DOWNLOADURL.'upload_document/'.$driver['Driver']['IMAGE_URL']; ?>" height="100" width="100"/></td>
            <td><a href="<?php echo Router::url(array('controller' => 'Drivers', 'action' => 'edit', $driver['Driver']['DRIVER_ID'],
                ))?>"><?php echo $this->General->first_letter_capitalized
                    ($driver['Driver']['FIRST_NAME']. ' '.$driver['Driver']['MIDDLE_NAME']. ' '.$driver['Driver']['LAST_NAME']); ?></a></td>
            <td class="text-center"><?php echo $driver['Driver']['MOBILE_NO']; ?></td>
            <td class="text-center"><?php echo $driver['Driver']['ADDRESS']; ?></td>
            <td class="text-center">

                <?php if($driver['Driver']['STATUS']) { ?>
                    Active
                <?php } else { ?>
                    Inactive
                <?php } ?>
            </td>
			<?php if(in_array($authUser["ROLE_ID"],array(TRANSPORTATION_ID))){?>
            <td class="text-center">
			
                <a href="<?php echo Router::url(array('controller' => 'Drivers',
                    'action' => 'edit', $driver['Driver']['DRIVER_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>

                <a href="<?php echo Router::url(array('controller' => 'Drivers',
                    'action' => 'delete', $driver['Driver']['DRIVER_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Delete">
                    <i class="fa fa-trash-o"></i></a>
			
            </td>
			<?php }?>
        </tr>
    <?php } ?>
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
                            