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

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo $this->params['controller'] == 'Roles' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-badge"></i>
                <span class="title">Manage Role</span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'roles' ? '' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Roles', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Roles', 'action' => 'add', 'admin' => true)); ?>
                </li>
            </ul>
        </li>
    <?php } ?>


    <li class="<?php echo $this->params['controller'] == 'School' ? 'active open' : '' ?>">
        <a href="javascript:;">
            <i class="fa icon-settings"></i>
            <span class="title">Manage School Profile</span>
            <span class="arrow <?php echo strtolower($this->params['controller']) == 'school' ? '' : '' ?>"></span>
        </a>
        <ul class="sub-menu">
            <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                <li>
                    <?php echo $this->Html->link('Edit Information', array('plugin' => false, 'controller' => 'School', 'action' => 'edit', '1', 'admin' => true)); ?>
                </li>
            <?php } ?>
            <li>
                <?php echo $this->Html->link('View Information', array('plugin' => false, 'controller' => 'School', 'action' => 'view', '1', 'admin' => true)); ?>
            </li>

        </ul>
    </li>


    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo $this->params['controller'] == 'Medium' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-tag"></i>
                <span class="title">Medium Section</span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'medium' ? '' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Medium', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Medium', 'action' => 'add', 'admin' => true)); ?>
                </li>
            </ul>
        </li>
    <?php } ?>


    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo $this->params['controller'] == 'AdmissionForms' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-users"></i>
                <span class="title">Adminssion Form</span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'admissionforms' ? '' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'AdmissionForms', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'AdmissionForms', 'action' => 'add', 'admin' => true)); ?>
                </li>
            </ul>
        </li>
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo $this->params['controller'] == 'AppAdmission' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-info"></i>
                <span class="title">Adminssion Inquiry</span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'appadmission' ? '' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'AppAdmission', 'action' => 'index', 'admin' => true)); ?>
                </li>
            </ul>
        </li>
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo $this->params['controller'] == 'Categories' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-badge"></i>
                <span class="title">Manage Category</span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'categories' ? '' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Categories', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Categories', 'action' => 'add', 'admin' => true)); ?>
                </li>
            </ul>
        </li>
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo $this->params['controller'] == 'PageNames' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-docs"></i>
                <span class="title">Manage Page Name</span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'pagenames' ? '' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'PageNames', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'PageNames', 'action' => 'add', 'admin' => true)); ?>
                </li>
            </ul>
        </li>
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo $this->params['controller'] == 'PagesContent' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-book-open"></i>
                <span class="title">Manage Page Content</span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'pagescontent' ? '' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'PagesContent', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'PagesContent', 'action' => 'add', 'admin' => true)); ?>
                </li>
            </ul>
        </li>
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo $this->params['controller'] == 'Achievements' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-trophy"></i>
                <span class="title">Manage Achievements</span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'achievements' ? '' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Achievements', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Achievements', 'action' => 'add', 'admin' => true)); ?>
                </li>
            </ul>
        </li>
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo $this->params['controller'] == 'Testimonials' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-speech"></i>
                <span class="title">Manage Testimonials</span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'testimonials' ? '' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Testimonials', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Testimonials', 'action' => 'add', 'admin' => true)); ?>
                </li>
            </ul>
        </li>
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo $this->params['controller'] == 'City' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-home"></i>
                <span class="title">Manage City</span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'city' ? '' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'City', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'City', 'action' => 'add', 'admin' => true)); ?>
                </li>
            </ul>
        </li>
    <?php } ?>



    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo $this->params['controller'] == 'CastCategories' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-badge"></i>
                <span class="title">Cast Categories</span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'castcategories' ? '' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'CastCategories', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'CastCategories', 'action' => 'add', 'admin' => true)); ?>
                </li>
            </ul>
        </li>
    <?php }?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) {

        $classArr = array(
            'admin_add',
            'admin_edit',
            'admin_index',
            'admin_gallery'
        );

        ?>

        <li class="<?php if(in_array($this->params['action'], $classArr) && strtolower($this->params['controller']) == 'album' && (in_array('albumlist',$this->params["pass"]))) { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-picture"></i>
                <span class="title">Manage Album</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'album' ? 'open' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View Album', array('plugin' => false, 'controller' => 'Album', 'action' => 'index', 'albumlist', 'admin' => true)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Add Album', array('plugin' => false, 'controller' => 'Album', 'action' => 'add', 'albumlist', 'admin' => true)); ?>
                </li>
            </ul>
        </li>
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) {

        $schoolArr = array(
            'admin_add_school',
            'admin_edit_school',
            'admin_school',
            'admin_gallery'

        );

        ?>
        <li class="<?php if(in_array($this->params['action'], $schoolArr) && strtolower($this->params['controller']) == 'album' && (in_array('schoollist',$this->params["pass"]))) { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-picture"></i>
                <span class="title">School Gallery</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'album' ? 'open' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View School Gallery', array('plugin' => false, 'controller' => 'Album', 'action' => 'school', 'schoollist', 'admin' => true)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Add School Gallery', array('plugin' => false, 'controller' => 'Album', 'action' => 'add_school', 'schoollist', 'admin' => true)); ?>
                </li>
            </ul>
        </li>
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) {

        $certificationArr = array(
            'admin_add_certification',
            'admin_edit_certification',
            'admin_certification'
        );

        ?>
        <li class="<?php if(in_array($this->params['action'], $certificationArr) && strtolower($this->params['controller']) == 'album') { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-graduation"></i>
                <span class="title">Manage Certification</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'album' ? 'open' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View Certification', array('plugin' => false, 'controller' => 'Album', 'action' => 'certification', 'admin' => true)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Add Certification', array('plugin' => false, 'controller' => 'Album', 'action' => 'add_certification', 'admin' => true)); ?>
                </li>
            </ul>
        </li>
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo $this->params['controller'] == 'BloodGroups' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-chemistry"></i>
                <span class="title">Blood Group</span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'bloodgroups' ? '' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'BloodGroups', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'BloodGroups', 'action' => 'add', 'admin' => true)); ?>
                </li>
            </ul>
        </li>
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==STUDENT_ID || $authUser["ROLE_ID"]==TEACHER_ID) {

        $studentArr = array(
            'admin_add_student',
            'admin_edit_student',
            'admin_view_student',
            'admin_students'
        );

        ?>
        <li class="<?php if(in_array($this->params['action'], $studentArr) && strtolower($this->params['controller']) == 'users') { echo 'active open'; } ?>">
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
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>"></span>
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

    <?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==TEACHER_ID) {

        $supervisorArr = array(
            'admin_add_supervisor',
            'admin_edit_supervisor',
            'admin_view_supervisor',
            'admin_supervisors'
        );

        ?>
        <li class="<?php if(in_array($this->params['action'], $supervisorArr) && strtolower($this->params['controller']) == 'users') { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">Supervisor Section</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>"></span>
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
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==STUDENT_ID || $authUser["ROLE_ID"]==TEACHER_ID) {

        $teacherArr = array(
            'admin_add_teacher',
            'admin_edit_teacher',
            'admin_view_teacher',
            'admin_teachers'
        );

        ?>
        <li class="<?php if(in_array($this->params['action'], $teacherArr) && strtolower($this->params['controller']) == 'users') { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-users"></i>
                <span class="title">Teacher Section</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>"></span>
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
    <?php } ?>

    <!--<li class="<?php echo strtolower($this->params['controller']) == 'users' ? 'active open' : '' ?>">
        <a href="javascript:;">
            <i class="fa icon-users"></i>
            <span class="title">User Section</span>
            <span class="selected"></span>
            <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>"></span>
        </a>
        <ul class="sub-menu">
            <li>
                <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'index', 'admin' => true)); ?>
            </li>
            <li>
                <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Users', 'action' => 'add', 'admin' => true)); ?>
            </li>
        </ul>
    </li>-->

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) {

        $teacherArr = array(
            'admin_add_hr',
            'admin_edit_hr',
            'admin_view_hr',
            'admin_hr'
        );

        ?>
        <li class="<?php if(in_array($this->params['action'], $teacherArr) && strtolower($this->params['controller']) == 'users') { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">HR Section</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'hr', 'admin' => true)); ?>
                </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                        <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Users', 'action' => 'add_hr', 'admin' => true)); ?>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>

    <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,ACCOUNT_ID))) {

        $AccountArr = array(
            'admin_add_account',
            'admin_edit_account',
            'admin_view_account',
            'admin_account',
            'admin_student_ledger',
            'admin_view_student_ledger',
        );

        ?>
        <li class="<?php if(in_array($this->params['action'], $AccountArr) && strtolower($this->params['controller']) == 'users') { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-user-follow"></i>
                <span class="title">Account Section</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'users' ? 'open' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'account', 'admin' => true)); ?>
                </li>
                <li>
                    <?php echo $this->Html->link('Student Fees Ledger', array('plugin' => false, 'controller' => 'Users', 'action' => 'student_ledger', 'admin' => true)); ?>
                </li>

                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                        <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Users', 'action' => 'add_account', 'admin' => true)); ?>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo strtolower($this->params['controller']) == 'paymenttypes' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-direction"></i>
                <span class="title">Payment Terms</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'paymenttypes' ? 'open' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'PaymentTypes', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                        <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'PaymentTypes', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo strtolower($this->params['controller']) == 'feetypes' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-layers"></i>
                <span class="title">Manage FeeTypes</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'feetypes' ? 'open' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'FeeTypes', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                        <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'FeeTypes', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo strtolower($this->params['controller']) == 'fees' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-briefcase"></i>
                <span class="title">Manage Fees</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'fees' ? 'open' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Fees', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                        <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Fees', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==STUDENT_ID || $authUser["ROLE_ID"]==TEACHER_ID) { ?>
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
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==STUDENT_ID || $authUser["ROLE_ID"]==TEACHER_ID) { ?>
        <li class="<?php echo strtolower($this->params['controller']) == 'ebook' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-book-open"></i>
                <span class="title">Manage EBook</span>
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
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo strtolower($this->params['controller']) == 'subjects' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-tag"></i>
                <span class="title">Manage Subject</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'subjects' ? 'open' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Subjects', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                        <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Subjects', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo strtolower($this->params['controller']) == 'transports' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-pointer"></i>
                <span class="title">Manage Transport</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'transports' ? 'open' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Transports', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                        <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Transports', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==STUDENT_ID || $authUser["ROLE_ID"]==TEACHER_ID) { ?>
        <li class="<?php echo strtolower($this->params['controller']) == 'blog' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-note"></i>
                <span class="title">Manage Blog</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'blog' ? 'open' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Blog', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==TEACHER_ID) { ?>
                    <li>
                        <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Blog', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==STUDENT_ID || $authUser["ROLE_ID"]==TEACHER_ID) { ?>
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
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
        <li class="<?php echo strtolower($this->params['controller']) == 'holidays' ? 'active open' : '' ?>">
            <a href="javascript:;">
                <i class="fa icon-calendar"></i>
                <span class="title">Manage Holiday</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'holidays' ? 'open' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Holidays', 'action' => 'index', 'admin' => true)); ?>
                </li>
                <?php if($authUser["ROLE_ID"]==ADMIN_ID) { ?>
                    <li>
                        <?php echo $this->Html->link('Add New', array('plugin' => false, 'controller' => 'Holidays', 'action' => 'add', 'admin' => true)); ?>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>

    <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,STUDENT_ID,TEACHER_ID,HR_ID))) { ?>
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
    <?php } ?>

    <?php if($authUser["ROLE_ID"]==ADMIN_ID || $authUser["ROLE_ID"]==STUDENT_ID || $authUser["ROLE_ID"]==TEACHER_ID) { ?>
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
    <?php } ?>

    <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID,TEACHER_ID,STUDENT_ID))) {
        $assignTimeTable = array(
            'TeacherTimeTables'
        );
        ?>
        <li class="<?php if(in_array($this->params['controller'], $assignTimeTable) && strtolower($this->params['controller']) == 'teachertimetables') { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-speedometer"></i>
                <?php if($authUser["ROLE_ID"]==STUDENT_ID) {  ?>
            <span class="title">Time Table</span>			
			<?php }else{ ?>
            <span class="title">Assign Time Table</span>
			<?php } ?>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'TeacherTimeTables' ? 'open' : '' ?>"></span>
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

    <?php if(in_array($authUser["ROLE_ID"],array(ADMIN_ID,HR_ID,TEACHER_ID))) {
        $Attendance = array(
            'Users'
        );
        ?>
        <li class="<?php if(in_array($this->params['controller'], $Attendance)) { echo 'active open'; } ?>">
            <a href="javascript:;">
                <i class="fa icon-bar-chart"></i>
                <span class="title">Attendance</span>
                <span class="selected"></span>
                <span class="arrow <?php echo strtolower($this->params['controller']) == 'Users' ? 'open' : '' ?>"></span>
            </a>
            <ul class="sub-menu">
                <li>
                    <?php echo $this->Html->link('View All', array('plugin' => false, 'controller' => 'Users', 'action' => 'attendance_listing', 'admin' => true)); ?>
                </li>
            </ul>
        </li>
    <?php } ?>

    </ul>

    <!-- END SIDEBAR MENU -->
    </div>
    </div>
<?php } ?>