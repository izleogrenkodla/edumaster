<?php
class AccountDepartmentsController extends AppController
{ 
    var $name = 'AccountDepartments';

    public function beforeFilter()
    {
        parent::beforeFilter();

        $this->Auth->allow('App_AllocateTransport');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }
	
	
		public function admin_index(){
			
        $this->layout = 'admin_form_layout';
		$result = $this->AccountDepartment->find("all", array(
            'contain' => array(),
			'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'AccountDepartment.SORT_ORDER asc'
        ));
		
        $this->set('data', $result);
		}
	
		public function admin_add(){		
		
		$this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=ACCOUNT_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {
						
            $this->AccountDepartment->set($this->request->data);

			/*echo "<pre>";
			print_r($this->AccountDepartment);
			die;*/
			
            if ($this->AccountDepartment->Validation()) {				
                $this->AccountDepartment->create();
								
				$this->AccountDepartment->saveField("created_by",$Session_data['ID']);
				
				$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
				$this->AccountDepartment->saveField("created_ip",$ip);
				
                if ($this->AccountDepartment->save($this->request->data)) {
                   
                    $this->Session->setFlash('Account Department Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Account Department Not Added Please Try Again!', 'message_bad');
            }
        }
        
       }
	   
	   
	public function admin_edit($id = null){
		
		
		 $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=ACCOUNT_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->AccountDepartment->id = $id;
        if (empty($this->AccountDepartment->id)) {
            $this->Session->setFlash('Invalid Account Department!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
	

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->AccountDepartment->Validation()) {
                if ($this->AccountDepartment->save($this->request->data)) {
                    $this->Session->setFlash('Account Department Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Account Department Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Account Department Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $AccountDepartments = $this->AccountDepartment->find('first', array(
                'contain' => array(),
                'conditions' => array('ACCOUNT_DEPARTMENT_ID' => $id)
            ));
			
			
			//print_r($AccountDepartments);die;
            if(empty($AccountDepartments)) {
                $this->Session->setFlash('Invalid Account Department!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $AccountDepartments;
        }
	}
	
	
	 public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=ACCOUNT_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if (!empty($Id)) {
            try {
                if ($this->AccountDepartment->delete($Id)) {
                    $this->Session->setFlash('Account Department Deleted Successfully', 'message_good');
                    $this->redirect(array('action' => 'index'));
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
            $this->Session->setFlash('Invalid Account Department!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	   
	   
	   
      
	
	

}	