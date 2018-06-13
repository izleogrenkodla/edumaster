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
                <a href="#">Demotion</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Demotion</a>
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
        <span aria-hidden="true" class="icon-users"></span> Demotion
    </div>
</div>
<div class="portlet-body">
                          <?php echo $this->Form->create('Mailer', array('class' => 'form-horizontal add','type' => 'file')); ?>
                        <div 
						<div class="row custom_search_filter">

                            <div class="col-md-12 custom_block">
                                	<div class="col-md-8">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Role</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom' data-html='true' data-original-title="Middle Name">
                                   <?php echo $this->Form->input('ROLE', array('options' => $user_roles,
                                        'label' => FALSE_VALUE, 'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control select2me' , 'onchange' => 'select()' ,'id'=>'role','onchange' => 'select()')); ?>	
										
                                </div>
								
								<?php ?>
							
                            </div>
                        </div>
                                <button type="submit" class="btn bg-blue-chambray">Search</button> OR
                                <a href="<?php echo Router::url(array("action"=>"index")); ?>">RESET</a>
                                
							
						
                            </div>
                        </div>
                        </form>
                        <?php echo $this->Form->create('AcademicHistory', array('class' => 'form-horizontal add','type' => 'file')); ?>
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
   
    <th>
        Sr. No.
    </th>
    <th>
       Full Name
    </th>
    <th>
       Base Salary
    </th>
    <th>
       Role Name
    </th>
     <th>
      Action
    </th>
   
</tr>
</thead>
<tbody>

<?php if(count($AcademicHistory) > 0): ?>
    <?php foreach($AcademicHistory as $key=>$AH) { ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $AH['User']['FIRST_NAME']." ".$AH['User']['MIDDLE_NAME']." ".$AH['User']['LAST_NAME'] ?></td>
           
            <td><?php echo $AH['User']['BASE_SALARY']; ?></td>
			 <td><?php echo $AH['Role']['ROLE_NAME']; ?></td>
            <td class="text-center"> 
            <a href="<?php echo Router::url(array('controller' => 'Demotion',
                    'action' => 'add', $AH['User']['ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   data-original-title="Edit">
                    <i class="fa fa-pencil"></i></a>
            </td>
        </tr>
    <?php } ?>
<?php endif; ?>
</tbody>
</table>
</form>
</div>
</div>
</div>