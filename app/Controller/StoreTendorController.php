  <?php
// app/Controller/UsersController.php


class StoreTendorController extends AppController {

    var $name = 'StoreTendor';

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
        $this->StoreTendor->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StoreTendor.created ASC'
        );
			
        $this->set('StoreTendor', $this->paginate('StoreTendor'));
    }

   public function admin_add()
    {
		// PR($_POST);
		// die;
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=STORE_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {
            $this->StoreTendor->set($this->request->data);
            if ($this->StoreTendor->Validation()) {
                $this->StoreTendor->create();
                if ($this->StoreTendor->save($this->request->data)) {
					
					//$this->request->data["StoreTendor"]["DATE"] = $this->General->datefordb($this->request->data["StoreTendor"]["DATE"]);
	
					// $this->StoreTendor->saveField('DATE',$this->request->data["StoreTendor"]["DATE"]);
					$this->request->data['StorReceiveRequest']['USER_ID'] = $Session_data['ID'];
					$this->StoreTendor->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->StoreTendor->saveField("created_ip",$ip);
                    $this->Session->setFlash('Store Tendor  Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Store Store Tendor  Not Added Please Try Again!', 'message_bad');
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
		
		if($Session_data["ROLE_ID"]!=STORE_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->StoreTendor->id = $id;
        if (empty($this->StoreTendor->id)) {
            $this->Session->setFlash('Invalid Store Store Tendor !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
			$this->request->data["StoreTendor"]["DATE"] = $this->General->datefordb($this->request->data["StoreTendor"]["DATE"]);
            if ($this->StoreTendor->Validation()) {
                if ($this->StoreTendor->save($this->request->data)) {
					
					
					
					
                    $this->Session->setFlash('Store Store Tendor Updated Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Store Store Tendor Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Store Store Tendor Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $StoreTendor = $this->StoreTendor->find('first', array(
                'contain' => array(),
                'conditions' => array('ID' => $id)
            ));
            if(empty($StoreTendor)) {
                $this->Session->setFlash('Invalid Store Store Tendor !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
			
            $this->request->data = $StoreTendor;
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
		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=STORE_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if (!empty($Id)) {
            try {
                if ($this->StoreTendor->delete($Id)) {
                    $this->Session->setFlash('Store Tendor is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid  Store Tendor.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
	
	
	
}
