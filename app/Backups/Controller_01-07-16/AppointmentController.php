<?php
class AppointmentController extends AppController
{ 
    var $name = 'Appointment';

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
		
        $conditions = array();
        switch($Session["ROLE_ID"]) {
            case STUDENT_ID:
                $conditions['User.ROLE_ID']=STUDENT_ID;
                $conditions['User.CLASS_ID']=$Session["CLASS_ID"];
                break;
            case TEACHER_ID:
                $conditions['User.ROLE_ID']=STUDENT_ID;
                $conditions['User.CLASS_ID']=$Session["CLASS_ID"];
                break;
            default:
                $conditions['ROLE_ID']=STUDENT_ID;
                break;
        }
		
		
        if(isset($this->request->data['Mailer']["ROLE"]) ) {
			
            $conditions = array('ROLE_ID' => $this->request->data['Mailer']["ROLE"]);
			if(isset($this->request->data['Mailer']["CLS"]) ) {
			
            $conditions["User.CLASS_ID"] = $this->request->data['Mailer']["CLS"];
			
			   }
            $this->request->data["User"]["ROLE"] = $this->request->data['Mailer']["ROLE"];
			$this->layout = 'admin_form_layout';	
			$students = $this->User->find('all',array(
            'limit' => PAGINATION_LIMIT_ADMIN,			
            'conditions' => $conditions,  
        ));
		if(sizeof($students)>0) {
		$this->Session->write('Filter_Students',$students);
		}
		}
		elseif(isset($this->request->data["ROLE"]) && ($this->request->data["ROLE"] == STUDENT_ID)){
        $conditions["User.ROLE_ID"] = $this->params->query["ROLE"];
        $this->layout = 'admin_form_layout';
		$this->layout = 'ajax';
		$students = $this->User->find('all',array(
            'limit' => PAGINATION_LIMIT_ADMIN,
            'conditions' => $conditions
        ));
			
		}else{
			  $this->layout = 'admin_form_layout';
			  $students=array();
		}
		 
		 $this->set('AcademicHistory', $students);
		 
		
		 
		$roles = $this->Appointment->Role->GetRoles();
        $this->set('user_roles', $roles);
		
	
     }
	 
	  public function admin_conform($id) {
	 	  $this->layout = 'admin_form_layout';
          $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		  $data = $this->User->find('first', array(
			'contain' => array(),
			'conditions' => array('ID' => $id)
		));
		
		$role = $data['User']['ROLE_ID'];
		$jdate = $data['User']['JOINING_DATE'];
		$bsal = $data['User']['BASE_SALARY'];
		
			$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
		
		 if ($this->request->is('post')) {
      
					   $abc['Appointment'] = array(
                        'ROLE_ID' => $role,
                        'USER_ID' => $id,
                        'BASE_SALARY' => $bsal,
                        'JOINING_DATE' => $jdate,
						'created_by' => $Session_data['ID'],
						'created_ip' => $ip,
						
                    );
					
					

                    $this->Appointment->create();
                    $this->Appointment->save($abc);
                    
                    $this->redirect(array('action' => 'pre_appointment',$id));
                
            } 
         $user_data = $this->User->read(null, $id);
		
          $this->set('list',$user_data);
	
	  }
	 
	 public function admin_pre_appointment($id) {
	
	    $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
	   
	   $this->School = ClassRegistry::init('School');
	   
	   $this->request->data['Appointment']['USER_ID'] = $Session_data['ID'];
	   
	   $hrname = $this->User->find('first', array(
			'contain' => array(),
			'conditions' => array('ID' => $Session_data['ID'])
		));
		
		
	  $atu_name = $hrname['User']['FIRST_NAME'].' '.$hrname['User']['LAST_NAME'];
	  
		$this->set('hr',$atu_name);
		
		
	   
	    $user_data = $this->User->read(null, $id);
		
          $this->set('data',$user_data);
		 
		 $this->School = ClassRegistry::init('School');
         $school = $this->School->find('first',array(
            'ID'=>1,
         ));
		 $this->set('school',$school);
	   
	}
	
	public function admin_list($id = null){
		
		  $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		$this->User = ClassRegistry::init('User');
		$rdata = $this->User->find('first',array(
            'contain' => array(),
            'conditions' => array('User.ID' =>$id),
        ));
		
		if((isset($id)) && ($id)>0)
			{
				$conditions['Appointment.USER_ID'] = $id;
				$conditions['Appointment.ROLE_ID'] = $rdata['User']['ROLE_ID'];
			}
		
		 $data = $this->Appointment->find('all', array(
			'contain' => array('Role','Name'),
			'conditions' => $conditions,
		));
		
		$this->set('data',$data);
	}
}
?>