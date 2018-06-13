<?php
class RemarkController extends AppController
{ 
    var $name = 'Remark';
	
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
		
		if(isset($this->request->data["Mailer"]["ROLE"]) && ($this->request->data["Mailer"]["ROLE"] == STUDENT_ID)){
			
			
			
			$disable = '';
			$this->set('disable', $disable);
			}else{
				
				
				
				$disable = 'disabled';
			$this->set('disable', $disable);
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
	
		 
		$roles = $this->Remark->Role->GetRoles();
        $this->set('user_roles', $roles);
		
		$classes = $this->Remark->AcademicClass->GetAcademicClasses();
        $this->set('classes', $classes);
       
    }
	
	 public function admin_add($id = null)
    {
		$this->layout = 'admin_form_layout';		
		 $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]==STUDENT_ID) {
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
					
            $this->Remark->set($this->request->data);
            if ($this->Remark->Validation()) {
                $this->Remark->create();
                if ($this->Remark->save($this->request->data)) {
					
					$this->Remark->saveField("USER_ID",$id);
					
					$d = $this->General->datefordb($this->request->data["Remark"]["DATE"]);
					$this->Remark->saveField("DATE",$d);
					
					$this->Remark->saveField("ROLE_ID",$rol['User']['ROLE_ID']);
					
					$this->request->data['Remark']['USER_ID'] = $Session_data['ID'];
					$this->Remark->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->Remark->saveField("created_ip",$ip);
				
                    $this->Session->setFlash('Remark Added Successfully!', 'message_good');
                    $this->redirect(array('controller' => 'Remark', 'action' => 'list',$id));
                }
                } else {
                $this->Session->setFlash('Remark Not Added Please Try Again!', 'message_bad');
                }
         }
		
	
	}
	
	 public function admin_list($id = null)
    {
		 $this->layout = 'admin_form_layout';		
		 $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		$history  = $this->Remark->find('all', array(
							'contain' => array('Name'),
							'conditions' => array('USER_ID' => $id)
						));
		
		$this->set('list', $history);
		$this->set('id', $id);
		
	}
	
	
	 public function admin_view($id = null)
    {
		 $this->layout = 'admin_form_layout';		
		 $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		$history  = $this->Remark->find('first', array(
							'contain' => array('Name'),
							'conditions' => array('REMARK_ID' => $id)
						));
		
		$this->set('list', $history);
		
	}
}
?>