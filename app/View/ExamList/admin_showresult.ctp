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
                <span aria-hidden="true" class="icon-user"></span>View Result
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
				<div id="abc">
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
					
					<div class="row">
						<table class="table table-striped table-bordered table-hover" >
							<thead>
							<tr role="row" class="heading">
								<th style="width: 100px;">
									Sr. No.
								</th>
								<th>
									Subject
								</th>
								<th>
									Written
								</th>
								<th>
									Oral
								</th>
								<th>
									Total
								</th>
								<th>
									Grade
								</th>
								<th>
									Remark
								</th>								
							</tr>
							</thead>
							<tbody>
								<?php if(count($result) > 0): $i = 1;?>
								<?php foreach($result as $key=>$re) { ?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td class="text-center"><?php echo $re['Subject']['TITLE']; ?></td>
										<td class="text-center"><?php echo $re['Result']['WRITTENMARK']; ?></td>
										<td class="text-center"><?php echo $re['Result']['ORALMARK']; ?></td>
										<td class="text-center"><?php echo $re['Result']['TOTALMARK']; ?></td>
										<td class="text-center"><?php echo $re['ExamGrade']['GRADE_NAME']; ?></td>
										<td class="text-center"><?php echo $re['ExamRemark']['REMARK']; ?></td>
										
									</tr> 
								<?php $i++; }  ?>
									<tr>
										<td>&nbsp;</td>
										<td class="text-center"><b>Total</b></td>
										<td class="text-center"><b>
										<?php $total = 0; foreach($result as $re){$total = $total+$re['Result']['WRITTENMARK'];} echo $total; ?>
										</b></td>
										<td class="text-center"><b>
										<?php $total = 0; foreach($result as $re){$total = $total+$re['Result']['ORALMARK'];} echo $total; ?>
										</b></td>
										<td class="text-center"><b>
											<?php
												$wi = 0; foreach($result as $re){$wi = $wi+$re['Result']['WRITTENMARK'];} 
											    $or = 0; foreach($result as $re){$or = $or+$re['Result']['ORALMARK'];} 
												
												echo $wi + $or;
											?>
										</b></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									
									<tr>
										<td>&nbsp;</td>
										<td class="text-center"><b>Out Of</b></td>
										<td class="text-center"><b>
											<?php $wi = 0; foreach($Written as $key => $ew){$wi = $wi + $ew['ExamWritten']['MARK'];} echo $wi; ?>
										</b></td>
										<td class="text-center"><b>
											<?php $oi = 0; foreach($oral as $key => $eo){$oi = $oi + $eo['ExamOral']['MARK'];} echo $oi; ?>
										</b></td>
										<td class="text-center"><b>
											<?php 
											$wi = 0;
											$oi = 0;
											
											foreach($Written as $key => $ew){
												$wi = $wi + $ew['ExamWritten']['MARK'];
											}
											
											foreach($oral as $key => $eo){
												$oi = $oi + $eo['ExamOral']['MARK'];
											}
											
											echo $wi+$oi;  ?>
										</b></td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									
									<tr>
										<td colspan="7" align="center"><b>CO- CURRICULAR  SUBJECTS</b></td>
										
									</tr>
									
								
								<?php foreach($resultco as $key=>$reco) { ?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td class="text-center"><?php echo $reco['Subject']['TITLE']; ?></td>
										<td class="text-center"><?php echo $reco['Result']['WRITTENMARK']; ?></td>
										<td class="text-center"><?php echo $reco['Result']['ORALMARK']; ?></td>
										<td class="text-center"><?php echo $reco['Result']['TOTALMARK']; ?></td>
										<td class="text-center"><?php echo $reco['ExamGrade']['GRADE_NAME']; ?></td>
										<td class="text-center"><?php echo $reco['ExamRemark']['REMARK']; ?></td>
										
									</tr> 
								<?php  $i++; }  ?>
								
									
									<tr>
										<td>&nbsp;</td>
										<td class="text-center"><b>Percentage</b></td>
										<td class="text-center"><b>
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
												
											echo number_format($pi,2);
											?>
										</b></td>
										<td class="text-center"> &nbsp; </td>
										<td class="text-center"> &nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
									
									<tr>
										<td>&nbsp;</td>
										<td class="text-center"><b>Attendance</b></td>
										<td class="text-center"><b>
											<?php 
													echo $totalday." / ".sizeof($attendance);
											?>
										</b></td>
										<td class="text-center"> &nbsp; </td>
										<td class="text-center"> &nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
				<!--
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
				
                </div> -->
					
			</div>
			
			<div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <!--<button type="submit" class="btn bg-blue-chambray"> <a href="printpage" onClick="printthis(); return false;">Print</a></button>-->
                                <button type="submit" class="btn bg-blue-chambray" onClick="printthis(); return false;">Print</button>
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
<script type="text/javascript">

function printthis()
{
 var w = window.open('', '', 'width=800,height=600,resizeable,scrollbars');
 w.document.write($("#abc").html());
 w.document.close(); // needed for chrome and safari
 javascript:w.print();
 w.close();
 return false;
}
</script>