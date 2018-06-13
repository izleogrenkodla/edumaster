<div class="top-menu">
<ul class="nav navbar-nav pull-right">
<!-- BEGIN NOTIFICATION DROPDOWN -->
<!-- END TODO DROPDOWN -->
<!-- BEGIN USER LOGIN DROPDOWN -->
<!-- BEGIN USER LOGIN DROPDOWN -->
<li class="dropdown dropdown-user">
    <?php if (isset($authUser)) { ?>
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">       
					<span class="username">
					<?php echo $authUser['FIRST_NAME']. " " .$authUser['LAST_NAME']; ?> </span>
        <i class="fa fa-angle-down"></i>
      <?php echo '<br>'; ?>
      </span>
      <span class="username">
        <?php 
		 if($authUser['ROLE_ID'] == 1){echo '[Administrator]'; }
		 elseif($authUser['ROLE_ID'] == 2){echo '[Principal]'; }
		 elseif($authUser['ROLE_ID'] == 3){echo '[Supervisor]'; }
		 elseif($authUser['ROLE_ID'] == 4){echo '[Teacher]'; }
		 elseif($authUser['ROLE_ID'] == 5){echo '[Student]'; }
		 elseif($authUser['ROLE_ID'] == 6){echo '[Front Office]'; }
		 elseif($authUser['ROLE_ID'] == 7){echo '[Super Admin]'; }
		 elseif($authUser['ROLE_ID'] == 8){echo '[Accounts]'; }
		 elseif($authUser['ROLE_ID'] == 9){echo '[HR]'; }
		 elseif($authUser['ROLE_ID'] == 10){echo '[Store]'; }
		 elseif($authUser['ROLE_ID'] == 11){echo '[Hostel]'; }
		 elseif($authUser['ROLE_ID'] == 12){echo '[Transport]'; }
		 elseif($authUser['ROLE_ID'] == 13){echo '[Library]'; }
		 elseif($authUser['ROLE_ID'] == 14){echo '[Canteen]'; }
		 elseif($authUser['ROLE_ID'] == 15){echo '[Security]'; }
		 ?>
      </span>
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