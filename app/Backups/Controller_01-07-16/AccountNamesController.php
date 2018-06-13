<?php
class AccountNamesController extends AppController
{ 
    var $name = 'AccountNames';

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
		$result = $this->AccountName->find("all", array(
            'contain' => array('AccountDepartment'),
			'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'AccountName.SORT_ORDER asc'
        ));
		
        $this->set('data', $result);
		
		/*$this->loadModel('AccountDepartment');
		$result = $this->AccountDepartment->GetAccountDepartment();
		$this->set('account_departments', $result);*/
		
		}
	
		public function admin_add(){		
		
		$this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

		$this->loadModel('AccountDepartment');
		$result = $this->AccountDepartment->GetAccountDepartment();
		
		$this->set('account_departments', $result);
		
        if ($this->request->is('post')) {
						
            $this->AccountName->set($this->request->data);

			/*echo "<pre>";
			print_r($this->AccountName);
			die;*/
			
            if ($this->AccountName->Validation()) {				
                $this->AccountName->create();
								
				$this->AccountName->saveField("created_by",$Session_data['ID']);
				
				$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
				$this->AccountName->saveField("created_ip",$ip);
				
                if ($this->AccountName->save($this->request->data)) {
                   
                    $this->Session->setFlash('Account Name Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Account Name Not Added Please Try Again!', 'message_bad');
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

        $this->AccountName->id = $id;
        if (empty($this->AccountName->id)) {
            $this->Session->setFlash('Invalid Account Name!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
	
		$this->loadModel('AccountDepartment');
		$result = $this->AccountDepartment->GetAccountDepartment();
		$this->set('account_departments', $result);

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->AccountName->Validation()) {
                if ($this->AccountName->save($this->request->data)) {
                    $this->Session->setFlash('Account Name Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Account Name Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Account Name Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $AccountNames = $this->AccountName->find('first', array(
                'contain' => array(),
                'conditions' => array('ACCOUNT_NAME_ID' => $id)
            ));
			
			
			//print_r($AccountNames);die;
            if(empty($AccountNames)) {
                $this->Session->setFlash('Invalid Account Name!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $AccountNames;
        }
	}
	
	
	 public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->AccountName->delete($Id)) {
                    $this->Session->setFlash('Account Name Deleted Successfully', 'message_good');
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
            $this->Session->setFlash('Invalid Account Name!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	   
	   
	   
      
	
	

}	