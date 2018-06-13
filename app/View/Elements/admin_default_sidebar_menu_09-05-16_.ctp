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

                <?php
			 			   $PERSONAL_SECTION_ACTION = array(
							'admin_add',
							'admin_edit',
							'admin_index',
							'admin_view',
							'admin_delete',
								'dailydiary',
							
							);
						   
						   $PERSONAL_SECTION_CONTROLLER = array(
							'profile',
							'idcard',
							'dailydiary',
							'history',
							'leave',
							'attendance',
							'remark',
							 'classwork',
						   'homeworks',
						   );
		   
						?>






            <li class="<?php if(in_array($this->params['action'], $PERSONAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$PERSONAL_SECTION_CONTROLLER)) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_main icn_main_myprofile"></span>
                    <span class="title">Personal Profile</span>

                    <span class="arrow <?php if(in_array($this->params['action'],$PERSONAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$PERSONAL_SECTION_CONTROLLER)) { echo ''; } ?>"></span>
                </a>

                <ul class="sub-menu">
            <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, ACCOUNT_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID, LIBRARY_ID))) { ?>
                    <li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'profile')) ?>">
                            <span class="icn icn_sub icn_sub_myprofile"></span>
                            <span class="title">Personal Profile</span>

                            <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                            </span>
                        </a>

                    </li>
                    <li class="<?php echo strtolower($this->params['controller']) == 'users' ? 'idcard' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'idcard')) ?>">
                            <span class="icn icn_sub icn_sub_idcard"></span>
                            <span class="title">ID Card</span>

                            <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                            </span>
                        </a>

                    </li>
            <?php } ?>
            <?php if(in_array($authUser["ROLE_ID"], array(TEACHER_ID, STUDENT_ID))) { ?>
                    <li class="<?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '')) ?>">
                            <span class="icn icn_sub icn_sub_myprofile"></span>
                            <span class="title">My Documents</span>

                            <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                            </span>
                        </a>

                    </li>
            <?php  } ?>
            <?php if(in_array($authUser["ROLE_ID"], array(STUDENT_ID, ACCOUNT_ID))) { ?>
                    <li class="<?php echo strtolower($this->params['controller']) == 'users' ? ' ' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '')) ?>">
                            <span class="icn icn_sub icn_sub_fee"></span>
                            <span class="title">Fee</span>

                            <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                            </span>
                        </a>

                    </li>
                    <li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '')) ?>">
                            <span class="icn icn_sub icn_sub_myprofile"></span>
                            <span class="title">Album</span>

                            <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                            </span>
                        </a>

                    </li>
            <?php } ?>
            <?php if(in_array($authUser["ROLE_ID"], array(TEACHER_ID, ACCOUNT_ID))) { ?>
                    <li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'student_ledger')) ?>">
                            <span class="icn icn_sub icn_sub_myprofile"></span>
                            <span class="title">Student Ledger</span>

                            <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                            </span>
                        </a>

                    </li>
            <?php } ?>
            <?php if(in_array($authUser["ROLE_ID"], array(TRANSPORTATION_ID))) { ?>
                    <li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '')) ?>">
                            <span class="icn icn_sub icn_sub_myprofile"></span>
                            <span class="title">Vehicle Profile</span>

                            <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                            </span>
                        </a>

                    </li>
            <?php } ?>
            <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, LIBRARY_ID))) { ?>
                    <!--<li class="<?php //echo strtolower($this->params['controller']) == array('admin_add', 'admin_index')? '' : '' ?>">-->
                    <li class="<?php if($this->params['action'] == array('admin_add', 'admin_index') && in_array(strtolower($this->params['controller']), $PERSONAL_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_dailydiary"></span>
                            <span class="title">Daily Diary</span>

                            <span class="arrow <?php echo strtolower($this->params['controller']) == array('homeworks', 'classwork') ? '' : '' ?>">
                            </span>
                        </a>

                        <ul class="sub-menu">
                            <li class="<?php echo strtolower($this->params['controller']) == 'homeworks' ? '' : '' ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_home_work"></span>
                                    <span class="title">Homework</span>
                                    <span class="arrow <?php echo strtolower($this->params['controller']) == 'homeworks' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'homeworks', 'action' => 'index', 'admin' => true)) ?>">
                                            <span  class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'homeworks', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                    <?php if(in_array($authUser["ROLE_ID"], array(TEACHER_ID))) { ?>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'homeworks', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'homeworks', 'action' => 'add', 'admin' => true)); ?>
                                    </li>

                    <?php  } ?>
                                </ul>
                            </li>
                            <li class="<?php echo strtolower($this->params['controller']) == 'classwork' ? '' : '' ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_class_work"></span>
                                    <span class="title">Classwork</span>

                                    <span class="arrow <?php echo strtolower($this->params['controller']) == 'classwork' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'classwork', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'classwork', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                    <?php if(in_array($authUser["ROLE_ID"], array(TEACHER_ID))) { ?>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'classwork', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'classwork', 'action' => 'add', 'admin' => true)); ?>
                                    </li>
                    <?php  } ?>
                                </ul>
                            </li>
                        </ul>
                    </li>
            <?php } ?>
            <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, ACCOUNT_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID, LIBRARY_ID))) { ?>
                    <li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'history')) ?>">
                            <span class="icn icn_sub icn_sub_acadamic_history"></span>
                            <span class="title">Academic History</span>

                            <span class="arrow <?php echo strtolower($this->params['controller']) == 'AcademicHistory' ? '' : '' ?>">
                            </span>
                        </a>
						 <ul class="sub-menu">
                                
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AcademicHistory', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                    <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Roles', 'action' => 'add', 'admin' => true)); ?>
                                </li>
                  <?php } ?>
                            </ul>

                    </li>

                    <li class="<?php if($this->params['action'] == 'admin_attendance_listing' && in_array(strtolower($this->params['controller']), $PERSONAL_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_attendance"></span>
                            <span class="title">Attendance</span>

                            <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'attendance_listing', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'attendance_listing', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>

                    <li class="<?php echo strtolower($this->params['controller']) == 'leaveapplications' ? '' : '' ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_leave_application"></span>
                            <span class="title">Leave Applications</span>

                            <span class="arrow <?php echo strtolower($this->params['controller']) == 'leaveapplications' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'leaveApplications', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'leaveApplications', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>

                    <li class="<?php if($this->params['action'] == 'admin_attendance_listing' && in_array(strtolower($this->params['controller']), $PERSONAL_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'remark')) ?>">
                            <span class="icn icn_sub icn_sub_remarks"></span>
                            <span class="title">Remarks</span>

                            <span class="arrow <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                                
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Remark', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                    <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Roles', 'action' => 'add', 'admin' => true)); ?>
                                </li>
                  <?php } ?>
                            </ul>

                    </li>
            <?php  } ?>
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_home"></span>
                            <span class="title">Back To Home</span>
                        </a>
                    </li>
                </ul>



            </li>

        <?php
					   $DEPT_SECTION_ACTION = array(
						   'admin_index',
						   'admin_add',
						   'admin_edit',
						   'admin_attendance_listing',
						   'admin_import',
						   'admin_view',
						   'admin_add_account',
						   'admin_edit_account',
						   'admin_view_account',
						   'admin_account',
						   'admin_student_ledger',
						   'admin_view_student_ledger',
						   'admin_add_student',
						   'admin_students',
						   'admin_supervisors',
						   'admin_add_supervisor',
						   'admin_teachers',
						   'admin_add_teacher',
						   'admin_attendance_listing',
						   'admin_list',
						   'admin_students',
						   'admin_add_student',
						   'admin_import',
						   'admin_view_inquiry',
						
						);
					   
					   $DEPT_SECTION_CONTROLLER = array(
						   'leaveapplications',
						   'events',
						   'teachertimetables',
						   'users',
						   'noticeboard',
						   'suggestions',
						   'vacancy',
						   'users',
						   'ebook',
						   'noticeboard',
						   'events',
						   'leaveapplications',
						   'suggestions',
						  
						   'student_ledger',
						   'transports',
						   'exams',
						   'results',
						   'library',
						   'account',
						   'fees',
						   'feetypes',
						   'paymenttypes',
						   'exams',
						   'exam_types',
						   'holidays',
						   'events',
						   'subjects',
						   'transports',
						   'admissionforms',
						   'appadmission',
											   
					   );
	   
					?>

					<?php 
					   $HR_SECTION_ACTION = array(
					   'admin_index',
					   'admin_add',
					   'admin_edit',
					   'admin_attendance_listing',
					   'admin_import',
					   'admin_view'
					   );
					   
					   $HR_SECTION_CONTROLLER = array(
					   'leaveapplications',
					   'events',
					   'teachertimetables',
					   'users',
					   'noticeboard',
					   'suggestions',
					   'vacancy'
					   );	   
					?>

					<?php
	   
					   $TEACHER_SECTION_ACTION = array(
					   'admin_index',
					   'admin_add',
					   'admin_edit',
					   'admin_add_student',
					   'admin_students',
					   'admin_supervisors',
					   'admin_add_supervisor',
					   'admin_teachers',
					   'admin_add_teacher',
					   'admin_attendance_listing',
					   'admin_list',
					   
					   
					   );
					   
					   $TEACHER_SECTION_CONTROLLER = array(
					   'users',
					   'ebook',
					   'noticeboard',
					   'events',
					   'leaveapplications',
					   'suggestions',
					   'classwork',
					   'homeworks',
					   'student_ledger',
					   'transports',
					   'exams',
					   'results'
					   
					   );	   
					   ?>

						<?php
					   $ACCOUNT_SECTION_ACTION = array(
						'admin_index',
						'admin_add',
						'admin_edit',
						'admin_add_account',
						'admin_edit_account',
						'admin_view_account',
						'admin_account',
						'admin_student_ledger',
						'admin_view_student_ledger'
						);
					   
					   $ACCOUNT_SECTION_CONTROLLER = array(
					   'users',
					   'account',
					   'fees',
					   'feetypes',
					   'paymenttypes'
					   );	   
					   ?>

						<?php
					   $LIBRARY_SECTION_ACTION = array(
						'admin_add',
						'admin_edit',
						'admin_index'
						);
					   
					   $LIBRARY_SECTION_CONTROLLER = array(
					   'library',
					   'books',
					   );	   
					   ?>

						<?php
					   $SUP_SECTION_ACTION = array(
						'admin_add',
						'admin_edit',
						'admin_index',
						'admin_list',
						'admin_import',
						'admin_view_inquiry'
						);
					   
					   $SUP_SECTION_CONTROLLER = array(
					   'users',
					   'exams',
					   'exam_types',
					   'holidays',
					   'events',
					   'subjects',
					   'transports',
					   'admissionforms',
					   'appadmission'
					   );
					   ?>

					<?php
					   $STUDENT_SECTION_ACTION = array(
						'admin_add',
						'admin_edit',
						'admin_index',
						'admin_students',
						'admin_add_student'
						);
					   
					   $STUDENT_SECTION_CONTROLLER = array(
					   'users',
					   'appadmission',
					   'admissionforms',
					   'fees'
					   );
					   
					?>


					<?php 
					$TRANSPORT_SECTION_ACTION = array(
						'admin_add',
						'admin_edit',
						'admin_index',
						
						);
					   
					   $TRANSPORT_SECTION_CONTROLLER = array(
					   
					   );
					   
					?>

					<?php 
					$STORE_SECTION_ACTION = array(
						'admin_add',
						'admin_edit',
						'admin_index',
						
						);
					   
					   $STORE_SECTION_CONTROLLER = array(
					   
					   );
					   
					?>

					<?php 
					$HOSTEL_SECTION_ACTION = array(
						'admin_add',
						'admin_edit',
						'admin_index',
						
						);
					   
					   $HOSTEL_SECTION_CONTROLLER = array(
					   
					   );
					   
					?>

					<?php 
					$CANTEEN_SECTION_ACTION = array(
						'admin_add',
						'admin_edit',
						'admin_index',
						
						);
					   
					   $CANTEEN_SECTION_CONTROLLER = array(
					   
					   );
					   
					?>

					<?php 
					$SECURITY_SECTION_ACTION = array(
						'admin_add',
						'admin_edit',
						'admin_index',
						
						);
					   
					   $SECURITY_SECTION_CONTROLLER = array(
					   
					   );
					   
					?>

					<?php 
					$ADMISSION_SECTION_ACTION = array(
						'admin_add',
						'admin_edit',
						'admin_index',
						
						);
					   
					   $ADMISSION_SECTION_CONTROLLER = array(
					   
					   );
					   
					?>

					<?php 
					$FRONT_SECTION_ACTION = array(
						'admin_add',
						'admin_edit',
						'admin_index',
						
						);
					   
					   $FRONT_SECTION_CONTROLLER = array(
					   
					   );
					   
					?>





            <li class="<?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_main icn_main_store_purchase"></span>
                    <span class="title">Departments</span>

                    <span class="arrow <?php if(in_array($this->params['action'],$DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                    </span>
                </a>

                <ul class="sub-menu">
            <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, FRONT_ID))) { ?>

                    <li class="<?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_exam_result"></span>
                            <span class="title">Exam & Result</span>

                            <span class="arrow <?php if(in_array($this->params['action'],$DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>

                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_home"></span>
                                    <span class="title">Back To Home</span>
                                </a>
                            </li>
                        </ul>
                    </li>
            <?php } ?>

            <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, ACCOUNT_ID, TRANSPORTATION_ID, STORE_ID, FRONT_ID, SECURITY_ID, LIBRARY_ID))) { ?>

                    <li class="<?php 
			if(in_array($this->params['action'], $TEACHER_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$TEACHER_SECTION_CONTROLLER) && in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_teacher"></span>
                            <span class="title">Teacher Section</span>

                            <span class="arrow <?php if(in_array($this->params['action'],$TEACHER_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$TEACHER_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>

                        <ul class="sub-menu">

                            <li class=" <?php if(in_array($this->params['action'], array('admin_students', 'admin_add_student'))) { echo ''; } ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_section"></span>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                    <span class="title">Admission Section</span>

                    <?php }  elseif($authUser["ROLE_ID"]==STUDENT_ID) { ?>
                                    <span class="title">Classmate Section</span>

                    <?php } elseif($authUser["ROLE_ID"]==TEACHER_ID) { ?>
                                    <span class="title">Student Section</span>
                    <?php }else { ?>
                                    <span class="title">Student Section</span>
                    <?php } ?>

                                    <span class="arrow <?php echo in_array($this->params['action'], array('admin_students', 'admin_add_student')) ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'students', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'students', 'admin' => true)); ?>
                                    </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'StudentRegistration', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New Student', array('plugin' => false, 'controller' => 'Users', 'action' => 'add_student', 'admin' => true)); ?>
                                    </li>
                    <?php } ?>
                                </ul>
                            </li>

                            <li class=" <?php echo strtolower($this->params['controller']) == 'ebook' ? '' : '' ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_ebook"></span>
                                    <span class="title">Manage Ebook</span>

                                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'ebook' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'EBook', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'EBook', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'EBook', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'EBook', 'action' => 'add', 'admin' => true)); ?>
                                    </li>
                    <?php } ?>
                                </ul>
                            </li>

                            <li class="<?php echo strtolower($this->params['controller']) == 'noticeboard' ? '' : '' ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_notice_board"></span>
                                    <span class="title">Notice Board</span>

                                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'noticeboard' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'add', 'admin' => true)); ?>
                                    </li>
                    <?php } ?>

                                </ul>
                            </li>

                            <li class="<?php echo strtolower($this->params['controller']) == 'events' ? '' : '' ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_events"></span>
                                    <span class="title">Manage Events</span>

                                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'events' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Events', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Events', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Events', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Events', 'action' => 'add', 'admin' => true)); ?>
                                    </li>
                    <?php } ?>
                                </ul>
                            </li>

                            <li class="<?php if(in_array($this->params['action'], array('admin_supervisors', 'admin_add_supervisor')) && strtolower($this->params['controller']) == 'users') { echo ''; } ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_supervisor"></span>
                                    <span class="title">Supervisor Section</span>

                                    <span class="arrow"
                      <?php echo in_array($this->params['action'], array('admin_supervisors', 'admin_add_supervisor')) ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'supervisors', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'supervisors', 'admin' => true)); ?>
                                    </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'add_supervisor', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Users', 'action' => 'add_supervisor', 'admin' => true)); ?>
                                    </li>
                    <?php } ?>
                                </ul>
                            </li>

                            <li class="<?php if(in_array($this->params['action'], array('admin_teachers','admin_add_teacher')) && strtolower($this->params['controller']) == 'users') { echo ''; } ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_teacher"></span>
                                    <span class="title">Teacher Section</span>

                                    <span class="arrow
                      <?php echo in_array($this->params['action'], array('admin_teachers','admin_add_teacher')) ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'teachers', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'teachers', 'admin' => true)); ?>
                                    </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'add_teacher', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Users', 'action' => 'add_teacher', 'admin' => true)); ?>
                                    </li>
                    <?php } ?>
                                </ul>
                            </li>

                            <li class="<?php echo strtolower($this->params['controller']) == 'leaveapplications' ? '' : '' ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_leave_application"></span>
                                    <span class="title">Leave Applications</span>

                                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'leaveapplications' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'leaveApplications', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'leaveApplications', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                                </ul>
                            </li>

                            <li class="<?php echo strtolower($this->params['controller']) == 'suggestions' ? '' : '' ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_user_suggestion"></span>
                                    <span class="title">User Suggestion</span>

                                    <span class="arrow <?php echo strtolower($this->params['controller']) == 'suggestions' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'suggestions', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'suggestions', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                                </ul>
                            </li>

                            <li class="<?php if(strtolower($this->params['controller']) == 'teachertimetables') { echo ''; } ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_time_table"></span>
                    <?php if($authUser["ROLE_ID"]==STUDENT_ID) {  ?>
                                    <span class="title">Time Table</span>
                    <?php }else{ ?>
                                    <span class="title">Assign Time Table</span>
                    <?php } ?>

                                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'teachertimetables' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                    <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID))) {  ?>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'add', 'admin' => true)); ?>
                                    </li>
                    <?php } ?>

                                </ul>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_home"></span>
                                    <span class="title">Back To Home</span>
                                </a>
                            </li>
                        </ul>

                    </li>
            <?php  } ?>

            <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, TEACHER_ID, SUPERVISOR_ID, STUDENT_ID, ACCOUNT_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID))) { ?>

                    <li class="<?php 
			if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $STUDENT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$STUDENT_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_student"></span>
                            <span class="title">Student Section</span>

                            <span class="arrow"
                  <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li class="<?php echo strtolower($this->params['controller']) == 'appadmission' ? '' : '' ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_app_admission"></span>
                                    <span class="title">App Admission</span>

                                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'appadmission' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                                </ul>
                            </li>

                            <li class="<?php echo strtolower($this->params['controller']) == 'admissionforms' ? '' : '' ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_admission_section"></span>
                                    <span class="title">Admission Forms</span>

                                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'admissionforms' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                       <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AdmissionForms', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'AdmissionForms', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AdmissionForms', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'AdmissionForms', 'action' => 'add', 'admin' => true)); ?>
                                    </li>
                    <?php } ?>
                                </ul>
                            </li>

                            <li class="<?php if(in_array($this->params['action'], array('admin_students', 'admin_add_student'))) { echo ''; } ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_section"></span>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                    <span class="title">Admission Section</span>

                    <?php }  elseif($authUser["ROLE_ID"]==STUDENT_ID) { ?>
                                    <span class="title">Classmate Section</span>

                    <?php } elseif($authUser["ROLE_ID"]==TEACHER_ID) { ?>
                                    <span class="title">Student Section</span>
                    <?php }else { ?>
                                    <span class="title">Student Section</span>
                    <?php } ?>

                                    <span class="arrow"
                      <?php echo in_array($this->params['action'], array('admin_students', 'admin_add_student')) ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'students', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'students', 'admin' => true)); ?>
                                    </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'add_student', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New Student', array('plugin' => false, 'controller' => 'Users', 'action' => 'add_student', 'admin' => true)); ?>
                                    </li>
                    <?php } ?>
                                </ul>
                            </li>

                            <li class="<?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_fee"></span>
                                    <span class="title">Manage Fees</span>

                                    <span class="arrow"
                      <?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Fees', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Fees', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Fees', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Fees', 'action' => 'add', 'admin' => true)); ?>
                                    </li>
                                </ul>
                            </li>

                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_home"></span>
                                    <span class="title">Back To Home</span>
                                </a>
                            </li>
                        </ul>
                    </li>
            <?php } ?>
            <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, SUPERVISOR_ID, STUDENT_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, FRONT_ID, SECURITY_ID))) { ?>


                    <li class="<?php 
			if(in_array($this->params['action'], $TRANSPORT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$TRANSPORT_SECTION_CONTROLLER) && in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_transport"></span>
                            <span class="title">Transport Section</span>

                            <span class="arrow"
                  <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
						
							<li class="<?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_vehicle_shift"></span>
                                    <span class="title">Vehicle Shift</span>

                                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'VehicleShift' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'VehicleShift', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'VehicleShift', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'add', 'admin' => true)); ?>
                                    </li>
                                </ul>
                            </li>
							
							<li class="<?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_vehicle_type"></span>
                                    <span class="title">Vehicle Type</span>

                                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'VehicleType' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'VehicleType', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'VehicleType', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'add', 'admin' => true)); ?>
                                    </li>
                                </ul>
                            </li>
							
							<li class="<?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_vehicle_master"></span>
                                    <span class="title">Vehicle Master</span>

                                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'Vehicle' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Vehicle', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Vehicle', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'add', 'admin' => true)); ?>
                                    </li>
                                </ul>
                            </li>
							
							<li class="<?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_vehicle_route_master"></span>
                                    <span class="title">Vehicle Route Master</span>

                                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'Route' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Route', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Route', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'add', 'admin' => true)); ?>
                                    </li>
                                </ul>
                            </li>
							
							<li class="<?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_vehicle_stoppage_master"></span>
                                    <span class="title">Vehicle Stoppage Master</span>

                                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'Stoppage' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Stoppage', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Stoppage', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'add', 'admin' => true)); ?>
                                    </li>
                                </ul>
                            </li>
							
							<li class="<?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_vehicle_departure_arrival"></span>
                                    <span class="title">Vehicle Departure Arrival</span>

                                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'DepartureArrival' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'DepartureArrival', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'DepartureArrival', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'add', 'admin' => true)); ?>
                                    </li>
                                </ul>
                            </li>
							
							<li class="<?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_vehicle_expese"></span>
                                    <span class="title">Vehicle Expense</span>

                                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'VehicleExpense' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'VehicleExpense', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'VehicleExpense', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'add', 'admin' => true)); ?>
                                    </li>
                                </ul>
                            </li>
							
							<li class="<?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_vehicle_route_detels"></span>
                                    <span class="title">Vehicle Route Details</span>

                                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'VehicleRoute' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'VehicleRoute', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'VehicleRoute', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'add', 'admin' => true)); ?>
                                    </li>
                                </ul>
                            </li>
						
                            <li class="<?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_route_schedule"></span>
                                    <span class="title">Route Schedule</span>

                                    <span class="arrow"
                      <?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">

                                </ul>
                            </li>

                            <li class="<?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                                <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_driver"></span>
                                    <span class="title">Driver</span>

                                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'Drivers' ? '' : '' ?>">
                                    </span>
                                </a>
                                <ul class="sub-menu">
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Drivers', 'action' => 'index', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_view_all"></span>
                                            <span class="title">View All</span>
                                        </a>
                      <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'index', 'admin' => true)); ?>
                                    </li>
                                    <li>
                                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Drivers', 'action' => 'add', 'admin' => true)) ?>">
                                            <span class="icn icn_sub icn_sub_add"></span>
                                            <span class="title">Add New</span>
                                        </a>
                      <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'add', 'admin' => true)); ?>
                                    </li>
                                </ul>
                            </li>
                    </li>



                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_home"></span>
                            <span class="title">Back To Home</span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, TEACHER_ID, SUPERVISOR_ID, STUDENT_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, FRONT_ID,SECURITY_ID))) { ?>
            <li class="<?php 
		if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $LIBRARY_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $LIBRARY_SECTION_CONTROLLER)) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_library"></span>
                    <span class="title">Library Section</span>

                    <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                    </span>
                </a>
                <ul class="sub-menu">

                    <li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_library"></span>
                            <span class="title">Manage Library</span>

                            <span class="arrow"
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Library', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_library"></span>
                                    <span class="title">Issue Book</span>
                                </a>
                                <?php // echo $this->Html->link('Issue Book', array('plugin' => false, 'controller' => 'Library', 'action' => 'add', 'admin' => true)); ?>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Library', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Library', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>

                    <li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_ebook"></span>
                            <span class="title">Book Master</span>

                            <span class="arrow"
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Books', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Books', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                            </li>
                        </ul>
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_library_member"></span>
                            <span class="title">Library Member</span>

                            <span class="arrow"
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
						<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID,LIBRARY_ID))) { ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                            </li>
						<?php } ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                            </li>
                        </ul>
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_group_master"></span>
                            <span class="title">Group Master</span>

                            <span class="arrow"
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
						<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID,LIBRARY_ID))) { ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                            </li>
						<?php } ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                            </li>
                        </ul>
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_publisher_master"></span>
                            <span class="title">Publisher Master</span>

                            <span class="arrow"
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
						<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID,LIBRARY_ID))) { ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                            </li>
						<?php } ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                            </li>
                        </ul>
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_library_transaction"></span>
                            <span class="title">Library Transaction</span>

                            <span class="arrow"
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                            </li>
                        </ul>
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_bookbank_transaction"></span>
                            <span class="title">Bookbank Transaction</span>

                            <span class="arrow"
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
						<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID,LIBRARY_ID))) { ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                            </li>
						<?php } ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                            </li>
                        </ul>
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_news_update"></span>
                            <span class="title">News Paper</span>

                            <span class="arrow"
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
						<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID,LIBRARY_ID))) { ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                            </li>
						<?php } ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                            </li>
                        </ul>
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_serial_news_paper"></span>
                            <span class="title">Serial News Paper</span>

                            <span class="arrow"
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
						<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID,LIBRARY_ID))) { ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                            </li>
						<?php } ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                            </li>
                        </ul>
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_subscription"></span>
                            <span class="title">Subscription</span>

                            <span class="arrow"
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
						<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID,LIBRARY_ID))) { ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                            </li>
						<?php } ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                            </li>
                        </ul>
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_receive_serial"></span>
                            <span class="title">Receive Serial</span>

                            <span class="arrow
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
						<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID,LIBRARY_ID))) { ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                            </li>
						<?php } ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                            </li>
                        </ul>
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
							<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_sms"></span>
                            <span class="title">SMS</span>

                            <span class="arrow"
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                       
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
							<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_bulk_editing"></span>
                            <span class="title">Bulk Editing</span>

                            <span class="arrow"
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                       
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
							<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_library_verification"></span>
                            <span class="title">Library Verification</span>

                            <span class="arrow"
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                       
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
							<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_library_visitor_records"></span>
                            <span class="title">Library Visitor Records</span>

                            <span class="arrow"
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                       
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
							<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_fine_collection"></span>
                            <span class="title">Fine Collection</span>

                            <span class="arrow
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                       
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_library_item_master"></span>
                            <span class="title">Library Item</span>

                            <span class="arrow
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
						<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID,LIBRARY_ID))) { ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                            </li>
						<?php } ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_home"></span>
                            <span class="title">Back To Home</span>
                        </a>
                    </li>

                </ul>
            </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, TEACHER_ID, SUPERVISOR_ID, STUDENT_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID,SECURITY_ID))) { ?>
            <li class="<?php 
		if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $SUP_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $SUP_SECTION_CONTROLLER)) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_supervisor"></span>
                    <span class="title">Supervisors Section</span>

                    <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li class="
              <?php echo strtolower($this->params['controller']) == 'exams' ? '' : '' ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_exam_result"></span>
                            <span class="title">Exams</span>

                            <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'exams' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'exams', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                  <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'exams', 'action' => 'add', 'admin' => true)); ?>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'exams', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'exams', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                            
                        </ul>
                    </li>

                    <li class="<?php echo $this->params['controller'] == 'ExamTypes' ? '' : ''; ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_exam_type"></span>
                            <span class="title">Exam Type</span>

                            <span class="arrow"
                  <?php echo $this->params['controller'] == 'ExamTypes' ? '' : ''; ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'ExamTypes', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                  <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'ExamTypes', 'action' => 'add', 'admin' => true)); ?>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'ExamTypes', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'ExamTypes', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>

                    <li class="<?php echo $this->params['controller'] == 'Holidays' ? '' : '' ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_holiday"></span>
                            <span class="title">Holidays</span>

                            <span class="arrow"
                  <?php echo $this->params['controller'] == 'Holidays' ? '' : ''; ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Holidays', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                  <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Holidays', 'action' => 'add', 'admin' => true)); ?>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Holidays', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Holidays', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>

                    <li class="<?php echo strtolower($this->params['controller']) == 'events' ? '' : '' ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_events"></span>
                            <span class="title">Manage Events</span>

                            <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'events' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Events', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Events', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Events', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                  <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Events', 'action' => 'add', 'admin' => true)); ?>
                            </li>
                <?php } ?>
                        </ul>
                    </li>

                    <li class="<?php if($this->params['action'] == 'admin_import' && in_array(strtolower($this->params['controller']), $SUP_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_imports"></span>
                            <span class="title">Import</span>

                            <span class="arrow"
                  <?php if($this->params['action'] == 'admin_import' && in_array(strtolower($this->params['controller']), $SUP_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                  <?php echo $this->Html->link('Bulk Import', array('plugin' => false, 'controller' => 'Users', 'action' => 'import', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>

                    <li class="<?php echo strtolower($this->params['controller']) == 'subjects' ? '' : '' ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_subject"></span>
                            <span class="title">Manage Subject</span>

                            <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'subjects' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'subjects', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'subjects', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'subjects', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                  <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'subjects', 'action' => 'add', 'admin' => true)); ?>
                            </li>
                <?php } ?>
                        </ul>
                    </li>

                    <li class="<?php echo strtolower($this->params['controller']) == 'transports' ? '' : '' ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_transport"></span>
                            <span class="title">Transports</span>

                            <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'transports' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'transports', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'transports', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>

                    <li class="<?php echo strtolower($this->params['controller']) == 'admissionforms' ? '' : '' ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_admission_section"></span>
                            <span class="title">Admission Forms</span>

                            <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'admissionforms' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AdmissionForms', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'AdmissionForms', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AdmissionForms', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                  <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'AdmissionForms', 'action' => 'add', 'admin' => true)); ?>
                            </li>
                <?php } ?>
                        </ul>
                    </li>

                    <li class="<?php echo strtolower($this->params['controller']) == 'appadmission' ? '' : '' ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_app_admission"></span>
                            <span class="title">App Admission</span>

                            <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'appadmission' ? 'open' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AdmissionForms', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_home"></span>
                            <span class="title">Back To Home</span>
                        </a>
                    </li>

                </ul>
            </li>
        <?php } ?>
      <!--   <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID,SECURITY_ID))) { ?>
            <li class="<?php 
		if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $STORE_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $STORE_SECTION_CONTROLLER)) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_store_purchase"></span>
                    <span class="title">Store & Purchase</span>

                    <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                    </span>
                </a>
                <ul class="sub-menu">
				
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_store_purchase"></span>
                            <span class="title">Store Category</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                       
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_store_purchase"></span>
                            <span class="title">Store Item</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                       
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_store_purchase"></span>
                            <span class="title">Department</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                       
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_store_purchase"></span>
                            <span class="title">Vender</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                       
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_store_purchase"></span>
                            <span class="title">Vender Payment</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                       
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_store_purchase"></span>
                            <span class="title">Tender</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                       
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_store_purchase"></span>
                            <span class="title">Received Quotation</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                       
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_store_purchase"></span>
                            <span class="title">Item Distribution</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                       
                    </li>
					
					<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_store_purchase"></span>
                            <span class="title">Purchase Order</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                       
                    </li>
				
				
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_home"></span>
                            <span class="title">Back To Home</span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?> -->
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, SUPERVISOR_ID, STUDENT_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID,SECURITY_ID))) { ?>
            <li class="<?php 
		if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $ACCOUNT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $ACCOUNT_SECTION_CONTROLLER)) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_accounts"></span>
                    <span class="title">Account Section</span>

                    <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                    </span>
                </a>
                <ul class="sub-menu">
				
				<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="javascript:;">
                            <span class="icn icn_sub icn_sub_account_groups_master"></span>
                            <span class="title">Account Groups</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
						<ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountGroups', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>                  
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountGroups', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>                  
                            </li>
                        </ul>
                       
                </li>
				
				<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="javascript:;">
                            <span class="icn icn_sub icn_sub_account_departments_master"></span>
                            <span class="title">Account Departments</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
						<ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountDepartments', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>                  
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountDepartments', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>                  
                            </li>
                        </ul>                       
                </li>
				
				<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="javascript:;">
                            <span class="icn icn_sub icn_sub_account_names_master"></span>
                            <span class="title">Account Names</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
						<ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountNames', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>                  
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountNames', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>                  
                            </li>
                        </ul>                       
                </li>
				
				<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="javascript:;">
                            <span class="icn icn_sub icn_sub_account_payment_types_master"></span>
                            <span class="title">Account Payment Types</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
						<ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountPaymentTypes', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>                  
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountPaymentTypes', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>                  
                            </li>
                        </ul>                       
                </li>
				
				<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="javascript:;">
                            <span class="icn icn_sub icn_sub_account_ledger_creation"></span>
                            <span class="title">Account Ledger Creation</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountLedgerDetails', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>                  
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountLedgerDetails', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>                  
                            </li>
                        </ul>
                </li>
				
				<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="javascript:;">
                            <span class="icn icn_sub icn_sub_account_ledger_report"></span>
                            <span class="title">Account Ledger Report</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
						<ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountLedgerDetails', 'action' => 'report', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>                  
                            </li>                            
                        </ul>                       
                </li>
				
				<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="javascript:;">
                            <span class="icn icn_sub icn_sub_bank_reconciliation_statement"></span>
                            <span class="title">Bank Reconciliation Statement</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountBankReconciliationStatements', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>                  
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountBankReconciliationStatements', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>                  
                            </li>
                        </ul>
                </li>
				
				<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="javascript:;">
                            <span class="icn icn_sub icn_sub_bank_reconciliation_statement_report"></span>
                            <span class="title">Bank Reconciliation Statement Report</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountBankReconciliationStatements', 'action' => 'report', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>                  
                            </li>                            
                        </ul>
                </li>
				
				<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="javascript:;">
                            <span class="icn icn_sub icn_sub_account_trial_balance"></span>
                            <span class="title">Account Trial Balance</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountTrialBalances', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>                  
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountTrialBalances', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>                  
                            </li>
                        </ul>
                </li>
				
				<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="javascript:;">
                            <span class="icn icn_sub icn_sub_account_trial_balance_report"></span>
                            <span class="title">Account Trial Balance Report</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountTrialBalances', 'action' => 'report', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>                  
                            </li>                            
                        </ul>
                </li>
								
				<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="javascript:;">
                            <span class="icn icn_sub icn_sub_account_balance_sheet_heads_master"></span>
                            <span class="title">Account Balance Sheet Heads</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountBalanceSheetHeads', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>                  
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountBalanceSheetHeads', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>                  
                            </li>
                        </ul>
                </li>
				
				<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="javascript:;">
                            <span class="icn icn_sub icn_sub_account_balance_sheet_sub_heads_master"></span>
                            <span class="title">Account Balance Sheet Sub Heads</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountBalanceSheetSubHeads', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>                  
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountBalanceSheetSubHeads', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>                  
                            </li>
                        </ul>
                </li>
				
				<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="javascript:;">
                            <span class="icn icn_sub icn_sub_account_balance_sheet_details"></span>
                            <span class="title">Account Balance Sheet Details</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountBalanceSheetDetails', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>                  
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountBalanceSheetDetails', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>                  
                            </li>
                        </ul>
                </li>
				
				<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="javascript:;">
                            <span class="icn icn_sub icn_sub_account_balance_sheet_report"></span>
                            <span class="title">Account Balance Sheet Report</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountBalanceSheetDetails', 'action' => 'report', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>                  
                            </li>                            
                        </ul>
                </li>
				
				<!--<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_account_cash_book_report"></span>
                            <span class="title">Cash Book Report</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                       
                </li>
				
				<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_account_bank_book_report"></span>
                            <span class="title">Bank Book Report</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                       
                </li>-->
								
				<li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
						<a href="javascript:;">
                            <span class="icn icn_sub icn_sub_account_budget"></span>
                            <span class="title">Account Budget</span>

                            <span class="arrow<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AccountLedgerDetails', 'action' => 'account_budget', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>                  
                            </li>                            
                        </ul>
                </li>
				
				
                    <li class="
              <?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_fee"></span>
                            <span class="title">Manage Fees</span>

                            <span class="arrow"
                  <?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Fees', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Fees', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Fees', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                  <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Fees', 'action' => 'add', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if(in_array($this->params['controller'], array('FeeTypes'))) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_accounts"></span>
                            <span class="title">Manage Fees Type</span>

                            <span class="arrow"
                  <?php if(in_array($this->params['controller'], array('FeeTypes'))) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'FeeTypes', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'FeeTypes', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'FeeTypes', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                  <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'FeeTypes', 'action' => 'add', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if(in_array($this->params['controller'], array('PaymentTypes'))) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_fee_type"></span>
                            <span class="title">Payment Terms</span>

                            <span class="arrow"
                  <?php if(in_array($this->params['controller'], array('PaymentTypes'))) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'PaymentTypes', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'PaymentTypes', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'PaymentTypes', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                  <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'PaymentTypes', 'action' => 'add', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php if(in_array($this->params['action'], array('admin_student_ledger'))) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_student"></span>
                            <span class="title">Students Ledger</span>

                            <span class="arrow"
                  <?php echo strtolower($this->params['action']) == 'student_ledger' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'student_ledger', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'student_ledger', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_home"></span>
                            <span class="title">Back To Home</span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID,SECURITY_ID))) { ?>
<!--<li class="<?php 
		if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $FRONT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $FRONT_SECTION_CONTROLLER)) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_front_office"></span>
                    <span class="title">Front Office</span>

                    <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="
                <?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_home"></span>
                            <span class="title">Back To Home</span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>  -->
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID,SECURITY_ID))) { ?>
            <li class="<?php 
		if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $HR_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $HR_SECTION_CONTROLLER)) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_hr"></span>
                    <span class="title">HR Section</span>

                    <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                    </span>
                </a>
                <ul class="sub-menu">
				
				<li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '')) ?>">
                        <span class="icn icn_sub icn_sub_promotion"></span>
                        <span class="title">Promotion</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        </span>
                    </a>

                </li>

<li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '')) ?>">
                        <span class="icn icn_sub icn_sub_demotion"></span>
                        <span class="title">Demotion</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        </span>
                    </a>

                </li>

<li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '')) ?>">
                        <span class="icn icn_sub icn_sub_termination"></span>
                        <span class="title">Termination</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        </span>
                    </a>

                </li>			

<li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '')) ?>">
                        <span class="icn icn_sub icn_sub_employee_performance"></span>
                        <span class="title">Employee Performance</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        </span>
                    </a>

                </li>	

<li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '')) ?>">
                        <span class="icn icn_sub icn_sub_admission_inquiry"></span>
                        <span class="title">Inquiry</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        </span>
                    </a>

                </li>		

<li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '')) ?>">
                        <span class="icn icn_sub icn_sub_document_checklist"></span>
                        <span class="title">Document Checklist</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        </span>
                    </a>

                </li>	

<li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '')) ?>">
                        <span class="icn icn_sub icn_sub_contact_list"></span>
                        <span class="title">Allowance</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        </span>
                    </a>

                </li>		

<li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '')) ?>">
                        <span class="icn icn_sub icn_sub_salary_generation"></span>
                        <span class="title">Salary Generation</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        </span>
                    </a>

                </li>					
				
                    <li class="<?php echo strtolower($this->params['controller']) == 'leaveapplications' ? '' : '' ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_leave_application"></span>
                            <span class="title">Leave Applications</span>

                            <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'leaveapplications' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'leaveApplications', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'leaveApplications', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>
                    <li class="<?php echo strtolower($this->params['controller']) == 'events' ? '' : '' ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_events"></span>
                            <span class="title">Manage Events</span>

                            <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'events' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Events', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Events', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Events', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                  <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Events', 'action' => 'add', 'admin' => true)); ?>
                            </li>
                <?php } ?>
                        </ul>
                    </li>

                    <li class="<?php if(strtolower($this->params['controller']) == 'teachertimetables') { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_time_table"></span>
                <?php if($authUser["ROLE_ID"]==STUDENT_ID) {  ?>
                            <span class="title">Time Table</span>
                <?php }else{ ?>
                            <span class="title">Assign Time Table</span>
                <?php } ?>

                            <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'teachertimetables' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID))) {  ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                  <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'add', 'admin' => true)); ?>
                            </li>
                <?php } ?>

                        </ul>
                    </li>

                    <li class="<?php if($this->params['action'] == 'admin_attendance_listing' && in_array(strtolower($this->params['controller']), $HR_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_attendance"></span>
                            <span class="title">Attendance</span>

                            <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'users' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'attendance_listing', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'attendance_listing', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>

                    <li class="<?php echo strtolower($this->params['controller']) == 'noticeboard' ? '' : '' ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_notice_board"></span>
                            <span class="title">Notice Board</span>

                            <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'noticeboard' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                  <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'add', 'admin' => true)); ?>
                            </li>
                <?php } ?>

                        </ul>
                    </li>

                    <li class="<?php echo strtolower($this->params['controller']) == 'suggestions' ? '' : '' ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_user_suggestion"></span>
                            <span class="title">User Suggestion</span>

                            <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'suggestions' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'suggestions', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'suggestions', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>

                    <li class="
              <?php echo strtolower($this->params['controller']) == 'vacancy' ? '' : '' ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_vacancy"></span>
                            <span class="title">Vacancy</span>

                            <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'vacancy' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'vacancy', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'vacancy', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>

                    <li class="
              <?php if($this->params['action'] == 'admin_import' && in_array(strtolower($this->params['controller']), $HR_SECTION_CONTROLLER)) { echo ''; } ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_imports"></span>
                            <span class="title">Import</span>

                            <span class="arrow"
                  <?php if($this->params['action'] == 'admin_import' && in_array(strtolower($this->params['controller']), $HR_SECTION_CONTROLLER)) { echo ''; } ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                  <?php echo $this->Html->link('Bulk Import', array('plugin' => false, 'controller' => 'Users', 'action' => 'import', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="
                <?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_home"></span>
                            <span class="title">Back To Home</span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>

      <!--  <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID,SECURITY_ID))) { ?>
            <li class="
          <?php 
		  if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $SECURITY_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $SECURITY_SECTION_CONTROLLER)) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_security"></span>
                    <span class="title">Security</span>

                    <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="
                <?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_home"></span>
                            <span class="title">Back To Home</span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, STUDENT_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID,SECURITY_ID))) { ?>
            <li class="
          <?php 
		  if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $CANTEEN_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $CANTEEN_SECTION_CONTROLLER)) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_canteen"></span>
                    <span class="title">Canteen</span>

                    <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="
                <?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_home"></span>
                            <span class="title">Back To Home</span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, SUPERVISOR_ID, STUDENT_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID,SECURITY_ID))) { ?>
            <li class="
          <?php 
		  if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $HOSTEL_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $HOSTEL_SECTION_CONTROLLER)) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_hostel"></span>
                    <span class="title">Hostel</span>

                    <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="
                <?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_home"></span>
                            <span class="title">Back To Home</span>
                        </a>
                    </li>
                </ul>
            </li>
        <?php } ?> -->
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, SUPERVISOR_ID, ACCOUNT_ID, FRONT_ID))) { ?>
            <li class="
          <?php 
		  if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $ADMISSION_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $ADMISSION_SECTION_CONTROLLER)) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_section"></span>
                    <span class="title">Admission Section</span>

                    <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo ''; } ?>">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li class="
              <?php echo strtolower($this->params['controller']) == 'appadmission' ? '' : '' ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_app_admission"></span>
                            <span class="title">App Admission</span>

                            <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'appadmission' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View  all</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                  <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'add', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>
                    <li class="
              <?php echo strtolower($this->params['controller']) == 'StudentRegistration' ? '' : '' ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_student"></span>
                            <span class="title">Student Registration</span>

                            <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'StudentRegistration' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'StudentRegistration', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'StudentRegistration', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'StudentRegistration', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                  <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'StudentRegistration', 'action' => 'add', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>
                    <li class="
              <?php echo strtolower($this->params['controller']) == 'AdmissionConfirm' ? '' : '' ?>">
                        <a href="javascript:;">
                            <span class="icn icn_sub icn_sub_admission_section"></span>
                            <span class="title">Confirm Admission</span>

                            <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'AdmissionConfirm' ? '' : '' ?>">
                            </span>
                        </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AdmissionConfirm', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_view_all"></span>
                                    <span class="title">View All</span>
                                </a>
                  <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'AdmissionConfirm', 'action' => 'index', 'admin' => true)); ?>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="
                <?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_home"></span>
                            <span class="title">Back To Home</span>
                        </a>
                    </li>

                </ul>
            </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPERVISOR_ID, HR_ID))) { ?>
            <li class="
          <?php echo strtolower($this->params['controller']) == 'events' ? '' : '' ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_events"></span>
                    <span class="title">Manage Events</span>

                    <span class="arrow"
              <?php echo strtolower($this->params['controller']) == 'events' ? '' : '' ?>">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Events', 'action' => 'index', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_myprofile"></span>
                            <span class="title">View All</span>
                        </a>
              <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Events', 'action' => 'index', 'admin' => true)); ?>
                    </li>
            <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Events', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_myprofile"></span>
                                    <span class="title">Add New</span>
                                </a>
              <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Events', 'action' => 'add', 'admin' => true)); ?>
                    </li>
            <?php } ?>
                </ul>
            </li>
        <?php } ?>

        <?php if(in_array($authUser["ROLE_ID"], array(HR_ID))) { ?>
            <li class="
          <?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_vacancy"></span>
                    <span class="title">Vacancy</span>

                    <span class="arrow"
              <?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Vacancy', 'action' => 'index', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_myprofile"></span>
                            <span class="title">View All</span>
                        </a>
              <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Vacancy', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Vacancy', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_myprofile"></span>
                                    <span class="title">Add New</span>
                                </a>
              <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Vacancy', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                </ul>
            </li>

        <?php } ?>

        <?php if(in_array($authUser["ROLE_ID"], array(ACCOUNT_ID))) { ?>

            <li class="
          <?php if(in_array($this->params['controller'], array('FeeTypes'))) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_accounts"></span>
                    <span class="title">Manage Fees Type</span>

                    <span class="arrow"
              <?php if(in_array($this->params['controller'], array('FeeTypes'))) { echo ''; } ?>">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'FeeTypes', 'action' => 'index', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_view_all"></span>
                            <span class="title">View All</span>
                        </a>
              <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'FeeTypes', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'FeeTypes', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
              <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'FeeTypes', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                </ul>
            </li>

            <li class="
          <?php if(in_array($this->params['controller'], array('PaymentTypes'))) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_fee_type"></span>
                    <span class="title">Payment Terms</span>

                    <span class="arrow"
              <?php if(in_array($this->params['controller'], array('PaymentTypes'))) { echo ''; } ?>">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'PaymentTypes', 'action' => 'index', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_view_all"></span>
                            <span class="title">View All</span>
                        </a>
              <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'PaymentTypes', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'PaymentTypes', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
              <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'PaymentTypes', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                </ul>
            </li>

        <?php } ?>

        <?php if(in_array($authUser["ROLE_ID"], array(STUDENT_ID))) { ?>


            <li class="
          <?php if(in_array($this->params['action'], array('admin_students', 'admin_add_student'))) { echo ''; } ?>">

                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_student"></span>
                    <span class="title">Classmate Section</span>

                    <span class="arrow"
              <?php if(in_array($this->params['controller'], array('PaymentTypes'))) { echo ''; } ?>">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'students', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_view_all"></span>
                            <span class="title">View All</span>
                        </a>
              <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'students', 'admin' => true)); ?>
                    </li>
            <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'add_student', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New Student</span>
                                </a>
              <?php // echo $this->Html->link('Add New Student', array('plugin' => false, 'controller' => 'Users', 'action' => 'add_student', 'admin' => true)); ?>
                    </li>
            <?php } ?>
                </ul>
            </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPERVISOR_ID))) { ?>
            <li class="
          <?php echo strtolower($this->params['controller']) == 'appadmission' ? '' : '' ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_admission_section"></span>
                    <span class="title">Admission Inquiry</span>

                    <span class="arrow"
              <?php echo strtolower($this->params['controller']) == 'appadmission' ? '' : '' ?>">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'index', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_view_all"></span>
                            <span class="title">View All</span>
                        </a>
              <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'index', 'admin' => true)); ?>
                    </li>
            <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,  SUPERVISOR_ID))) {  ?>
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'index', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
              <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'index', 'admin' => true)); ?>
                    </li>
            <?php } ?>
                </ul>
            </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(TRANSPORTATION_ID))) { ?>
            <li class="
          <?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_myprofile"></span>
                    <span class="title">Route Schedule</span>

                    <span class="arrow"
              <?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                    </span>
                </a>
                <ul class="sub-menu">

                </ul>
            </li>

            <li class="
          <?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_driver_profile"></span>
                    <span class="title">Driver</span>

                    <span class="arrow"
              <?php if(in_array($this->params['controller'], array('Fees'))) { echo ''; } ?>">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Drivers', 'action' => 'index', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_view_all"></span>
                            <span class="title">View All</span>
                        </a>
              <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Drivers', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
              <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                </ul>
            </li>
        <?php } ?>

        <?php if(in_array($authUser["ROLE_ID"], array(SUPERVISOR_ID, HR_ID))) { ?>
            <li class="
          <?php if(strtolower($this->params['controller']) == 'teachertimetables') { echo ''; } ?>">
                <a href="javascript:;">
                    <span class="icn icn_sub icn_sub_time_table"></span>
            <?php if($authUser["ROLE_ID"]==STUDENT_ID) {  ?>
                    <span class="title">Time Table</span>
            <?php }else{ ?>
                    <span class="title">Assign Time Table</span>
            <?php } ?>

                    <span class="arrow"
              <?php echo strtolower($this->params['controller']) == 'teachertimetables' ? '' : '' ?>">
                    </span>
                </a>
                <ul class="sub-menu">
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'index', 'admin' => true)) ?>">
                            <span class="icn icn_sub icn_sub_view_all"></span>
                            <span class="title">View All</span>
                        </a>
              <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'index', 'admin' => true)); ?>
                    </li>
            <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID))) {  ?>
                    <li>
                        <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
              <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'add', 'admin' => true)); ?>
                    </li>
            <?php } ?>

                </ul>
            </li>
        <?php } ?>

        </ul>
        </li>




      <?php
						   $COMMUNICATION_SECTION_ACTION = array(
							'admin_add',

							'admin_edit',
							'admin_index',
							'admin_view',
							'admin_delete',
							
							);
						   
						   $COMMUNICATION_SECTION_CONTROLLER = array(
							'suggestion',
							'mailer',
							'SMS',
							'news',
							'circulars'						   
						   );
		   
						?>

        <li class="<?php if(in_array($this->params['action'], $COMMUNICATION_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$COMMUNICATION_SECTION_CONTROLLER)) { echo ''; } ?>">
            <a href="javascript:;">
                <span class="icn icn_main icn_main_circular"></span>
                <span class="title">Communication</span>
                <span class="selected"></span>
                <span class="arrow"
            <?php if(in_array($this->params['action'],$COMMUNICATION_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$COMMUNICATION_SECTION_CONTROLLER)) { echo ''; } ?>">
                </span>
            </a>

            <ul class="sub-menu">
          <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, ACCOUNT_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID, LIBRARY_ID))) { ?>
                <li class=" <?php echo strtolower($this->params['controller']) == 'suggestions' ? '' : '' ?>">
                    <a href="javascript:;">
                        <span class="icn icn_sub icn_sub_user_suggestion"></span>
                        <span class="title">User Suggestion</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == 'suggestions' ? '' : '' ?>">
                        </span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'suggestions', 'action' => 'index', 'admin' => true)) ?>">
                                <span class="icn icn_sub icn_sub_view_all"></span>
                                <span class="title">View All</span>
                            </a>
                <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'suggestions', 'action' => 'index', 'admin' => true)); ?>
                        </li>
                        <li>
                            <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'suggestions', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'suggestions', 'action' => 'index', 'admin' => true)); ?>
                        </li>
                    </ul>
                </li>

                <li class="<?php echo strtolower($this->params['controller']) == 'noticeboard' ? '' : '' ?>">
                    <a href="javascript:;">
                        <span class="icn icn_sub icn_sub_notice_board"></span>
                        <span class="title">Notice Board</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == 'noticeboard' ? '' : '' ?>">
                        </span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'index', 'admin' => true)) ?>">
                                <span class="icn icn_sub icn_sub_view_all"></span>
                                <span class="title">View All</span>
                            </a>
                <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'index', 'admin' => true)); ?>
                        </li>
              <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, ACCOUNT_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID, LIBRARY_ID))) { ?>
                        <li>
                            <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'add', 'admin' => true)); ?>
                        </li>
              <?php } ?>
                    </ul>
                </li>

                <li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                    <a href="javascript:;">
                        <span class="icn icn_sub icn_sub_news_update"></span>
                        <span class="title">News & Update</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        </span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_view_all"></span>
                                <span class="title">View All</span>
                            </a>
                <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => '', 'action' => '', 'admin' => true)); ?>
                        </li>
                        <li>
                            <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => '', 'action' => '', 'admin' => true)); ?>
                        </li>

                    </ul>
                </li>
          <?php } ?>
          <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPER_ADMIN_ID, ACCOUNT_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID, LIBRARY_ID))) { ?>

                <li class="<?php echo strtolower($this->params['controller']) == 'suggestions' ? '' : '' ?>">
                    <a href="javascript:;">
                        <span class="icn icn_sub icn_sub_mailer"></span>
                        <span class="title">Mailer</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        </span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_view_all"></span>
                                <span class="title">View All</span>
                            </a>
                <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => '', 'action' => '', 'admin' => true)); ?>
                        </li>
                        <li>
                            <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => '', 'action' => '', 'admin' => true)); ?>
                        </li>
                    </ul>
                </li>

                <li class="<?php echo strtolower($this->params['controller']) == 'suggestions' ? '' : '' ?>">
                    <a href="javascript:;">
                        <span class="icn icn_sub icn_sub_sms"></span>
                        <span class="title">SMS</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        </span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_view_all"></span>
                                <span class="title">View All</span>
                            </a>
                <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => '', 'action' => '', 'admin' => true)); ?>
                        </li>
                        <li>
                            <a href="javascript:;">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => '', 'action' => '', 'admin' => true)); ?>
                        </li>
                    </ul>
                </li>
          <?php } ?>
                <li>
                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                        <span class="icn icn_sub icn_sub_home"></span>
                        <span class="title">Back To Home</span>
                    </a>
                </li>
            </ul>
        </li>



      <?php
						   $MEDIA_SECTION_ACTION = array(
							'admin_add',
							'admin_edit',
							'admin_index',
							'admin_view',
							'admin_delete',
							'admin_Import'
							);
						   
						   $MEDIA_SECTION_CONTROLLER = array(
						   'import',
						   'gallery',
						   'downloads',
						   'ebook',
						   );
		   
						?>


        <li class="<?php if(in_array($this->params['action'], $MEDIA_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$MEDIA_SECTION_CONTROLLER)) { echo ''; } ?>">
            <a href="javascript:;">
                <span class="icn icn_main icn_main_gallery"></span>
                <span class="title">Media</span>
                <span class="selected"></span>
                <span class="arrow"
            <?php if(in_array($this->params['action'],$MEDIA_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$MEDIA_SECTION_CONTROLLER)) { echo ''; } ?>">
                </span>
            </a>

            <ul class="sub-menu">
          <?php if(in_array($authUser["ROLE_ID"], array(HR_ID, SUPERVISOR_ID))) { ?>
                <li class="<?php if($this->params['action'] == 'admin_import' && in_array(strtolower($this->params['controller']), $MEDIA_SECTION_CONTROLLER)) { echo ''; } ?>">
                    <a href="javascript:;">
                        <span class="icn icn_sub icn_sub_imports"></span>
                        <span class="title">Import</span>

                        <span class="arrow"
                <?php if($this->params['action'] == 'admin_import' && in_array(strtolower($this->params['controller']), $MEDIA_SECTION_CONTROLLER)) { echo ''; } ?>">
                        </span>
                    </a>

                    <ul class="sub-menu">
                        <li>
                <?php echo $this->Html->link('Bulk Import', array('plugin' => false, 'controller' => 'Users', 'action' => 'import', 'admin' => true)); ?>
                        </li>
                    </ul>
                </li>
          <?php } ?>
          <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, ACCOUNT_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID, LIBRARY_ID))) { ?>
                <li class="<?php echo strtolower($this->params['controller']) == 'album' ? '' : '' ?>">
                    <a href="javascript:;">
                        <span class="icn icn_sub icn_sub_gallery"></span>
                        <span class="title">School Gallery</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == 'album' ? '' : '' ?>">
                        </span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                <?php echo $this->Html->link('School Gallery', array('plugin' => false, 'controller' => 'Album', 'action' => 'school', 'admin' => true)); ?>
                        </li>
                    </ul>
                </li>

                <li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                    <a href="javascript:;">
                        <span class="icn icn_sub icn_sub_download"></span>
                        <span class="title">Download</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == 'album' ? '' : '' ?>">
                        </span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                <?php echo $this->Html->link('School Gallery', array('plugin' => false, 'controller' => '', 'action' => '')); ?>
                        </li>
                    </ul>
                </li>
          <?php  }  ?>
          <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, ACCOUNT_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, LIBRARY_ID))) { ?>

                <li class="<?php echo strtolower($this->params['controller']) == 'ebook' ? '' : '' ?>">
                    <a href="javascript:;">
                        <span class="icn icn_sub icn_sub_ebook"></span>
                        <span class="title">Manage Ebook</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == 'ebook' ? '' : '' ?>">
                        </span>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'EBook', 'action' => 'index', 'admin' => true)) ?>">
                                <span class="icn icn_sub icn_sub_view_all"></span>
                                <span class="title">View All</span>
                            </a>
                <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'EBook', 'action' => 'index', 'admin' => true)); ?>
                        </li>
              <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                        <li>
                            <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'EBook', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'EBook', 'action' => 'add', 'admin' => true)); ?>
                        </li>
              <?php }  ?>

                    </ul>
                </li>
          <?php } ?>
                <li>
                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                        <span class="icn icn_sub icn_sub_home"></span>
                        <span class="title">Back To Home</span>
                    </a>
                </li>
            </ul>


        </li>


      <?php
					   $GENERAL_SECTION_ACTION = array(
						'admin_add',
						'admin_edit',
						'admin_index',
						'admin_view',
						'admin_delete',
						'admin_school',
						);
					   
					   $GENERAL_SECTION_CONTROLLER = array(
					   'bloodgroups',
					   'castcategories',
					   'categories',
					   'city',
					   'medium',
					   'pagescontent',
					   'pagenames',
					   'roles',
					   'school',
					   'pagenames',
					   'roles',
					   'school',
					   'album',
					   'certification',	   
					   'achievements',
					   'testimonials',
					   'vacancy'
					   );
			   
			   ?>

			<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, SUPERVISOR_ID, SUPER_ADMIN_ID))) { ?>
        <li class="<?php if(in_array($this->params['action'],$GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$GENERAL_SECTION_CONTROLLER)) { echo ''; } ?>">
            <a href="javascript:;">
                <span class="icn icn_main icn_main_general_setting"></span>
                <span class="title">General Settings </span>
                <span class="selected"></span>
                <span class="arrow <?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$GENERAL_SECTION_CONTROLLER)) { echo ''; } ?>"></span>
            </a>


            <ul class="sub-menu">
<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, SUPERVISOR_ID, SUPER_ADMIN_ID))) { ?>

                <li class="
            <?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$GENERAL_SECTION_CONTROLLER)) { echo ''; } ?>">
                    <a href="javascript:;">
                        <span class="icn icn_sub icn_sub_general_setting"></span>
                        <span class="title">General Settings</span>

                        <span class="arrow"
                <?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$GENERAL_SECTION_CONTROLLER)) { echo ''; } ?>">
                        </span>
                    </a>
                    <ul class="sub-menu">

                        <li class="<?php echo strtolower($this->params['controller']) == 'bloodgroups' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_blood_group"></span>
                                <span class="title">Blood Groups</span>

                                <span class="arrow <?php echo strtolower($this->params['controller']) == 'bloodgroups' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'BloodGroups', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                    <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'BloodGroups', 'action' => 'index', 'admin' => true)); ?>
                                </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'BloodGroups', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                    <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'BloodGroups', 'action' => 'add', 'admin' => true)); ?>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>

                        <li class="<?php echo strtolower($this->params['controller']) == 'castcategories' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_cast_categories"></span>
                                <span class="title">Cast Categories</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'castcategories' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'CastCategories', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                    <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'CastCategories', 'action' => 'index', 'admin' => true)); ?>
                                </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'CastCategories', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                    <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'CastCategories', 'action' => 'add', 'admin' => true)); ?>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>

                        <li class="<?php echo strtolower($this->params['controller']) == 'categories' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_categories"></span>
                                <span class="title">Categories</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'categories' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Categories', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                    <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Categories', 'action' => 'index', 'admin' => true)); ?>
                                </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Categories', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                    <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Categories', 'action' => 'add', 'admin' => true)); ?>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>

                        <li class="<?php echo strtolower($this->params['controller']) == 'city' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_city"></span>
                                <span class="title">City</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'city' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'City', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                    <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'City', 'action' => 'index', 'admin' => true)); ?>
                                </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'City', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                    <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'City', 'action' => 'add', 'admin' => true)); ?>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>

                        <li class="<?php echo strtolower($this->params['controller']) == 'medium' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_medium"></span>
                                <span class="title">Medium</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'medium' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Medium', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                    <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Medium', 'action' => 'index', 'admin' => true)); ?>
                                </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Medium', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                    <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Medium', 'action' => 'add', 'admin' => true)); ?>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>

                        <li class="<?php echo strtolower($this->params['controller']) == 'pagescontent' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_pages_content"></span>
                                <span class="title">Pages Content</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'pagescontent' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'pagescontent', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                    <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'pagescontent', 'action' => 'index', 'admin' => true)); ?>
                                </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'pagescontent', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                    <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'pagescontent', 'action' => 'add', 'admin' => true)); ?>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>

                        <li class="<?php echo strtolower($this->params['controller']) == 'pagenames' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_pages_name"></span>
                                <span class="title">Page Names</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'pagenames' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'PageNames', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                    <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'PageNames', 'action' => 'index', 'admin' => true)); ?>
                                </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'PageNames', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                    <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'PageNames', 'action' => 'add', 'admin' => true)); ?>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>

                        <li class="<?php echo strtolower($this->params['controller']) == 'roles' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_roles"></span>
                                <span class="title">Roles</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'roles' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Roles', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                    <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Roles', 'action' => 'index', 'admin' => true)); ?>
                                </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Roles', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                    <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Roles', 'action' => 'add', 'admin' => true)); ?>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>
						
						<li class="<?php echo strtolower($this->params['controller']) == 'AdmissionVacancy' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_vacancy"></span>
                                <span class="title">Admission Vacancy</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AdmissionVacancy', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                    <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Roles', 'action' => 'index', 'admin' => true)); ?>
                                </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'AdmissionVacancy', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                    <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Roles', 'action' => 'add', 'admin' => true)); ?>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>
						
						<li class="<?php echo strtolower($this->params['controller']) == 'Document' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_document"></span>
                                <span class="title">Document</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Document', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                    <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Roles', 'action' => 'index', 'admin' => true)); ?>
                                </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Document', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                    <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Roles', 'action' => 'add', 'admin' => true)); ?>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>
						
						<li class="<?php echo strtolower($this->params['controller']) == 'Group' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_group"></span>
                                <span class="title">Group</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Group', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                    <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Roles', 'action' => 'index', 'admin' => true)); ?>
                                </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Group', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                    <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Roles', 'action' => 'add', 'admin' => true)); ?>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>

                        <li class="<?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_schools"></span>
                                <span class="title">School</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                            
                            
                            
                                <li>
                    <?php echo $this->Html->link('Edit School', array('plugin' => false, 'controller' => 'School', 'action' => 'edit', 1, 'admin' => true)); ?>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                                <span class="icn icn_sub icn_sub_home"></span>
                                <span class="title">Back To Home</span>
                            </a>
                        </li>


                    </ul>


                </li>

<?php } ?>
<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, SUPER_ADMIN_ID))) { ?>

                <li class="<?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $GENERAL_SECTION_CONTROLLER)) { echo ''; } ?>">
                    <a href="javascript:;">
                        <span class="icn icn_sub icn_sub_guest_setting"></span>
                        <span class="title">Guest Section</span>

                        <span class="arrow"
                <?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $GENERAL_SECTION_CONTROLLER)) { echo ''; } ?>">
                        </span>
                    </a>
                    <ul class="sub-menu">

                        <li class="<?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_schools"></span>
                                <span class="title">School</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                    <?php echo $this->Html->link('Edit School', array('plugin' => false, 'controller' => 'School', 'action' => 'edit', 1, 'admin' => true)); ?>
                                </li>
                            </ul>
                        </li>

                        <li class="<?php echo strtolower($this->params['controller']) == 'album' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_Manage_certification"></span>
                                <span class="title">Manage certification</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'album' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                    <?php echo $this->Html->link('Certification', array('plugin' => false, 'controller' => 'Album', 'action' => 'certification', 'admin' => true)); ?>
                                </li>
                            </ul>
                        </li>

                        <li class="<?php echo strtolower($this->params['controller']) == 'album' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_gallery"></span>
                                <span class="title">School Gallery</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'album' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                    <?php echo $this->Html->link('School Gallery', array('plugin' => false, 'controller' => 'Album', 'action' => 'school', 'admin' => true)); ?>
                                </li>
                            </ul>
                        </li>

                        <li class="<?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_brocher"></span>
                                <span class="title">Brochure</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                    <?php echo $this->Html->link('View Brochure', array('plugin' => false, 'controller' => 'School', 'action' => 'view', 1, 'admin' => true)); ?>
                                </li>
                            </ul>
                        </li>

                        <li class="<?php echo strtolower($this->params['controller']) == 'achievements' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_achievements"></span>
                                <span class="title">Achievements</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'achievements' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Achievements', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                    <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Achievements', 'action' => 'index', 'admin' => true)); ?>
                                </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Achievements', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                    <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Achievements', 'action' => 'add', 'admin' => true)); ?>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>

                        <li class="<?php echo strtolower($this->params['controller']) == 'testimonials' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_tiktalk"></span>
                                <span class="title">Testimonials</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'testimonials' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Testimonials', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                    <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Testimonials', 'action' => 'index', 'admin' => true)); ?>
                                </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Testimonials', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                    <?php // echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Testimonials', 'action' => 'add', 'admin' => true)); ?>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>

                        <li class="<?php echo strtolower($this->params['controller']) == 'vacancy' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_vacancy"></span>
                                <span class="title">Vacancy</span>

                                <span class="arrow <?php echo strtolower($this->params['controller']) == 'vacancy' ? '' : '' ?>">
                                </span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Vacancy', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                    <?php // echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Vacancy', 'action' => 'index', 'admin' => true)); ?>
                                </li>
                            </ul>
                        </li>


                        <li>
                            <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                                <span class="icn icn_sub icn_sub_home"></span>
                                <span class="title">Back To Home</span>
                            </a>
                        </li>

                    </ul>
                </li>
				
				
				<li class="<?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $GENERAL_SECTION_CONTROLLER)) { echo ''; } ?>">
                    <a href="javascript:;">
                        <span class="icn icn_sub icn_sub_website_section"></span>
                        <span class="title">Website Section</span>

                        <span class="arrow"
                <?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $GENERAL_SECTION_CONTROLLER)) { echo ''; } ?>">
                        </span>
                    </a>
                    <ul class="sub-menu">

                        <li class="<?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_about"></span>
                                <span class="title">About</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>">
                                </span>
                            </a>
                           <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'FrontAbout', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                   
                                </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'FrontAbout', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>

                        <li class="<?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_admission_section"></span>
                                <span class="title">Admission</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>">
                                </span>
                            </a>
                           <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'FrontAdmission', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                   
                                </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'FrontAdmission', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>
						
						<li class="<?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_contactus"></span>
                                <span class="title">Contact</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>">
                                </span>
                            </a>
                           <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'FrontContact', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                   
                                </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'FrontContact', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>
						
						<li class="<?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_facility"></span>
                                <span class="title">Facility</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>">
                                </span>
                            </a>
                           <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'FrontFacility', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                   
                                </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'FrontFacility', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>
						
						<li class="<?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>">
                            <a href="javascript:;">
                                <span class="icn icn_sub icn_sub_gallery"></span>
                                <span class="title">Gallery</span>

                                <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>">
                                </span>
                            </a>
                           <ul class="sub-menu">
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'FrontGallery', 'action' => 'index', 'admin' => true)) ?>">
                                        <span class="icn icn_sub icn_sub_view_all"></span>
                                        <span class="title">View All</span>
                                    </a>
                   
                                </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                                <li>
                                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'FrontGallery', 'action' => 'add', 'admin' => true)) ?>">
                                    <span class="icn icn_sub icn_sub_add"></span>
                                    <span class="title">Add New</span>
                                </a>
                                </li>
                  <?php } ?>
                            </ul>
                        </li>


                        <li>
                            <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                                <span class="icn icn_sub icn_sub_home"></span>
                                <span class="title">Back To Home</span>
                            </a>
                        </li>

                    </ul>
                </li>
<?php } ?>


            </ul>



        </li>
<?php } ?>

      <?php
								$OTHER_SECTION_ACTION = array( 
									'admin_add',
									'admin_edit',
									'admin_index',
									'admin_view'
									);
								   
								   $OTHER_SECTION_CONTROLLER = array(
								   'help',
								   'share',
								   'contact',
								   'refer',
								   );
								   
							?>

        <li class="<?php if(in_array($this->params['action'], $OTHER_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$OTHER_SECTION_CONTROLLER)) { echo ''; } ?>">
            <a href="javascript:;">
                <span class="icn icn_main icn_main_utility_help"></span>
                <span class="title">Others</span>
                <span class="selected"></span>
                <span class="arrow"
            <?php if(in_array($this->params['action'], $OTHER_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$OTHER_SECTION_CONTROLLER)) { echo ''; } ?>">
                </span>
            </a>

            <ul class="sub-menu">
          <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, ACCOUNT_ID, HR_ID, TRANSPORTATION_ID, LIBRARY_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID))) { ?>
                <li class="<?php echo strtolower($this->params['controller']) == '' ?>">
                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '')) ?>">
                        <span class="icn icn_sub icn_sub_utility_help"></span>
                        <span class="title">Utility & Help</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        </span>
                    </a>
                </li>


          <?php  } ?>
          <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, STUDENT_ID , HR_ID, ADMIN_ID, SUPERVISOR_ID,  ACCOUNT_ID, TEACHER_ID, TRANSPORTATION_ID, LIBRARY_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID))) { ?>
                <li class="<?php echo strtolower($this->params['controller']) ==  '' ?>">
                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '')) ?>">
                        <span class="icn icn_sub icn_sub_share_app"></span>
                        <span class="title">Share This App</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        </span>
                    </a>

                </li>

                <li class="<?php echo strtolower($this->params['controller']) == '' ?>">
                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '')) ?>">
                        <span class="icn icn_sub icn_sub_contactus"></span>
                        <span class="title">Contact Us</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        </span>
                    </a>

                </li>

                <li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Construction', 'action' => '')) ?>">
                        <span class="icn icn_sub icn_sub_contact_list"></span>
                        <span class="title">Contact List</span>

                        <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
                        </span>
                    </a>

                </li>

                <li>
                    <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                        <span class="icn icn_sub icn_sub_home"></span>
                        <span class="title">Back To Home</span>
                    </a>
                </li>

          <?php }  ?>
            </ul>
        </li>
			 

        </ul>


    </div>
</div>


<?php }  ?> 