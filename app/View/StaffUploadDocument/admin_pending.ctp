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
                <a href="#">Document</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Pending Document</a>
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
        <span aria-hidden="true" class="icon-users"></span>  View Pending Document
    </div>
</div>
<div class="portlet-body">


<table class="table table-striped table-bordered table-hover" id="user_table">
<thead>
<tr role="row" class="heading">
    <th>
        Sr. No.
    </th>
    <th class="text-center">
        User Name
    </th>
  
     <th class="text-center">
        Required Document
    </th>
    <th class="text-center">
        Submitted Document
    </th>
      <th class="text-center">
        Missing Document
    </th>
    
<?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
      <th class="text-center">
        Action
    </th>
    <?php } ?>
    
</tr>
</thead>
<tbody>


<?php if(count($StaffUploadDocument) > 0):
    $i = 1;
    ?>
    <?php foreach($StaffUploadDocument as $key => $udoc) { ?>
        <?php
          foreach($req as $uid)
        {
           
            $user_id= $req[$key];
        }
       ?>

       <?php
          foreach($sub as $userid)
        {
           
            $sub_id= $sub[$key];
        }
       ?>

     

        <tr>
            <td class="text-center"><?php echo $i; ?></td>
            <td class="text-center" ><?php 
			echo $udoc['User']['FIRST_NAME'].' ' .$udoc['User']['MIDDLE_NAME'].' '.$udoc['User']['LAST_NAME']?></td>
        
            <td class="text-center" ><?php echo $user_id; ?></td>
             <td class="text-center" ><?php echo $sub_id; ?></td>
              <td class="text-center" ><?php echo $user_id-$sub_id ?></td>
        <?php if(in_array($authUser["ROLE_ID"],array(HR_ID))) { ?>
            <td class="text-center">
            	 
                     <a href="<?php echo Router::url(array('controller' => 'StaffUploadDocument',
                    'action' => 'add', $udoc['User']['ID'],
                ))?>" class="tooltips btn" data-container="body" data-placement="top" data-html="true"
                   ><i class="icon-paper-clip"></i></a>
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
</script>ss