<link rel="stylesheet" type="text/css" href="<?php echo ASSETS_URL ?>/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>

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
                <a href="#">Exam Time Table</a>
                <i class="fa fa-angle-right"></i>
            </li>
            <li>
                <a href="#">View Exam Time Table</a>
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

<div id="abc">

	
	<div class="portlet box blue-madison">
        <div class="portlet-title">
            <div class="caption">
                <span aria-hidden="true" class="icon-user"></span>&nbsp; <?php foreach ($ExamData as $name) { echo $name["ExamType"]["TITLE"]; break; } ?> Time Table
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form">
            <!-- BEGIN FORM-->
          
                <div class="form-body">
					<div class="row">
						<div class="col-md-12">
                            
                                <div class="col-md-2 tooltips">
                                   <strong>Date</strong>
                                </div>
								
								<?php if($Section == 2) { ?>
								<div class="col-md-1 tooltips">
                                    <strong>I</strong>
                                </div>
								
								<div class="col-md-1 tooltips">
                                    <strong>II</strong>
                                </div>
								
								<div class="col-md-1 tooltips">
                                    <strong>III</strong>
                                </div>
								
								<div class="col-md-1 tooltips">
                                    <strong>IV</strong>
                                </div>
								
								<div class="col-md-1 tooltips">
                                    <strong>V</strong>
                                </div>
								
								<div class="col-md-1 tooltips">
                                    <strong>VI</strong>
                                </div>
								
								<div class="col-md-1 tooltips">
                                    <strong>VII</strong>
                                </div>
								
								<div class="col-md-1 tooltips">
                                    <strong>VIII</strong>
                                </div>
								
								
								<?php }elseif($Section == 3) { ?>
									<div class="col-md-1 tooltips">
                                    <strong>IX</strong>
									</div>
									
									<div class="col-md-1 tooltips">
										<strong>X</strong>
									</div>
								<?php }elseif($Section == 1) { ?>
									<div class="col-md-1 tooltips">
										<strong>Nursery</strong>
									</div>
									
									<div class="col-md-1 tooltips">
										<strong>LKG</strong>
									</div>
									
									<div class="col-md-1 tooltips">
										<strong>UKG</strong>
									</div>
								<?php } ?>
								
                        </div>	
					</div>
					<br />
                    <?php 
						/*$totalMarks = 0;
						$totalget = 0;
						foreach($Result_xref as $Result) {   $nameprefix = $Result["ResultXref"]["EX_REF_ID"].']';
						$totalget = $totalget+$Result["ResultXref"]["MARKS"];
						$totalMarks = $totalMarks+$Result["ExamXref"]["TOTAL_MARKS"];*/
					?>
					<div class="row">
                        <div class="col-md-12">
								
                                <div class="col-md-2">
									<?php
										foreach($ExamDate as $dt){ 
										
										echo $dt['ExamList']['EXAM_DATE'].'<br>'.'<br>';
										} 
									?>
                                </div>
								<?php if($Section == 2) { ?>
								<div class="col-md-1">
									
									<?php foreach ($Examsub4 as $sub) { 
											if($sub['Subject']['SUBJECT_ID'] == 0){
												echo 'No Exam'.'<br>'.'<br>';
											}else{
												echo $sub['Subject']['TITLE'].'<br>'.'<br>';
											}
										}
									?>
								</div>
								
								<div class="col-md-1">
									
									<?php foreach ($Examsub8 as $sub) { 
											if($sub['Subject']['SUBJECT_ID'] == 0){
												echo 'No Exam'.'<br>'.'<br>';
											}else{
												echo $sub['Subject']['TITLE'].'<br>'.'<br>';
											}
									}
									?>
								</div>
								
								<div class="col-md-1">
									
									<?php foreach ($Examsub11 as $sub) { 
											if($sub['Subject']['SUBJECT_ID'] == 0){
												echo 'No Exam'.'<br>'.'<br>';
											}else{
												echo $sub['Subject']['TITLE'].'<br>'.'<br>';
											}
										}
									?>
								</div>
								
								<div class="col-md-1">
									
									<?php foreach ($Examsub14 as $sub) { 
											if($sub['Subject']['SUBJECT_ID'] == 0){
												echo 'No Exam'.'<br>'.'<br>';
											}else{
												echo $sub['Subject']['TITLE'].'<br>'.'<br>';
											}
										}
									?>
								</div>
								
								<div class="col-md-1">
									
									<?php foreach ($Examsub17 as $sub) { 
											if($sub['Subject']['SUBJECT_ID'] == 0){
												echo 'No Exam'.'<br>'.'<br>';
											}else{
												echo $sub['Subject']['TITLE'].'<br>'.'<br>';
											}
										}
									?>
								</div>
								
								<div class="col-md-1">
									
									<?php foreach ($Examsub20 as $sub) { 
											if($sub['Subject']['SUBJECT_ID'] == 0){
												echo 'No Exam'.'<br>'.'<br>';
											}else{
												echo $sub['Subject']['TITLE'].'<br>'.'<br>';
											}
										}
									?>
								</div>
								
								<div class="col-md-1">
									
									<?php foreach ($Examsub23 as $sub) { 
											if($sub['Subject']['SUBJECT_ID'] == 0){
												echo 'No Exam'.'<br>'.'<br>';
											}else{
												echo $sub['Subject']['TITLE'].'<br>'.'<br>';
											}
										}
									?>
								</div>
								
								<div class="col-md-1">
									
									<?php foreach ($Examsub26 as $sub) { 
											if($sub['Subject']['SUBJECT_ID'] == 0){
												echo 'No Exam'.'<br>'.'<br>';
											}else{
												echo $sub['Subject']['TITLE'].'<br>'.'<br>';
											}
										}
									?>
								</div>
								
								<?php }elseif($Section == 3) { ?>
								
								<div class="col-md-1">
									
									<?php foreach ($Examsub29 as $sub) { 
											if($sub['Subject']['SUBJECT_ID'] == 0){
												echo 'No Exam'.'<br>'.'<br>';
											}else{
												echo $sub['Subject']['TITLE'].'<br>'.'<br>';
											}
										}
									?>
								</div>
								
								<div class="col-md-1">
									
									<?php foreach ($Examsub32 as $sub) { 
											if($sub['Subject']['SUBJECT_ID'] == 0){
												echo 'No Exam'.'<br>'.'<br>';
											}else{
												echo $sub['Subject']['TITLE'].'<br>'.'<br>';
											}
										}
									?>
								</div>
								<?php }elseif($Section == 1) {  ?>
									<div class="col-md-1">
									
									<?php foreach ($Examsub38 as $sub) { 
											if($sub['Subject']['SUBJECT_ID'] == 0){
												echo 'No Exam'.'<br>'.'<br>';
											}else{
												echo $sub['Subject']['TITLE'].'<br>'.'<br>';
											}
										}
									?>
									</div>
									
									<div class="col-md-1">
										
										<?php foreach ($Examsub01 as $sub) { 
												if($sub['Subject']['SUBJECT_ID'] == 0){
													echo 'No Exam'.'<br>'.'<br>';
												}else{
													echo $sub['Subject']['TITLE'].'<br>'.'<br>';
												}
											}
										?>
									</div>
									
									<div class="col-md-1">
										
										<?php foreach ($Examsub35 as $sub) { 
												if($sub['Subject']['SUBJECT_ID'] == 0){
													echo 'No Exam'.'<br>'.'<br>';
												}else{
													echo $sub['Subject']['TITLE'].'<br>'.'<br>';
												}
											}
										?>
									</div>
								<?php } ?>
								
								

                        </div>
                    </div>
					<br />
				
                </div>
				
		</form>	
            <!-- END FORM-->
        </div>
    </div>

</div>

<div class="form-actions fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="col-md-offset-3 col-md-9">
                                <button type="button" class="btn default" onclick="window.location.href='<?php echo Router::url(array("controller"=>"Results","action"=>"index")); ?>'">Go Back</button>
								<!--<a href="printpage" onClick="printthis(); return false;">Print</a>-->
								<a href="printpage" id="btn_print" class="btn default" onClick="printthis(); return false;">Print</a>
                            </div>
                        </div>
                        <div class="col-md-6">
                        </div>
                    </div>
                </div>
</div>
</div>
<!-- END PAGE CONTENT-->
</div>
</div>
<script>
$(document).ready(function(){
	$("#ResultSTUDENTID").change(function(){
		if($(this).val().length>0) { 
			$("#ResultAdminViewForm").submit();
		}
	});
})
</script>

<script type="text/javascript">

function printthis()
{
 var w = window.open('', '', 'width=800,height=600,resizeable,scrollbars');
 w.document.write('<link href="<?php echo ASSETS_URL; ?>admin/layout/css/print_layout.css" rel="stylesheet" type="text/css" />');
 w.document.write($("#abc").html());
 w.document.close(); // needed for chrome and safari
 javascript:w.print();
 w.close();
 return false;
}
</script>