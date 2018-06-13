<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

$SITE_FOLDER_NAME_GLOB='edusystem_bd';

define('WEBSITE_NAME', 'EDU Master');
define('ADMIN_EMAIL', 'php2@nividaweb.com');
define('ADMIN_EMAIL_NAME', 'EDU Master');
define('SERVER_NAME', $_SERVER['SERVER_NAME']);
if(isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT']!="" && $_SERVER['SERVER_PORT']!=80)
{
	define('SITE_URL', 'http://' . SERVER_NAME .':'.$_SERVER['SERVER_PORT'].'/'.$SITE_FOLDER_NAME_GLOB.'/app/webroot/');
}
else
{
//define('SITE_URL', 'http://' . SERVER_NAME . '/'.$SITE_FOLDER_NAME_GLOB.'/');
define('SITE_URL', 'http://' . SERVER_NAME . '/'.$SITE_FOLDER_NAME_GLOB.'/app/webroot/');
}
define('NOTIFY_URL', SITE_URL."paypal_ipn/process");
if(isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT']!="" && $_SERVER['SERVER_PORT']!=80)
{
//define('ADMIN_URL', 'http://' . SERVER_NAME .':'.$_SERVER['SERVER_PORT'].'/'.$SITE_FOLDER_NAME_GLOB.'/admin/');	
define('ADMIN_URL', 'http://' . SERVER_NAME .':'.$_SERVER['SERVER_PORT'].'/'.$SITE_FOLDER_NAME_GLOB.'/index.php/admin/');	
}
else
{
//define('ADMIN_URL', 'http://' . SERVER_NAME . '/'.$SITE_FOLDER_NAME_GLOB.'/admin/');
define('ADMIN_URL', 'http://' . SERVER_NAME . '/'.$SITE_FOLDER_NAME_GLOB.'/index.php/admin/');
}
if(isset($_SERVER['SERVER_ADDR']) && $_SERVER['SERVER_ADDR']!="")
{
define('SERVER_ADDRESS', $_SERVER['SERVER_ADDR']);
}
else
{
//define('SERVER_ADDRESS', $_SERVER['SERVER_ADDR']);
define('SERVER_ADDRESS', $_SERVER['LOCAL_ADDR']);
}
define('SERVER_PORT', $_SERVER['SERVER_PORT']);
define('DOCUMENT_ROOT', $_SERVER['DOCUMENT_ROOT']);
define('REMOTE_PORT', $_SERVER['REMOTE_PORT']);
define('REQUEST_TIME', $_SERVER['REQUEST_TIME']);
define('PAGINATION_LIMIT', 20);
define('PAGINATION_LIMIT_ADMIN', -1);
define('PAGINATION_LIMIT_ADMIN_AJAX', -1);
define('PAGINATION_LIMIT_FRONT', 5);
define('FALSE_VALUE', false);
define('SUB_DIRECTORY', '/'.$SITE_FOLDER_NAME_GLOB.'');
//define('REQUEST_URL', '/'.$SITE_FOLDER_NAME_GLOB.'/admin');
define('REQUEST_URL', '/'.$SITE_FOLDER_NAME_GLOB.'/index.php/admin');
define('WEBSITE_URL', SITE_URL);
//define('RESOURCES_DIRECTORY', '/'.$SITE_FOLDER_NAME_GLOB.'/img/admin/');
define('RESOURCES_DIRECTORY', '/'.$SITE_FOLDER_NAME_GLOB.'/app/webroot/img/admin/');
//define('FRONT_RESOURCES_DIRECTORY', '/'.$SITE_FOLDER_NAME_GLOB.'/img/front/');
define('FRONT_RESOURCES_DIRECTORY', '/'.$SITE_FOLDER_NAME_GLOB.'/app/webroot/img/front/');
define("UPLOADURL", $_SERVER['DOCUMENT_ROOT'] . SUB_DIRECTORY . '/app/webroot/files/');
//define("ASSETS_URL", '/'.$SITE_FOLDER_NAME_GLOB.'/assets/');
define("ASSETS_URL", '/'.$SITE_FOLDER_NAME_GLOB.'/app/webroot/assets/');
define("AWR_CSS_URL", '/'.$SITE_FOLDER_NAME_GLOB.'/app/webroot/');
define("FRONT_ASSETS_URL", '/'.$SITE_FOLDER_NAME_GLOB.'/');
define("DOWNLOADURL", SUB_DIRECTORY . '/app/webroot/files/');
define("PHYSICAL_IMAGE_PATH", SUB_DIRECTORY . '/app/webroot/');
define("UPLOAD_AVATARS", "upload_photo");
define("UPLOAD_DOCUMENT", "upload_document/");
define("UPLOAD_TEMP", "upload_temp/");
define("UPLOAD_BANK_STAT_DOC", "upload_bank_stat_doc/");
define("UPLOAD_ACC_LEDG_DOC", "upload_acc_ledger_doc/");
define("UPLOAD_EXCEL", "uplaod_excel/");
define("UPLOAD_HOSPITAL_LOGO", "hospital_logo");
define("UPLOAD_PRODUCT_IMAGE", "upload_testapp");
define("UPLOAD_DOCTOR_PHOTO", "doctor_photo");
define("UPLOAD_STUDENT_DOCUMENT","student_document");
define("UPLOAD_STAFF_DOCUMENT","staff_document");
define("HOMEWORK_CLASSWORK", "homework_classwork/");
define("STAFF_RESUME","staff_resume");
define("UPLOAD_FILE_ALL", "upload_file_all");
define("UPLOAD_FILE_testapp", "upload_file_testapp");
define("UPLOAD_SCHOOL_GALLERY_PHOTO", "upload_document");
define('WWW_ROOT_EMAIL_ATTACHED', ROOT . DS . APP_DIR . DS . WEBROOT_DIR);
define('UPLOADS', "uploads/");
define('CURRENCY_SYMBOL', "$");
define('DEFAULT_PAYMENT_ID', "");
define('LOGIN_SUC_MSG', 'You have successfully logged in');
define('LOGIN_NOT_SUC_MSG', 'Invalid email id or password, try again');
define('REG_SUC_MSG', 'You have successfully registered');
define('REG_NOT_SUC_MSG', 'You have not successfully registered, try again');
define('DUPLICATE_USER_MSG', 'Email-id already registered please try another');
define('CURRENCY_CODE', '');
define('ADMIN_EMAIL_ID', '');
define('USER_DELETED', 'User successfully deleted');
define('USER_NOT_DELETED', 'User not deleted');
define('USER_UPDATE', 'User successfully updated');
define('ADMIN_ID',1);
define('PRINCIPAL_ID',2);
define('SUPERVISOR_ID',3);
define('LIBRARY_ID',13);
define('TEACHER_ID',4);
define('TRANSPORTATION_ID',12);
define('CANTEEN_ID',14);
define('FRONT_ID',6);
define('SECURITY_ID',15);
define('HOSTEL_ID',11);
define('STUDENT_ID',5);
define('STORE_ID',10);
define('ACCOUNT_ID',8);
define('SUPER_ADMIN_ID',7);
define('HR_ID',9);
define('DTFRMT','d-m-Y');
define('LVSTS_PENDING',0);
define('LVSTS_APPROVED',1);
define('LVSTS_REJECT',2);
define('ADMISSION_FEE',1);
define('PAYMENT_TYPE',1);
define('ACADEMIC_FEE',5);
define('PAYMENT_TERM_YEARLY',1);
define('PRESENT_TEXT','Present');
define('ABSENT_TEXT','Absent');
define('HOLIDAY_TEXT','Holiday');
define('PRESENT_COLOR','green');
define('ABSENT_COLOR','red');
define('HOLIDAY_COLOR','blue');
define('CLASS_ALBUM',1);
define('SCHOOL_GALLAERY_ALBUM',2);
define('CERTIFICATION_ALBUM',3);
define('ALLOWED_EXT','png,jpg');
define('ALLOWED_SIZE','1048576');
define('ATTACHMENT_ALLOWED_SIZE',5);
define('UPLOAD_ALLOWED_SIZE',2);
define('TIMEFORMAT','H:i a');
define('UPLOAD_STUDENT_EXCEL','upload_student_excel/');
define('SUB_FAIL',0);
define('SUB_PASS',1);
define('SUB_COMPARTMENT',2);
define('RECEIVED_BOOK',"Received Book");
define('ISSUED_BOOK','Issued Book');
define('RECEIVED_ID',0);
define('ISSUED_ID',1);
define('PRE_PRIMARY_SECTION_ID',1);
define('PRIMARY_SECTION_ID',2);
define('SECONDARY_SECTION_ID',3);
define('HIGHER_SECONDARY_SECTION_ID',4);



//CakePlugin::load('AjaxMultiUpload', array('bootstrap' => true));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models/', '/next/path/to/models/'),
 *     'Model/Behavior'            => array('/path/to/behaviors/', '/next/path/to/behaviors/'),
 *     'Model/Datasource'          => array('/path/to/datasources/', '/next/path/to/datasources/'),
 *     'Model/Datasource/Database' => array('/path/to/databases/', '/next/path/to/database/'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions/', '/next/path/to/sessions/'),
 *     'Controller'                => array('/path/to/controllers/', '/next/path/to/controllers/'),
 *     'Controller/Component'      => array('/path/to/components/', '/next/path/to/components/'),
 *     'Controller/Component/Auth' => array('/path/to/auths/', '/next/path/to/auths/'),
 *     'Controller/Component/Acl'  => array('/path/to/acls/', '/next/path/to/acls/'),
 *     'View'                      => array('/path/to/views/', '/next/path/to/views/'),
 *     'View/Helper'               => array('/path/to/helpers/', '/next/path/to/helpers/'),
 *     'Console'                   => array('/path/to/consoles/', '/next/path/to/consoles/'),
 *     'Console/Command'           => array('/path/to/commands/', '/next/path/to/commands/'),
 *     'Console/Command/Task'      => array('/path/to/tasks/', '/next/path/to/tasks/'),
 *     'Lib'                       => array('/path/to/libs/', '/next/path/to/libs/'),
 *     'Locale'                    => array('/path/to/locales/', '/next/path/to/locales/'),
 *     'Vendor'                    => array('/path/to/vendors/', '/next/path/to/vendors/'),
 *     'Plugin'                    => array('/path/to/plugins/', '/next/path/to/plugins/'),
 * ));
 *
 */

/**
 * Custom Inflector rules can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. Make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */

/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter. By default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 *		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 *		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 *		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'File',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'File',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));