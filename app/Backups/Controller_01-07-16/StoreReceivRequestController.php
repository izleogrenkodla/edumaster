  <?php
// app/Controller/UsersController.php


class StoreReceivRequestController extends AppController {

    var $name = 'StoreReceivRequest';

    public function beforeFilter()
    {
        parent::beforeFilter();

        // $this->Auth->allow('App_UserTypes');

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->StoreReceivRequest->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StoreReceivRequest.created ASC'
        );
			
        $this->set('StoreReceivRequest', $this->paginate('StoreReceivRequest'));
    }

   public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post')) {
            $this->StoreReceivRequest->set($this->request->data);
            if ($this->StoreReceivRequest->Validation()) {
                $this->StoreReceivRequest->create();
                if ($this->StoreReceivRequest->save($this->request->data)) {
					
					$this->request->data["StoreReceivRequest"]["DATE"] = $this->General->datefordb($this->request->data["StoreReceivRequest"]["DATE"]);
	
					 $this->StoreReceivRequest->saveField('DATE',$this->request->data["StoreReceivRequest"]["DATE"]);
					$this->request->data['StorReceiveRequest']['USER_ID'] = $Session_data['ID'];
					$this->StoreReceivRequest->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->StoreReceivRequest->saveField("created_ip",$ip);
                    $this->Session->setFlash('Store Distribution  Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Store Receive Request  Not Added Please Try Again!', 'message_bad');
                }
        }
		
		 $this->loadModel('StoreCategory');
        $cat = $this->StoreCategory->getStoreCategory();
        $this->set('cat',$cat);

       $this->loadModel('Role');
        $role = $this->Role->getRoles();
        $this->set('role',$role);

        $this->loadModel('StoreVendor');
        $vendor = $this->StoreVendor->getStoreVendor();
        $this->set('vendor',$vendor);


        $this->loadModel('StoreItemMstr');
        $item = $this->StoreItemMstr->getStoreItemMstr();
        $this->set('item',$item);
    }

    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->StoreReceivRequest->id = $id;
        if (empty($this->StoreReceivRequest->id)) {
            $this->Session->setFlash('Invalid Store Receive Request !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
			$this->request->data["StoreReceivRequest"]["DATE"] = $this->General->datefordb($this->request->data["StoreReceivRequest"]["DATE"]);
            if ($this->StoreReceivRequest->Validation()) {
                if ($this->StoreReceivRequest->save($this->request->data)) {
					
					
					
					
                    $this->Session->setFlash('Store Receive Request Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Store Receive Request Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Store Receive Request Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $StoreReceivRequest = $this->StoreReceivRequest->find('first', array(
                'contain' => array(),
                'conditions' => array('ID' => $id)
            ));
            if(empty($StoreReceivRequest)) {
                $this->Session->setFlash('Invalid Store Receive Request !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			$StoreReceivRequest['StoreReceivRequest']['DATE'] = date('d/m/Y', strtotime(str_replace('-','/',$StoreReceivRequest['StoreReceivRequest']['DATE'])));
            $this->request->data = $StoreReceivRequest;
        }
		
		
		
		$this->loadModel('StoreCategory');
        $cat = $this->StoreCategory->getStoreCategory();
        $this->set('cat',$cat);
		
		$this->loadModel('Role');
        $role = $this->Role->getRoles();
        $this->set('role',$role);

       

        $this->loadModel('StoreVendor');
        $vendor = $this->StoreVendor->getStoreVendor();
        $this->set('vendor',$vendor);


        $this->loadModel('StoreItemMstr');
        $item = $this->StoreItemMstr->getStoreItemMstr();
        $this->set('item',$item);
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->StoreReceivRequest->delete($Id)) {
                    $this->Session->setFlash('Store Receive Request is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Store Receive Request.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	
	
	public function admin_update($Id = null){
		
		  $StoreReceivRequest = $this->StoreReceivRequest->find('first', array(
                'contain' => array(),
                'conditions' => array('ID' => $Id)
            ));
			
			
		
	}
}
