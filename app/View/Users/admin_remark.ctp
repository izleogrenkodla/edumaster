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
                <a href="#">Remark</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Remark</a>
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
        <span aria-hidden="true" class="icon-users"></span> Remark
    </div>
</div>
<div class="portlet-body">
                     
<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
   
    <th style="width:85px;">
        Sr. No.
    </th>
    <th>
       Title
    </th>
    <th>
       Description
    </th>
    <th style="width:120px;">
      Date
    </th>
	<th>
      Remark From
    </th>
    <th style="width:100px;">
       Action
    </th>
   
</tr>
</thead>
<tbody>

<?php if(count($list) > 0): ?>
    <?php foreach($list as $key=>$AH) { ?>
        <tr>
            <td class="text-center"><?php echo $key+1; ?></td>
           
            <td class=""><?php echo $AH['Remark']['TITLE']; ?></td>
            <td class=""><?php echo $AH['Remark']['DESCRIPTION']; ?></td>
            <td class="text-center"><?php echo $AH['Remark']['DATE']; ?></td>
			<td class="text-center"><?php echo $AH['Name']['FIRST_NAME'].' '.$AH['Name']['MIDDLE_NAME'].' '.$AH['Name']['LAST_NAME']; ?></td>
           	 <td class="text-center">
            	<a href="<?php echo Router::url(array('controller' => 'Remark',
                    'action' => 'view', $AH['Remark']['REMARK_ID'],
                ))?>" class="tooltips btn" data-placement="top" data-toggle="tooltip" title="View">
                    <i class="fa fa-desktop"></i></a>
            
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

