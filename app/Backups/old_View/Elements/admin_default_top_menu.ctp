<div class="top-menu">
<ul class="nav navbar-nav pull-right">
<!-- BEGIN NOTIFICATION DROPDOWN -->
<!-- END TODO DROPDOWN -->
<!-- BEGIN USER LOGIN DROPDOWN -->
<!-- BEGIN USER LOGIN DROPDOWN -->
<li class="dropdown dropdown-user">
    <?php if (isset($authUser)) { ?>
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
        <?php echo $this->html->image("/admin/images/view/user/29/29/false/"
            . $authUser['ID'],
        array('alt' => $authUser['FIRST_NAME'], 'class' => 'img-circle')); ?>
					<span class="username">
					<?php echo $authUser['FIRST_NAME']. " " .$authUser['LAST_NAME']; ?> </span>
        <i class="fa fa-angle-down"></i>
    </a>
    <ul class="dropdown-menu">
        <li>
            <?php if($authUser['ROLE_ID'] == 1) { ?>
            <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'edit',
                $authUser['ID'], 'admin' => true, 'plugin' => false)); ?>"> <?php echo $this->General->first_letter_capitalized
            ($authUser['FIRST_NAME']. ' ' .$authUser['LAST_NAME']); ?> </a>
            <?php } elseif($authUser['ROLE_ID'] == 11) { ?>
                <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'edit_agent',
                    $authUser['ID'], 'admin' => true, 'plugin' => false)); ?>"> <?php echo $this->General->first_letter_capitalized
                        ($authUser['FIRST_NAME']. ' ' .$authUser['LAST_NAME']); ?> </a>
            <?php } elseif($authUser['ROLE_ID'] == 13) { ?>
                <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'edit_college',
                    $authUser['ID'], 'admin' => true, 'plugin' => false)); ?>"> <?php echo $this->General->first_letter_capitalized
                        ($authUser['FIRST_NAME']); ?> </a>
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