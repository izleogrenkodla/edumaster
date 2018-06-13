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
                <a href="#">Experience Letter</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Experience Letter</a>
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
        <span aria-hidden="true" class="icon-users"></span>View Experience Letter   </div>
</div>
<div class="portlet-body">

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th class="text-center">
        Sr. No.
    </th>
    <th class="text-center">
       Full Name
    </th>
    <th class="text-center">
      Role 
    </th> 
	<th class="text-center">
      Date
    </th> 

	<th class="text-center">
		Net Salary
    </th>
	<?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
    <th class="text-center">
		Action
    </th>
	<?php } ?>
  
</tr>
</thead>
<tbody>

<?php if(count($list) > 0): ?>
    <?php foreach($list as $key=>$user) { ?>
        <tr>
            <td class="text-center"><?php echo $key+1; ?></td>
            <td class="text-center"><?php echo $user['Name']['FIRST_NAME'].' '.$user['Name']['MIDDLE_NAME'].' '.$user['Name']['LAST_NAME']; ?></td>
            <td class="text-center"><?php echo $user['Role']['ROLE_NAME'];?></td>
			<td class="text-center"><?php echo $user['Termination']['TERM_DATE'];?></td>
	
			<td class="text-center"><?php echo $user['Termination']['NET_SALARY'];?></td>
			<?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
			<td class="text-center">    
             <a href="<?php echo Router::url(array('controller' => 'Experience',
                    'action' => 'add', $user['Termination']['USER_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>

            </td>
			<?php } ?>
             
           
          
        </tr>
    <?php } ?>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
