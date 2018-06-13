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
                <a href="#">Salary</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Salary</a>
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
        <span aria-hidden="true" class="icon-users"></span> Salary
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
       User
    </th>
    <th class="text-center">
       Role 
    </th>

    <th class="text-center">
       Paid For Month
    </th>



     <th class="text-center">
       Base Salary
    </th>
     <th class="text-center">
       Present Day
    </th>
    
     <th class="text-center">
      Payable Salary
    </th>
<?php if(in_array($authUser["ROLE_ID"],array(HR_ID,ADMIN_ID))) { ?>
    <th class="text-center">
      Action
    </th>
<?php } ?>
</tr>
</thead>
<tbody>

<?php if(count($list) > 0): ?>
    <?php foreach($list as $key=>$AH) { ?>
        <tr>
       
            <td class="text-center"><?php echo $key+1; ?></td>
             <td class="text-center"><?php echo $AH['Name']['FIRST_NAME'].' '. $AH['Name']['MIDDLE_NAME'].' ' .$AH['Name']['LAST_NAME']; ?></td>
             <td class="text-center"><?php echo $AH['Role']['ROLE_NAME']; ?></td>
             <td class="text-center">

            
                <?php if($AH['Salary']['PAID_MONTH'] == 01)
                {
                    echo 'January';
                }elseif ($AH['Salary']['PAID_MONTH'] == 02) {
                    echo 'February';
                }elseif ($AH['Salary']['PAID_MONTH'] == 03) {
                    echo 'March';
                }elseif ($AH['Salary']['PAID_MONTH'] == 04) {
                    echo 'April';
                }elseif ($AH['Salary']['PAID_MONTH'] == 05) {
                    echo 'May';
                }elseif ($AH['Salary']['PAID_MONTH'] == 06) {
                   echo 'June';
                }elseif ($AH['Salary']['PAID_MONTH'] == 07) {
                    echo 'July';
                }elseif ($AH['Salary']['PAID_MONTH'] == 08) {
                    echo 'August';
                }elseif ($AH['Salary']['PAID_MONTH'] == 09) {
                    echo 'September';
                }elseif ($AH['Salary']['PAID_MONTH'] == 10) {
                   echo 'October';
                }elseif ($AH['Salary']['PAID_MONTH'] == 11) {
                    echo 'November';
                }elseif ($AH['Salary']['PAID_MONTH'] == 12) {
                    echo 'December';
                }
                ?>


            </td>
           
            <td class="text-center"><?php echo $AH['Salary']['BASE_SALARY']; ?></td>
            <td class="text-center"><?php echo $AH['Salary']['PRESENT_DAY']; ?></td>
            <td class="text-center"><?php echo $AH['Salary']['PAYABLE_SALARY']; ?></td>
			<?php if(in_array($authUser["ROLE_ID"],array(HR_ID,ADMIN_ID))) { ?>
            <td class="text-center">

                    <a href="<?php echo Router::url(array('controller' => 'Salary',
                    'action' => 'view', $AH['Salary']['SALARY_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" 
                data-html="true" data-original-title="Edit">
                    <i class="fa fa-desktop"></i></a>
			<?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
 <a href="<?php echo Router::url(array('controller' => 'Salary',
                    'action' => 'pre_salary', $AH['Salary']['SALARY_ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" 
                data-html="true" data-original-title="Edit">
                <i class="fa fa-file-text-o"></i></a>
			<?php } ?>

            </td>
			<?php } ?>
           	
        </tr>
    <?php } ?>
<?php endif; ?>
</tbody>
</table>
</form>
</div>
</div>
</div>
 
<script>

        $(document).ready(function(){
            $("#AcademicHistoryROLE").bind("change",
            function(event){
                $.ajax({
					
                    async: true,
                    beforeSend: function(XMLHttpRequest){
                        // $('#UserAMOUNT').attr('readonly',true);
                    },
                    complete: function(XMLHttpRequest,
                    textStatus){
                        // $('#UserAMOUNT').attr('readonly', true);
                    },
					
                    data: $("#AcademicHistoryROLE").closest("form").serialize(),
                    dataType: "html",
                    success: function(data,
                    textStatus){
                        $("#test").html(data);
                    },
                    type: "post",
                    url: REQUEST_URL+"AcademicHistory/GetClassByUser"
                });
                return false;
            });
        });
</script>

