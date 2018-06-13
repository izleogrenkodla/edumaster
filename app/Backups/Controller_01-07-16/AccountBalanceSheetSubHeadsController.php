<?php
class AccountBalanceSheetSubHeadsController extends AppController
{ 
    var $name = 'AccountBalanceSheetSubHeads';

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
		$result = $this->AccountBalanceSheetSubHead->find("all", array(
            'contain' => array('AccountBalanceSheetHead'),
			'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'AccountBalanceSheetSubHead.SORT_ORDER asc'
        ));
		
        $this->set('data', $result);
		
		/*$this->loadModel('AccountBalanceSheetHead');
		$result = $this->AccountBalanceSheetHead->GetAccountBalanceSheetHead();
		$this->set('account_balance_sheet_heads', $result);*/
		
		}
	
		public function admin_add(){		
		
		$this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

		$this->loadModel('AccountBalanceSheetHead');
		$result = $this->AccountBalanceSheetHead->GetAccountBalanceSheetHead();
		
		$this->set('account_balance_sheet_heads', $result);
		
        if ($this->request->is('post')) {
						
            $this->AccountBalanceSheetSubHead->set($this->request->data);

			/*echo "<pre>";
			print_r($this->AccountBalanceSheetSubHead);
			die;*/
			
            if ($this->AccountBalanceSheetSubHead->Validation()) {				
                $this->AccountBalanceSheetSubHead->create();
								
				$this->AccountBalanceSheetSubHead->saveField("created_by",$Session_data['ID']);
				
				$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
				$this->AccountBalanceSheetSubHead->saveField("created_ip",$ip);
				
                if ($this->AccountBalanceSheetSubHead->save($this->request->data)) {
                   
                    $this->Session->setFlash('Account Balance Sheet Sub Head Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Account Balance Sheet Sub Head Not Added Please Try Again!', 'message_bad');
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

        $this->AccountBalanceSheetSubHead->id = $id;
        if (empty($this->AccountBalanceSheetSubHead->id)) {
            $this->Session->setFlash('Invalid Account Balance Sheet Sub Head!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
	
		$this->loadModel('AccountBalanceSheetHead');
		$result = $this->AccountBalanceSheetHead->GetAccountBalanceSheetHead();
		$this->set('account_balance_sheet_heads', $result);

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->AccountBalanceSheetSubHead->Validation()) {
                if ($this->AccountBalanceSheetSubHead->save($this->request->data)) {
                    $this->Session->setFlash('Account Balance Sheet Sub Head Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Account Balance Sheet Sub Head Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Account Balance Sheet Sub Head Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $AccountBalanceSheetSubHeads = $this->AccountBalanceSheetSubHead->find('first', array(
                'contain' => array(),
                'conditions' => array('ACCOUNT_BALANCE_SHEET_SUB_HEAD_ID' => $id)
            ));
			
			
			//print_r($AccountBalanceSheetSubHeads);die;
            if(empty($AccountBalanceSheetSubHeads)) {
                $this->Session->setFlash('Invalid Account Balance Sheet Sub Head!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $AccountBalanceSheetSubHeads;
        }
	}
	
	
	 public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->AccountBalanceSheetSubHead->delete($Id)) {
                    $this->Session->setFlash('Account Balance Sheet Sub Head Deleted Successfully', 'message_good');
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
            $this->Session->setFlash('Invalid Account Balance Sheet Sub Head!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	   
	   
	   
      
	
	

}	