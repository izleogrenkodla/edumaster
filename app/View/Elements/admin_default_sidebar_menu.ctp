<?php

if (isset($authUser)) { ?>

<!-- datetime_section -->
<!--<div class="datetime_section">
    <div class="time">
        05:42 PM
    </div>
    <div class="date">
        Friday, 18 March 2016
    </div>
</div> End: datetime_section -->


<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->

        <ul class="page-sidebar-menu" data-auto-scroll="false" data-auto-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>
			
			<!-- PERSONAL PROFILE -->

            <li class="<?php if(in_array($this->params['action'], $PERSONAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$PERSONAL_SECTION_CONTROLLER)) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_main icn_main_personal_profile"></span>
                    <span class="title">Personal Profile</span>

                    <span class="arrow <?php if(in_array($this->params['action'],$PERSONAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$PERSONAL_SECTION_CONTROLLER)) { echo ''; } ?>"></span>
                </a>

                <ul class="sub-menu">
            <?php //if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, ACCOUNT_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID, LIBRARY_ID))) { ?>
                    <li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'profile',$authUser["ROLE_ID"])) ?>">
                            <span class="icn icn_sub icn_sub_personal_profile"></span>
                            <span class="title">Personal Profile</span>
                        </a>
                    </li>
                    <li class="<?php echo strtolower($this->params['controller']) == 'users' ? 'idcard' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'idcard',$authUser["ROLE_ID"])) ?>">
                            <span class="icn icn_sub icn_sub_idcard"></span>
                            <span class="title">ID Card</span>
						</a>
                    </li>					
					<li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'history',$authUser["ROLE_ID"])) ?>">
                            <span class="icn icn_sub icn_sub_acadamic_history"></span>
                            <span class="title">Academic History</span>
                        </a>
                    </li>
					
            <?php //} ?>
			
            <?php if(in_array($authUser["ROLE_ID"], array(STUDENT_ID))) { ?>
                    <li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Uploaddocument',$authUser["ROLE_ID"])) ?>">
                            <span class="icn icn_sub icn_sub_student_document"></span>
                            <span class="title">Student Documents</span>
						</a>
                    </li>
            <?php  }else { ?>
                    <li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'StaffUploadDocument',$authUser["ROLE_ID"])) ?>">
                            <span class="icn icn_sub icn_sub_staff_upload_document"></span>
                            <span class="title">Staff Documents</span>
						</a>
                    </li>
            <?php  } ?>	            
                </ul>
            </li>

			
			
			<!-- DEPARTMENTS -->
			
            <li class="<?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_main icn_main_departments"></span>
                    <span class="title">Departments</span>

                    <span class="arrow <?php if(in_array($this->params['action'],$DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                    </span>
                </a>

                <ul class="sub-menu">
            <?php //if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, FRONT_ID))) { ?>
					
					<?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==SUPERVISOR_ID || $authUser["ROLE_ID"]==ACCOUNT_ID
							 || $authUser["ROLE_ID"]==SUPERVISOR_ID || $authUser["ROLE_ID"]==ACCOUNT_ID
					) { ?>
                    <li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users',"action"=>"admission_section")) ?>">
                            <span class="icn icn_sub icn_sub_admission_section"></span>
                            <span class="title">Admission</span>
						</a>
                    </li>
					<?php  } ?>
					<?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==STUDENT_ID || $authUser["ROLE_ID"]==TEACHER_ID
							 || $authUser["ROLE_ID"]==SUPERVISOR_ID || $authUser["ROLE_ID"]==ACCOUNT_ID
					) { ?>
					<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users',"action"=>"fees_section")) ?>">
                            <span class="icn icn_sub icn_sub_fees"></span>
                            <span class="title">Fees</span>
						</a>
                    </li>
					<?php  } ?>
					<?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==STUDENT_ID) { ?>
					<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users',"action"=>"transport_section")) ?>">
                            <span class="icn icn_sub icn_sub_transport"></span>
                            <span class="title">Transport</span>
						</a>
                    </li>
					<?php  } ?>
					<?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==STUDENT_ID || $authUser["ROLE_ID"]==TEACHER_ID
							 || $authUser["ROLE_ID"]==SUPERVISOR_ID || $authUser["ROLE_ID"]==TRANSPORTATION_ID || $authUser["ROLE_ID"]==ACCOUNT_ID
							 || $authUser["ROLE_ID"]==STORE_ID || $authUser["ROLE_ID"]==HR_ID
					) { ?>
					<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users',"action"=>"library_section")) ?>">
                            <span class="icn icn_sub icn_sub_library"></span>
                            <span class="title">Library</span>
						</a>
                    </li>
					<?php  } ?>
					<?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==TEACHER_ID || $authUser["ROLE_ID"]==SUPERVISOR_ID
							 || $authUser["ROLE_ID"]==LIBRARY_ID || $authUser["ROLE_ID"]==TRANSPORTATION_ID || $authUser["ROLE_ID"]==ACCOUNT_ID
							 || $authUser["ROLE_ID"]==HR_ID 
					) { ?>
					<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users',"action"=>"store_section")) ?>">
                            <span class="icn icn_sub icn_sub_store_purchase"></span>
                            <span class="title">Store & Purchase</span>
						</a>
                    </li>
					<?php  } ?>
					<?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==TEACHER_ID || $authUser["ROLE_ID"]==SUPERVISOR_ID
							 || $authUser["ROLE_ID"]==LIBRARY_ID || $authUser["ROLE_ID"]==TRANSPORTATION_ID || $authUser["ROLE_ID"]==STORE_ID
							 || $authUser["ROLE_ID"]==HR_ID 
					) { ?>
					<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users',"action"=>"account_section")) ?>">
                            <span class="icn icn_sub icn_sub_accounts"></span>
                            <span class="title">Accounts</span>
						</a>
                    </li>
					<?php  } ?>
					<?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==TEACHER_ID || $authUser["ROLE_ID"]==SUPERVISOR_ID
							 || $authUser["ROLE_ID"]==LIBRARY_ID || $authUser["ROLE_ID"]==TRANSPORTATION_ID || $authUser["ROLE_ID"]==ACCOUNT_ID
							 || $authUser["ROLE_ID"]==STORE_ID 
					) { ?>
					<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users',"action"=>"hr_section")) ?>">
                            <span class="icn icn_sub icn_sub_hr"></span>
                            <span class="title">HR</span>
						</a>
                    </li>
					<?php  } ?>
					<?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==STUDENT_ID || $authUser["ROLE_ID"]==TEACHER_ID
							 || $authUser["ROLE_ID"]==SUPERVISOR_ID
					) { ?>
					<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users',"action"=>"exam_section")) ?>">
                            <span class="icn icn_sub icn_sub_exams"></span>
                            <span class="title">Exams</span>
						</a>
                    </li>
					<?php  } ?>
					<?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
					<!--<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users',"action"=>"generate_documents")) ?>">
                            <span class="icn icn_sub icn_sub_generate_documents"></span>
                            <span class="title">Generate Documents</span>
						</a>
                    </li>-->
					<?php  } ?>
					<?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==TEACHER_ID || $authUser["ROLE_ID"]==SUPERVISOR_ID
							 || $authUser["ROLE_ID"]==HR_ID
					) { ?>
					<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users',"action"=>"userlist_section")) ?>">
                            <span class="icn icn_sub icn_sub_user_list"></span>
                            <span class="title">User List</span>
						</a>
                    </li>
					<?php  } ?>
            <?php //} ?>

        </ul>
        </li>

		<!-- ACTIVITY -->
		
		<li class="<?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_main icn_main_activity"></span>
                    <span class="title">Activity</span>

                    <span class="arrow <?php if(in_array($this->params['action'],$DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                    </span>
                </a>

                <ul class="sub-menu">
            <?php //if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, FRONT_ID))) { ?>
                    <li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users',"action"=>"event_section")) ?>">
                            <span class="icn icn_sub icn_sub_events"></span>
                            <span class="title">Events</span>
						</a>
                    </li>
					<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'TeacherTimeTables')) ?>">
                            <span class="icn icn_sub icn_sub_time_table"></span>
                            <span class="title">Teacher Time Table</span>
						</a>
                    </li>
					<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Classwork')) ?>">
                            <span class="icn icn_sub icn_sub_class_work"></span>
                            <span class="title">Class Work</span>
						</a>
                    </li>
					<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Homeworks')) ?>">
                            <span class="icn icn_sub icn_sub_home_work"></span>
                            <span class="title">Home Work</span>
						</a>
                    </li>
					<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'leaveApplications')) ?>">
                            <span class="icn icn_sub icn_sub_leave_application"></span>
                            <span class="title">Leave Application</span>
						</a>
                    </li>
					<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users',"action"=>"attendance_listing")) ?>">
                            <span class="icn icn_sub icn_sub_attendance"></span>
                            <span class="title">Attendance</span>
						</a>
                    </li>					
					<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users',"action"=>"remark",$authUser["ROLE_ID"])) ?>">
                            <span class="icn icn_sub icn_sub_remarks"></span>
                            <span class="title">Remarks</span>
						</a>
                    </li>
            <?php //} ?>

        </ul>
        </li>
	
		<!-- COMMUNICATION -->
	
        <li class="<?php if(in_array($this->params['action'], $COMMUNICATION_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$COMMUNICATION_SECTION_CONTROLLER)) { echo ''; } ?>">
            <a href="javascript:;">
                <span class="icn icn_main icn_main_communication"></span>
                <span class="title">Communication</span>
                <span class="selected"></span>
                <span class="arrow
            <?php if(in_array($this->params['action'],$COMMUNICATION_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$COMMUNICATION_SECTION_CONTROLLER)) { echo ''; } ?>">
                </span>
            </a>

            <ul class="sub-menu">
          <?php //if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, ACCOUNT_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID, LIBRARY_ID))) { ?>
				<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
					<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'suggestions')) ?>">
						<span class="icn icn_sub icn_sub_user_suggestion"></span>
						<span class="title">User Suggestion</span>
					</a>
				</li>
				<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
					<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Mailer')) ?>">
						<span class="icn icn_sub icn_sub_mailer"></span>
						<span class="title">Mailer</span>
					</a>
				</li>
				<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
					<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'SmsComm')) ?>">
						<span class="icn icn_sub icn_sub_sms"></span>
						<span class="title">SMS</span>
					</a>
				</li>
				<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
					<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'News')) ?>">
						<span class="icn icn_sub icn_sub_news_update"></span>
						<span class="title">News & Updates</span>
					</a>
				</li>
				<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
					<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'NoticeBoard')) ?>">
						<span class="icn icn_sub icn_sub_circular"></span>
						<span class="title">Circular</span>
					</a>
				</li>
				
            </ul>
        </li>

		<!-- MEDIA -->

        <li class="<?php if(in_array($this->params['action'], $MEDIA_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$MEDIA_SECTION_CONTROLLER)) { echo ''; } ?>">
            <a href="javascript:;">
                <span class="icn icn_main icn_main_media"></span>
                <span class="title">Media</span>
                <span class="selected"></span>
                <span class="arrow <?php if(in_array($this->params['action'],$MEDIA_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$MEDIA_SECTION_CONTROLLER)) { echo ''; } ?>">
                </span>
            </a>

            <ul class="sub-menu">
          <?php //if(in_array($authUser["ROLE_ID"], array(HR_ID, SUPERVISOR_ID))) { ?>
                <li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
					<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'album')) ?>">
						<span class="icn icn_sub icn_sub_gallery"></span>
						<span class="title">Gallery</span>
					</a>
				</li>
				<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
					<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'EBook')) ?>">
						<span class="icn icn_sub icn_sub_ebook"></span>
						<span class="title">EBooks</span>
					</a>
				</li>
          <?php //} ?>                
            </ul>
        </li>
		
		<!-- GENERAL SETTINGS -->

			<?php //if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, SUPERVISOR_ID, SUPER_ADMIN_ID))) { ?>
        <li class="<?php if(in_array($this->params['action'],$GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$GENERAL_SECTION_CONTROLLER)) { echo ''; } ?>">
            <a href="javascript:;">
                <span class="icn icn_main icn_main_general_settings"></span>
                <span class="title">General Settings </span>
                <span class="selected"></span>
                <span class="arrow <?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$GENERAL_SECTION_CONTROLLER)) { echo ''; } ?>"></span>
            </a>
            <ul class="sub-menu">			
				<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
					<a href="<?php echo Router::url(array('plugin' => false, 'controller'=>"Users","action"=>"general_setting")) ?>">
						<span class="icn icn_sub icn_sub_general_setting"></span>
						<span class="title">General Setting</span>
					</a>
				</li>
				<li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
					<a href="<?php echo Router::url(array('plugin' => false, 'controller'=>"Users","action"=>"website")) ?>">
						<span class="icn icn_sub icn_sub_front_site_setting"></span>
						<span class="title">Front Site Setting</span>
					</a>
				</li>			
            </ul>
        </li>


    </ul>


    </div>
</div>


<?php }  ?> 