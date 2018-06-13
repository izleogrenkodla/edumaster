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
                <a href="#">Suggestion</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View All Suggestions</a>
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
        <span aria-hidden="true" class="icon-users"></span>View All Suggestions
    </div>
</div>
<div class="portlet-body">

<?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,TEACHER_ID,HR_ID,ACCOUNT_ID,SUPERVISOR_ID))) { ?>
    <div class="table-toolbar">
        <div class="btn-group">
            <a href="<?php echo Router::url(array('controller' => 'Suggestions','action' => 'add')) ?>" class="btn
        green bg-green"> ADD NEW <i class="fa fa-plus"></i>
            </a>
        </div>
    </div>
    <?php } ?>

<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID))) { ?>    
   <th>
       First Name
    </th>
    <th>
        Middle Name
    </th>
    <th>
        Last Name
    </th>
    <th>
        User Type
    </th>
    <?php } ?>
    <?php  if(in_array($authUser["ROLE_ID"],array(STUDENT_ID,TEACHER_ID))) { ?>  
        <th>
        Message
    </th>  
     <?php } ?>
    <th>
        Date
    </th>
    
   <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID))) { ?>    
     <th>
        Action
    </th>
    <?php  } ?>
	
</tr>
</thead>
<tbody>
<?php if(count($suggestions) > 0): ?>
    <?php foreach($suggestions as $key=>$suggestion) { ?>
        <tr>
            <td align="center"><?php echo $key+1; ?></td>
            <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID))) { ?>   
            <td><?php echo $suggestion['Suggestion']['FIRST_NAME']; ?></td>
            <td><?php echo $suggestion['Suggestion']['MIDDLE_NAME']; ?></td>
            <td><?php echo $suggestion['Suggestion']['LAST_NAME']; ?></td>
            <td align="center"><?php echo $suggestion['Role']['ROLE_NAME']; ?></td>
            <?php } ?>
             <?php if(in_array($authUser["ROLE_ID"],array(STUDENT_ID,TEACHER_ID))) { ?>  
            <td align="center"><?php echo $suggestion['Suggestion']['SUGGESTION_MESSAGE']; ?></td>
            <?php } ?>
            <td align="center"><?php echo $this->General->dbfordate($suggestion['Suggestion']['created']); ?></td>
            
            <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID))) { ?>    
			<td align="center"><a href="<?php echo Router::url(array('controller' => 'Suggestions',
                    'action' => 'view', $suggestion['Suggestion']['SUGGESTION_ID'],
                ))?>" class="tooltips btn" data-toggle="tooltip" title="View">
                    <i class="fa fa-desktop"></i></a></td>
                   <?php } ?> 
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
                            