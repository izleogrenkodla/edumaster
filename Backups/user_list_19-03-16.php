<?php
/**
 * Requests collector.
 *
 *  This file collects requests if:
 *	- no mod_rewrite is available or .htaccess files are not supported
 *  - requires App.baseUrl to be uncommented in app/Config/core.php
 *	- app/webroot is not set as a document root.
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


$link = mysql_connect('localhost','root','admin'); 
if (!$link) { 
	die('Could not connect to MySQL: ' . mysql_error()); 
} 
mysql_set_charset('utf8', $link);

// make foo the current db
$db_selected = mysql_select_db('edumaster_dev', $link);
if (!$db_selected) {
    die ('Can\'t use foo : ' . mysql_error());
}

$sql = 'SELECT *
        FROM school';
$retval = mysql_query( $sql, $link );
if(! $retval )
{
  die('Could not get data: ' . mysql_error());
}
while($row = mysql_fetch_array($retval, MYSQL_ASSOC))
{
    /*echo "School ID :{$row['SCHOOL_ID']}  <br> ".
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
         "--------------------------------<br>";*/
         
      $SCHOOL_NAME=$row['SCHOOL_NAME'];
      $SCHOOL_TAGLINE=$row['SCHOOL_TAGLINE'];
		$SCHOOL_LOGO_IMAGE=$row['LOGO_IMAGE'];
      $SCHOOL_ADDRESS=$row['ADDRESS'];   
      $ADDRESS_IMAGE=$row['ADDRESS_IMAGE'];
      $BROCHURE=$row['BROCHURE'];
		$PHONE_NO=$row['PHONE_NO'];
		  $MOBILE_NO=$row['MOBILE_NO'];
      $FAX=$row['FAX'];
      $EMAIL=$row['EMAIL'];
      $WEBSITE_URL=$row['WEBSITE_URL'];
      $STATUS=$row['STATUS'];
		 		 
} 

//echo 'Connection OK';
mysql_close($link); 

if(isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT']!="" && $_SERVER['SERVER_PORT']!=80)
{
$SERVER_NAME_GLOB='103.195.186.229:'.$_SERVER['SERVER_PORT'];
}
else
{
$SERVER_NAME_GLOB='103.195.186.229';
}
$SITE_FOLDER_NAME_GLOB='edusystem_dev';

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/use-style.css" type="text/css" rel="stylesheet" />
<title><?php echo $SCHOOL_NAME; ?></title>
</head>

<body style="background:url(\image/gdg.png); background-size:cover; background-attachment:fixed;  background-position:fixed;>
	
    <div class="main">
        	<div class="head">
            	<div class="container">
                    <div class="edu-logo">
                     <img src="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/app/webroot/files/upload_document/<?php echo $SCHOOL_LOGO_IMAGE; ?>" width="100%" height="100%"  alt=""/>
                    </div>
           			<div class="schools-name"><?php echo $SCHOOL_NAME; ?></div>         	
                    	               
            	</div>
            </div>	
    
    <div class="container" align="center">
            	
            	<div class="right-boxs">
                	<div class="right-boxs-info">
                    
               		<div class="boxs-bondaed">
               	    	<img src="image/dashboard/SUPER_ADMIN.png" width="100%" height="100%"  alt=""/>
                    </div>
                    <div class="boxs-bondaed">
               	    	<a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="image/dashboard/ADMIN.png" width="100%" height="100%"  alt=""/> </a>
                    </div>
                    <div class="boxs-bondaed">
               	    	<a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="image/dashboard/teacher_section.jpg" width="100%" height="100%"  alt=""/> </a>
                    </div>
                    <div class="boxs-bondaed">
               	    	<img src="image/dashboard/supervisor_section.jpg" width="100%" height="100%"  alt=""/>
                    </div>
                    <div class="boxs-bondaed">
               	    	<a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="image/dashboard/student_section.jpg" width="100%" height="100%"  alt=""/> </a>
                    </div>
                    <div class="boxs-bondaed">
               	    <img src="image/dashboard/account_section.jpg" width="100%" height="100%"  alt=""/>
                    </div>
                    <div class="boxs-bondaed">
               	    	<img src="image/dashboard/hr_section.jpg" width="100%" height="100%"  alt=""/>
                    </div>
                    <div class="boxs-bondaed">
               	    	<img src="image/dashboard/library.jpg" width="100%" height="100%"  alt=""/>
                    </div>
                    <div class="boxs-bondaed">
               	    	<img src="image/dashboard/transports.jpg" width="100%" height="100%"  alt=""/>
                    </div>
                    <div class="boxs-bondaed">
               	    	<img src="image/dashboard/STORE_PURCHASE.png" width="100%" height="100%"  alt=""/>
                    </div>
                    <div class="boxs-bondaed">
               	    	<img src="image/dashboard/HOSTEL.png" width="100%" height="100%"  alt=""/>
                    </div>
                    <div class="boxs-bondaed">
               	    	<img src="image/dashboard/CANTEEN.png" width="100%" height="100%"  alt=""/>
                    </div>
                    <div class="boxs-bondaed">
               	    	<!--<a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="image/dashboard/FRONT_OFFICE.png" width="100%" height="100%"  alt=""/> </a>-->
						<img src="image/dashboard/FRONT_OFFICE.png" width="100%" height="100%"  alt=""/>
                    </div>
                    <div class="boxs-bondaed">
               	    	<!--<a href="http://<?php echo $SERVER_NAME_GLOB; ?>/<?php echo $SITE_FOLDER_NAME_GLOB; ?>/index.php/admin"><img src="image/dashboard/security.png" width="100%" height="100%"  alt=""/></a>-->
						<img src="image/dashboard/security.png" width="100%" height="100%"  alt=""/> 
                    </div>
                    <div class="boxs-bondaed">
               	    	<img src="image/dashboard/image_preview.jpeg" width="100%" height="100%"  alt=""/> 
                    </div>
                    <div class="boxs-bondaed">
               	    	<img src="image/dashboard/image_preview.jpeg" width="100%" height="100%"  alt=""/> 
                    </div>

              </div>
            
            
            
            	</div>
</div>

</body>
</html>
