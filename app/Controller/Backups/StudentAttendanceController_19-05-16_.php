<?php
class StudentAttendanceController extends AppController
{
    var $name = 'StudentAttendance';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
	
	 public function admin_index()
    {
		$Session = $this->Session->read('Auth.Admin');
		
		if(isset($this->params->query["CLS"])) {
            $con["StudentAttendance.CLASS_ID"] = $this->params->query["CLS"];
            $this->request->data["User"]["CLS"] = $this->params->query["CLS"];
        }
			$conditions = array('StudentAttendance.STATUS'=>1,$con);
			
			$this->layout = 'admin_form_layout';
			$this->paginate = array(
				'conditions' => $conditions,
				'Contain' => array(''),
				'limit' => PAGINATION_LIMIT_ADMIN,
				'order' => 'StudentAttendance.created DESC'
			);
	
			$this->set('StudentAttendance', $this->paginate('StudentAttendance'));
			
			 $classes = $this->StudentAttendance->AcademicClass->GetAcademicClasses();
         $this->set('classes', $classes);
    }
	
	
	
	
	  public function admin_add(){

       
            $this->layout = 'admin_form_layout';
            $Session_data = $this->Session->read('Auth.Admin');


			if (empty($Session_data)) {
				$this->Session->setFlash('Please login', 'message_bad');
				$this->redirect(array('action' => 'index'));
			}

			if ($this->request->is('post')) {
	
			   $this->StudentAttendance->set($this->request->data);
			 
					if ($this->request->data) {
						 if ($this->StudentAttendance->Validation()) {
						
						$list = $this->request->data['selected_users'];
						
						$id = $this->request->data['id'];
						
						$class_id = $this->request->data['cls'];
						
						
						$this->request->data['StudentAttendance']['USER_ID'] = $Session_data['ID'];
						
						$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					   
	
						  foreach($list as $key => $stid)
							{
								$status = $stid;
									foreach($id as $uid)
									{
									   
										$user_id= $id[$key];
									}
	
									foreach($class_id as $cid)
									{
									   
										$role_id= $class_id[$key];
									}
									
							 
								 $ttdata['StudentAttendance'] = array(
											'AVAILABILITY'=>$status,
											'ATTENDANCE_DATE'=>$this->General->datefordb($this->request->data['StudentAttendance']['ATTENDANCE_DATE']),
											'ID'=>$user_id,
											'STATUS' => 1,
											'CLASS_ID' => $role_id,
											
	
										);
	
									 $this->StudentAttendance->create();
									 $this->StudentAttendance->save($ttdata);
						   
							}
						
						$this->Session->setFlash('Student Attendance Added Successfully!', 'message_good');
						$this->redirect(array('action' => 'index'));
					 }
				} else
				{
					$this->Session->setFlash('Student Attendance Not Added Please Try Again!', 'message_bad');
				}
			}
        
       $this->User = ClassRegistry::init('User');
	   
	    if(isset($this->params->query["CLS"])) {
            $conditions["User.CLASS_ID"] = $this->params->query["CLS"];
            $this->request->data["User"]["CLS"] = $this->params->query["CLS"];
        }
	
        $us = $this->User->find('all',array(
            'Contain' => array('AcademicClass'),
            'conditions' =>array('ROLE_ID'=>5,$conditions),
        ));
        $this->set('users', $us);
		
    	 $classes = $this->StudentAttendance->AcademicClass->GetAcademicClasses();
         $this->set('classes', $classes);
        
     }
   
}
?>

