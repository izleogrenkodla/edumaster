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
                <a href="#">Outstanding</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Outstanding</a>
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
        <span aria-hidden="true" class="icon-users"></span> Outstanding
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
       Base Salary
    </th>
     <th class="text-center">
       Outsatanding
    </th>
    
     <th class="text-center">
      Remark
    </th>
   
</tr>
</thead>
<tbody>

<?php if(count($list) > 0): ?>
    <?php foreach($list as $key=>$AH) { ?>
        <tr>
       
            <td class="text-center"><?php echo $key+1; ?></td>
             <td class="text-center"><?php echo $AH['Name']['FIRST_NAME'].' '. $AH['Name']['MIDDLE_NAME'].' ' .$AH['Name']['LAST_NAME']; ?></td>
             <td class="text-center"><?php echo $AH['Role']['ROLE_NAME']; ?></td>
           
            <td class="text-center"><?php echo $AH['Outstanding']['BASE_SALARY']; ?></td>
            <td class="text-center"><?php echo $AH['Outstanding']['OUTSTANDING_AMOUNT']; ?></td>
          
              <td class="text-center"><?php echo $AH['Outstanding']['REMARK']; ?></td>
        
           	
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

