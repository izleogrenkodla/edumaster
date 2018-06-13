<?php if (isset($authUser)) { ?>

    <!-- datetime_section -->
    <div class="datetime_section">
        <div class="time">
            05:42 PM
        </div>
        <div class="date">
            Friday, 18 March 2016
        </div>
    </div><!-- End: datetime_section -->


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






        <li class="<?php if(in_array($this->params['action'], $PERSONAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$PERSONAL_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <span class="icn icn_main"></span>
            <span class="title">Personal Profile</span>
            <span class="selected"></span>
            <span class="arrow <?php if(in_array($this->params['action'],$PERSONAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$PERSONAL_SECTION_CONTROLLER)) { echo 'open'; } ?>">
            </span>
          </a>

          <ul class="sub-menu">
            <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, ACCOUNT_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID, LIBRARY_ID))) { ?>
            <li class="<?php echo strtolower($this->params['controller']) == 'users' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">Personal Profile</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>">
                </span>
              </a>

            </li>
            <li class="<?php echo strtolower($this->params['controller']) == 'users' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">ID Card</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>">
                </span>
              </a>

            </li>
            <?php } ?>
            <?php if(in_array($authUser["ROLE_ID"], array(TEACHER_ID, STUDENT_ID))) { ?>
            <li class="<?php echo strtolower($this->params['controller']) == 'users' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">My Documents</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>">
                </span>
              </a>

            </li>
            <?php  } ?>
            <?php if(in_array($authUser["ROLE_ID"], array(STUDENT_ID, ACCOUNT_ID))) { ?>
            <li class="<?php echo strtolower($this->params['controller']) == 'users' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">Fee</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>">
                </span>
              </a>

            </li>
            <li class="<?php echo strtolower($this->params['controller']) == '' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">Album</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>">
                </span>
              </a>

            </li>
            <?php } ?>
            <?php if(in_array($authUser["ROLE_ID"], array(TEACHER_ID, ACCOUNT_ID))) { ?>
            <li class="<?php echo strtolower($this->params['controller']) == '' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">Student Ledger</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>">
                </span>
              </a>

            </li>
            <?php } ?>
            <?php if(in_array($authUser["ROLE_ID"], array(TRANSPORTATION_ID))) { ?>
            <li class="<?php echo strtolower($this->params['controller']) == '' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">Vehicle Profile</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>">
                </span>
              </a>

            </li>
            <?php } ?>
            <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, LIBRARY_ID))) { ?>
            <li class="<?php echo strtolower($this->params['controller']) == array('admin_add', 'admin_index')? 'active open' : '' ?>">
			<li class="<?php if($this->params['action'] == array('admin_add', 'admin_index') && in_array(strtolower($this->params['controller']), $PERSONAL_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">Daily Diary</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == array('homeworks', 'classwork') ? 'open' : '' ?>">
                </span>
              </a>

              <ul class="sub-menu">
                <li class="<?php echo strtolower($this->params['controller']) == 'homeworks' ? 'active open' : '' ?>">
                  <a href="javascript:;">
                    <i class="fa icon-bubbles"></i>
                    <span class="title">Homework</span>
                    <span class="selected"></span>
                    <span class="arrow <?php echo strtolower($this->params['controller']) == 'homeworks' ? 'open' : '' ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'homeworks', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                    <?php if(in_array($authUser["ROLE_ID"], array(TEACHER_ID))) { ?>
                    <li>
                      <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'homeworks', 'action' => 'add', 'admin' => true)); ?>
                    </li>

                    <?php  } ?>
                  </ul>
                </li>
                <li class="<?php echo strtolower($this->params['controller']) == 'classwork' ? 'active open' : '' ?>">
                  <a href="javascript:;">
                    <i class="fa icon-bubbles"></i>
                    <span class="title">Classwork</span>
                    <span class="selected"></span>
                    <span class="arrow <?php echo strtolower($this->params['controller']) == 'classwork' ? 'open' : '' ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'classwork', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                    <?php if(in_array($authUser["ROLE_ID"], array(TEACHER_ID))) { ?>
                    <li>
                      <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'classwork', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                    <?php  } ?>
                  </ul>
                </li>
              </ul>
            </li>
            <?php } ?>
            <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, ACCOUNT_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID, LIBRARY_ID))) { ?>
            <li class="<?php echo strtolower($this->params['controller']) == '' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">Academic History</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == '' ? 'open' : '' ?>">
                </span>
              </a>

            </li>

            <li class="<?php if($this->params['action'] == 'admin_attendance_listing' && in_array(strtolower($this->params['controller']), $PERSONAL_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-bar-chart"></i>
                <span class="title">Attendance</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'attendance_listing', 'admin' => true)); ?>
                </li>
              </ul>
            </li>

            <li class="<?php echo strtolower($this->params['controller']) == 'leaveapplications' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-envelope-letter"></i>
                <span class="title">Leave Applications</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'leaveapplications' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'leaveApplications', 'action' => 'index', 'admin' => true)); ?>
                </li>
              </ul>
            </li>

            <li class="<?php if($this->params['action'] == 'admin_attendance_listing' && in_array(strtolower($this->params['controller']), $PERSONAL_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-bar-chart"></i>
                <span class="title">Remarks</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == '' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => '', 'action' => '')); ?>
                </li>
              </ul>
            </li>
            <?php  } ?>
            <li>
              <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                <i class="fa icon-home"></i>
                <span class="title">Back To Home</span>
                <span class="selected"></span>
                <span class="arrow"></span>
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
					
					
					
					

        <li class="<?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">Departments</span>
            <span class="selected"></span>
            <span class="arrow <?php if(in_array($this->params['action'],$DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER)) { echo 'open'; } ?>">
            </span>
          </a>

          <ul class="sub-menu">
            <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, FRONT_ID))) { ?>

            <li class="<?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">Exam & Result</span>
                <span class="selected"></span>
                <span class="arrow <?php if(in_array($this->params['action'],$DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER)) { echo 'open'; } ?>">
                </span>
              </a>

              <ul class="sub-menu">
                <li>
                  <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                    <i class="fa icon-home"></i>
                    <span class="title">Back To Home</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                  </a>
                </li>
              </ul>
            </li>
            <?php } ?>

            <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, ACCOUNT_ID, TRANSPORTATION_ID, STORE_ID, FRONT_ID, SECURITY_ID, LIBRARY_ID))) { ?>

            <li class="<?php 
			if(in_array($this->params['action'], $TEACHER_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$TEACHER_SECTION_CONTROLLER) && in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">Teacher Section</span>
                <span class="selected"></span>
                <span class="arrow <?php if(in_array($this->params['action'],$TEACHER_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$TEACHER_SECTION_CONTROLLER)) { echo 'open'; } ?>">
                </span>
              </a>

              <ul class="sub-menu">

                <li class=" <?php if(in_array($this->params['action'], array('admin_students', 'admin_add_student'))) { echo 'active open'; } ?>">
                  <a href="javascript:;">
                    <i class="fa icon-user-follow"></i>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <span class="title">Admission Section</span>

                    <?php }  elseif($authUser["ROLE_ID"]==STUDENT_ID) { ?>
                    <span class="title">Classmate Section</span>

                    <?php } elseif($authUser["ROLE_ID"]==TEACHER_ID) { ?>
                    <span class="title">Student Section</span>
                    <?php }else { ?>
                    <span class="title">Student Section</span>
                    <?php } ?>
                    <span class="selected"></span>
                    <span class="arrow <?php echo in_array($this->params['action'], array('admin_students', 'admin_add_student')) ? 'open' : '' ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'students', 'admin' => true)); ?>
                    </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                      <?php echo $this->Html->link('Add New Student', array('plugin' => false, 'controller' => 'Users', 'action' => 'add_student', 'admin' => true)); ?>
                    </li>
                    <?php } ?>
                  </ul>
                </li>

                <li class=" <?php echo strtolower($this->params['controller']) == 'ebook' ? 'active open' : '' ?>">
                  <a href="javascript:;">
                    <i class="fa icon-book-open"></i>
                    <span class="title">Manage Ebook</span>
                    <span class="selected"></span>
                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'ebook' ? 'open' : '' ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'EBook', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                      <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'EBook', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                    <?php } ?>
                  </ul>
                </li>

                <li class="<?php echo strtolower($this->params['controller']) == 'noticeboard' ? 'active open' : '' ?>">
                  <a href="javascript:;">
                    <i class="fa icon-bell"></i>
                    <span class="title">Notice Board</span>
                    <span class="selected"></span>
                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'noticeboard' ? 'open' : '' ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                      <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                    <?php } ?>

                  </ul>
                </li>

                <li class="<?php echo strtolower($this->params['controller']) == 'events' ? 'active open' : '' ?>">
                  <a href="javascript:;">
                    <i class="fa icon-social-dribbble"></i>
                    <span class="title">Manage Events</span>
                    <span class="selected"></span>
                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'events' ? 'open' : '' ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Events', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                      <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Events', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                    <?php } ?>
                  </ul>
                </li>

                <li class="<?php if(in_array($this->params['action'], array('admin_supervisors', 'admin_add_supervisor')) && strtolower($this->params['controller']) == 'users') { echo 'active open'; } ?>">
                  <a href="javascript:;">
                    <i class="fa icon-user-follow"></i>
                    <span class="title">Supervisor Section</span>
                    <span class="selected"></span>
                    <span class="arrow"
                      <?php echo in_array($this->params['action'], array('admin_supervisors', 'admin_add_supervisor')) ? 'open' : '' ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'supervisors', 'admin' => true)); ?>
                    </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                      <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Users', 'action' => 'add_supervisor', 'admin' => true)); ?>
                    </li>
                    <?php } ?>
                  </ul>
                </li>

                <li class="<?php if(in_array($this->params['action'], array('admin_teachers','admin_add_teacher')) && strtolower($this->params['controller']) == 'users') { echo 'active open'; } ?>">
                  <a href="javascript:;">
                    <i class="fa icon-users"></i>
                    <span class="title">Teacher Section</span>
                    <span class="selected"></span>
                    <span class="arrow"
                      <?php echo in_array($this->params['action'], array('admin_teachers','admin_add_teacher')) ? 'open' : '' ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'teachers', 'admin' => true)); ?>
                    </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                      <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Users', 'action' => 'add_teacher', 'admin' => true)); ?>
                    </li>
                    <?php } ?>
                  </ul>
                </li>

                <li class="<?php echo strtolower($this->params['controller']) == 'leaveapplications' ? 'active open' : '' ?>">
                  <a href="javascript:;">
                    <i class="fa icon-envelope-letter"></i>
                    <span class="title">Leave Applications</span>
                    <span class="selected"></span>
                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'leaveapplications' ? 'open' : '' ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'leaveApplications', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                  </ul>
                </li>

                <li class="<?php echo strtolower($this->params['controller']) == 'suggestions' ? 'active open' : '' ?>">
                  <a href="javascript:;">
                    <i class="fa icon-bubbles"></i>
                    <span class="title">User Suggestion</span>
                    <span class="selected"></span>
                    <span class="arrow <?php echo strtolower($this->params['controller']) == 'suggestions' ? 'open' : '' ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'suggestions', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                  </ul>
                </li>

                <li class="<?php if(strtolower($this->params['controller']) == 'teachertimetables') { echo 'active open'; } ?>">
                  <a href="javascript:;">
                    <i class="fa icon-speedometer"></i>
                    <?php if($authUser["ROLE_ID"]==STUDENT_ID) {  ?>
                    <span class="title">Time Table</span>
                    <?php }else{ ?>
                    <span class="title">Assign Time Table</span>
                    <?php } ?>
                    <span class="selected"></span>
                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'teachertimetables' ? 'open' : '' ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                    <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID))) {  ?>
                    <li>
                      <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                    <?php } ?>

                  </ul>
                </li>
                <li>
                  <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                    <i class="fa icon-home"></i>
                    <span class="title">Back To Home</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                  </a>
                </li>
              </ul>

            </li>
            <?php  } ?>

            <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, TEACHER_ID, SUPERVISOR_ID, STUDENT_ID, ACCOUNT_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID))) { ?>

            <li class="<?php 
			if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $STUDENT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$STUDENT_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">Student Section</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo 'open'; } ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li class="<?php echo strtolower($this->params['controller']) == 'appadmission' ? 'active open' : '' ?>">
                  <a href="javascript:;">
                    <i class="fa icon-social-dribbble"></i>
                    <span class="title">App Admission</span>
                    <span class="selected"></span>
                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'appadmission' ? 'open' : '' ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                  </ul>
                </li>

                <li class="<?php echo strtolower($this->params['controller']) == 'admissionforms' ? 'active open' : '' ?>">
                  <a href="javascript:;">
                    <i class="fa icon-social-dribbble"></i>
                    <span class="title">Admission Forms</span>
                    <span class="selected"></span>
                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'admissionforms' ? 'open' : '' ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'AdmissionForms', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                      <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'AdmissionForms', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                    <?php } ?>
                  </ul>
                </li>

                <li class="<?php if(in_array($this->params['action'], array('admin_students', 'admin_add_student'))) { echo 'active open'; } ?>">
                  <a href="javascript:;">
                    <i class="fa icon-user-follow"></i>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <span class="title">Admission Section</span>

                    <?php }  elseif($authUser["ROLE_ID"]==STUDENT_ID) { ?>
                    <span class="title">Classmate Section</span>

                    <?php } elseif($authUser["ROLE_ID"]==TEACHER_ID) { ?>
                    <span class="title">Student Section</span>
                    <?php }else { ?>
                    <span class="title">Student Section</span>
                    <?php } ?>
                    <span class="selected"></span>
                    <span class="arrow"
                      <?php echo in_array($this->params['action'], array('admin_students', 'admin_add_student')) ? 'open' : '' ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'students', 'admin' => true)); ?>
                    </li>
                    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                      <?php echo $this->Html->link('Add New Student', array('plugin' => false, 'controller' => 'Users', 'action' => 'add_student', 'admin' => true)); ?>
                    </li>
                    <?php } ?>
                  </ul>
                </li>

                <li class="<?php if(in_array($this->params['controller'], array('Fees'))) { echo 'active open'; } ?>">
                  <a href="javascript:;">
                    <i class="fa icon-user-follow"></i>
                    <span class="title">Manage Fees</span>
                    <span class="selected"></span>
                    <span class="arrow"
                      <?php if(in_array($this->params['controller'], array('Fees'))) { echo 'open'; } ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Fees', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                    <li>
                      <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Fees', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                  </ul>
                </li>

                <li>
                  <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                    <i class="fa icon-home"></i>
                    <span class="title">Back To Home</span>
                    <span class="selected"></span>
                    <span class="arrow"></span>
                  </a>
                </li>
              </ul>
            </li>
            <?php } ?>
            <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, SUPERVISOR_ID, STUDENT_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, FRONT_ID, SECURITY_ID))) { ?>


            <li class="<?php 
			if(in_array($this->params['action'], $TRANSPORT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$TRANSPORT_SECTION_CONTROLLER) && in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$DEPT_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">Transport Section</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo 'open'; } ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li class="<?php if(in_array($this->params['controller'], array('Fees'))) { echo 'active open'; } ?>">
                  <a href="javascript:;">
                    <i class="fa icon-user-follow"></i>
                    <span class="title">Route Schedule</span>
                    <span class="selected"></span>
                    <span class="arrow"
                      <?php if(in_array($this->params['controller'], array('Fees'))) { echo 'open'; } ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">

                  </ul>
                </li>

                <li class="<?php if(in_array($this->params['controller'], array('Fees'))) { echo 'active open'; } ?>">
                  <a href="javascript:;">
                    <i class="fa icon-user-follow"></i>
                    <span class="title">Driver</span>
                    <span class="selected"></span>
                    <span class="arrow"
                      <?php echo strtolower($this->params['controller']) == 'Drivers' ? 'open' : '' ?>">
                    </span>
                  </a>
                  <ul class="sub-menu">
                    <li>
                      <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'index', 'admin' => true)); ?>
                    </li>
                    <li>
                      <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                  </ul>
                </li>
              </li>



            <li>
              <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                <i class="fa icon-home"></i>
                <span class="title">Back To Home</span>
                <span class="selected"></span>
                <span class="arrow"></span>
              </a>
            </li>
          </ul>
        </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, TEACHER_ID, SUPERVISOR_ID, STUDENT_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, FRONT_ID,SECURITY_ID))) { ?>
        <li class="<?php 
		if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $LIBRARY_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $LIBRARY_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">Library Section</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo 'open'; } ?>">
            </span>
          </a>
          <ul class="sub-menu">

            <li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">Manage Library</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo 'open'; } ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('Issue Book', array('plugin' => false, 'controller' => 'Library', 'action' => 'add', 'admin' => true)); ?>
                </li>
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Library', 'action' => 'index', 'admin' => true)); ?>
                </li>
              </ul>
            </li>

            <li class="<?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">Book Master</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php if(in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo 'open'; } ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Books', 'action' => 'add', 'admin' => true)); ?>
                </li>
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Books', 'action' => 'index', 'admin' => true)); ?>
                </li>
              </ul>
            </li>

            <li>
              <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                <i class="fa icon-home"></i>
                <span class="title">Back To Home</span>
                <span class="selected"></span>
                <span class="arrow"></span>
              </a>
            </li>

          </ul>
        </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, TEACHER_ID, SUPERVISOR_ID, STUDENT_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID,SECURITY_ID))) { ?>
        <li class="<?php 
		if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $SUP_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $SUP_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">Supervisors Section</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo 'open'; } ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li class="
              <?php echo strtolower($this->params['controller']) == 'exams' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">Exams</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'exams' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'exams', 'action' => 'add', 'admin' => true)); ?>
                </li>
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'exams', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                  <?php echo $this->Html->link('Exam Schedule', array('plugin' => false, 'controller' => 'exams', 'action' => 'list', 'admin' => true)); ?>
                </li>
              </ul>
            </li>

            <li class="<?php echo $this->params['controller'] == 'ExamTypes' ? 'active open' : ''; ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">Exam Type</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo $this->params['controller'] == 'ExamTypes' ? 'open' : ''; ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'ExamTypes', 'action' => 'add', 'admin' => true)); ?>
                </li>
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'ExamTypes', 'action' => 'index', 'admin' => true)); ?>
                </li>
              </ul>
            </li>

            <li class="<?php echo $this->params['controller'] == 'Holidays' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">Holidays</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo $this->params['controller'] == 'Holidays' ? 'open' : ''; ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Holidays', 'action' => 'add', 'admin' => true)); ?>
                </li>
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Holidays', 'action' => 'index', 'admin' => true)); ?>
                </li>
              </ul>
            </li>

            <li class="<?php echo strtolower($this->params['controller']) == 'events' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-social-dribbble"></i>
                <span class="title">Manage Events</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'events' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Events', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                <li>
                  <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Events', 'action' => 'add', 'admin' => true)); ?>
                </li>
                <?php } ?>
              </ul>
            </li>

            <li class="<?php if($this->params['action'] == 'admin_import' && in_array(strtolower($this->params['controller']), $SUP_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">Import</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php if($this->params['action'] == 'admin_import' && in_array(strtolower($this->params['controller']), $SUP_SECTION_CONTROLLER)) { echo 'open'; } ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('Bulk Import', array('plugin' => false, 'controller' => 'Users', 'action' => 'import', 'admin' => true)); ?>
                </li>
              </ul>
            </li>

            <li class="<?php echo strtolower($this->params['controller']) == 'subjects' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-social-dribbble"></i>
                <span class="title">Manage Subject</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'subjects' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'subjects', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                <li>
                  <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'subjects', 'action' => 'add', 'admin' => true)); ?>
                </li>
                <?php } ?>
              </ul>
            </li>

            <li class="<?php echo strtolower($this->params['controller']) == 'transports' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">Transports</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'transports' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'transports', 'action' => 'index', 'admin' => true)); ?>
                </li>
              </ul>
            </li>

            <li class="<?php echo strtolower($this->params['controller']) == 'admissionforms' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-social-dribbble"></i>
                <span class="title">Admission Forms</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'admissionforms' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'AdmissionForms', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                <li>
                  <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'AdmissionForms', 'action' => 'add', 'admin' => true)); ?>
                </li>
                <?php } ?>
              </ul>
            </li>

            <li class="<?php echo strtolower($this->params['controller']) == 'appadmission' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-social-dribbble"></i>
                <span class="title">App Admission</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'appadmission' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'index', 'admin' => true)); ?>
                </li>
              </ul>
            </li>

            <li>
              <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                <i class="fa icon-home"></i>
                <span class="title">Back To Home</span>
                <span class="selected"></span>
                <span class="arrow"></span>
              </a>
            </li>

          </ul>
        </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID,SECURITY_ID))) { ?>
        <li class="<?php 
		if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $STORE_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $STORE_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">Store & Purchase</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo 'open'; } ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                <i class="fa icon-home"></i>
                <span class="title">Back To Home</span>
                <span class="selected"></span>
                <span class="arrow"></span>
              </a>
            </li>
          </ul>
        </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, SUPERVISOR_ID, STUDENT_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID,SECURITY_ID))) { ?>
        <li class="<?php 
		if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $ACCOUNT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $ACCOUNT_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">Account Section</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo 'open'; } ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li class="
              <?php if(in_array($this->params['controller'], array('Fees'))) { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">Manage Fees</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php if(in_array($this->params['controller'], array('Fees'))) { echo 'open'; } ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Fees', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                  <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Fees', 'action' => 'add', 'admin' => true)); ?>
                </li>
              </ul>
            </li>
            <li class="<?php if(in_array($this->params['controller'], array('FeeTypes'))) { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">Manage Fees Type</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php if(in_array($this->params['controller'], array('FeeTypes'))) { echo 'open'; } ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'FeeTypes', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                  <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'FeeTypes', 'action' => 'add', 'admin' => true)); ?>
                </li>
              </ul>
            </li>
            <li class="<?php if(in_array($this->params['controller'], array('PaymentTypes'))) { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">Payment Terms</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php if(in_array($this->params['controller'], array('PaymentTypes'))) { echo 'open'; } ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'PaymentTypes', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                  <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'PaymentTypes', 'action' => 'add', 'admin' => true)); ?>
                </li>
              </ul>
            </li>
            <li class="<?php if(in_array($this->params['action'], array('admin_student_ledger'))) { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">Students Ledger</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['action']) == 'student_ledger' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'student_ledger', 'admin' => true)); ?>
                </li>
              </ul>
            </li>

            <li>
              <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                <i class="fa icon-home"></i>
                <span class="title">Back To Home</span>
                <span class="selected"></span>
                <span class="arrow"></span>
              </a>
            </li>
          </ul>
        </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID,SECURITY_ID))) { ?>
        <li class="<?php 
		if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $FRONT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $FRONT_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">Front Office</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo 'open'; } ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="
                <?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                <i class="fa icon-home"></i>
                <span class="title">Back To Home</span>
                <span class="selected"></span>
                <span class="arrow"></span>
              </a>
            </li>
          </ul>
        </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID,SECURITY_ID))) { ?>
        <li class="<?php 
		if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $HR_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $HR_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">HR Section</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo 'open'; } ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li class="<?php echo strtolower($this->params['controller']) == 'leaveapplications' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-envelope-letter"></i>
                <span class="title">Leave Applications</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'leaveapplications' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'leaveApplications', 'action' => 'index', 'admin' => true)); ?>
                </li>
              </ul>
            </li>
            <li class="<?php echo strtolower($this->params['controller']) == 'events' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-social-dribbble"></i>
                <span class="title">Manage Events</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'events' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Events', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                <li>
                  <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Events', 'action' => 'add', 'admin' => true)); ?>
                </li>
                <?php } ?>
              </ul>
            </li>

            <li class="<?php if(strtolower($this->params['controller']) == 'teachertimetables') { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-speedometer"></i>
                <?php if($authUser["ROLE_ID"]==STUDENT_ID) {  ?>
                <span class="title">Time Table</span>
                <?php }else{ ?>
                <span class="title">Assign Time Table</span>
                <?php } ?>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'teachertimetables' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID))) {  ?>
                <li>
                  <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'add', 'admin' => true)); ?>
                </li>
                <?php } ?>

              </ul>
            </li>

            <li class="<?php if($this->params['action'] == 'admin_attendance_listing' && in_array(strtolower($this->params['controller']), $HR_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-bar-chart"></i>
                <span class="title">Attendance</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'attendance_listing', 'admin' => true)); ?>
                </li>
              </ul>
            </li>

            <li class="<?php echo strtolower($this->params['controller']) == 'noticeboard' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-bell"></i>
                <span class="title">Notice Board</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'noticeboard' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                <li>
                  <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'add', 'admin' => true)); ?>
                </li>
                <?php } ?>

              </ul>
            </li>

            <li class="<?php echo strtolower($this->params['controller']) == 'suggestions' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">User Suggestion</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'suggestions' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'suggestions', 'action' => 'index', 'admin' => true)); ?>
                </li>
              </ul>
            </li>

            <li class="
              <?php echo strtolower($this->params['controller']) == 'vacancy' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">Vacancy</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'vacancy' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'vacancy', 'action' => 'index', 'admin' => true)); ?>
                </li>
              </ul>
            </li>

            <li class="
              <?php if($this->params['action'] == 'admin_import' && in_array(strtolower($this->params['controller']), $HR_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
              <a href="javascript:;">
                <i class="fa icon-bubbles"></i>
                <span class="title">Import</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php if($this->params['action'] == 'admin_import' && in_array(strtolower($this->params['controller']), $HR_SECTION_CONTROLLER)) { echo 'open'; } ?>">
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
                <i class="fa icon-home"></i>
                <span class="title">Back To Home</span>
                <span class="selected"></span>
                <span class="arrow"></span>
              </a>
            </li>
          </ul>
        </li>
        <?php } ?>

        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID,SECURITY_ID))) { ?>
        <li class="
          <?php 
		  if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $SECURITY_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $SECURITY_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">Security</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo 'open'; } ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="
                <?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                <i class="fa icon-home"></i>
                <span class="title">Back To Home</span>
                <span class="selected"></span>
                <span class="arrow"></span>
              </a>
            </li>
          </ul>
        </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, STUDENT_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID,SECURITY_ID))) { ?>
        <li class="
          <?php 
		  if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $CANTEEN_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $CANTEEN_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">Canteen</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo 'open'; } ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="
                <?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                <i class="fa icon-home"></i>
                <span class="title">Back To Home</span>
                <span class="selected"></span>
                <span class="arrow"></span>
              </a>
            </li>
          </ul>
        </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, SUPERVISOR_ID, STUDENT_ID, ACCOUNT_ID, HR_ID, LIBRARY_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID,SECURITY_ID))) { ?>
        <li class="
          <?php 
		  if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $HOSTEL_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $HOSTEL_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">Hostel</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo 'open'; } ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li>
              <a href="
                <?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                <i class="fa icon-home"></i>
                <span class="title">Back To Home</span>
                <span class="selected"></span>
                <span class="arrow"></span>
              </a>
            </li>
          </ul>
        </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, SUPERVISOR_ID, ACCOUNT_ID, FRONT_ID))) { ?>
        <li class="
          <?php 
		  if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER) && in_array($this->params['action'], $ADMISSION_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $ADMISSION_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">Admission Section</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php if(in_array($this->params['action'], $DEPT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $DEPT_SECTION_CONTROLLER)) { echo 'open'; } ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li class="
              <?php echo strtolower($this->params['controller']) == 'appadmission' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-social-dribbble"></i>
                <span class="title">App Admission</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'appadmission' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                  <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'add', 'admin' => true)); ?>
                </li>
              </ul>
            </li>
            <li class="
              <?php echo strtolower($this->params['controller']) == 'StudentRegistration' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-social-dribbble"></i>
                <span class="title">Student Registration</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'StudentRegistration' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'StudentRegistration', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                  <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'StudentRegistration', 'action' => 'add', 'admin' => true)); ?>
                </li>
              </ul>
            </li>
            <li class="
              <?php echo strtolower($this->params['controller']) == 'AdmissionConfirm' ? 'active open' : '' ?>">
              <a href="javascript:;">
                <i class="fa icon-social-dribbble"></i>
                <span class="title">Confirm Admission</span>
                <span class="selected"></span>
                <span class="arrow"
                  <?php echo strtolower($this->params['controller']) == 'AdmissionConfirm' ? 'open' : '' ?>">
                </span>
              </a>
              <ul class="sub-menu">
                <li>
                  <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'AdmissionConfirm', 'action' => 'index', 'admin' => true)); ?>
                </li>
              </ul>
            </li>

            <li>
              <a href="
                <?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                <i class="fa icon-home"></i>
                <span class="title">Back To Home</span>
                <span class="selected"></span>
                <span class="arrow"></span>
              </a>
            </li>

          </ul>
        </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPERVISOR_ID, HR_ID))) { ?>
        <li class="
          <?php echo strtolower($this->params['controller']) == 'events' ? 'active open' : '' ?>">
          <a href="javascript:;">
            <i class="fa icon-social-dribbble"></i>
            <span class="title">Manage Events</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php echo strtolower($this->params['controller']) == 'events' ? 'open' : '' ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li>
              <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Events', 'action' => 'index', 'admin' => true)); ?>
            </li>
            <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
            <li>
              <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Events', 'action' => 'add', 'admin' => true)); ?>
            </li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>

        <?php if(in_array($authUser["ROLE_ID"], array(HR_ID))) { ?>
        <li class="
          <?php if(in_array($this->params['controller'], array('Fees'))) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">Vacancy</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php if(in_array($this->params['controller'], array('Fees'))) { echo 'open'; } ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li>
              <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Vacancy', 'action' => 'index', 'admin' => true)); ?>
            </li>
            <li>
              <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Vacancy', 'action' => 'add', 'admin' => true)); ?>
            </li>
          </ul>
        </li>

        <?php } ?>

        <?php if(in_array($authUser["ROLE_ID"], array(ACCOUNT_ID))) { ?>

        <li class="
          <?php if(in_array($this->params['controller'], array('FeeTypes'))) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">Manage Fees Type</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php if(in_array($this->params['controller'], array('FeeTypes'))) { echo 'open'; } ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li>
              <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'FeeTypes', 'action' => 'index', 'admin' => true)); ?>
            </li>
            <li>
              <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'FeeTypes', 'action' => 'add', 'admin' => true)); ?>
            </li>
          </ul>
        </li>

        <li class="
          <?php if(in_array($this->params['controller'], array('PaymentTypes'))) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">Payment Terms</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php if(in_array($this->params['controller'], array('PaymentTypes'))) { echo 'open'; } ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li>
              <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'PaymentTypes', 'action' => 'index', 'admin' => true)); ?>
            </li>
            <li>
              <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'PaymentTypes', 'action' => 'add', 'admin' => true)); ?>
            </li>
          </ul>
        </li>

        <?php } ?>

        <?php if(in_array($authUser["ROLE_ID"], array(STUDENT_ID))) { ?>


        <li class="
          <?php if(in_array($this->params['action'], array('admin_students', 'admin_add_student'))) { echo 'active open'; } ?>">

          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">Classmate Section</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php if(in_array($this->params['controller'], array('PaymentTypes'))) { echo 'open'; } ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li>
              <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'students', 'admin' => true)); ?>
            </li>
            <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
            <li>
              <?php echo $this->Html->link('Add New Student', array('plugin' => false, 'controller' => 'Users', 'action' => 'add_student', 'admin' => true)); ?>
            </li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(SUPERVISOR_ID))) { ?>
        <li class="
          <?php echo strtolower($this->params['controller']) == 'appadmission' ? 'active open' : '' ?>">
          <a href="javascript:;">
            <i class="fa icon-social-dribbble"></i>
            <span class="title">Admission Inquiry</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php echo strtolower($this->params['controller']) == 'appadmission' ? 'open' : '' ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li>
              <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'index', 'admin' => true)); ?>
            </li>
            <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,  SUPERVISOR_ID))) {  ?>
            <li>
              <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'index', 'admin' => true)); ?>
            </li>
            <?php } ?>
          </ul>
        </li>
        <?php } ?>
        <?php if(in_array($authUser["ROLE_ID"], array(TRANSPORTATION_ID))) { ?>
        <li class="
          <?php if(in_array($this->params['controller'], array('Fees'))) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">Route Schedule</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php if(in_array($this->params['controller'], array('Fees'))) { echo 'open'; } ?>">
            </span>
          </a>
          <ul class="sub-menu">

          </ul>
        </li>

        <li class="
          <?php if(in_array($this->params['controller'], array('Fees'))) { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-user-follow"></i>
            <span class="title">Driver</span>
            <span class="selected"></span>
            <span class="arrow"
              <?php if(in_array($this->params['controller'], array('Fees'))) { echo 'open'; } ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li>
              <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'index', 'admin' => true)); ?>
            </li>
            <li>
              <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Drivers', 'action' => 'add', 'admin' => true)); ?>
            </li>
          </ul>
        </li>
        <?php } ?>

        <?php if(in_array($authUser["ROLE_ID"], array(SUPERVISOR_ID, HR_ID))) { ?>
        <li class="
          <?php if(strtolower($this->params['controller']) == 'teachertimetables') { echo 'active open'; } ?>">
          <a href="javascript:;">
            <i class="fa icon-speedometer"></i>
            <?php if($authUser["ROLE_ID"]==STUDENT_ID) {  ?>
            <span class="title">Time Table</span>
            <?php }else{ ?>
            <span class="title">Assign Time Table</span>
            <?php } ?>
            <span class="selected"></span>
            <span class="arrow"
              <?php echo strtolower($this->params['controller']) == 'teachertimetables' ? 'open' : '' ?>">
            </span>
          </a>
          <ul class="sub-menu">
            <li>
              <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'index', 'admin' => true)); ?>
            </li>
            <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID))) {  ?>
            <li>
              <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'TeacherTimeTables', 'action' => 'add', 'admin' => true)); ?>
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

      <li class="<?php if(in_array($this->params['action'], $COMMUNICATION_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$COMMUNICATION_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
        <a href="javascript:;">
          <i class="fa icon-user-follow"></i>
          <span class="title">Communication</span>
          <span class="selected"></span>
          <span class="arrow"
            <?php if(in_array($this->params['action'],$COMMUNICATION_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$COMMUNICATION_SECTION_CONTROLLER)) { echo 'open'; } ?>">
          </span>
        </a>

        <ul class="sub-menu">
          <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, STUDENT_ID, ACCOUNT_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID, LIBRARY_ID))) { ?>
          <li class=" <?php echo strtolower($this->params['controller']) == 'suggestions' ? 'active open' : '' ?>">
            <a href="javascript:;">
              <i class="fa icon-bubbles"></i>
              <span class="title">User Suggestion</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php echo strtolower($this->params['controller']) == 'suggestions' ? 'open' : '' ?>">
              </span>
            </a>
            <ul class="sub-menu">
              <li>
                <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'suggestions', 'action' => 'index', 'admin' => true)); ?>
              </li>
              <li>
                <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'suggestions', 'action' => 'index', 'admin' => true)); ?>
              </li>
            </ul>
          </li>

          <li class="<?php echo strtolower($this->params['controller']) == 'noticeboard' ? 'active open' : '' ?>">
            <a href="javascript:;">
              <i class="fa icon-bell"></i>
              <span class="title">Notice Board</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php echo strtolower($this->params['controller']) == 'noticeboard' ? 'open' : '' ?>">
              </span>
            </a>
            <ul class="sub-menu">
              <li>
                <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'index', 'admin' => true)); ?>
              </li>
              <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPERVISOR_ID, SUPER_ADMIN_ID, TEACHER_ID, ACCOUNT_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID, LIBRARY_ID))) { ?>
              <li>
                <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'NoticeBoard', 'action' => 'add', 'admin' => true)); ?>
              </li>
              <?php } ?>
            </ul>
          </li>

          <li class="<?php echo strtolower($this->params['controller']) == '' ? 'active open' : '' ?>">
            <a href="javascript:;">
              <i class="fa icon-bell"></i>
              <span class="title">News & Update</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? 'open' : '' ?>">
              </span>
            </a>
            <ul class="sub-menu">
              <li>
                <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => '', 'action' => '', 'admin' => true)); ?>
              </li>
              <li>
                <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => '', 'action' => '', 'admin' => true)); ?>
              </li>

            </ul>
          </li>
          <?php } ?>
          <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, HR_ID, SUPER_ADMIN_ID, ACCOUNT_ID, TRANSPORTATION_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID, LIBRARY_ID))) { ?>

          <li class="<?php echo strtolower($this->params['controller']) == 'suggestions' ? 'active open' : '' ?>">
            <a href="javascript:;">
              <i class="fa icon-bubbles"></i>
              <span class="title">Mailer</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? 'open' : '' ?>">
              </span>
            </a>
            <ul class="sub-menu">
              <li>
                <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => '', 'action' => '', 'admin' => true)); ?>
              </li>
              <li>
                <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => '', 'action' => '', 'admin' => true)); ?>
              </li>
            </ul>
          </li>

          <li class="<?php echo strtolower($this->params['controller']) == 'suggestions' ? 'active open' : '' ?>">
            <a href="javascript:;">
              <i class="fa icon-bubbles"></i>
              <span class="title">SMS</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? 'open' : '' ?>">
              </span>
            </a>
            <ul class="sub-menu">
              <li>
                <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => '', 'action' => '', 'admin' => true)); ?>
              </li>
              <li>
                <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => '', 'action' => '', 'admin' => true)); ?>
              </li>
            </ul>
          </li>
          <?php } ?>
          <li>
            <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
              <i class="fa icon-home"></i>
              <span class="title">Back To Home</span>
              <span class="selected"></span>
              <span class="arrow"></span>
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


      <li class="<?php if(in_array($this->params['action'], $MEDIA_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$MEDIA_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
        <a href="javascript:;">
          <i class="fa icon-user-follow"></i>
          <span class="title">Media</span>
          <span class="selected"></span>
          <span class="arrow"
            <?php if(in_array($this->params['action'],$MEDIA_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$MEDIA_SECTION_CONTROLLER)) { echo 'open'; } ?>">
          </span>
        </a>

        <ul class="sub-menu">
          <?php if(in_array($authUser["ROLE_ID"], array(HR_ID, SUPERVISOR_ID))) { ?>
          <li class="<?php if($this->params['action'] == 'admin_import' && in_array(strtolower($this->params['controller']), $MEDIA_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
            <a href="javascript:;">
              <i class="fa icon-bubbles"></i>
              <span class="title">Import</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php if($this->params['action'] == 'admin_import' && in_array(strtolower($this->params['controller']), $MEDIA_SECTION_CONTROLLER)) { echo 'open'; } ?>">
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
          <li class="<?php echo strtolower($this->params['controller']) == 'album' ? 'active open' : '' ?>">
            <a href="javascript:;">
              <i class="fa icon-social-dribbble"></i>
              <span class="title">School Gallery</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php echo strtolower($this->params['controller']) == 'album' ? 'open' : '' ?>">
              </span>
            </a>
            <ul class="sub-menu">
              <li>
                <?php echo $this->Html->link('School Gallery', array('plugin' => false, 'controller' => 'Album', 'action' => 'school', 'admin' => true)); ?>
              </li>
            </ul>
          </li>

          <li class="<?php echo strtolower($this->params['controller']) == '' ? 'active open' : '' ?>">
            <a href="javascript:;">
              <i class="fa icon-social-dribbble"></i>
              <span class="title">Download</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php echo strtolower($this->params['controller']) == 'album' ? 'open' : '' ?>">
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

          <li class="<?php echo strtolower($this->params['controller']) == 'ebook' ? 'active open' : '' ?>">
            <a href="javascript:;">
              <i class="fa icon-book-open"></i>
              <span class="title">Manage Ebook</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php echo strtolower($this->params['controller']) == 'ebook' ? 'open' : '' ?>">
              </span>
            </a>
            <ul class="sub-menu">
              <li>
                <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'EBook', 'action' => 'index', 'admin' => true)); ?>
              </li>
              <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
              <li>
                <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'EBook', 'action' => 'add', 'admin' => true)); ?>
              </li>
              <?php }  ?>

            </ul>
          </li>
          <?php } ?>
          <li>
            <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
              <i class="fa icon-home"></i>
              <span class="title">Back To Home</span>
              <span class="selected"></span>
              <span class="arrow"></span>
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
      <li class="<?php if(in_array($this->params['action'],$GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$GENERAL_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
        <a href="javascript:;">
          <i class="fa icon-user-follow"></i>
          <span class="title">General Settings </span>
          <span class="selected"></span>
          <span class="arrow <?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$GENERAL_SECTION_CONTROLLER)) { echo 'open'; } ?>"></span>
        </a>


        <ul class="sub-menu">
<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, SUPERVISOR_ID, SUPER_ADMIN_ID))) { ?>

          <li class="
            <?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$GENERAL_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
            <a href="javascript:;">
              <i class="fa icon-user-follow"></i>
              <span class="title">General Settings</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$GENERAL_SECTION_CONTROLLER)) { echo 'open'; } ?>">
              </span>
            </a>
            <ul class="sub-menu">

              <li class="<?php echo strtolower($this->params['controller']) == 'bloodgroups' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Blood Groups</span>
                  <span class="selected"></span>
                  <span class="arrow <?php echo strtolower($this->params['controller']) == 'bloodgroups' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'BloodGroups', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'BloodGroups', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'castcategories' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Cast Categories</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'castcategories' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'CastCategories', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'CastCategories', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'categories' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Categories</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'categories' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Categories', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Categories', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'city' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">City</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'city' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'City', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'City', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'medium' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Medium</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'medium' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Medium', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Medium', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'pagescontent' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Pages Content</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'pagescontent' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'pagescontent', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'pagescontent', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'pagenames' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Page Names</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'pagenames' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'PageNames', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'PageNames', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'roles' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Roles</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'roles' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Roles', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Roles', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'school' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">School</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'school' ? 'open' : '' ?>">
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
                  <i class="fa icon-home"></i>
                  <span class="title">Back To Home</span>
                  <span class="selected"></span>
                  <span class="arrow"></span>
                </a>
              </li>
              
              
            </ul>


          </li>

<?php } ?>
<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, SUPER_ADMIN_ID))) { ?>

          <li class="<?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $GENERAL_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
            <a href="javascript:;">
              <i class="fa icon-user-follow"></i>
              <span class="title">Guest Section</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $GENERAL_SECTION_CONTROLLER)) { echo 'open'; } ?>">
              </span>
            </a>
            <ul class="sub-menu">

              <li class="<?php echo strtolower($this->params['controller']) == 'school' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">School</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'school' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('Edit School', array('plugin' => false, 'controller' => 'School', 'action' => 'edit', 1, 'admin' => true)); ?>
                  </li>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'album' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Manage certification</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'album' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('Certification', array('plugin' => false, 'controller' => 'Album', 'action' => 'certification', 'admin' => true)); ?>
                  </li>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'album' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">School Gallery</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'album' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('School Gallery', array('plugin' => false, 'controller' => 'Album', 'action' => 'school', 'admin' => true)); ?>
                  </li>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'school' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Brochure</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'school' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View Brochure', array('plugin' => false, 'controller' => 'School', 'action' => 'view', 1, 'admin' => true)); ?>
                  </li>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'achievements' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Achievements</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'achievements' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Achievements', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Achievements', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'testimonials' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Testimonials</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'testimonials' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Testimonials', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Testimonials', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'vacancy' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Vacancy</span>
                  <span class="selected"></span>
                  <span class="arrow <?php echo strtolower($this->params['controller']) == 'vacancy' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Vacancy', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                </ul>
              </li>

         
                <li>
                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                  <i class="fa icon-home"></i>
                  <span class="title">Back To Home</span>
                  <span class="selected"></span>
                  <span class="arrow"></span>
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

      <li class="<?php if(in_array($this->params['action'], $OTHER_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$OTHER_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
        <a href="javascript:;">
          <i class="fa icon-user-follow"></i>
          <span class="title">Others</span>
          <span class="selected"></span>
          <span class="arrow"
            <?php if(in_array($this->params['action'], $OTHER_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$OTHER_SECTION_CONTROLLER)) { echo 'open'; } ?>">
          </span>
        </a>

        <ul class="sub-menu">
          <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, ADMIN_ID, ACCOUNT_ID, HR_ID, TRANSPORTATION_ID, LIBRARY_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID))) { ?>
          <li class="<?php echo strtolower($this->params['controller']) == '' ?>">
            <a href="javascript:;">
              <i class="fa icon-social-dribbble"></i>
              <span class="title">Utility & Help</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
              </span>
            </a>
          </li>


          <?php  } ?>
          <?php if(in_array($authUser["ROLE_ID"], array(SUPER_ADMIN_ID, STUDENT_ID , HR_ID, ADMIN_ID, SUPERVISOR_ID,  ACCOUNT_ID, TEACHER_ID, TRANSPORTATION_ID, LIBRARY_ID, STORE_ID, HOSTEL_ID, CANTEEN_ID, FRONT_ID, SECURITY_ID))) { ?>
          <li class="<?php echo strtolower($this->params['controller']) ==  '' ?>">
            <a href="javascript:;">
              <i class="fa icon-social-dribbble"></i>
              <span class="title">Share This App</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
              </span>
            </a>

          </li>

          <li class="<?php echo strtolower($this->params['controller']) == '' ?>">
            <a href="javascript:;">
              <i class="fa icon-social-dribbble"></i>
              <span class="title">Contact Us</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
              </span>
            </a>

          </li>

          <li class="<?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
            <a href="javascript:;">
              <i class="fa icon-social-dribbble"></i>
              <span class="title">Refer a Friend</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php echo strtolower($this->params['controller']) == '' ? '' : '' ?>">
              </span>
            </a>

          </li>

          <li>
            <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
              <i class="fa icon-home"></i>
              <span class="title">Back To Home</span>
              <span class="selected"></span>
              <span class="arrow"></span>
            </a>
          </li>

          <?php }  ?>
        </ul>
      </li>


	   

	
		
			   
			    <?php
						   $PERSONAL_SECTION_ACTION = array(
							'admin_add',
							'admin_edit',
							'admin_index',
							'admin_view',
							'admin_delete',
							
							);
						   
						   $PERSONAL_SECTION_CONTROLLER = array(
							'profile',
							'idcard',
							'dailydiary',
							'history',
							'leave',
							'attendance',
							'remark',
							'homeworks',
						   );
		   
						?>

			<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, SUPERVISOR_ID, SUPER_ADMIN_ID))) { ?>
      <li class="<?php if(in_array($this->params['action'],$GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$GENERAL_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
        <a href="javascript:;">
          <i class="fa icon-user-follow"></i>
          <span class="title">personal</span>
          <span class="selected"></span>
          <span class="arrow <?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$GENERAL_SECTION_CONTROLLER)) { echo 'open'; } ?>"></span>
        </a>


        <ul class="sub-menu">
<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, SUPERVISOR_ID, SUPER_ADMIN_ID))) { ?>

          <li class="<?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$GENERAL_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
            <a href="javascript:;">
              <i class="fa icon-user-follow"></i>
              <span class="title">Dayli dire</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']),$GENERAL_SECTION_CONTROLLER)) { echo 'open'; } ?>">
              </span>
            </a>
            <ul class="sub-menu">

              <li class="<?php echo strtolower($this->params['controller']) == 'homeworks' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">HOME WORK</span>
                  <span class="selected"></span>
                  <span class="arrow <?php echo strtolower($this->params['controller']) == 'homeworks' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'homeworks', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'homeworks', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'castcategories' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Cast Categories</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'castcategories' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'CastCategories', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'CastCategories', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'categories' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Categories</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'categories' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Categories', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Categories', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'city' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">City</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'city' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'City', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'City', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'medium' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Medium</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'medium' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Medium', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Medium', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'pagescontent' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Pages Content</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'pagescontent' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'pagescontent', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'pagescontent', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'pagenames' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Page Names</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'pagenames' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'PageNames', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'PageNames', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class=" <?php echo strtolower($this->params['controller']) == 'roles' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Roles</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'roles' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Roles', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Roles', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'school' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">School</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'school' ? 'open' : '' ?>">
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
                  <i class="fa icon-home"></i>
                  <span class="title">Back To Home</span>
                  <span class="selected"></span>
                  <span class="arrow"></span>
                </a>
              </li>
              
              
            </ul>


          </li>

<?php } ?>
<?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, SUPER_ADMIN_ID))) { ?>

          <li class="<?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $GENERAL_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
            <a href="javascript:;">
              <i class="fa icon-user-follow"></i>
              <span class="title">Guest Section</span>
              <span class="selected"></span>
              <span class="arrow"
                <?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $GENERAL_SECTION_CONTROLLER)) { echo 'open'; } ?>">
              </span>
            </a>
            <ul class="sub-menu">

              <li class="<?php echo strtolower($this->params['controller']) == 'school' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">School</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'school' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('Edit School', array('plugin' => false, 'controller' => 'School', 'action' => 'edit', 1, 'admin' => true)); ?>
                  </li>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'album' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Manage certification</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'album' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('Certification', array('plugin' => false, 'controller' => 'Album', 'action' => 'certification', 'admin' => true)); ?>
                  </li>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'album' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">School Gallery</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'album' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('School Gallery', array('plugin' => false, 'controller' => 'Album', 'action' => 'school', 'admin' => true)); ?>
                  </li>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'school' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Brochure</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'school' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View Brochure', array('plugin' => false, 'controller' => 'School', 'action' => 'view', 1, 'admin' => true)); ?>
                  </li>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'achievements' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Achievements</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'achievements' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Achievements', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Achievements', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'testimonials' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Testimonials</span>
                  <span class="selected"></span>
                  <span class="arrow"
                    <?php echo strtolower($this->params['controller']) == 'testimonials' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Testimonials', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                  <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                  <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Testimonials', 'action' => 'add', 'admin' => true)); ?>
                  </li>
                  <?php } ?>
                </ul>
              </li>

              <li class="<?php echo strtolower($this->params['controller']) == 'vacancy' ? 'active open' : '' ?>">
                <a href="javascript:;">
                  <i class="fa icon-social-dribbble"></i>
                  <span class="title">Vacancy</span>
                  <span class="selected"></span>
                  <span class="arrow <?php echo strtolower($this->params['controller']) == 'vacancy' ? 'open' : '' ?>">
                  </span>
                </a>
                <ul class="sub-menu">
                  <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Vacancy', 'action' => 'index', 'admin' => true)); ?>
                  </li>
                </ul>
              </li>

         
                <li>
                <a href="<?php echo Router::url(array('plugin' => false, 'controller' => 'Users', 'action' => 'dashboard', 'admin' => true)) ?>">
                  <i class="fa icon-home"></i>
                  <span class="title">Back To Home</span>
                  <span class="selected"></span>
                  <span class="arrow"></span>
                </a>
              </li>
              
            </ul>
          </li>
<?php } ?>


        </ul>



      </li>
<?php } ?>				 
	  
      </ul>


    </div>
	</div>
	
	
<?php }  ?> 