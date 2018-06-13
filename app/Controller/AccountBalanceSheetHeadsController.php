<?php
class AccountBalanceSheetHeadsController extends AppController
{ 
    var $name = 'AccountBalanceSheetHeads';

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
		$result = $this->AccountBalanceSheetHead->find("all", array(
            'contain' => array(),
			'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'AccountBalanceSheetHead.SORT_ORDER asc'
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
						
            $this->AccountBalanceSheetHead->set($this->request->data);

			/*echo "<pre>";
			print_r($this->AccountBalanceSheetHead);
			die;*/
			
            if ($this->AccountBalanceSheetHead->Validation()) {				
                $this->AccountBalanceSheetHead->create();
								
				$this->AccountBalanceSheetHead->saveField("created_by",$Session_data['ID']);
				
				$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
				$this->AccountBalanceSheetHead->saveField("created_ip",$ip);
				
                if ($this->AccountBalanceSheetHead->save($this->request->data)) {
                   
                    $this->Session->setFlash('Account Balance Sheet Head Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Account Balance Sheet Head Not Added Please Try Again!', 'message_bad');
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
		
        $this->AccountBalanceSheetHead->id = $id;
        if (empty($this->AccountBalanceSheetHead->id)) {
            $this->Session->setFlash('Invalid Account Balance Sheet Head!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
	

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->AccountBalanceSheetHead->Validation()) {
                if ($this->AccountBalanceSheetHead->save($this->request->data)) {
                    $this->Session->setFlash('Account Balance Sheet Head Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Account Balance Sheet Head Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Account Balance Sheet Head Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $AccountBalanceSheetHeads = $this->AccountBalanceSheetHead->find('first', array(
                'contain' => array(),
                'conditions' => array('ACCOUNT_BALANCE_SHEET_HEAD_ID' => $id)
            ));
			
			
			//print_r($AccountBalanceSheetHeads);die;
            if(empty($AccountBalanceSheetHeads)) {
                $this->Session->setFlash('Invalid Account Balance Sheet Head!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $AccountBalanceSheetHeads;
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
                if ($this->AccountBalanceSheetHead->delete($Id)) {
                    $this->Session->setFlash('Account Balance Sheet Head Deleted Successfully', 'message_good');
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
            $this->Session->setFlash('Invalid Account Balance Sheet Head!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	   
	   
	   
      
	
	

}	