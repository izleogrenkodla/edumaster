<div class="page-content-dashboard">
    
    
    
    <!-- main-boxs -->
    <div class="main-boxs">
    
        <!-- left-boxs -->
        <div class="left-boxs">
            <div class="box_left">

				<!-- home-boxas -->
                <div class="box_block box_02">

                    <div class="box_header">
                        My Profile
                        <!--<div class="notification_block">
                            <div class="notification_text">
                                1
                            </div>
                        </div>-->
                    </div>
                    <div class="box_content" style="display:block;">
                        <div class="row">
                            <div class="col-md-12" >


                                <div class="col-md-8">
                                    <strong>Full Name</strong>
                                    <address>
							<?php echo $sel_user_det["User"]["FIRST_NAME"].' &nbsp;'.$sel_user_det["User"]["MIDDLE_NAME"].'&nbsp;'.$sel_user_det["User"]["LAST_NAME"]; ?>
                                    </address>
									<strong>Role</strong>
                                    <address>
										<?php echo $sel_user_role_det["Role"]["ROLE_NAME"]; ?>
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
                                    <!--<strong>Date of Birth</strong>
                                    <address>
							<?php 
							echo $user_info["User"]["DOB"]; ?>
                                    </address>-->
                                </div>
                                <div class="col-md-4">
								<?php //if($user_info["User"]["IMAGE_URL"]!='') {
										$user_img = "14525121041.jpg";				
										if(isset($sel_user_det["User"]['IMAGE_URL']) && $sel_user_det["User"]['IMAGE_URL']!="")
										{
											$user_img=$sel_user_det["User"]['IMAGE_URL'];
											$path = DOWNLOADURL.UPLOAD_DOCUMENT.$user_img;
										}
										else
										{
											$path = DOWNLOADURL.UPLOAD_DOCUMENT.$user_img;
										}
								?>
                                    <img src="<?php echo $path; ?>" width="100" />
								<?php //} ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- End: home-boxas -->
			
                <!-- home-boxas -->
                <div class="box_block box_01">

                    <div class="box_header">
                        School Information
                        <div class="notification_block">
                            <div class="notification_text">
                                1
                            </div>
                        </div>
                    </div>
                    <div class="box_content">
                        <div align="center">
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

                </div><!-- End: home-boxas -->

                <!-- home-boxas -->
                <div class="box_block box_03">

                    <div class="box_header">
                        Circular
                        <div class="notification_block">
                            <div class="notification_text">
                                0
                            </div>
                        </div>
                    </div>
                    <div class="box_content">
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
                                                    <a href="<?php echo Router::url(array("controller"=>"NoticeBoard","action"=>"view",$notice["NoticeBoard"]["NOTICE_ID"])) ?>" title="View <?php echo  $notice["NoticeBoard"]["NOTICE_TITLE"]?>"><i  class="fa fa-desktop"></i></a>
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

                </div><!-- End: home-boxas -->



            </div>
        </div><!-- End: left-boxs -->
        
        <!-- right-boxs -->
        <div class="right-boxs">
            <div class="dashboard_tiles">


                <div class="tiles" >
									<?php 
$user_rep_profile = $this->General->subval_sort($user_rep_profile,'name');
$user_rep_activity = $this->General->subval_sort($user_rep_activity,'name');
$user_rep_comm = $this->General->subval_sort($user_rep_comm,'name');

if( (is_array($user_rep_profile) && sizeof($user_rep_profile)>0) || (is_array($user_rep_activity) && sizeof($user_rep_activity)>0) || (is_array($user_rep_comm) && sizeof($user_rep_comm)>0) ) {  ?>
                    
					<!-- Reports -->
                    <div class="home-boxas">
                        <div class="lb">Reports</div>
						
						<!-- Profile -->
                        <div class="subdashboard_box">
                            <div class="subdashboard_heading">Profile</div>
							
							<?php foreach($user_rep_profile as $key=>$menu) { ?>
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
								</div>
							</a>							
							<?php } ?>							
                        </div>
                        <!-- End: Profile -->
						
						<!-- Activity -->
                        <div class="subdashboard_box">
                            <div class="subdashboard_heading">Library Activity</div>
							
							<?php foreach($user_rep_activity as $key=>$menu) { ?>
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
								</div>
							</a>							
							<?php } ?>
                        </div>
                        <!-- End: Activity -->

						<!-- Communication -->
                        <div class="subdashboard_box">
                            <div class="subdashboard_heading">Communication</div>
							
							<?php foreach($user_rep_comm as $key=>$menu) { ?>
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
								</div>
							</a>							
							<?php } ?>
                        </div>
                        <!-- End: Communication -->
						
						
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
                    </div>
					<!-- End: Reports -->
                    
					<!-- Forms -->
                    <div class="home-boxas">
                        <div class="lb">Forms</div>
						<?php foreach($user_forms as $key=>$menu) { ?>
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
                    </div>
					<!-- End: Forms -->
                    
					<!-- Master -->
                    <div class="home-boxas">
                        <div class="lb">Master</div>
						<?php foreach($user_master as $key=>$menu) { ?>
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
                    </div>
					<!-- End: Master -->
									<?php } ?>

                </div>


            </div>
        </div>
        <!-- End: right-boxs -->
        
    </div>
    <!-- End: main-boxs -->
    
    
    
    
    
    
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