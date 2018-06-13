<link href="<?php echo AWR_CSS_URL; ?>css/edu-main-style.css" rel="stylesheet" type="text/css" />
<!-- BEGIN DASHBOARD STATS -->
        <?php echo $this->Session->flash(); ?>


<div class="main-boxs">

    <!-- datetime_section -->
<!--    <div class="datetime_section">
        <div class="time">
            05:42 PM
        </div>
        <div class="date">
            Friday, 18 March 2016
        </div>
    </div> End: datetime_section -->

    <!-- left-boxs -->
    <div class="left-boxs">
        <div class="box_left">
        <!-- home-boxas -->
        <div id="notice_circular" class="box_block box_01">

           <div class="box_header">
                Circular
                <div class="notification_block">
                    <div class="notification_text">
                        <?php echo  $notice > 0 ? $notice : $noticeout;?>
                    </div>
                </div>
            </div>
            <div class="box_content">

				<ul class="nav nav-tabs" role="tablist">
					<li role="presentation" class="active"><a href="#inbox" aria-controls="inbox" role="tab" data-toggle="tab">Inbox</a></li>
					<li role="presentation"><a href="#outbox" aria-controls="outbox" role="tab" data-toggle="tab">Outbox</a></li>
					<li role="presentation"><a href="<?php echo $this->Html->url(array('controller'=>'NoticeBoard','action'=>'add')); ?>"  target="_blank">Compose</a></li>
				</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="inbox">
		
			<div class="scroll_container">
                    <?php foreach($noticedata as $notices){?>
							
					<!-- circular_timeline -->
					<div class="circular_timeline">
							
						<!-- ct_box -->
						<div class="ct_box unread">
							<div class="ct_datebox">
								<span class="ct_day"><?php $dtime = strtotime($notices['NoticeBoard']['created']);
								
									$date = date( 'Y-m-d ', $dtime );
									echo date('D', strtotime($date));
									
								?></span>
								<span class="ct_date"><?php echo date('d', strtotime($date));?></span>
								<span class="ct_year"><?php echo date('Y', strtotime($date));?></span>
							</div>
							<div class="ct_content">
								<div class="ct_title">
									<?php echo $notices['NoticeBoard']['NOTICE_TITLE'];?>
								</div>
								<div class="ct_description">
									<?php echo $notices['NoticeBoard']['NOTICE_DESC'];?>
								</div>
								<div class="ct_footer">
									<span class="ct_emailer">
										<span class="ct_sender">
											<span class="ct_label">To:</span>
											<span class="ct_sender_name"><?php echo $notices['User']['FIRST_NAME']." ".$notices['User']['LAST_NAME']?></span>
										</span>
										<span class="ct_sender">
											<span class="ct_label">From:</span>
											<span class="ct_sender_name"><?php echo $notices['UserFrom']['FIRST_NAME']." ".$notices['UserFrom']['LAST_NAME']?></span>
										</span>
									</span>
									
									<a href="#" class="ct_attachement">
										<i class="fa fa-download"></i>
									</a>
								</div>
							</div>
						</div>
						<!-- End: ct_box -->
						
					
						
						
						
					</div>
					<!-- End: circular_timeline -->
					<?php }?>
                </div>
		
		</div>
		
		<div role="tabpanel" class="tab-pane" id="outbox">
		
			
			<div class="scroll_container">
                    <?php foreach($noticedataout as $noticesout){?>
					<!-- circular_timeline -->
					<div class="circular_timeline">
					
						<!-- ct_box -->
						<div class="ct_box unread">
							<div class="ct_datebox">
								<span class="ct_day"><?php $dtime = strtotime($noticesout['NoticeBoard']['created']);
								
									$date = date( 'Y-m-d ', $dtime );
									echo date('D', strtotime($date));
									
								?></span>
								<span class="ct_date"><?php echo date('d', strtotime($date));?></span>
								<span class="ct_year"><?php echo date('Y', strtotime($date));?></span>
							</div>
							<div class="ct_content">
								<div class="ct_title">
									<?php echo $noticesout['NoticeBoard']['NOTICE_TITLE'];?>
								</div>
								<div class="ct_description">
									<?php echo $noticesout['NoticeBoard']['NOTICE_DESC'];?>
								</div>
								<div class="ct_footer">
									<span class="ct_emailer">
										<span class="ct_sender">
											<span class="ct_label">To:</span>
											<span class="ct_sender_name"><?php echo $noticesout['User']['FIRST_NAME']." ".$noticesout['User']['LAST_NAME']?></span>
										</span>
										<span class="ct_sender">
											<span class="ct_label">From:</span>
											<span class="ct_sender_name"><?php echo $noticesout['UserFrom']['FIRST_NAME']." ".$noticesout['UserFrom']['LAST_NAME']?></span>
										</span>
									</span>
									
									<a href="#" class="ct_attachement">
										<i class="fa fa-download"></i>
									</a>
								</div>
							</div>
						</div>
						<!-- End: ct_box -->
						
						
						
					</div>
					<?php }?>
					<!-- End: circular_timeline -->
					
                </div>
		
		</div>
	</div>
            </div>
		
        </div><!-- End: home-boxas -->

        <?php if($aid == '1'){?>
        <!-- home-boxas -->
        <div id="notice_staff_leave" class="box_block box_02">

            <div class="box_header">
                Staff Leave
                <div class="notification_block">
                    <div class="notification_text">
                        <?php echo $staffleavecount;?>
                    </div>
                </div>
            </div>
            <div class="box_content">
                
				<!-- leave_container -->
				<div class="leave_container">
					
					<div class="scroll_container">
					 <?php foreach($staffleavedata as $staffleave):?>
						<!-- leave_list -->
						<div class="leave_list">
							<h5><?php echo $staffleave['User']['FIRST_NAME']. " " .$staffleave['User']['MIDDLE_NAME']." " .$staffleave['User']['LAST_NAME'];?></h5>
							<div class="leave_duration">
								<span class="date_from">
									From: <?php echo $staffleave['LeaveApplication']['FROM_DATE'];?>
								</span>
								<span class="date_to">
									To: <?php echo $staffleave['LeaveApplication']['TO_DATE'];?>
								</span>
							</div>
							<div class="leave_reason">
								<span>Reason:</span>
								 <?php echo $staffleave['LeaveApplication']['REASON'];?>
							</div>
							<div class="leave_status_container">
							<?php if($staffleave['LeaveApplication']['LEAVE_STATUS'] == 0){?>
								<span class="label label-sm label-success hide">Approved</span>
								<span class="label label-sm label-warning ">Pending</span>
								<span class="label label-sm label-danger hide">Rejected</span>
							<?php } elseif($staffleave['LeaveApplication']['LEAVE_STATUS'] == 1){?>
								<span class="label label-sm label-success ">Approved</span>
								<span class="label label-sm label-warning hide">Pending</span>
								<span class="label label-sm label-danger hide">Rejected</span>
							
							<?php }elseif($staffleave['LeaveApplication']['LEAVE_STATUS'] == 2){?>
								<span class="label label-sm label-success hide">Approved</span>
								<span class="label label-sm label-warning hide">Pending</span>
								<span class="label label-sm label-danger ">Rejected</span>
							<?php }?>
							</div>
						</div>
						<!-- End: leave_list -->
						
						<!-- leave_list -->
						
						<?php endforeach;?>
					
					</div>
					
				</div>
				<!-- End: leave_container -->
				
            </div>

        </div><!-- End: box_block -->
		
		<!-- home-boxas -->
        <div id="notice_student_leave" class="box_block box_12">

            <div class="box_header">
                Student Leave
                <div class="notification_block">
                    <div class="notification_text">
                        <?php echo $studentleavecount; ?>
                        
                    </div>
                </div>
            </div>
            <div class="box_content">
               
				<!-- leave_container -->
				<div class="leave_container">
					
					<div class="scroll_container">
					 <?php foreach($studentleavedata as $stuleave):?>
						<!-- leave_list -->
						<div class="leave_list">
							<h5><?php echo $stuleave['User']['FIRST_NAME']. " " .$stuleave['User']['MIDDLE_NAME']."" .$stuleave['User']['LAST_NAME'];?></h5>
							<div class="leave_duration">
								<span class="date_from">
									From: <?php echo $stuleave['LeaveApplication']['FROM_DATE'];?>
								</span>
								<span class="date_to">
									To: <?php echo $stuleave['LeaveApplication']['TO_DATE'];?>
								</span>
							</div>
							<div class="leave_reason">
								<span>Reason:</span>
								 <?php echo $stuleave['LeaveApplication']['REASON'];?>
							</div>
							<div class="leave_status_container">
							<?php if($stuleave['LeaveApplication']['LEAVE_STATUS'] == 0){?>
								<span class="label label-sm label-success hide">Approved</span>
								<span class="label label-sm label-warning ">Pending</span>
								<span class="label label-sm label-danger hide">Rejected</span>
							<?php } elseif($stuleave['LeaveApplication']['LEAVE_STATUS'] == 1){?>
								<span class="label label-sm label-success ">Approved</span>
								<span class="label label-sm label-warning hide">Pending</span>
								<span class="label label-sm label-danger hide">Rejected</span>
							
							<?php }elseif($stuleave['LeaveApplication']['LEAVE_STATUS'] == 2){?>
								<span class="label label-sm label-success hide">Approved</span>
								<span class="label label-sm label-warning hide">Pending</span>
								<span class="label label-sm label-danger ">Rejected</span>
							<?php }?>
							</div>
						</div>
						<!-- End: leave_list -->
						
						<!-- leave_list -->
						
						<?php endforeach;?>
					
					</div>
					
				</div>
				<!-- End: leave_container -->
				
            </div>

        </div><!-- End: box_block -->
	<?php }?>

        <!-- box_block -->
        <div id="notice_suggestion" class="box_block box_03">

            <div class="box_header">
                Suggestion
                <div class="notification_block">
                    <div class="notification_text">
                        <?php echo $Suggestion;?>
                    </div>
                </div>
            </div>
            <div class="box_content">
                <div class="suggestion_container">
					<div class="scroll_container">
						<?php
						foreach($sdata as $s){
						?>
							<div class="suggestion_list">
								
								<div class="suggestion_name">
									<span class="suggestion_label">Name:</span>
									<span class="suggestion_value">
										<?php echo $s['Suggestion']['FIRST_NAME']." ".$s['Suggestion']['LAST_NAME']; ?>
									</span>
								</div>
								<div class="suggestion_date">
									<span class="suggestion_label">Date:</span>
									<span class="suggestion_value">
										<?php echo $this->General->dbfordate($s['Suggestion']['created']); ?>
									</span>
								</div>
								<div class="suggestion_message">
									<span class="suggestion_label">Message:</span>
									<span class="suggestion_value">
										<?php echo $s['Suggestion']['SUGGESTION_MESSAGE'];?>
									</span>
								</div>
								
							</div>
						<?php }?>
						
					</div>
						
				</div>
            </div>

        </div><!-- End: box_block -->

        <!-- box_block -->
        <div id="notice_news_updates" class="box_block box_04">

            <div class="box_header">
                News &amp; Updates
                <div class="notification_block">
                    <div class="notification_text">
                        <?php echo $NewsCount;?>
                    </div>
                </div>
            </div>
            <div class="box_content">
                <div class="news_container">
					<div class="scroll_container">
                    <?php
					foreach($News as $n){					
					?>
						<div class="news_list">
							<div class="news_name">
								<span class="news_label">News Title:</span>
								<span class="news_value">
									<a href="<?php echo $this->Html->url(array('controller'=>'News','action'=>'view',$n['News']['NEWS_ID'])); ?>"  target="_blank"><?php echo $n['News']['NEWS_TITLE']; ?></a>
								</span>
							</div>
							<div class="news_date">
								<span class="news_label">Date:</span>
								<span class="news_value">
									<?php echo $n['News']['START_DATE'];?>
								</span>
							</div>
						</div>
					<?php }?>
					</div>
					
					
				</div>
            </div>

        </div><!-- End: box_block -->

        <!-- box_block -->
        <div class="box_block box_05">

            <div class="box_header">
                Time Table
                <div class="notification_block">
                    <div class="notification_text">
                        3
                    </div>
                </div>
            </div>
            <div class="box_content">
                <p>
                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.
                </p>
            </div>

        </div><!-- End: box_block -->

        <?php if($aid == '1'){?>
        <!-- box_block -->
        <div id="notice_attendance" class="box_block box_06">

            <div class="box_header">
               Student Attendance
                <div class="notification_block">
                    <div class="notification_text">
                       <?php echo $studentc;?>
                    </div>
                </div>
            </div>
            <div class="box_content">
                <div class="attendance_container">
					<div class="scroll_container">
						<p>
							Total Students: <?php echo $studentc;?>
						</p>
						<p>
							Total Students Present: <?php echo $studp;?>
						</p>
						<p>
							Total Students Absent: <?php echo $studa;?>
						</p>
					</div>
				</div>
            </div>

        </div><!-- End: box_block -->

		<!-- box_block -->
        <div id="notice_attendance" class="box_block box_07">

            <div class="box_header">
                Staff Attendance
                <div class="notification_block">
                    <div class="notification_text">
                       <?php echo $staffc; ?>
                    </div>
                </div>
            </div>
            <div class="box_content">
                <div class="attendance_container">
					<div class="scroll_container">
							<p>
							Total Staff: <?php echo $staffc;?>
						</p>
						<p>
							Total Staff Present: <?php echo $staffp;?>
						</p>
						<p>
							Total Staff Absent: <?php echo $staffa;?>
						</p>
					</div>
				</div>
            </div>

        </div><!-- End: box_block -->
<?php }?>

        <!-- box_block -->
        <div id="notice_class_work" class="box_block box_08">

            <div class="box_header">
                Class Work
                <div class="notification_block">
                    <div class="notification_text">
                       <?php if(isset($ccon)){ echo $ccon;}else{echo "0";}?>
                    </div>
                </div>
            </div>
            <div class="box_content">
                <div class="classwork_container">
					<div style="width:98%;" class="scroll_container">
				
				<?php if(isset($ccondata)){ foreach($ccondata as $cw){?>
						<div class="class_work_input" >
								
								<div class="suggestion_name">
									<span class="suggestion_label">Date: </span>
									<span class="suggestion_value">
										Date : <?php echo $cw['Classwork']['CW_DATE'];?>
									</span>
								</div>
								<div class="suggestion_message">
									<span class="suggestion_label">Start Time: </span>
									<span class="suggestion_value">
										Start Time: <?php echo $cw['Classwork']['START_TIME'];?>
									</span>
								</div>
								<div class="suggestion_message">
									<span class="suggestion_label">End Time: </span>
									<span class="suggestion_value">
									End Time: <?php echo $cw['Classwork']['END_TIME'];?>
									</span>
								</div>
								<div class="suggestion_message">
									<span class="suggestion_label">Class: </span>
									<span class="suggestion_value">
									Class: <?php echo $cw['AcademicClass']['CLASS_NAME'];?>
									</span>
								</div>	
								<div class="suggestion_message">
									<span class="suggestion_label">Subject: </span>
									<span class="suggestion_value">
									Subject: <?php echo $cw['Subject']['TITLE'];?>
									</span>
								</div>
								<div class="suggestion_message">
									<span class="suggestion_label">Teacher: </span>
									<span class="suggestion_value">
									Teacher: <?php echo $cw['User']['FIRST_NAME'] ." ". $cw['User']['MIDDLE_NAME'] ."  ". $cw['User']['LAST_NAME']; ?>
									</span>
								</div>
								
							</div>
					
							
							
							
						
						<?php }}?>
					</div>
				</div>
            </div>

        </div><!-- End: box_block -->

        <!-- box_block -->
        <div id="notice_home_work" class="box_block box_09">

            <div class="box_header">
                Home Work
                <div class="notification_block">
                    <div class="notification_text">
                       <?php if(isset($hwc)){ echo $hwc;}else{echo "0";}?>
                    </div>
                </div>
            </div>
           <div class="box_content">
                <div class="classwork_container">
					<div style="width:98%;" class="scroll_container">
				
				<?php if(isset($hwdata)){ foreach($hwdata as $hw){?>
						<div class="class_work_input" >
								<div class="suggestion_name">
									<span class="suggestion_label">Date: </span>
									<span class="suggestion_value">
										Classwork Date: <?php echo $hw['Homework']['DATE'];?>
									</span>
								</div>
								<div class="suggestion_name">
									<span class="suggestion_label">Classwork Submission Date: </span>
									<span class="suggestion_value">
									Submission Date: <?php echo $hw['Homework']['SUBMISSION_DATE'];?>
									</span>
								</div>
								<div class="suggestion_message">
									<span class="suggestion_label">Date: </span>
									<span class="suggestion_value">
										Description : <?php echo $hw['Homework']['DESCRIPTION'];?>
									</span>
								</div>
								
								<div class="suggestion_message">
									<span class="suggestion_label">Class: </span>
									<span class="suggestion_value">
									Class: <?php echo $hw['AcademicClass']['CLASS_NAME'];?>
									</span>
								</div>	
								<div class="suggestion_message">
									<span class="suggestion_label">Subject: </span>
									<span class="suggestion_value">
									Subject: <?php echo $hw['Subject']['TITLE'];?>
									</span>
								</div>
								<div class="suggestion_message">
									<span class="suggestion_label">Teacher: </span>
									<span class="suggestion_value">
										Teacher: <?php echo $hw['User']['FIRST_NAME'] ." ". $cw['User']['MIDDLE_NAME'] ."  ". $cw['User']['LAST_NAME']; ?>
									</span>
								</div>
								
							</div>
					
							
							
							
						
						<?php }}?>
					</div>
				</div>
            </div>

        </div><!-- End: box_block -->

        <!-- box_block -->
        <div id="notice_events" class="box_block box_10">

            <div class="box_header">
                Events
                <div class="notification_block">
                    <div class="notification_text">
                        <?php echo  $tevents;?>
                    </div>
                </div>
            </div>
            <div class="box_content">
                <div class="events_container">
					<div class="scroll_container">
						<?php
						foreach($events as $e){
						?>
							<div class="events_list">
								<h5><?php echo $e['Event']['EVENT_TITLE'] ?></h5>
								<div class="events_duration">
									<span class="date_from">
										<em>From:</em> <?php echo $e['Event']['EVENT_START'];?>
									</span>
									<span class="date_to">
										<em>To:</em> <?php echo $e['Event']['EVENT_END'];?>
									</span>
								</div>
								<div class="events_class">
									<em>Class:</em> <?php echo $e['AcademicClass']['CLASS_NAME'];?>
								</div>
							</div>
							<?php /* ?>
							 Starting Date:<?php echo $e['Event']['EVENT_START'];?>&nbsp;&nbsp;&nbsp;&nbsp;<br/>
							 Ending Date:<?php echo $e['Event']['EVENT_END'];?>&nbsp;&nbsp;<br/>
							 Event Name:<?php echo $e['Event']['EVENT_TITLE'] ?><br/>						 
							 Class:<?php echo $e['AcademicClass']['CLASS_NAME'];?>
							 <?php */ ?>
							
						<?php }?>
					</div>
					
				</div>
            </div>

        </div><!-- End: box_block -->

        <!-- box_block -->
        <div id="notice_exam_schedual" class="box_block box_11">

            <div class="box_header">
                Exam Schedual
                <div class="notification_block">
                    <div class="notification_text">
                        6
                    </div>
                </div>
            </div>
            <div class="box_content">
                <div class="exam_schedual_container">
					<div class="scroll_container">
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.
						</p>
					</div>
				</div>
            </div>

        </div><!-- End: box_block -->





        <!--                        <div class="home-boxas">
                                                                <div class="flip">SCHOOL INFORMATION<span class="glyphicon glyphicon-menu-down" style="margin-left:10px;" aria-hidden="true"></span></div>
        
                                 <div class="tools">
                        <a href="javascript:void(0);" class="collapse"></a>
                    </div>
                                                        <div  class="panel" align="center" style="display:block;">
                        		<?php if($profile["School"]["LOGO_IMAGE"]!='') {  ?>
                                                                <img src="<?php echo DOWNLOADURL.UPLOAD_DOCUMENT.$profile["School"]["LOGO_IMAGE"]; ?>" height="112" />
						<?php } ?>
                                            <div align="center">
                                            <h1><?php echo $profile["School"]["SCHOOL_NAME"]==''?NOTMENTIONED:$profile["School"]["SCHOOL_NAME"]; ?></h1>					
                                                <p><span class="fa fa-phone">&nbsp;</span> <?php echo $profile["School"]["MOBILE_NO"]==''?NOTMENTIONED:$profile["School"]["MOBILE_NO"]; ?></p>
                                                <span>Website: <?php 	echo $profile["School"]["WEBSITE_URL"]==''?NOTMENTIONED:'<a href="http://'.$profile["School"]["WEBSITE_URL"].'" target="_blank">'.$profile["School"]["WEBSITE_URL"].'</a>'; ?> </span>
                                </div>
                                </div>
                            </div>-->

        <!--                        <div class="home-boxas">
                                                        <div class="bh">MY PROFILE<span class="glyphicon glyphicon-menu-down" style="margin-left:10px;" aria-hidden="true"></span></div>
                                                        <div  class="hb col-xs-12" align="center" style="display:block;">
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
                                                                <div class="col-md-4" style="padding:0 !important;">
								<?php if($user_info["User"]["IMAGE_URL"]!='') {  ?>
                                                                <img style="min-height:130px;" src="<?php echo DOWNLOADURL.UPLOAD_DOCUMENT.$user_info["User"]["IMAGE_URL"]; ?>" width="100%" />
								<?php } ?>
                                                                </div>
                                        </div>
                                </div>-->

        <!--                        <div class="home-boxas">
                                                        <div class="lb">CIRCULAR<span class="glyphicon glyphicon-menu-down" style="margin-left:10px;" aria-hidden="true"></span></div>
                                <div class="tools">
                                    <a href="javascript:void(0);" class="collapse">
                                    </a>
                                  </div>
                                                        <div  class="bl" align="center" style="display:block;">
                                
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
                                                                                                        <a href="<?php echo Router::url(array("controller"=>"NoticeBoard","action"=>"view",$notice["NoticeBoard"]["NOTICE_ID"])) ?>" title="View <?php echo  $notice["NoticeBoard"]["NOTICE_TITLE"]?>"><i  class="fa fa-desktop"></i></a>
                                                                                                </div>
                                                                                        </div>
                                                                                </li>
									<?php } ?>
                                                                        </ul>
								<?php } ?>
                                                                </div>
                                                                </div>
                            /row
                                                </div>
                        </div>
                                
                               
                                
                                </div>
                            </div>-->

       <?php if(in_array($authUser["ROLE_ID"],array(STUDENT_ID,TEACHER_ID))) {  ?>
      <div class="home-boxas">
            <div class="hw">Homework<span class="glyphicon glyphicon-menu-down" style="margin-left:10px;" aria-hidden="true"></span></div>
            <div  class="hmw" align="center" style="padding: 14px; display:block;">
                        <?php if(is_array($hw_list) && sizeof($hw_list)>0) {  ?>
                <ul class="feeds"  style="overflow:scroll; width:257px; height:283px; float:left;">
									<?php foreach($hw_list as $hw) { ?>
                    <li>
                        <div class="col1">
                            <div class="cont">

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

                     <?php if(in_array($authUser["ROLE_ID"],array(STUDENT_ID))) {  ?>

        <div class="home-boxas">
            <div class="att">Attendance Chart of <?php echo date("F"); ?> Month<span class="glyphicon glyphicon-menu-down" style="margin-left:10px;" aria-hidden="true"></span></div>
            <div class="tools">
                <a href="javascript:void(0);" class="collapse">
                </a>
            </div>
            <div  class="attn" align="center" style="display:block;">

                <div class="form-body">
											<?php $TotalPresent = 0;if($TotalPresent>0 || $TotalAbsent>0) {  ?>
                    <div class="row">

                        <div id="jqChart" style="width: 450px; height: 225px;margin-left:10px;">
                        </div>
                    </div>
							<?php }else{ ?>
                    <div><strong>No Attendance found yet...</strong></div>
							<?php } ?>
                </div>

            </div>
        </div>




                        <?php } } ?>
        </div>
    </div><!-- End: left-boxs -->

    <div class="right-boxs">	
        <div class=" dashboard_tiles" style="margin-left:50px;"  >
            <div class="tiles" >
									<?php 
$user_menus = $this->General->subval_sort($user_menus,'name');
if(is_array($user_menus) && sizeof($user_menus)>0) {  ?>
                <div class="home-boxas">

                                              <!--<div class="lb">PERSONAL PROFILE<span class="glyphicon glyphicon-menu-down" style="margin-left:10px;" aria-hidden="true"></span></div>-->
                    <div class="lb">PERSONAL PROFILE<span style="margin-left:10px;" aria-hidden="true"></span></div>               
										<?php foreach($user_menus as $key=>$menu) {	?>
                    <a href="<?php echo $menu["url"]; ?>">
                        <div class="tile <?php echo (isset($menu["bgcolor"]) && $menu["bgcolor"]!="")?$menu["bgcolor"]:"bg-red-sunglo"; ?>">
                            <div class="tile-body">
											<?php // echo $menu["icon"] ?>
                            </div>
                        </div></a>	

										<?php } ?>
                </div>
                           <?php } ?>


                           <?php 
$dep = $this->General->subval_sort($department,'name');
if(is_array($dep) && sizeof($dep)>0) {  ?>
                <div class="home-boxas">

                    <div class="lb">DEPARTMENTS<span style="margin-left:10px;" aria-hidden="true"></span></div>  

										<?php foreach($dep as $key=>$d) {	?>
                    <a href="<?php echo $d["url"]; ?>">
                        <div class="tile <?php echo (isset($d["bgcolor"]) && $d["bgcolor"]!="")?$d["bgcolor"]:"bg-red-sunglo"; ?>">
                            <div class="tile-body">
											<?php // echo $menu["icon"] ?>
                            </div>
                        </div></a>	

										<?php } ?>
                </div>
                           <?php } ?>	
						   
						   <?php 
$dep = $this->General->subval_sort($activity,'name');
//if(is_array($dep) && sizeof($dep)>0) {
  if(is_array($dep) && sizeof($dep)>0 && $authUser["ROLE_ID"]!=LIBRARY_ID && $authUser["ROLE_ID"]!=TRANSPORTATION_ID
	 && $authUser["ROLE_ID"]!=STORE_ID && $authUser["ROLE_ID"]!=ACCOUNT_ID && $authUser["ROLE_ID"]!=HR_ID ) {

	?>
                <div class="home-boxas">

                    <div class="lb">ACTIVITY<span style="margin-left:10px;" aria-hidden="true"></span></div>  

										<?php foreach($dep as $key=>$d) {	?>
                    <a href="<?php echo $d["url"]; ?>">
                        <div class="tile <?php echo (isset($d["bgcolor"]) && $d["bgcolor"]!="")?$d["bgcolor"]:"bg-red-sunglo"; ?>">
                            <div class="tile-body">
											<?php // echo $menu["icon"] ?>
                            </div>
                        </div></a>	

										<?php } ?>
                </div>
                           <?php } ?>

						   <?php
$user_act_report = $this->General->subval_sort($user_reports,'name');
$user_act_form = $this->General->subval_sort($user_forms,'name');
$user_act_master = $this->General->subval_sort($user_master,'name');

if( ( (is_array($user_act_report) && sizeof($user_act_report)>0) || (is_array($user_act_form) && sizeof($user_act_form)>0)
	  || (is_array($user_act_master) && sizeof($user_act_master)>0) ) && ($authUser["ROLE_ID"]==LIBRARY_ID || $authUser["ROLE_ID"]==TRANSPORTATION_ID
	  || $authUser["ROLE_ID"]==STORE_ID || $authUser["ROLE_ID"]==ACCOUNT_ID || $authUser["ROLE_ID"]==HR_ID) ) {  ?>
                    
					<!-- Activity -->
                    <div class="home-boxas">
                        <div class="lb">ACTIVITY<span style="margin-left:10px;" aria-hidden="true"></span></div>
						
						<!-- Report -->
                        <div class="subdashboard_box">
                            <div class="subdashboard_heading">Reports</div>
							
							<?php foreach($user_act_report as $key=>$menu) { ?>
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
                        <!-- End: Report -->
						
						<!-- Form -->
                        <div class="subdashboard_box">
                            <div class="subdashboard_heading">Forms</div>
							
							<?php foreach($user_act_form as $key=>$menu) { ?>
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
                        <!-- End: Form -->

						<!-- Master -->
                        <div class="subdashboard_box">
                            <div class="subdashboard_heading">Master</div>
							
							<?php foreach($user_act_master as $key=>$menu) { ?>
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
						
					</div>	
                        <!-- End: Master -->
                           <?php } ?>
						<!-- End: Activity -->
						   
                            <?php 
$comm = $this->General->subval_sort($com,'name');
if(is_array($comm) && sizeof($comm)>0) {  ?>
                <div class="home-boxas">

                    <div class="lb">COMMUNICATION<span style="margin-left:10px;" aria-hidden="true"></span></div>  

										<?php foreach($com as $key=>$c) {	?>
                    <a href="<?php echo $c["url"]; ?>">
                        <div class="tile <?php echo (isset($c["bgcolor"]) && $c["bgcolor"]!="")?$c["bgcolor"]:"bg-red-sunglo"; ?>">
                            <div class="tile-body">
											<?php // echo $menu["icon"] ?>
                            </div>
                        </div></a>	

										<?php } ?>
                </div>
                           <?php } ?>	

                             <?php 
$me = $this->General->subval_sort($media,'name');
if(is_array($me) && sizeof($me)>0) {  ?>
                <div class="home-boxas">

                    <div class="lb">MEDIA<span style="margin-left:10px;" aria-hidden="true"></span></div>  

										<?php foreach($me as $key=>$m) {	?>
                    <a href="<?php echo $m["url"]; ?>">
                        <div class="tile <?php echo (isset($m["bgcolor"]) && $m["bgcolor"]!="")?$m["bgcolor"]:"bg-red-sunglo"; ?>">
                            <div class="tile-body">
											<?php // echo $menu["icon"] ?>
                            </div>
                        </div></a>	

										<?php } ?>
                </div>
                           <?php } ?>	

                           <?php 
$gen = $this->General->subval_sort($general,'name');

if(is_array($gen) && sizeof($gen)>0) {   ?>


                <div class="home-boxas">

                    <div class="lb">GENERAL SETTINGS<span style="margin-left:10px;" aria-hidden="true"></span></div>  

										<?php foreach($gen as $key=>$g) {	?>
                    <a href="<?php echo $g["url"]; ?>">
                        <div class="tile <?php echo (isset($g["bgcolor"]) && $g["bgcolor"]!="")?$g["bgcolor"]:"bg-red-sunglo"; ?>">
                            <div class="tile-body">
											<?php // echo $menu["icon"] ?>
                            </div>
                        </div></a>	

										<?php } ?>
                </div>
                           <?php } ?>

                             <?php /* 
$oth = $this->General->subval_sort($other,'name');

if(is_array($oth) && sizeof($oth)>0) {  ?>
                <div class="home-boxas">

                    <div class="lb">OTHERS<span style="margin-left:10px;" aria-hidden="true"></span></div>  

										<?php foreach($oth as $key=>$o) {	?>
                    <a href="<?php echo $o["url"]; ?>">
                        <div class="tile <?php echo (isset($o["bgcolor"]) && $o["bgcolor"]!="")?$o["bgcolor"]:"bg-red-sunglo"; ?>">
                            <div class="tile-body">
											<?php // echo $menu["icon"] ?>
                            </div>
                        </div></a>	

										<?php } ?>
                </div>
                           <?php }*/ ?>		



            </div>
        </div>
    </div>
</div>		



</div>
<script>

    $(document).ready(function () {
        if ($(".dashboard_tiles").length > 0) {
            $(".dashboard_tiles").animate({
                right: "50",
            }, 1000);
        }

  <?php if(in_array($authUser["ROLE_ID"],array(STUDENT_ID,TEACHER_ID))) {  ?>

  <?php if($TotalPresent>0 || $TotalAbsent>0) {  ?>
        var background = {
            type: 'linearGradient',
            x0: 0,
            y0: 0,
            x1: 0,
            y1: 1,
            colorStops: [{offset: 0, color: '#fff'},
                {offset: 1, color: 'white'}]
        };

        $('#jqChart').jqChart({
            title: {text: ''},
            legend: {title: 'Students'},
            border: {strokeStyle: '#fff'},
            background: background,
            animation: {duration: 1},
            shadows: {
                enabled: false
            },
            series: [
                {
                    type: 'pie',
                    fillStyles: ['<?php echo PRESENT_COLOR; ?>', '<?php echo ABSENT_COLOR; ?>'],
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
<script>


    $(document).ready(function () {
        /*$(".flip").click(function () {
            $(".panel").slideToggle("slow");
        });*/

        //Left box Flip JS Code
        /*$(".box_01 .box_header").click(function () {
            $(".box_01 .box_content").slideToggle("slow");
        });
        $(".box_02 .box_header").click(function () {
            $(".box_02 .box_content").slideToggle("slow");
        });
        $(".box_03 .box_header").click(function () {
            $(".box_03 .box_content").slideToggle("slow");
        });
        $(".box_04 .box_header").click(function () {
            $(".box_04 .box_content").slideToggle("slow");
        });
        $(".box_05 .box_header").click(function () {
            $(".box_05 .box_content").slideToggle("slow");
        });
        $(".box_06 .box_header").click(function () {
            $(".box_06 .box_content").slideToggle("slow");
        });
        $(".box_07 .box_header").click(function () {
            $(".box_07 .box_content").slideToggle("slow");
        });
        $(".box_08 .box_header").click(function () {
            $(".box_08 .box_content").slideToggle("slow");
        });
        $(".box_09 .box_header").click(function () {
            $(".box_09 .box_content").slideToggle("slow");
        });
        $(".box_10 .box_header").click(function () {
            $(".box_10 .box_content").slideToggle("slow");
        });
        $(".box_11 .box_header").click(function () {
            $(".box_11 .box_content").slideToggle("slow");
        });*/


        //Scrollbar JS Code
        $('.scroll_container').slimScroll({
            height: '200px'
        });



    });
    $(document).ready(function () {
        $(".hw").click(function () {
            $(".hmw").slideToggle("slow");
        });
    });

    $(document).ready(function () {
        $(".bh").click(function () {
            $(".hb").slideToggle("slow");
        });
    });
    $(document).ready(function () {
        $(".lb").click(function () {
            $(".bl").slideToggle("slow");
        });
    });
    $(document).ready(function () {
        $(".att").click(function () {
            $(".attn").slideToggle("slow");
        });
    });

</script>