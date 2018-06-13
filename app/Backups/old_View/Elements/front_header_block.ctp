    <!-- start headerwrapper -->
    <div id="headerwrapper">
        <div class="container">
            <div id="logowrapper" class="leftcontent"> <a href="<?php //echo Router::url(array('controller' => 'Users', 'action' => 'dashboard', 'admin' => false, 'plugin' => false)); ?>"><img src="<?php //echo FRONT_ASSETS_URL; ?>css/images/logo.png" alt="Logo:Capis"/></a></div>
            <div id="rightheader" class="rightcontent">

                <div class="hedaerlinkwrapper rightcontent">
                    <?php if (isset($front_auth_User)) { ?>
                   <div class="beforewelcome leftcontent"> <div class="welcome leftcontent"><?php echo "Welcome ".$this->General->first_letter_capitalized($front_auth_User['first_name'])." | "; ?></div>
                       &nbsp;<div class="logout leftcontent">&nbsp;<a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'logout', 'admin' => false, 'plugin' => false)); ?>">
                        Logout
                    </a></div></div>
                    <?php } else { ?>
                        <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'login', 'admin' => false, 'plugin' => false)); ?>">
                            <div class="hedaerlink reglink leftcontent">Login</div>
                        </a>
                        <a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'register', 'admin' => false, 'plugin' => false)); ?>">
                            <div class="hedaerlink reglink leftcontent">Register</div>
                        </a>
                    <?php } ?>

                </div>
                <div class="social rightcontent"> <img src="<?php echo FRONT_ASSETS_URL; ?>css/images/fb.png" /> <img src="<?php echo FRONT_ASSETS_URL; ?>css/images/twitter.png" /> <img src="<?php echo FRONT_ASSETS_URL; ?>css/images/in.png" /> <img src="<?php echo FRONT_ASSETS_URL; ?>css/images/googleplus.png" /> <img src="<?php echo FRONT_ASSETS_URL; ?>css/images/email.png" /> </div>
            </div>
        </div>
    </div>

    <div class="rmm">
        <ul>
            <li><a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'dashboard', 'admin' => false, 'plugin' => false)); ?>" class="homeicon">Home</a></li>
            <li><a href="http://clickcare.in/caips/?page_id=6" class="serviceicon">Services</a></li>
            <li><a href="http://clickcare.in/caips/?page_id=8" class="keybenefiticon">Key Benefits</a></li>
            <li><a href="http://clickcare.in/staff/Pages/display/cost" class="costicon">Cost</a></li>
            <li><a href="http://clickcare.in/caips/?page_id=12" class="applyicon">How To Apply</a></li>
            <li><a href="http://clickcare.in/caips/?page_id=14" class="faqicon">Faq</a></li>
            <li><a href="http://clickcare.in/caips/?page_id=16" class="contacticon">Contact Us</a></li>
            <li><a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'dashboard', 'admin' => false, 'plugin' => false)); ?>" class="applicationicon">My application</a></li>
        </ul>
    </div>
    <!-- end headerwrapper -->
    <!-- start navwrapper -->
    <div id="navwrapper">
        <div class="container">
            <ul>
                <li><a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'dashboard', 'admin' => false, 'plugin' => false)); ?>" class="homeicon">Home</a></li>
                <li><a href="http://clickcare.in/caips/?page_id=6" class="serviceicon">Services</a></li>
                <li><a href="http://clickcare.in/caips/?page_id=8" class="keybenefiticon">Key Benefits</a></li>
                <li><a href="http://clickcare.in/staff/Pages/display/cost" class="costicon">Cost</a></li>
                <li><a href="http://clickcare.in/caips/?page_id=12" class="applyicon">How To Apply</a></li>
                <li><a href="http://clickcare.in/caips/?page_id=14" class="faqicon">Faq</a></li>
                <li><a href="http://clickcare.in/caips/?page_id=16" class="contacticon">Contact Us</a></li>
                <li><a href="<?php echo Router::url(array('controller' => 'Users', 'action' => 'dashboard', 'admin' => false, 'plugin' => false)); ?>" class="applicationicon">My application</a></li>
            </ul>
        </div>
    </div>
    <!-- end navwrapper -->