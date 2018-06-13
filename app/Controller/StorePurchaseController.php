<?php
//app/Controller/UsersController.php
class StorePurchaseController extends AppController
{
    var $name = 'StorePurchase';

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
        $this->StorePurchase->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StorePurchase.created ASC'
        );

        $this->set('StorePurchase', $this->paginate('StorePurchase'));
    }

   public function admin_add()
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


        if ($this->request->is('post')) {
			
            $this->StorePurchase->set($this->request->data);
            if ($this->StorePurchase->Validation()) {
                $this->StorePurchase->create();
				
					
					
                if ($this->StorePurchase->save($this->request->data)) {
					$this->loadModel('StorePurchaseOrder');
					$res = $this->StorePurchaseOrder->find('first',array(
						
							'conditons' => array(
								'CATEGORY_ID' => $this->request->data['StorePurchase']['CATEGORY_ID'],
								'ITEM_ID' => $this->request->data['StorePurchase']['ITEM_ID'],
							),
							'order' => 'StorePurchaseOrder.ID DESC'
							));
							//PR($res);
							$id = $res['StorePurchaseOrder']['ID'];
							// foreach($res as $res1){
								// $id = $res1['ID'];
								// $id = $id;
							// }
							if($res){
							
							$this->StorePurchaseOrder->updateAll(
							array(
							'QUANTITY' => $this->request->data['StorePurchase']['QUANTITY'],
							'REMAINING_QUANTITY' => "0",
							
							
						),array('StorePurchaseOrder.ID '=>$id)
					);
							$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->StorePurchase->saveField("created_ip",$ip);
					 
                    $this->Session->setFlash('Store Purchase Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
							
							}else{
							
		
					     
					$this->StorePurchaseOrder->saveField("QUANTITY",$this->request->data['StorePurchase']['QUANTITY']);
					$this->StorePurchaseOrder->saveField("CATEGORY_ID",$this->request->data['StorePurchase']['CATEGORY_ID']);
					$this->StorePurchaseOrder->saveField("ITEM_ID",$this->request->data['StorePurchase']['ITEM_ID']);
					$this->StorePurchaseOrder->saveField("RATE",$this->request->data['StorePurchase']['RATE_ID']);
					$this->StorePurchaseOrder->saveField("AMOUNT",$this->request->data['StorePurchase']['AMOUNT']);
					$this->StorePurchaseOrder->saveField("DETAILS",$this->request->data['StorePurchase']['DETAILS']);
					$this->request->data['Route']['USER_ID'] = $Session_data['ID'];
					$this->StorePurchase->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->StorePurchase->saveField("created_ip",$ip);
					 
                    $this->Session->setFlash('Store Purchase Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
							}
                }
                } else {
                $this->Session->setFlash('Store Purchase Not Added Please Try Again!', 'message_bad');
                }
			
        }

        $this->loadModel('StoreCategory');
        $cat = $this->StoreCategory->getStoreCategory();
        $this->set('cat',$cat);

       

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

        $this->StorePurchase->id = $id;
        if (empty($this->StorePurchase->id)) {
            $this->Session->setFlash('Invalid Store Purchase !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->StorePurchase->Validation()) {
                if ($this->StorePurchase->save($this->request->data)) {
                    $this->Session->setFlash('Store Purchase Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Store Purchase Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Store Purchase Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $StorePurchase = $this->StorePurchase->find('first', array(
                'contain' => array(),
                'conditions' => array('ID' => $id)
            ));
            if(empty($StorePurchase)) {
                $this->Session->setFlash('Invalid Store Purchase !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $StorePurchase;
        }

          $this->loadModel('StoreCategory');
        $cat = $this->StoreCategory->getStoreCategory();
        $this->set('cat',$cat);

       

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
                if ($this->StorePurchase->delete($Id)) {
                    $this->Session->setFlash('Store Purchase is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Store Purchase.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
}
