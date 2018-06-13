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
                <a href="#">Exam Mark</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">Add Exam Mark</a>
            </li>
        </ul>
        <?php echo $this->Session->flash(); ?>
        <?php echo $this->Session->flash('auth'); ?>
        <!-- END PAGE TITLE & BREADCRUMB-->
    </div>
</div>
<!-- END PAGE HEADER-->
<!-- BEGIN PAGE CONTENT-->

<div class="row">
<div class="col-md-12">

    <div class="portlet box blue-madison">
        <div class="portlet-title">
            <div class="caption">
                <span aria-hidden="true" class="icon-user"></span>&nbsp; Add Exam
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
            <?php echo $this->Form->create('ExamList', array('class' => 'form-horizontal add', 'id' => 'Roles','type' => 'file')); ?>
                <div class="form-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Exam Type</label>
                              <div class="col-md-9 tooltips">
								<?php
									echo $Examtype['ExamType']['TITLE'];
								?>
							</div>
                            </div>
                        </div>
						
						<div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Full Name</label>
                              <div class="col-md-9 tooltips">
								<?php
									echo $student['User']['FIRST_NAME']." " .$student['User']['MIDDLE_NAME']." " .$student['User']['LAST_NAME'];
								?>
							</div>
                            </div>
                        </div>
                
					</div>
					
					<div class="row">

                       <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">Class</label>
                                <div class="col-md-9 tooltips" data-container='body' data-placement='bottom'
                                     data-html='true' data-original-title="Mobile No.">
                                   <?php
									echo $student['AcademicClass']['CLASS_NAME'];
								?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label col-md-3">GR. Number</label>
                              <div class="col-md-9 tooltips">
								<?php
									echo $student['User']['GR_NO'];
								?>
							</div>
                            </div>
                        </div>
                    </div>
					
					<div class="form-body">
					<div class="row">
						<div class="col-md-12">
                            
                                <div class="col-md-1 tooltips">
                                   <strong>No</strong>
                                </div>
								<div class="col-md-1 tooltips">
                                    <strong>Subject</strong>
                                </div>
								
								<div class="col-md-2 tooltips">
                                    <strong>Written</strong>
                                </div>
								
								<div class="col-md-2 tooltips">
                                    <strong>Oral</strong>
                                </div>
								
								<!--<div class="col-md-2 tooltips">
                                    <strong>Total</strong>
                                </div> -->
								
								<div class="col-md-2 tooltips">
                                    <strong>Grade</strong>
                                </div>
								
								<div class="col-md-2 tooltips">
                                    <strong>Remark</strong>
                                </div>
                        </div>	
					</div>
					<br />
                   
					<div class="row">
                        <div class="col-md-12">
								
                                <div class="col-md-1">
									<?php
										$i = 1;
										foreach($subjectlist as $sub){
											echo $i;
											echo '<br><br><br>';
											$i++;
										}
									?>
                                </div>
								
								<div class="col-md-1">
									<?php
									foreach($subjectlist as $sub){
										echo $sub['Subject']['TITLE'];
										echo '<br><br><br>';
									}
									?>
									
								</div>
								
								<div class="col-md-2">
									
									<?php
									foreach($subjectlist as $sub){
										?>
											<input type="text" name="written[]" label ="FALSE_VALUE" class = "form-control select2me" placeholder = "Example :- ( 30 )">
										<?php	
											echo '<br>';
									}
                                    ?>
								</div>
								
								<div class="col-md-2">
									<?php
									foreach($subjectlist as $sub){
										?>
											<input type="text" name="oral[]" label ="FALSE_VALUE" class = "form-control select2me" placeholder = "Example :- ( 50 )">
										<?php
										echo '<br>';
									}
                                    ?>
								</div>
								
								<!--<div class="col-md-2">
									
								<?php
								foreach($subjectlist as $sub){
								?>
                                    <input type="text" name="total[]" label ="FALSE_VALUE" class = "form-control select2me" placeholder = "Example :- ( 80 )">
								<?php	
									echo '<br>';
								}
                                    ?>
								</div> -->
								
								<div class="col-md-2">
									
									<?php 
									foreach($subjectlist as $sub){
									?>
										<select name="grade[]" label ="FALSE_VALUE" class = "form-control select2me" >
											<?php foreach($ExamGrade as $key=>$eg){ ?> 
												<option value="<?php echo $key; ?>"><?php echo $eg; ?></option>
											<?php } ?>
										</select>
									<?php
										echo '<br>';
									}
									?>	
								</div>
								
								<div class="col-md-2">
									
									<?php 
									foreach($subjectlist as $sub){
									?>
										<select name="remark[]" label ="FALSE_VALUE" class = "form-control select2me" >
											<?php foreach($ExamRemark as $key=>$re){ ?> 
												<option value="<?php echo $key; ?>"><?php echo $re; ?></option>
											<?php } ?>
										</select>
									<?php
										echo '<br>';
									}
									?>
								</div>
								
                        </div>
                    </div>
					<br />
				
                </div>
					
			</div>
				
                <div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="submit" class="btn bg-blue-chambray">Submit</button>
                                <button type="button" class="btn default" onclick="window.location.href='<?php echo $this->request->referer(); ?>'">Cancel</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
		    
        </div>
		
	</form>
  </div>

</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>