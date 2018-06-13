<?php
/**
 * Requests collector.
 *
 *  This file collects requests if:
 * 	- no mod_rewrite is available or .htaccess files are not supported
 *  - requires App.baseUrl to be uncommented in app/Config/core.php
 * 	- app/webroot is not set as a document root.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 *  Get CakePHP's root directory
 */
define('APP_DIR', 'app');
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('WEBROOT_DIR', 'webroot');
define('WWW_ROOT', ROOT . DS . APP_DIR . DS . WEBROOT_DIR . DS);

/**
 * This only needs to be changed if the "cake" directory is located
 * outside of the distributed structure.
 * Full path to the directory containing "cake". Do not add trailing directory separator
 */
if (!defined('CAKE_CORE_INCLUDE_PATH')) {
    define('CAKE_CORE_INCLUDE_PATH', ROOT . DS . 'lib');
}

//require APP_DIR . DS . WEBROOT_DIR . DS . 'index.php';
$link = mysql_connect('localhost','root',''); 
//$link = mysql_connect('localhost', 'root', 'admin');
if (!$link) {
    die('Could not connect to MySQL: ' . mysql_error());
}

// make foo the current db
$db_selected = mysql_select_db('edumaster_bd', $link);
if (!$db_selected) {
    die('Can\'t use foo : ' . mysql_error());
}

$sql = 'SELECT *
        FROM school';
$retval = mysql_query($sql, $link);
if (!$retval) {
    die('Could not get data: ' . mysql_error());
}
while ($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
    /* echo "School ID :{$row['SCHOOL_ID']}  <br> ".
      "Title: {$row['SCHOOL_NAME']} <br> ".
      "Tagline: {$row['SCHOOL_TAGLINE']} <br> ".
      "Logo: {$row['LOGO_IMAGE']} <br> ".
      "Address : {$row['ADDRESS']} <br> ".
      "Address Image: {$row['ADDRESS_IMAGE']} <br> ".
      "Brochure: {$row['BROCHURE']} <br> ".
      "Phone No: {$row['PHONE_NO']} <br> ".
      "Mobile No: {$row['MOBILE_NO']} <br> ".
      "Fax: {$row['FAX']} <br> ".
      "Email: {$row['EMAIL']} <br> ".
      "Website URL: {$row['WEBSITE_URL']} <br> ".
      "Status: {$row['STATUS']} <br> ".
      "--------------------------------<br>"; */

    $SCHOOL_NAME = $row['SCHOOL_NAME'];
    $SCHOOL_TAGLINE = $row['SCHOOL_TAGLINE'];
    $SCHOOL_LOGO_IMAGE = $row['LOGO_IMAGE'];
    $SCHOOL_ADDRESS = $row['ADDRESS'];
    $ADDRESS_IMAGE = $row['ADDRESS_IMAGE'];
    $BROCHURE = $row['BROCHURE'];
    $PHONE_NO = $row['PHONE_NO'];
    $MOBILE_NO = $row['MOBILE_NO'];
    $FAX = $row['FAX'];
    $EMAIL = $row['EMAIL'];
    $WEBSITE_URL = $row['WEBSITE_URL'];
    $STATUS = $row['STATUS'];
}

//echo 'Connection OK';
mysql_close($link);

if (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] != "" && $_SERVER['SERVER_PORT'] != 80) {
$SERVER_NAME_GLOB = 'localhost:' . $_SERVER['SERVER_PORT'];
//$SERVER_NAME_GLOB='demo-edumaster.in:'.$_SERVER['SERVER_PORT'];
} else {
$SERVER_NAME_GLOB = 'localhost';
//$SERVER_NAME_GLOB='demo-edumaster.in';
}
$SITE_FOLDER_NAME_GLOB = 'edusystem_bd';
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<link rel="shortcut icon" href="app/webroot/assets/favicon.png" />
        <link href="app/webroot/assets/admin/layout/css/fonts.css" type="text/css" rel="stylesheet" />
		<link href="fonts/font-awesome.min.css" type="text/css" rel="stylesheet" />
        <link href="css/use-style.css" type="text/css" rel="stylesheet" />
        <link href="app/webroot/assets/admin/layout/css/loaders.css" type="text/css" rel="stylesheet" />
        <link href="app/webroot/assets/admin/layout/css/color_theme.css" type="text/css" rel="stylesheet" />

        <title><?php echo $SCHOOL_NAME; ?></title>
    </head>

    <body>

        <div class="main">
            <div class="head">
                <div class="container">
                    <div class="edu-logo">
                        <img src="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/app/webroot/files/upload_document/<?php echo $SCHOOL_LOGO_IMAGE; ?>" alt=""/>
                    </div>
                    <div class="schools-name"><?php echo $SCHOOL_NAME; ?></div>   

                    <!-- datetime_section -->
                    <div class="datetime_section">
                        <div class="time">
                            <span id="hours"></span>
                            <span id="point">:</span>
                            <span id="min"></span>
<!--                            <span id="point">:</span>
                            <span id="sec"></span>-->
                            <span id="ampm"></span>
                        </div>
                        <div class="date">
                            <div id="Date"></div>
                        </div>
                    </div><!-- End: datetime_section -->
                </div>
            </div>


			<!-- userlist_container -->
            <div class="userlist_container">

                <div class="main-boxs">

                    <!-- left-boxs -->
                    <?php /* ?>
					<div class="left-boxs">
                        <div class="box_left">

                            <!-- home-boxas -->
                            <div class="box_block box_01">

                                <div class="box_header">
                                    Circular
                                    <div class="notification_block">
                                        <div class="notification_text">
                                            3
                                        </div>
                                    </div>
                                </div>
                                <div class="box_content">
                                    <div class="scroll_container">
                                        <p>
                                            Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.
                                        </p>
                                    </div>
                                </div>

                            </div><!-- End: home-boxas -->

                            <!-- box_block -->
                            <div class="box_block box_02">

                                <div class="box_header">
                                    News &amp; Updates
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

                            <!-- box_block -->
                            <div class="box_block box_03">

                                <div class="box_header">
                                    Events
                                    <div class="notification_block">
                                        <div class="notification_text">
                                            6
                                        </div>
                                    </div>
                                </div>
                                <div class="box_content">
                                    <p>
                                        Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus.
                                    </p>
                                </div>

                            </div><!-- End: box_block -->

                        </div>
                    </div>
                    <?php */ ?>
					<!-- End: left-boxs -->

                    <!-- right-boxs -->
                    <div class="right-boxs">

                        <div class="dashboard_tiles">

                            <div class="tiles" >

                                <!-- home-boxas -->
                                <div class="home-boxas">

                                    <div class="lb">Administrative Users</div>               


                                    <div class="tile">
                                        <div class="tile-body">
                                            <div class="boxs-bondaed">
                                                <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/super_admin.png" width="100%" height="100%"  alt=""/></a> 
                                            </div>
                                            <div class="boxs-bondaed">
                                                <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/admin.png" width="100%" height="100%"  alt=""/> </a>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <!-- End: home-boxas -->

                                <!-- home-boxas -->
                                <div class="home-boxas">

                                    <div class="lb">Non Teaching Users</div>               


                                    <div class="tile">
                                        <div class="tile-body">

                                            <div class="boxs-bondaed">
                                                <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/supervisor_section.png" width="100%" height="100%"  alt=""/> </a>
                                            </div>

                                            <div class="boxs-bondaed">
                                                <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/account_section.png" width="100%" height="100%"  alt=""/> </a>
                                            </div>
                                            <div class="boxs-bondaed">
                                                <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/hr_section.png" width="100%" height="100%"  alt=""/> </a>
                                            </div>
                                            <div class="boxs-bondaed">
                                                <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/library.png" width="100%" height="100%"  alt=""/> </a>
                                            </div>
                                            <div class="boxs-bondaed">
                                                <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/transports.png" width="100%" height="100%"  alt=""/></a>
                                            </div>
                                            <div class="boxs-bondaed">
                                                <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/store_purchase.png" width="100%" height="100%"  alt=""/></a> 
                                            </div>

                                        </div>
                                    </div>


                                </div>
                                <!-- End: home-boxas -->

                                <!-- home-boxas -->
                                <div class="home-boxas">

                                    <div class="lb">Academic Users</div>               


                                    <div class="tile">
                                        <div class="tile-body">
                                            <div class="boxs-bondaed">
                                                <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/teacher_section.png" width="100%" height="100%"  alt=""/> </a>
                                            </div>
                                            <div class="boxs-bondaed">
                                                <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/student_section.png" width="100%" height="100%"  alt=""/> </a>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <!-- End: home-boxas -->

                                <!-- home-boxas -->
                                <!--<div class="home-boxas">

                                    <div class="lb">Subordinate Staff</div>               


                                    <div class="tile">
                                        <div class="tile-body">
                                            <div class="boxs-bondaed">
                                                <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/clerk.png" width="100%" height="100%"  alt=""/></a> 
                                            </div>
                                            <div class="boxs-bondaed">
                                                <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/peon.png" width="100%" height="100%"  alt=""/> </a>
                                            </div>
                                            <div class="boxs-bondaed">
                                                <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/sweeper.png" width="100%" height="100%"  alt=""/> </a>
                                            </div>
                                        </div>
                                    </div>


                                </div>-->
                                <!-- End: home-boxas -->

                            </div>

                        </div>

                    </div>
                    <!-- End: right-boxs -->

                </div>


            </div>
            <!-- End: userlist_container -->
			
			<div class="page-footer">
                <div class="page-footer-inner">
                    2016 &copy; EDU Master. Admin Control Panel.
                </div>
            </div>

            <a class="scrollToTop" href="javascript:void(0)">
                <i class="fa fa-arrow-up"></i>
            </a>
			

            <!--<div class="container" align="center">

                <div class="right-boxs">



                    <div class="right-boxs-info">

                        <div class="boxs-bondaed">
                            <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/super_admin.png" width="100%" height="100%"  alt=""/></a> 
                        </div>
                        <div class="boxs-bondaed">
                            <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/admin.png" width="100%" height="100%"  alt=""/> </a>
                        </div>
                        <div class="boxs-bondaed">
                            <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/teacher_section.png" width="100%" height="100%"  alt=""/> </a>
                        </div>
                        <div class="boxs-bondaed">
                            <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/supervisor_section.png" width="100%" height="100%"  alt=""/> </a>
                        </div>
                        <div class="boxs-bondaed">
                            <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/student_section.png" width="100%" height="100%"  alt=""/> </a>
                        </div>
                        <div class="boxs-bondaed">
                            <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/account_section.png" width="100%" height="100%"  alt=""/> </a>
                        </div>
                        <div class="boxs-bondaed">
                            <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/hr_section.png" width="100%" height="100%"  alt=""/> </a>
                        </div>
                        <div class="boxs-bondaed">
                            <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/library.png" width="100%" height="100%"  alt=""/> </a>
                        </div>
                        <div class="boxs-bondaed">
                            <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/transports.png" width="100%" height="100%"  alt=""/></a>
                        </div>
                        <div class="boxs-bondaed">
                            <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/store_purchase.png" width="100%" height="100%"  alt=""/></a> 
                        </div>
                        <!--<div class="boxs-bondaed">
                            <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/hostel.png" width="100%" height="100%"  alt=""/></a>
                        </div>
                        <div class="boxs-bondaed">
                            <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/canteen.png" width="100%" height="100%"  alt=""/></a>
                        </div>
                        <div class="boxs-bondaed">
                            <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/front_office.png" width="100%" height="100%"  alt=""/> </a>
                        </div>
                        <div class="boxs-bondaed">
                            <a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="app/webroot/img/dashboard/security.png" width="100%" height="100%"  alt=""/></a> 
                        </div>
                        <div class="boxs-bondaed">
                            <img src="app/webroot/img/dashboard/image_preview.png" width="100%" height="100%"  alt=""/> 
                        </div>
                        <div class="boxs-bondaed">
                            <img src="app/webroot/img/dashboard/image_preview.png" width="100%" height="100%"  alt=""/> 
                        </div>-->

                    <!--</div>



                </div>
            </div>-->
            <!-- loaderMain -->
            <!--                        <div class="loaderMain">
                                        <div class="loader">
                                            <div class="loader-inner ball-spin-fade-loader">
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                                <div></div>
                                            </div>
                                        </div>
                                    </div> End: loaderMain -->

            <script src="js/jquery.min.js"></script>
			<script src="js/jquery.slimscroll.min.js"></script>
            <script type="text/javascript">
			
				// scrollToTop
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 100) {
                        $('.scrollToTop').fadeIn();
                    } else {
                        $('.scrollToTop').fadeOut();
                    }
                });
			
                // Loader
                $(window).load(function () {
                    $('.loaderMain').hide();

                    setTimeout(function () {
                        $('.loaderMain').fadeOut();
                    }, 3000);

                });

                $(document).ready(function () {
                    // Create two variable with the names of the months and days in an array
                    var monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
                    var dayNames = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]

                    // Create a newDate() object
                    var newDate = new Date();
                    // Extract the current date from Date object
                    newDate.setDate(newDate.getDate());
                    // Output the day, date, month and year    
                    $('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

                    setInterval(function () {
                        // Create a newDate() object and extract the seconds of the current time on the visitor's
                        var seconds = new Date().getSeconds();
                        // Add a leading zero to seconds value
                        $("#sec").html((seconds < 10 ? "0" : "") + seconds);
                    }, 1000);

                    setInterval(function () {
                        // Create a newDate() object and extract the minutes of the current time on the visitor's
                        var minutes = new Date().getMinutes();
                        // Add a leading zero to the minutes value
                        $("#min").html((minutes < 10 ? "0" : "") + minutes);
                    }, 1000);

                    setInterval(function () {
                        // Create a newDate() object and extract the hours of the current time on the visitor's
                        var hours = new Date().getHours();
						hours = hours % 12;
                        hours = hours ? hours : 12; // the hour '0' should be '12'
                        // Add a leading zero to the hours value
                        $("#hours").html((hours < 10 ? "0" : "") + hours);
                    }, 1000);

                    setInterval(function () {
                        // Create a newDate() object and extract the hours of the current time on the visitor's
                        var hours = new Date().getHours();
                        var minutes = new Date().getMinutes();

                        var ampm = hours >= 12 ? 'PM' : 'AM';
                        hours = hours % 12;
                        hours = hours ? hours : 12; // the hour '0' should be '12'
                        minutes = minutes < 10 ? '0' + minutes : minutes;
                        
                        // Add a leading zero to the hours value
                        $("#ampm").html(ampm);
                    }, 1000);
					
					//Scrollbar JS Code
                    $('.scroll_container').slimScroll({
                        height: '200px'
                    });

                    //Left box Flip JS Code
                    $(".box_01 .box_header").click(function () {
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
					
					// scrollToTop
                    $('.scrollToTop').click(function () {
                        $('html, body').animate({scrollTop: 0}, 800);
                        return false;
                    });

                });
            </script>

    </body>
</html>
