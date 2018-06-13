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
                <a href="#">Staff Attendance</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Select Users</a>
            </li>
        </ul>
        <!-- END PAGE TITLE & BREADCRUMB-->
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth'); 
		
			
		?>
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
        <span aria-hidden="true" class="icon-users"></span>Staff Attendance
    </div>
</div>
<div class="portlet-body">
		<?php echo $this->Form->create('StaffAttendance', array('class' => 'form-horizontal add', 'onsubmit'=>'','type' => 'file','url' => array('controller' => 'StaffAttendance', 'action' => 'add'))); ?>
        <div class="row">
         <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Date<span class="required"> * </span></label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                    <?php echo $this->Form->input('ATTENDANCE_DATE', array('type' => 'text',
                                        'label' => FALSE_VALUE,
                                        'div' => FALSE_VALUE, 'data-required' => '1', 'class' => 'form-control date-picker', 'placeholder' => 'Example :- ( 1/12/1989 )')); ?>
                                </div>
                            </div>
                        </div>
        </div>
        

<div id="users_list">
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
        Status
    </th>
    
  
</tr>
</thead>
<tbody>

<?php if(count($users) > 0): ?>
    <?php foreach($users as $key=>$user) { ?>
        <tr> 
            

            <td class="text-center"><?php echo $key+1; ?></td>
            <td class="text-center"><?php echo $user['User']['FIRST_NAME'].' '.$user['User']['MIDDLE_NAME'].' '.$user['User']['LAST_NAME']; ?></td>
            <td class="text-center"><?php echo $user['Role']['ROLE_NAME']; ?></td>
            <td class="text-center"><?php echo date("d-m-Y") ?></td>
            <td class="text-center">
                 <select name="selected_users[]">
                  <option value="1">Present</option>
                  <option value="2">Absent</option>
                  
                </select>

            <input type="hidden" value="<?php echo $user['User']['ID']; ?>" name="id[]" />
            <input type="hidden" value="<?php echo $user['User']['ROLE_ID']; ?>" name="role[]" />
            </td>
          
        </tr>
    <?php } ?>
<?php endif; ?>
</tbody>
</table>
</div>

		<button type="submit" class="btn bg-blue-chambray">Submit</button> 
</form>
</div>
</div>

		
