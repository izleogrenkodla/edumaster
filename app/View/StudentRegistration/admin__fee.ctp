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
                <a href="#">Form Fee</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Form Fee</a>
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
        <span aria-hidden="true" class="icon-users"></span>View all Form Fee
    </div>
</div>
<div class="portlet-body">

  <?php echo $this->Form->create('User', array('class' => 'form-horizontal add custom_form',
                            'type' => 'file', 'novalidate' => 'novalidate', 'Method' => 'get')); ?>
                            <strong>User Search Form: </strong>
                       
                        <div class="row custom_search_filter">

                            <div class="col-md-12 custom_block">
                                <div class="col-md-6 custom_block">
                                      
                                   <label class="control-label flef">Date: From</label>
                                    <input type="text" class="form-control form-control-inline date-picker input-small" name="data[User][from_date]"
                                           value="<?php echo isset($this->request->query['data']['User']['from_date']) ? $this->request->query['data']['User']['from_date']
                                               : '' ?>" readonly  />

                                    <label class="control-label flef">To</label>
                                    <input type="text" class="form-control form-control-inline date-picker input-small" name="data[User][to_date]"
                                           value="<?php echo isset($this->request->query['data']['User']['to_date']) ? $this->request->query['data']['User']['to_date']
                                               : '' ?>"  readonly />
                                </div>
                                <button type="submit" class="btn bg-blue-chambray">Search</button> OR
                                <a href="<?php  echo Router::url(array("action"=>"index")); ?>">RESET</a> 
                              
                            </div>
                        </div>
                        </form>
                   
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    
    <th>
       Date
    </th>
    <th>
       Full Name
    </th>
   
    <th>
        Class Name
    </th>
    <th>
        Form Fee
    </th>
    
    
</tr>
</thead>
<tbody>

<?php if(count($fee) > 0): ?>
    <?php foreach($fee as $key=>$user) { ?>
        <tr>
            <td><?php echo $key+1; ?></td>
            <td><?php echo $user['StudentRegistration']['REG_DATE']; ?></td>
            <td><?php echo $user['StudentRegistration']['FIRST_NAME'].' '.$user['StudentRegistration']['MIDDLE_NAME'].' '.$user['StudentRegistration']['LAST_NAME']; ?></td>
  
            <td><?php echo $user['AcademicClass']['CLASS_NAME']; ?></td>

            <td><?php echo $user['StudentRegistration']['FORM_FEE']; ?></td>
            
            
            
          
        </tr>
    <?php } ?>
<?php endif; ?>
</tbody>
</table>
</div>
</div>
