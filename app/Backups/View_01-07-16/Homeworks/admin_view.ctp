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
<a href="#">Homework</a>
<i class="fa fa-angle-right"></i>
</li>
<li>
<a href="#">View Homework</a>
</li>
</ul>
<?php echo $this->Session->flash(); ?>
<?php echo $this->Session->flash('auth'); ?>
<!-- END PAGE TITLE & BREADCRUMB-->
</div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->
<?php echo $this->Form->create('Homework', array('class' => 'form-horizontal add')); ?>
<div class="row">
<div class="col-md-12">

<div class="portlet box blue-madison">
	<div class="portlet-title">
	<div class="caption">
<span aria-hidden="true" class="icon-note"></span>&nbsp; View Homework
</div>
	<div class="tools">
<a href="javascript:void(0);" class="collapse">
</a>
</div>
</div>

<div class="portlet-body form">


<div class="form-body">
	<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label col-md-3">  Class:
			</label>
			<div class="col-md-9 tooltips">
				<?php  echo $lists["AcademicClass"]["CLASS_NAME"];?>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group">
			<label class="control-label col-md-3"> Subject:
			</label>
			<div class="col-md-9 tooltips">
				<?php  echo $lists["Subject"]["TITLE"];?>
			</div>
		</div>
	</div>
	</div>
	<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3"> Assigned Work (HW) :
					</label>
					<div class="col-md-9 tooltips">
						<?php  echo $lists["Homework"]["DESCRIPTION"];?>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label col-md-3"> Date:
					</label>
					<div class="col-md-9 tooltips">
						<?php  echo $this->General->dbfordate($lists["Homework"]["DATE"]);?>
					</div>
				</div>
			</div>
		</div>
	
	
	
</div>


<!--/row-->
</div>
<div class="form-actions fluid">
<div class="row">
<div class="col-md-6">
    <div class="col-md-offset-3 col-md-9">
    </div>
</div>
<div class="col-md-6">
</div>
</div>
</div>

<!-- END FORM-->
</div>
<div class="portlet box blue-madison">
	<div class="portlet-title">
	<div class="caption">
<span aria-hidden="true" class="icon-user"></span>&nbsp; Students Reply
</div>
	<div class="tools">
<a href="javascript:void(0);" class="collapse">
</a>
</div>
</div>

<div class="portlet-body form">


<div class="form-body">
	
	
	
	<div class="row">
	<div class="col-md-12">
		<div class="table-scrollable"><table class="table table-striped table-bordered table-hover dataTable"  aria-describedby="user_table_info">
<thead>
<tr role="row" class="heading">
	<th class="sorting" width="50">ID</th>
	<th class="sorting" width="150">Student Name</th>
	<th class="sorting" width="250">Comment</th>
	<th class="sorting" width="100">Hw Status</th>
	<th class="sorting" width="200">HW Status by Teacher</th>
</tr>
</thead>

<tbody role="alert" aria-live="polite" aria-relevant="all">
<?php if(is_array($lists["HomeworkXref"]) && sizeof($lists["HomeworkXref"])>0) {  $sr=0; foreach($lists["HomeworkXref"] as $list) { $sr++; ?>
	<input type="hidden" name="data[Homework][<?php echo $list["ID"]; ?>][STUDENT_NAME]" value="<?php echo $list["User"]["FIRST_NAME"].' '.$list["User"]["MIDDLE_NAME"].' '.$list["User"]["LAST_NAME"];?>" />
	<input type="hidden" name="data[Homework][<?php echo $list["ID"]; ?>][EMAIL_ID]" value="<?php echo $list["User"]["EMAIL_ID"];?>" />
	
	
				   <tr class="odd" >
					   <td class="text-center"><?php echo $sr; ?></td>
					   <td class="text-center"><?php echo $list['User']["FIRST_NAME"]; ?></td>
					   <td class="text-center">
						   <textarea name="data[Homework][<?php echo $list["ID"]; ?>][COMMENT]" rows="2" cols="5" data-required="1" class="form-control" id="HomeworkCOMMENT"><?php echo $list["COMMENT"] ?></textarea>
	
	</div></td>
					   <td class="text-center">
					  		<?php  if($list['STUDENT_STATUS']==1 && $list['TEACHER_STATUS']==1) { ?>
								<span style="color:#003300;font-weight:bold;">Completed!</span>
							<?php } ?>
							<?php  if($list['STUDENT_STATUS']==0 && $list['TEACHER_STATUS']==1) { ?>
								<span style="color:#FF0000;font-weight:bold;">Waiting for response from <?php echo $list['User']["FIRST_NAME"];?></span>
							<?php } ?>
							<?php  if($list['STUDENT_STATUS']==1 && $list['TEACHER_STATUS']==0) { ?>
								<span style="color:#003300;font-weight:bold;"><?php echo $list['User']["FIRST_NAME"];?> Replied! </span>
							<?php } ?>
						  </td>
					   <td class="text-center">
					  <div class="col-md-9 tooltips" data-container="body" data-placement="bottom" data-html="true" data-original-title="Select Gender">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <div class="radio"><span class="checked"><input type="radio" name="data[Homework][<?php echo $list["ID"]; ?>][TEACHER_STATUS]" <?php if($list["STUDENT_STATUS"]==1){ ?> checked="checked" <?php } ?>  value="1" ></span></div>
                                            Done </label>
                                        <label class="radio-inline">
                                            <div class="radio"><span class=""><input type="radio" name="data[Homework][<?php echo $list["ID"]; ?>][TEACHER_STATUS]"   value="0" <?php if($list["STUDENT_STATUS"]==0){ ?> checked="checked" <?php } ?> ></span></div>
                                            Not done</label>
                                    </div>
                                </div>
						  </td>
						  
				   </tr>
			<?php } }else{ ?>
		 <tr>
					<td colspan=10 class="text-center">No Student submitted</td>
	</tr>
	<?php } ?>
</tbody></table></div>
		
		
	
	
	</div>
	
</div>


<!--/row-->
</div>
<div class="form-actions fluid">
<div class="row">
<div class="col-md-6">
    <div class="col-md-offset-3 col-md-9">
        <button type="submit" class="btn bg-blue-chambray">Update</button>
        <a href="<?php echo Router::url(array("action"=>"index")); ?>" class="btn default">Go Back</a>
    </div>
</div>
<div class="col-md-6">
</div>
</div>
</div>

<!-- END FORM-->
</div>
</div>

</div>
</form>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>