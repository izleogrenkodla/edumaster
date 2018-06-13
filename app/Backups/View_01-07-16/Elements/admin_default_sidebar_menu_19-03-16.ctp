<?php if (isset($authUser)) { ?>
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
    <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->

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
	   
	    <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID))) { ?>
	   
	   <li class="<?php if(in_array($this->params['action'], $HR_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $HR_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">HR Section</span>
                <span class="selected"></span>
                <span class="arrow <?php if(in_array($this->params['action'], $HR_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $HR_SECTION_CONTROLLER)) { echo 'open'; } ?>"></span>
            </a>
            <ul class="sub-menu">
				<li class="<?php echo strtolower($this->params['controller']) == 'leaveapplications' ? 'active open' : '' ?>">
					<a href="javascript:;">
						<i class="fa icon-envelope-letter"></i>
						<span class="title">Leave Applications</span>
						<span class="selected"></span>
						<span class="arrow <?php echo strtolower($this->params['controller']) == 'leaveapplications' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'events' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'teachertimetables' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>"></span>
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
						<span class="arrow <?php echo strtolower($this->params['controller']) == 'noticeboard' ? 'open' : '' ?>"></span>
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
						<span class="arrow <?php echo strtolower($this->params['controller']) == 'suggestions' ? 'open' : '' ?>"></span>
					</a>
					<ul class="sub-menu">
						<li>
							<?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'suggestions', 'action' => 'index', 'admin' => true)); ?>
						</li>
					</ul>
				</li>

				<li class="<?php echo strtolower($this->params['controller']) == 'vacancy' ? 'active open' : '' ?>">
					<a href="javascript:;">
						<i class="fa icon-bubbles"></i>
						<span class="title">Vacancy</span>
						<span class="selected"></span>
						<span class="arrow <?php echo strtolower($this->params['controller']) == 'vacancy' ? 'open' : '' ?>"></span>
					</a>
					<ul class="sub-menu">
						<li>
							<?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'vacancy', 'action' => 'index', 'admin' => true)); ?>
						</li>
					</ul>
				</li>

				<li class="<?php if($this->params['action'] == 'admin_import' && in_array(strtolower($this->params['controller']), $HR_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
					<a href="javascript:;">
						<i class="fa icon-bubbles"></i>
						<span class="title">Import</span>
						<span class="selected"></span>
						<span class="arrow <?php if($this->params['action'] == 'admin_import' && in_array(strtolower($this->params['controller']), $HR_SECTION_CONTROLLER)) { echo 'open'; } ?>"></span>
					</a>
					<ul class="sub-menu">
						<li>
							<?php echo $this->Html->link('Bulk Import', array('plugin' => false, 'controller' => 'Users', 'action' => 'import', 'admin' => true)); ?>
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
	   
	   <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID,TEACHER_ID))) { ?>
	   
	   	   <li class="<?php if(in_array($this->params['action'], $TEACHER_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $TEACHER_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">Teacher Section</span>
                <span class="selected"></span>
                <span class="arrow <?php if(in_array($this->params['action'], $TEACHER_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $TEACHER_SECTION_CONTROLLER)) { echo 'open'; } ?>"></span>
            </a>
			
        <ul class="sub-menu">	   
	    <li class="<?php if(in_array($this->params['action'], array('admin_students', 'admin_add_student'))) { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <span class="title">Admission Section</span>
                <?php } ?>
                <?php if($authUser["ROLE_ID"]==STUDENT_ID) { ?>
                    <span class="title">Classmate Section</span>
                <?php } ?>
                <?php if($authUser["ROLE_ID"]==TEACHER_ID) { ?>
                    <span class="title">Student Section</span>
                <?php } ?>
                <span class="selected"></span>
                <span class="arrow <?php echo in_array($this->params['action'], array('admin_students', 'admin_add_student')) ? 'open' : '' ?>"></span>
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
		
		<li class="<?php echo strtolower($this->params['controller']) == 'ebook' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-book-open"></i>
                <span class="title">Manage Ebook</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'ebook' ? 'open' : '' ?>"></span>
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
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'noticeboard' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'events' ? 'open' : '' ?>"></span>
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
                <span class="arrow <?php echo in_array($this->params['action'], array('admin_supervisors', 'admin_add_supervisor')) ? 'open' : '' ?>"></span>
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
                <span class="arrow <?php echo in_array($this->params['action'], array('admin_teachers','admin_add_teacher')) ? 'open' : '' ?>"></span>
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
				<span class="arrow <?php echo strtolower($this->params['controller']) == 'leaveapplications' ? 'open' : '' ?>"></span>
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
						<span class="arrow <?php echo strtolower($this->params['controller']) == 'suggestions' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'teachertimetables' ? 'open' : '' ?>"></span>
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
			<span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>"></span>
		</a>
		<ul class="sub-menu">
			<li>
				<?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'attendance_listing', 'admin' => true)); ?>
			</li>
		</ul>
		</li>
		
		<li class="<?php echo strtolower($this->params['controller']) == 'classwork' ? 'active open' : '' ?>">
		<a href="javascript:;">
			<i class="fa icon-bubbles"></i>
			<span class="title">Classwork</span>
			<span class="selected"></span>
			<span class="arrow <?php echo strtolower($this->params['controller']) == 'classwork' ? 'open' : '' ?>"></span>
		</a>
		<ul class="sub-menu">
			<li>
				<?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'classwork', 'action' => 'index', 'admin' => true)); ?>
			</li>
		</ul>
		</li>

		<li class="<?php echo strtolower($this->params['controller']) == 'homeworks' ? 'active open' : '' ?>">
		<a href="javascript:;">
			<i class="fa icon-bubbles"></i>
			<span class="title">Homeworks</span>
			<span class="selected"></span>
			<span class="arrow <?php echo strtolower($this->params['controller']) == 'homeworks' ? 'open' : '' ?>"></span>
		</a>
		<ul class="sub-menu">
			<li>
				<?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'homeworks', 'action' => 'index', 'admin' => true)); ?>
			</li>
		</ul>
		</li>
		
		<li class="<?php if($this->params['action'] == 'admin_student_ledger' && in_array(strtolower($this->params['controller']), $HR_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
		<a href="javascript:;">
			<i class="fa icon-bar-chart"></i>
			<span class="title">Students Ledger</span>
			<span class="selected"></span>
			<span class="arrow <?php if($this->params['action'] == 'admin_student_ledger' && in_array(strtolower($this->params['controller']), $HR_SECTION_CONTROLLER)) { echo 'open'; } ?>"></span>
		</a>
		<ul class="sub-menu">
			<li>
				<?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'student_ledger', 'admin' => true)); ?>
			</li>
		</ul>
		</li>
		
		<li class="<?php echo strtolower($this->params['controller']) == 'transports' ? 'active open' : '' ?>">
		<a href="javascript:;">
			<i class="fa icon-bubbles"></i>
			<span class="title">Transports</span>
			<span class="selected"></span>
			<span class="arrow <?php echo strtolower($this->params['controller']) == 'transports' ? 'open' : '' ?>"></span>
		</a>
		<ul class="sub-menu">
			<li>
				<?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'transports', 'action' => 'index', 'admin' => true)); ?>
			</li>
		</ul>
		</li>

		<li class="<?php echo strtolower($this->params['controller']) == 'exams' ? 'active open' : '' ?>">
		<a href="javascript:;">
			<i class="fa icon-bubbles"></i>
			<span class="title">Exams</span>
			<span class="selected"></span>
			<span class="arrow <?php echo strtolower($this->params['controller']) == 'exams' ? 'open' : '' ?>"></span>
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

		<li class="<?php echo strtolower($this->params['controller']) == 'results' ? 'active open' : '' ?>">
		<a href="javascript:;">
			<i class="fa icon-bubbles"></i>
			<span class="title">Results</span>
			<span class="selected"></span>
			<span class="arrow <?php echo strtolower($this->params['controller']) == 'results' ? 'open' : '' ?>"></span>
		</a>
		<ul class="sub-menu">			
			<li>
				<?php echo $this->Html->link('Exam Result', array('plugin' => false, 'controller' => 'results', 'action' => 'index', 'admin' => true)); ?>
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
	   
	   <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID,ACCOUNT_ID))) { ?>
	   
        <li class="<?php if(in_array($this->params['action'], $ACCOUNT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $ACCOUNT_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">Account Section</span>
                <span class="selected"></span>
                <span class="arrow <?php if(in_array($this->params['action'], $ACCOUNT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $ACCOUNT_SECTION_CONTROLLER)) { echo 'open'; } ?>"></span>
            </a>
            <ul class="sub-menu">
                <li class="<?php if(in_array($this->params['controller'], array('Fees'))) { echo 'active open'; } ?>">
				<a href="javascript:;">
					<i class="fa icon-user-follow"></i>
					<span class="title">Manage Fees</span>
					<span class="selected"></span>
					<span class="arrow <?php if(in_array($this->params['controller'], array('Fees'))) { echo 'open'; } ?>"></span>
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
					<span class="arrow <?php if(in_array($this->params['controller'], array('FeeTypes'))) { echo 'open'; } ?>"></span>
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
					<span class="arrow <?php if(in_array($this->params['controller'], array('PaymentTypes'))) { echo 'open'; } ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['action']) == 'student_ledger' ? 'open' : '' ?>"></span>
				</a>
				<ul class="sub-menu">
					<li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'student_ledger', 'admin' => true)); ?>
					</li>
				</ul>
                </li>
            </ul>
        </li>
	   <?php } ?>
	   
	   <?php
	   $LIBRARY_SECTION_ACTION = array(
		'admin_add',
		'admin_edit',
		'admin_index'
		);
	   
	   $LIBRARY_SECTION_CONTROLLER = array(
	   'library',
	   );	   
	   ?>
	   
	   <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID))) { ?>
	   
        <li class="<?php if(in_array($this->params['action'], $LIBRARY_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $LIBRARY_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">Library Section</span>
                <span class="selected"></span>
                <span class="arrow <?php if(in_array($this->params['action'], $LIBRARY_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $LIBRARY_SECTION_CONTROLLER)) { echo 'open'; } ?>"></span>
            </a>
            <ul class="sub-menu">		
				
				<li class="<?php if(in_array(strtolower($this->params['controller']), $LIBRARY_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
				<a href="javascript:;">
					<i class="fa icon-bubbles"></i>
					<span class="title">Manage Library</span>
					<span class="selected"></span>
					<span class="arrow <?php if(in_array(strtolower($this->params['controller']), $LIBRARY_SECTION_CONTROLLER)) { echo 'open'; } ?>"></span>
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
	   
	   <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, SUPERVISOR_ID))) { ?>
	   
        <li class="<?php if(in_array($this->params['action'], $SUP_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $SUP_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">Supervisors Section</span>
                <span class="selected"></span>
                <span class="arrow <?php if(in_array($this->params['action'], $SUP_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $SUP_SECTION_CONTROLLER)) { echo 'open'; } ?>"></span>
            </a>
            <ul class="sub-menu">				
				<li class="<?php echo strtolower($this->params['controller']) == 'exams' ? 'active open' : '' ?>">
				<a href="javascript:;">
					<i class="fa icon-bubbles"></i>
					<span class="title">Exams</span>
					<span class="selected"></span>
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'exams' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo $this->params['controller'] == 'ExamTypes' ? 'open' : ''; ?>"></span>
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
					<span class="arrow <?php echo $this->params['controller'] == 'Holidays' ? 'open' : ''; ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'events' ? 'open' : '' ?>"></span>
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
						<span class="arrow <?php if($this->params['action'] == 'admin_import' && in_array(strtolower($this->params['controller']), $SUP_SECTION_CONTROLLER)) { echo 'open'; } ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'subjects' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'transports' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'admissionforms' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'appadmission' ? 'open' : '' ?>"></span>
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
	   
	   <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID, STUDENT_ID))) { ?>
	   
        <li class="<?php if(in_array($this->params['action'], $STUDENT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $STUDENT_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">Student Section</span>
                <span class="selected"></span>
                <span class="arrow <?php if(in_array($this->params['action'], $STUDENT_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $STUDENT_SECTION_CONTROLLER)) { echo 'open'; } ?>"></span>
            </a>
            <ul class="sub-menu">
			
				<li class="<?php echo strtolower($this->params['controller']) == 'appadmission' ? 'active open' : '' ?>">
				<a href="javascript:;">
					<i class="fa icon-social-dribbble"></i>
					<span class="title">App Admission</span>
					<span class="selected"></span>
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'appadmission' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'admissionforms' ? 'open' : '' ?>"></span>
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
					<?php } ?>
					<?php if($authUser["ROLE_ID"]==STUDENT_ID) { ?>
						<span class="title">Classmate Section</span>
					<?php } ?>
					<?php if($authUser["ROLE_ID"]==TEACHER_ID) { ?>
						<span class="title">Student Section</span>
					<?php } ?>
					<span class="selected"></span>
					<span class="arrow <?php echo in_array($this->params['action'], array('admin_students', 'admin_add_student')) ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php if(in_array($this->params['controller'], array('Fees'))) { echo 'open'; } ?>"></span>
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

	   <?php
	   $GENERAL_SECTION_ACTION = array(
		'admin_add',
		'admin_edit',
		'admin_index',
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
	   );
	   
	   ?>
	   
	   <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID))) { ?>
	   
        <li class="<?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $GENERAL_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">General Settings Section</span>
                <span class="selected"></span>
                <span class="arrow <?php if(in_array($this->params['action'], $GENERAL_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $GENERAL_SECTION_CONTROLLER)) { echo 'open'; } ?>"></span>
            </a>
            <ul class="sub-menu">	
				
				<li class="<?php echo strtolower($this->params['controller']) == 'bloodgroups' ? 'active open' : '' ?>">
				<a href="javascript:;">
					<i class="fa icon-social-dribbble"></i>
					<span class="title">Blood Groups</span>
					<span class="selected"></span>
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'bloodgroups' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'castcategories' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'categories' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'city' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'medium' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'pagescontent' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'pagenames' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'roles' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'school' ? 'open' : '' ?>"></span>
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

	   <?php
	   $GUEST_SECTION_ACTION = array(
		'admin_add',
		'admin_edit',
		'admin_index',
		'admin_school',
		'admin_view'
		);
	   
	   $GUEST_SECTION_CONTROLLER = array(
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
	   
	   <?php if(in_array($authUser["ROLE_ID"], array(ADMIN_ID))) { ?>
	   
        <li class="<?php if(in_array($this->params['action'], $GUEST_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $GUEST_SECTION_CONTROLLER)) { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">Guest Section</span>
                <span class="selected"></span>
                <span class="arrow <?php if(in_array($this->params['action'], $GUEST_SECTION_ACTION) && in_array(strtolower($this->params['controller']), $GUEST_SECTION_CONTROLLER)) { echo 'open'; } ?>"></span>
            </a>
            <ul class="sub-menu">
			
				<li class="<?php echo strtolower($this->params['controller']) == 'school' ? 'active open' : '' ?>">
				<a href="javascript:;">
					<i class="fa icon-social-dribbble"></i>
					<span class="title">School</span>
					<span class="selected"></span>
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'school' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'album' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'album' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'school' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'achievements' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'testimonials' ? 'open' : '' ?>"></span>
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
					<span class="arrow <?php echo strtolower($this->params['controller']) == 'vacancy' ? 'open' : '' ?>"></span>
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

    <!-- END SIDEBAR MENU -->
    </div>
    </div>
<?php } ?>