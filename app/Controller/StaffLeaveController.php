<?php
// app/Controller/UsersController.php
class StaffLeaveController extends AppController 
{ 
    var $name = 'StaffLeave';

    public function beforeFilter()
    {
		$this->Auth->allow();
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
		 
		$roles = $this->StaffLeave->Role->GetRoles();
        $this->set('user_roles', $roles);
       
    }
	
	public function admin_add($id = null){
	
		 $this->layout = 'admin_form_layout';		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
	
		if($Session_data["ROLE_ID"]!=HR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
				
			$this->User = ClassRegistry::init('User');
					$rol  = $this->User->find('first', array(
							'contain' => array(),
							'conditions' => array('ID' => $id)
						));
						
						
			$this->set('ro',$rol);			
				
					

        if ($this->request->is('post')) {
			
					
            $this->StaffLeave->set($this->request->data);
            if ($this->StaffLeave->Validation()) {
                $this->StaffLeave->create();
                if ($this->StaffLeave->save($this->request->data)) {
					
					$this->StaffLeave->saveField("USER_ID",$id);
					$this->StaffLeave->saveField("ROLE_ID",$rol['User']['ROLE_ID']);
					
					$this->request->data['StaffLeave']['USER_ID'] = $Session_data['ID'];
					$this->StaffLeave->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->StaffLeave->saveField("created_ip",$ip);
					
					
                    $this->Session->setFlash('Leave Added Successfully!', 'message_good');
                     $this->redirect(array('controller' => 'StaffLeave', 'action' => 'list'));
                }
                } else {
                $this->Session->setFlash('Leave Not Added Please Try Again!', 'message_bad');
                }
         }
		//$this->loadModel('Leavetype');
        $ltype = $this->StaffLeave->LeaveType->GetLType();
        $this->set('ltype', $ltype);
	
	}

	 public function admin_list($id = null)
    {
		 $this->layout = 'admin_form_layout';		
		 $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if(isset($this->params->query["CLS"])) {
            $conditions["StaffLeave.ROLE_ID"] = $this->params->query["CLS"];
            $this->request->data["StaffLeave"]["CLS"] = $this->params->query["CLS"];
        }
		
		$this->User = ClassRegistry::init('User');
		$rdata = $this->User->find('first',array(
            'contain' => array(),
            'conditions' => array('User.ID' =>$id),
        ));
		
		if((isset($id)) && ($id)>0)
			{
				$conditions['StaffLeave.USER_ID'] = $id;
				$conditions['StaffLeave.ROLE_ID'] = $rdata['User']['ROLE_ID'];
			}
		
		$history  = $this->StaffLeave->find('all', array(
							'contain' => array('Role','Name','LeaveType'),
							'conditions' => $conditions,
		));
		
		$this->set('list', $history);
		//$this->set('id', $id);
		
		  $ltype = $this->StaffLeave->LeaveType->GetLType();
        $this->set('ltype', $ltype);
		
		 $roles = $this->StaffLeave->Role->GetRoles();
        $this->set('user_roles', $roles);

	}

	 public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
	
		if($Session_data["ROLE_ID"]!=HR_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if (!empty($Id)) {
            try {
                if ($this->StaffLeave->delete($Id)) {
                    $this->Session->setFlash('Leave is successfully deleted', 'message_good');
                    $this->redirect(array('action' => 'list'));
                } else {
                    $this->redirect(array('action' => 'index'));
                    $this->Session->setFlash('Record was not deleted. Unknown error.', 'message_bad');
                }
            } catch (Exception $e) {
                $this->Session->setFlash("Delete failed. {$e->getMessage()}", 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->redirect(array('action' => 'index'));
        } else {
            $this->Session->setFlash('Invalid Leave.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }

}
?>