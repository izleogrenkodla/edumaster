<?php
class AccountPaymentTypesController extends AppController
{ 
    var $name = 'AccountPaymentTypes';

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
		$result = $this->AccountPaymentType->find("all", array(
            'contain' => array(),
			'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'AccountPaymentType.SORT_ORDER asc'
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
						
            $this->AccountPaymentType->set($this->request->data);

			/*echo "<pre>";
			print_r($this->AccountPaymentType);
			die;*/
			
            if ($this->AccountPaymentType->Validation()) {				
                $this->AccountPaymentType->create();
								
				$this->AccountPaymentType->saveField("created_by",$Session_data['ID']);
				
				$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
				$this->AccountPaymentType->saveField("created_ip",$ip);
				
                if ($this->AccountPaymentType->save($this->request->data)) {
                   
                    $this->Session->setFlash('Account Payment Type Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $this->Session->setFlash('Account Payment Type Not Added Please Try Again!', 'message_bad');
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

        $this->AccountPaymentType->id = $id;
        if (empty($this->AccountPaymentType->id)) {
            $this->Session->setFlash('Invalid Account Payment Type!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
	

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->AccountPaymentType->Validation()) {
                if ($this->AccountPaymentType->save($this->request->data)) {
                    $this->Session->setFlash('Account Payment Type Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Account Payment Type Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Account Payment Type Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $AccountPaymentTypes = $this->AccountPaymentType->find('first', array(
                'contain' => array(),
                'conditions' => array('ACCOUNT_PAYMENT_TYPE_ID' => $id)
            ));
			
			
			//print_r($AccountPaymentTypes);die;
            if(empty($AccountPaymentTypes)) {
                $this->Session->setFlash('Invalid Account Payment Type!', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $AccountPaymentTypes;
        }
	}
	
	
	 public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->AccountPaymentType->delete($Id)) {
                    $this->Session->setFlash('Account Payment Type Deleted Successfully', 'message_good');
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
            $this->Session->setFlash('Invalid Account Payment Type!', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	   
	   
	   
      
	
	

}	