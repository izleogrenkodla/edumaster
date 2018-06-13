<div class="page-content-dashboard">
    <div class="page-content">

        <!-- BEGIN DASHBOARD STATS -->
        <?php echo $this->Session->flash(); ?>
		<div class="row margin-bottom-20">
						<div class="col-md-4">
							<div class="portlet box blue-madison" >
        <div class="portlet-title" >
            <div class="caption">
                 School Information
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
				<div class="col-md-12" align="center">
								<?php if($profile["School"]["LOGO_IMAGE"]!='') {  ?>
							<img src="<?php echo DOWNLOADURL.UPLOAD_DOCUMENT.$profile["School"]["LOGO_IMAGE"]; ?>" height="112" />
						<?php } ?>
						<div align="center">
					<h1><?php echo $profile["School"]["SCHOOL_NAME"]==''?NOTMENTIONED:$profile["School"]["SCHOOL_NAME"]; ?></h1>					
					<p><span class="fa fa-phone">&nbsp;</span> <?php echo $profile["School"]["MOBILE_NO"]==''?NOTMENTIONED:$profile["School"]["MOBILE_NO"]; ?></p>
					<span>Website: <?php 	echo $profile["School"]["WEBSITE_URL"]==''?NOTMENTIONED:'<a href="http://'.$profile["School"]["WEBSITE_URL"].'" target="_blank">'.$profile["School"]["WEBSITE_URL"].'</a>'; ?> </span>
					
					</div>

				</div>
			</div>                    
                    <!--/row-->
                </div>
            <!-- END FORM-->
        </div>
    </div>
						</div>
						<div class="col-md-4">
							<div class="portlet box blue-madison" >
        <div class="portlet-title"  >
            <div class="caption">
                 My Profile
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form" style="min-height:246px;">
            <!-- BEGIN FORM-->
                <div class="form-body">
					<div class="row">
				<div class="col-md-12" >
						

							<div class="col-md-8">
								<strong>Full Name</strong>
						<address>
							<?php echo $user_info["User"]["FIRST_NAME"].' &nbsp;'.$user_info["User"]["MIDDLE_NAME"].'&nbsp;'.$user_info["User"]["LAST_NAME"]; ?>
						</address>

												<?php if(in_array($user_info["User"]["ROLE_ID"],array(TEACHER_ID,STUDENT_ID))) { ?>
						<strong>Class</strong>
						<address>
							<?php echo $user_info["AcademicClass"]["CLASS_NAME"]; ?>
						</address>
						<strong>Medium</strong>
						<address>
							<?php echo $user_info["Medium"]["MEDIUM_NAME"]; ?>
						</address>
						<?php } ?>
						<strong>Date of Birth</strong>
						<address>
							<?php 
							echo $user_info["User"]["DOB"]; ?>
						</address>
							</div>
							<div class="col-md-4">
								<?php if($user_info["User"]["IMAGE_URL"]!='') {  ?>
							<img src="<?php echo DOWNLOADURL.UPLOAD_DOCUMENT.$user_info["User"]["IMAGE_URL"]; ?>" width="100" />
								<?php } ?>
							</div>
				</div>
			</div>                    
                    <!--/row-->
                </div>
            <!-- END FORM-->
        </div>
    </div>
						</div>

						<div class="col-md-4">
							<div class="portlet box blue-madison" >
        <div class="portlet-title"  >
            <div class="caption">
                Circular
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form" style="height: 246px;">
            <!-- BEGIN FORM-->
                <div class="form-body">
					<div class="row">
							<div class="col-md-12">
						<div class="scroller" data-always-visible="1" data-rail-visible="0">
								<?php if(is_array($notice_board) && sizeof($notice_board)>0) {  ?>
								<ul class="feeds">
									<?php foreach($notice_board as $notice) { 
									
										?>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-info">
														<i class="fa fa-check"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														  <?php	  echo $notice["NoticeBoard"]["NOTICE_TITLE"]; ?>
														   <span class="label label-sm label-success">
														  
														<br />
														By &nbsp; <?php echo $notice["UserFrom"]["FIRST_NAME"].'&nbsp;'.$notice["UserFrom"]["LAST_NAME"]; ?> </span>
														</span>
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date">
												<a href="<?php echo Router::url(array("controller"=>"NoticeBoard","action"=>"view",$notice["NoticeBoard"]["NOTICE_ID"])) ?>" title="View <?php echo  $notice["NoticeBoard"]["NOTICE_TITLE"]?>"><i  class="fa fa-eye"></i></a>
											</div>
										</div>
									</li>
									<?php } ?>
								</ul>
								<?php } ?>
							</div>
							</div>
                    <!--/row-->
					</div>
                </div>
            <!-- END FORM-->
        </div>
    </div>
						</div>
						<?php if(in_array($authUser["ROLE_ID"],array(STUDENT_ID,TEACHER_ID))) {  ?>
						<div class="col-md-6">
							<div class="portlet box blue-madison" >
        <div class="portlet-title"  >
            <div class="caption">
                Homework
            </div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
        </div>
        <div class="portlet-body form" style="height: 246px;">
            <!-- BEGIN FORM-->
                <div class="form-body">
					<div class="row">
							<div class="col-md-12">
						<div class="scroller" data-always-visible="1" data-rail-visible="0">
								<?php if(is_array($hw_list) && sizeof($hw_list)>0) {  ?>
								<ul class="feeds">
									<?php foreach($hw_list as $hw) { ?>
									<li>
										<div class="col1">
											<div class="cont">
												<div class="cont-col1">
													<div class="label label-sm label-info">
														<i class="fa fa-check"></i>
													</div>
												</div>
												<div class="cont-col2">
													<div class="desc">
														Submission:  <?php	 echo $hw["Homework"]["DESCRIPTION"]; ?>
														<br />
														   <span class="label label-sm label-warning">
														<?php echo $this->General->dbfordate($hw["Homework"]["SUBMISSION_DATE"]); ?> </span>
															&nbsp;
														   <span class="label label-sm label-success">
														  
														
														By &nbsp; <?php echo $hw["User"]["FIRST_NAME"].'&nbsp;'.$hw["User"]["LAST_NAME"]; ?> </span>&nbsp;
														<span class="label label-sm label-info">
														
														<?php echo $this->General->getStatusOfStudent($hw["HomeworkXref"]); ?> </span>
													</div>
												</div>
											</div>
										</div>
									</li>
									<?php } ?>
								</ul>
								<br />
									<a class="btn red"  href="<?php  echo Router::url(array("controller"=>"Homeworks","action"=>"index"));?>" title="View all Homeworks">View All</a>
								<?php }else{ ?>
<div><strong>No Homework assigned yet..</strong></div>

<?php } ?>
								
							</div>
							</div>
                    <!--/row-->
					</div>
                </div>
            <!-- END FORM-->
        </div>
    </div>
						</div>
<?php if(in_array($authUser["ROLE_ID"],array(STUDENT_ID))) {  ?>
						<div class="col-md-6">
						<div class="portlet box blue-madison" >
								<div class="portlet-title"  >
									<div class="caption">
										Attendance Chart of <?php echo date("F"); ?> Month
									</div>
									<div class="tools">
										<a href="javascript:void(0);" class="collapse">
										</a>
									</div>
								</div>
								<div class="portlet-body form"  style="min-height:246px;">
									<!-- BEGIN FORM-->
										<div class="form-body">
											<?php $TotalPresent = 0;if($TotalPresent>0 || $TotalAbsent>0) {  ?>
											<div class="row">
											
													<div id="jqChart" style="width: 450px; height: 225px;margin-left:10px;">
							</div>
											</div>
							<?php }else{ ?>
								<div><strong>No Attendance found yet...</strong></div>
							<?php } ?>
											<!--/row-->

										</div>
									<!-- END FORM-->
								</div>
					    </div>
			</div>		

						
						
						<?php }  } ?>
						<div class="col-md-12 dashboard_tiles" style="margin-left:50px;"  >
							<div class="tiles" >
									<?php 
$user_menus = $this->General->subval_sort($user_menus,'name');
if(is_array($user_menus) && sizeof($user_menus)>0) {  ?>
										<?php foreach($user_menus as $key=>$menu) { ?>
											<a href="<?php echo $menu["url"]; ?>">
									<div class="tile <?php echo (isset($menu["bgcolor"]) && $menu["bgcolor"]!="")?$menu["bgcolor"]:"bg-red-sunglo"; ?>">
										<div class="tile-body">
											<?php // echo $menu["icon"] ?>
										</div>
										<div class="tile-object">
										<div  align="center"> 
											 <strong> <?php // echo $menu["name"]?></strong>
										</div>
									</div>
									</div></a>	
										
										<?php } ?>
									
									<?php } ?>

								</div>
							</div>
						
		</div>
    </div>
</div>
<script>

$(document).ready(function(){
	if($(".dashboard_tiles").length>0) { 
		$(".dashboard_tiles").animate({ 
				right: "50",
			},1000);
	}
	
						<?php if(in_array($authUser["ROLE_ID"],array(STUDENT_ID,TEACHER_ID))) {  ?>
	
<?php if($TotalPresent>0 || $TotalAbsent>0) {  ?>
            var background = {
                type: 'linearGradient',
                x0: 0,
                y0: 0,
                x1: 0,
                y1: 1,
                colorStops: [{ offset: 0, color: '#fff' },
                             { offset: 1, color: 'white' }]
            };

            $('#jqChart').jqChart({
                title: { text: '' },
                legend: { title: 'Students' },
                border: { strokeStyle: '#fff' },
                background: background,
                animation: { duration: 1 },
                shadows: {
                    enabled: false
                },
                series: [
                    {
                        type: 'pie',
                        fillStyles: ['<?php echo PRESENT_COLOR; ?>', '<?php echo ABSENT_COLOR; ?>' ],
                        labels: {
                            stringFormat: '%.1f%%',
                            valueType: 'percentage',
                            font: '15px sans-serif',
                            fillStyle: 'white'
                        },
                        explodedRadius: 10,
                        explodedSlices: [5],
                        data: [['<?php echo PRESENT_TEXT  ?>', '<?php echo $TotalPresent; ?>'], ['<?php echo ABSENT_TEXT  ?>', '<?php echo $TotalAbsent; ?>']]
                    }
                ]
            });
        
		<?php } } ?>
});

</script>