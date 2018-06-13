<div class="top-menu">
    <ul class="nav navbar-nav pull-right">
        <!-- BEGIN NOTIFICATION DROPDOWN -->
        <!-- END TODO DROPDOWN -->
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <!-- BEGIN USER LOGIN DROPDOWN -->
        <li class="dropdown dropdown-user">
    <?php if (isset($authUser)) { 			
						
			$this->User = ClassRegistry::init('User');
			$user_det = $this->User->find('first',array(
				'conditions' => array('User.ID'=>$authUser['ID'],'User.ROLE_ID'=>$authUser['ROLE_ID'])				
			));
			$user_img = "14525121041.jpg";
			if(isset($user_det['User']['IMAGE_URL']) && $user_det['User']['IMAGE_URL']!="")
			{
				$user_img=$user_det['User']['IMAGE_URL'];
				$path = DOWNLOADURL.UPLOAD_DOCUMENT.$user_img;				
			}
			else
			{
				$path = DOWNLOADURL.UPLOAD_DOCUMENT.$user_img;
			}
	?>



            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">       
                <span class="profile_photo_container">
					<img src="<?php echo $path; ?>" width="100%" alt="" />
                </span>
                <span class="profile_content">
                    <span class="user_name"><?php echo $authUser['FIRST_NAME']. " " .$authUser['LAST_NAME']; ?></span>
                    <span class="user_role">
                <?php
		 $SESS_ROLE_ID = $this->Session->read('SESS_ROLE_ID');
		 if($authUser['ROLE_ID'] == ADMIN_ID && $SESS_ROLE_ID==SUPER_ADMIN_ID)
		 {
			 echo '[Super Admin]';
			 if($authUser['DESIGNATION']!="")
			 {
				echo ' ['.$authUser['DESIGNATION'].']';
			 }
		 }
		 elseif($authUser['ROLE_ID'] == ADMIN_ID)
		 {echo '[Administrator]';
			$SECTION_NAME = $this->Session->read('SECTION_NAME');
			if($SECTION_NAME != "")
			{
				echo ' ['.$SECTION_NAME.']';
			}
		 }
		 elseif($authUser['ROLE_ID'] == PRINCIPAL_ID){echo '[Principal]'; }
		 elseif($authUser['ROLE_ID'] == SUPERVISOR_ID){echo '[Supervisor]'; }
		 elseif($authUser['ROLE_ID'] == TEACHER_ID){echo '[Teacher]'; }
		 elseif($authUser['ROLE_ID'] == STUDENT_ID){echo '[Student]'; }
		 elseif($authUser['ROLE_ID'] == FRONT_ID){echo '[Fornt Office]'; }
		 elseif($authUser['ROLE_ID'] == SUPER_ADMIN_ID){echo '[Super Admin]'; }
		 elseif($authUser['ROLE_ID'] == ACCOUNT_ID){echo '[Accounts]'; }
		 elseif($authUser['ROLE_ID'] == HR_ID){echo '[HR]'; }
		 elseif($authUser['ROLE_ID'] == STORE_ID){echo '[Store]'; }
		 elseif($authUser['ROLE_ID'] == HOSTEL_ID){echo '[Hostel]'; }
		 elseif($authUser['ROLE_ID'] == TRANSPORTATION_ID){echo '[Transport]'; }
		 elseif($authUser['ROLE_ID'] == LIBRARY_ID){echo '[Library]'; }
		 elseif($authUser['ROLE_ID'] == CANTEEN_ID){echo '[Canteen]'; }
		 elseif($authUser['ROLE_ID'] == SECURITY_ID){echo '[Security]'; }
		 ?>
                    </span>
                    <span class="date_block">
                        <span class="time_text">
                            <span id="hours"></span>
                            <span class="point">:</span>
                            <span id="min"></span>
<!--                            <span id="point">:</span>
                            <span id="sec"></span>-->
                            <span id="ampm"></span>
                        </span>
                        <span class="date_text">
                            <div id="Date"></div>
                        </span>
                    </span>
                </span>
        <!--        <span class="username">
            <?php echo $authUser['FIRST_NAME']. " " .$authUser['LAST_NAME']; ?> </span>
                    <i class="fa fa-angle-down"></i>
            <?php echo '<br>'; ?>
                </span>-->

            </a>
            <ul class="dropdown-menu">
                <li>
            <?php if($authUser['ROLE_ID'] == 1) { ?>
                    <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'edit',
                $authUser['ID'], 'admin' => true, 'plugin' => false)); ?>"> <?php echo $this->General->first_letter_capitalized
            ($authUser['FIRST_NAME']. ' ' .$authUser['LAST_NAME']); ?> </a>
            <?php } ?>
                </li>
                <li>
                    <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'dashboard', 'admin' => true, 'plugin' => false)); ?>">Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'logout', 'admin' => true, 'plugin' => false)); ?>">Log Out</a>
                </li>
            </ul>
    <?php } ?>

    <?php if (isset($front_auth_User)) { ?>
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <?php echo $this->html->image("/images/view/user/29/29/false/"
            . $front_auth_User['ID'],
        array('alt' => $front_auth_User['FIRST_NAME'], 'class' => 'img-circle')); ?>
                <span class="username">
					<?php echo isset($front_auth_User['FIRST_NAME']) ? $front_auth_User['LAST_NAME'] : 'Login'; ?> </span>
                <i class="fa fa-angle-down"></i>
            </a>
            <ul class="dropdown-menu">
                <li>
                    <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'index', 'admin' => true, 'plugin' => false
             )); ?>"> <?php echo $this->General->first_letter_capitalized
            ($front_auth_User['FIRST_NAME']. ' ' .$front_auth_User['LAST_NAME']); ?> </a>
                </li>
                <li>
                    <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'dashboard', 'admin' => true, 'plugin' => false)); ?>">Dashboard</a>
                </li>
                <li>
                    <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'logout', 'admin' => true, 'plugin' => false)); ?>"> Log Out </a>
                </li>
            </ul>
    <?php } ?>

        </li>
        <!-- END USER LOGIN DROPDOWN -->
        <!-- END USER LOGIN DROPDOWN -->
    </ul>
</div>