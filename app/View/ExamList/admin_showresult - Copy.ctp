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
                <a href="#">Result</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Result</a>
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
                <span aria-hidden="true" class="icon-user"></span>&nbsp; View Result
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
								
								<div class="col-md-1 tooltips">
                                    <strong>Written</strong>
                                </div>
								
								<div class="col-md-1 tooltips">
                                    <strong>Oral</strong>
                                </div>
								
								<div class="col-md-1 tooltips">
                                    <strong>Total</strong>
                                </div>
								
								<div class="col-md-1 tooltips">
                                    <strong>Grade</strong>
                                </div>
								
								<div class="col-md-4 tooltips">
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
											echo '<br><br>';
											$i++;
										}
									?>
                                </div>
								
								<div class="col-md-1">
									<?php
									foreach($subjectlist as $sub){
										echo $sub['Subject']['TITLE'];
										echo '<br><br>';
									}
									?>
									
								</div>
								
								<div class="col-md-1">
									
									<?php
									foreach($result as $key => $re){
										echo $re['Result']['WRITTENMARK'];
										echo '<br><br>';
									}
                                    ?>
								</div>
								
								<div class="col-md-1">
									<?php
									foreach($result as $key => $re){
										echo $re['Result']['ORALMARK'];
										echo '<br><br>';
									}
                                    ?>
								</div>
								
								<div class="col-md-1">
									
									<?php
										foreach($result as $key => $re){
											echo $re['Result']['TOTALMARK'];
											echo '<br><br>';
										}
									?>
								</div> 
								
								<div class="col-md-1">
									
									<?php
										foreach($result as $key => $re){
											echo $re['ExamGrade']['GRADE_NAME'];
											echo '<br><br>';
										}
									?>
								</div>
								
								<div class="col-md-4">
									
									<?php
										foreach($result as $key => $re){
											echo $re['ExamRemark']['REMARK'];
											echo '<br><br>';
										}
									?>
								</div>
								
                        </div>
                    </div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-1">
									&nbsp;
                                </div>
								
								<div class="col-md-1">
									<strong>Total</strong>
									
								</div>
								
								<div class="col-md-1">
									<?php
										$wi = 0;
										foreach($result as $key => $ew){
											$wi = $wi + $ew['Result']['WRITTENMARK'];
										}
											echo '<strong>'.$wi.'</strong>';
											echo '<br><br>';
									?>
								</div>
								
								<div class="col-md-1">
									<?php
										$oi = 0;
										foreach($result as $key => $ew){
											$oi = $oi + $ew['Result']['ORALMARK'];
										}
											echo '<strong>'.$oi.'</strong>';
											echo '<br><br>';
									?>
								</div>
								
								<div class="col-md-1">
									
									<?php
										$ti = 0;
										foreach($result as $key => $re){
											$ti = $ti + $re['Result']['TOTALMARK'];
										}
											echo '<strong>'.$ti.'</strong>';
											echo '<br><br>';
									?>
								</div> 
								
								<div class="col-md-1">
									
									&nbsp;
								</div>
								
								<div class="col-md-4">
									
									&nbsp;
								</div>
						
						 
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-1">
									&nbsp;
                                </div>
								
								<div class="col-md-1">
									<strong>Out Of</strong>
									<?php echo '<br><br>'; ?>
									
								</div>
								
								<div class="col-md-1">
									<?php
										$wi = 0;
										
										foreach($Written as $key => $ew){
											$wi = $wi + $ew['ExamWritten']['MARK'];
										}
											echo '<strong>'.$wi.'</strong>';
											echo '<br><br>';
									?>
								</div>
								
								<div class="col-md-1">
									<?php
										$oi = 0;
										foreach($oral as $key => $eo){
											$oi = $oi + $eo['ExamOral']['MARK'];
										}
											echo '<strong>'.$oi.'</strong>';
											echo '<br><br>';
									?>
								</div>
								
								<div class="col-md-1">
									
									<?php
										$ti = 0;
										$wi = 0;
										$oi = 0;
										
										foreach($Written as $key => $ew){
											$wi = $wi + $ew['ExamWritten']['MARK'];
										}
										
										foreach($oral as $key => $eo){
											$oi = $oi + $eo['ExamOral']['MARK'];
										}
										
										$total = $wi+$oi;
										echo '<strong>'.$total.'</strong>';
										echo '<br><br>';
									?>
								</div> 
								
								<div class="col-md-1">
									
									&nbsp;
								</div>
								
								<div class="col-md-4">
									
									&nbsp;
								</div>
						
						 
						</div>
					</div>
					
					<div class="row">
						<div class="col-md-12">
							<div class="col-md-1">
									&nbsp;
                                </div>
								
								<div class="col-md-1">
									<strong>PERCENTAGE</strong>
									
								</div>
								
								<div class="col-md-1">
									<?php
										
										$ti = 0;
										$wi = 0;
										$oi = 0;
										
										foreach($Written as $key => $ew){
											$wi = $wi + $ew['ExamWritten']['MARK'];
										}
										
										foreach($oral as $key => $eo){
											$oi = $oi + $eo['ExamOral']['MARK'];
										}
										
										$total = $wi+$oi;
										
										$totalobten = 0;
										foreach($result as $key => $re){
											$totalobten = $totalobten + $re['Result']['TOTALMARK'];
										}
								
										
										
										$pi = ($totalobten*100)/$total;
										echo '<strong>'.$pi.'</strong>';
									?>
								</div>
								
								<div class="col-md-1">
									&nbsp;
								</div>
								
								<div class="col-md-1">
									
									&nbsp;
								</div> 
								
								<div class="col-md-1">
									
									&nbsp;
								</div>
								
								<div class="col-md-4">
									
									&nbsp;
								</div>
						
						 
						</div>
					</div>
					
					<br />
				
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