<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */


class AppController extends Controller
{
    public $components = array(
        'Acl',
        'Security',
        'Session',
        'Cookie',
        'Upload',
        'Paginator',
        'RequestHandler',
        'General',
        'ExcelReader',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('user_id' => 'username')
                )
            ),
            'loginRedirect' => array('controller' => 'Users', 'action' => 'dashboard', 'admin' => true),
            'logoutRedirect' => array('controller' => 'Users', 'action' => 'login', 'admin' => true),
          //  'authorize'=> array('Actions'),
            'authError'=> 'You are not authorized to view this page'
        ),
    );

    public $helpers = array('Html', 'Form', 'Text', 'General', 'Session', 'Js' => array("Jquery"), 'Time');

    public function beforeFilter()
    {
       // $this->Session->delete('Auth.Admin');
       // $this->Session->delete('Auth.User');
        //pr($this->Session->read('Auth'));

       // $this->RequestHandler->respondAs('text/x-json');
        if ($this->request->is('ajax'))
        {
            $this->Security->unlockedActions = array($this->request->action);
        } else {
            $this->Security->unlockedActions = array($this->request->action);
        }

          if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
        }
        $this->Auth->autoRedirect = false;
        if (isset($this->params['admin']) && $this->params['prefix'] == 'admin' && $this->request->prefix == 'admin') {

            $this->Auth->loginAction = array('controller' => 'Users', 'action' => 'login', 'admin' => true);
            $this->Auth->logoutRedirect = array('controller' => 'Users', 'action' => 'login', 'admin' => true);
            $this->Auth->loginRedirect = array('controller' => 'Users', 'action' => 'dashboard' , 'admin' => true);
            AuthComponent::$sessionKey = 'Auth.Admin';
            $this->Auth->authenticate = array(
                'Form' => array(
                    'userModel' => 'User',
                )
            );

            $this->Auth->allow('admin_login', 'admin_forgot_password', 'admin_reset', 'admin_GetStateByCountry', 'admin_add','App_ViewBooks','App_AllBooks');

           // $this->layout = 'admin_layout';
            //$this->admin = $this->check_admin();

            if ($this->Session->read('Auth.Admin')) {
                $user_id = $this->Session->read('Auth.Admin');
                $user_id = $user_id['ID'];
                $this->set('session_user_id', $user_id);
                $authUser = $this->Session->read('Auth.Admin');
                $this->set('authUser', $authUser);
 			    $this->User = ClassRegistry::init('User');
				
				/*
				switch($authUser["ROLE_ID"]) {
					case STUDENT_ID:
						$class = $authUser["CLASS_ID"];
						
						$this->Holiday = ClassRegistry::init('Holiday');
						$holiday_cnt = 0;
						$holiday_cnt = $this->Holiday->find('count',array(
							'conditions'=>array(
								'Holiday.STATUS'=>1,
								'MONTH(Holiday.START_DATE)'=>date("m"),
								'YEAR(Holiday.END_DATE)'=>date("Y"),
							)
						));

						
						$this->Attendance = ClassRegistry::init('Attendance');
						$present_cnt = 0;
						$present_cnt = $this->Attendance->find('count',array(
							'conditions'=>array(
								'Attendance.ID'=>$authUser["ID"],
								'Attendance.STATUS'=>1,
								'Attendance.AVAILABILITY'=>'P',
								'MONTH(Attendance.ATTENDANCE_DATE)'=>date("m"),
								'YEAR(Attendance.ATTENDANCE_DATE)'=>date("Y"),
							)
						));
						
						$absent_cnt = 0;
						$absent_cnt = $this->Attendance->find('count',array(
							'conditions'=>array(
								'Attendance.ID'=>$authUser["ID"],
								'Attendance.STATUS'=>1,
								'Attendance.AVAILABILITY'=>'A',
								'MONTH(Attendance.ATTENDANCE_DATE)'=>date("m"),
								'YEAR(Attendance.ATTENDANCE_DATE)'=>date("Y"),
							)
						));

						$this->LeaveApplication = ClassRegistry::init('LeaveApplication');						
						$total_leaves = $this->LeaveApplication->find('all',array(
							'conditions'=>array(
								'LeaveApplication.USER_ID'=>$authUser["ID"]
							)								
						));


					
						$unapprove_leaves_cnt = 0;
						$approve_leaves_cnt = 0;
						$reject_leaves_cnt = 0;
						if(is_array($total_leaves) && sizeof($total_leaves)) { 
							foreach($total_leaves as $totl) {
								if($totl["LeaveApplication"]["LEAVE_STATUS"]==0) {
									$unapprove_leaves_cnt++;
								}
								if($totl["LeaveApplication"]["LEAVE_STATUS"]==1) {
									$approve_leaves_cnt++;
								}
								if($totl["LeaveApplication"]["LEAVE_STATUS"]==2) {
									$reject_leaves_cnt++;
								}

							}
						}
						$this->set('total_leaves_cnt',sizeof($total_leaves));
						$this->set('unapprove_leaves_cnt',$unapprove_leaves_cnt);
						$this->set('approve_leaves_cnt',$approve_leaves_cnt);
						$this->set('reject_leaves_cnt',$reject_leaves_cnt);
						$this->set('holiday_cnt',$holiday_cnt);
						$this->set('present_cnt',$present_cnt);
						$this->set('absent_cnt',$absent_cnt);
					break;
					case TEACHER_ID:
						$this->Attendance = ClassRegistry::init('Attendance');
						$present_cnt = 0;
						$present_cnt = $this->Attendance->find('count',array(
							'conditions'=>array(
								'Attendance.STATUS'=>1,
								'Attendance.AVAILABILITY'=>'P',
								'Attendance.ATTENDANCE_DATE'=>date("Y-m-d"),
								'User.CLASS_ID'=>$authUser["CLASS_ID"],
							)
						));
						
						$absent_cnt = 0;
						$absent_cnt = $this->Attendance->find('count',array(
							'conditions'=>array(
								'User.CLASS_ID'=>$authUser["CLASS_ID"],
								'Attendance.STATUS'=>1,
								'Attendance.AVAILABILITY'=>'A',
								'Attendance.ATTENDANCE_DATE'=>date("Y-m-d"),
							)
						));

                                                $this->LeaveApplication = ClassRegistry::init('LeaveApplication');						
						$total_leaves = $this->LeaveApplication->find('all',array(
							'conditions'=>array(
								'LeaveApplication.USER_ID'=>$authUser["ID"],
								'? BETWEEN ? AND ?'=>array(date("m"),'LeaveApplication.FROM_DATE','LeaveApplication.TO_DATE'),
							)
						));
						$unapprove_leaves_cnt = 0;
						$approve_leaves_cnt = 0;
						$reject_leaves_cnt = 0;
						if(is_array($total_leaves) && sizeof($total_leaves)) { 
							foreach($total_leaves as $totl) {
								if($totl["LeaveApplication"]["LEAVE_STATUS"]==0) {
									$unapprove_leaves_cnt++;
								}
								if($totl["LeaveApplication"]["LEAVE_STATUS"]==1) {
									$approve_leaves_cnt++;
								}
								if($totl["LeaveApplication"]["LEAVE_STATUS"]==2) {
									$reject_leaves_cnt++;
								}

							}
						}
						$this->set('total_leaves_cnt',sizeof($total_leaves));
						$this->set('unapprove_leaves_cnt',$unapprove_leaves_cnt);
						$this->set('approve_leaves_cnt',$approve_leaves_cnt);
						$this->set('reject_leaves_cnt',$reject_leaves_cnt);
	                                        $this->set('present_cnt',$present_cnt);
						$this->set('absent_cnt',$absent_cnt);
					break;
                                        case ADMIN_ID:					
                                        case ACCOUNT_ID:
					case HR_ID:
					case SUPERVISOR_ID:
					$this->LeaveApplication = ClassRegistry::init('LeaveApplication');						
						$total_leaves = $this->LeaveApplication->find('all',array(
							'conditions'=>array(
								'LeaveApplication.ROLE_ID !='=>STUDENT_ID,
								'? BETWEEN ? AND ?'=>array(date("m"),'LeaveApplication.FROM_DATE','LeaveApplication.TO_DATE'),
							)
						));
						$unapprove_leaves_cnt = 0;
						$approve_leaves_cnt = 0;
						$reject_leaves_cnt = 0;
						if(is_array($total_leaves) && sizeof($total_leaves)) { 
							foreach($total_leaves as $totl) {
								if($totl["LeaveApplication"]["LEAVE_STATUS"]==0) {
									$unapprove_leaves_cnt++;
								}
								if($totl["LeaveApplication"]["LEAVE_STATUS"]==1) {
									$approve_leaves_cnt++;
								}
								if($totl["LeaveApplication"]["LEAVE_STATUS"]==2) {
									$reject_leaves_cnt++;
								}

							}
						}
						$this->set('total_leaves_cnt',sizeof($total_leaves));
						$this->set('unapprove_leaves_cnt',$unapprove_leaves_cnt);
						$this->set('approve_leaves_cnt',$approve_leaves_cnt);
						$this->set('reject_leaves_cnt',$reject_leaves_cnt);
					
					break;	
				} */
            }
        } else {
            $this->Auth->allow('index', 'view', 'forgot_password', 'reset', 'register', 'dashboard', 'GetStateByCountry', 'GetCityByCountry');
            //Configure AuthComponent For Front Side Login
            $this->Auth->loginAction = array('controller' => 'Users', 'action' => 'login', 'admin' => false);
            $this->Auth->logoutRedirect = array('controller' => 'Users', 'action' => 'login', 'admin' => false);
            $this->Auth->loginRedirect = array('controller' => 'Users', 'action' => 'students', 'admin' => false);
            AuthComponent::$sessionKey = 'Auth.User';

                if ($this->Session->read('Auth.User')) {
                    $user_id = $this->Session->read('Auth.User');
                    $id = $user_id['ID'];
                    $this->set('front_session_user_id', $id);
                    $this->set('front_auth_User', $this->Session->read('Auth.User'));
            }
        }
    }
}