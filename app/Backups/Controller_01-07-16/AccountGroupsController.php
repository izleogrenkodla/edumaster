<?php
class AccountGroupsController extends AppController
{ 
    var $name = 'AccountGroups';

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
		$result = $this->AccountGroup->find("all", array(
            'contain' => array(),
			'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'AccountGroup.SORT_ORDER asc'
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

        if ($this->request->is('post')) {
						
            $this->AccountGroup->set($this->request->data);

			/*echo "<pre>";
			print_r($this->AccountGroup);
			die;*/
			
            if ($this->AccountGroup->Validation()) {				
                $this->AccountGroup->create();
								
				$this->AccountGroup->saveField("created_by",$Session_data['ID']);
				
				$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
				$this->AccountGroup->saveField("created_ip",$ip);
				
                if ($this->AccountGroup->save($this->request->data)) {
                   
                    $this->Session->setFlash('Account Group Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Account Group Not Added Please Try Again!', 'message_bad');
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

        $this->AccountGroup->id = $id;
        if (empty($this->AccountGroup->id)) {
            $this->Session->setFlash('Invalid Account Group!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
	

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->AccountGroup->Validation()) {
                if ($this->AccountGroup->save($this->request->data)) {
                    $this->Session->setFlash('Account Group Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Account Group Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Account Group Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $AccountGroups = $this->AccountGroup->find('first', array(
                'contain' => array(),
                'conditions' => array('ACCOUNT_GROUP_ID' => $id)
            ));
			
			
			//print_r($AccountGroups);die;
            if(empty($AccountGroups)) {
                $this->Session->setFlash('Invalid Account Group!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $AccountGroups;
        }
	}
	
	
	 public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->AccountGroup->delete($Id)) {
                    $this->Session->setFlash('Account Group Deleted Successfully', 'message_good');
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
            $this->Session->setFlash('Invalid Account Group!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	   
	   
	   
      
	
	

}	