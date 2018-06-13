<?php
// app/Controller/UsersController.php


class StoreDistributionController extends AppController
{
    var $name = 'StoreDistribution';

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
        $this->StoreDistribution->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StoreDistribution.created ASC'
        );
			
        $this->set('StoreDistribution', $this->paginate('StoreDistribution'));
    }

   public function admin_add($id)
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
		
		$this->loadModel('StoreReceivRequest');
        //$this->StoreReceivRequest->recursive = 0;
        $data = $this->StoreReceivRequest->find('first',array(
            'conditions' => array('StoreReceivRequest.ID'=>$id),	
        ));
			
        $this->set('StoreReceivRequest', $data);        

        if ($this->request->is('post')) {
            $this->StoreDistribution->set($this->request->data);
            if ($this->StoreDistribution->Validation()) {
                $this->StoreDistribution->create();
				$this->loadModel('StorePurchaseOrder');
					$cat = $this->request->data['StoreDistribution']['CATEGORY_ID'];
					$item = $this->request->data['StoreDistribution']['ITEM_ID'];
					$disq = $this->request->data['StoreDistribution']['QUANTITY'];
					
					$res = $this->StorePurchaseOrder->find('first',array(
						
							'conditons' => array(
								'CATEGORY_ID' => $cat,
								'ITEM_ID' => $item,
							),
							'order' => 'StorePurchaseOrder.ID DESC'
							));
						
					
					//$livid = $res1['StorePurchaseOrder']['ID'];
					
					$totalstock = $res['StorePurchaseOrder']['QUANTITY'];
					$purid = $res['StorePurchaseOrder']['ID'];
					$rqty = $res['StorePurchaseOrder']['REMAINING_QUANTITY'];
						
					
					$this->loadModel('StorePurchaseOrder');
					$res2 = $this->StorePurchaseOrder->find('all',array(
						
							'conditons' => array(
								'CATEGORY_ID' => $cat,
								'ITEM_ID' => $item,
							)));
							
							$this->loadModel('StorePurchase');
					$res3 = $this->StorePurchase->find('first',array(
						
							'conditons' => array(
								'CATEGORY_ID' => $cat,
								'ITEM_ID' => $item,
							),
							'order' => 'StorePurchase.ID DESC'
							));
						
						$pq = $res3['StorePurchase']['QUANTITY'];
						
					
					
					if($rqty == $totalstock){
						$this->Session->setFlash('Item is Not In Stock!', 'message_bad');
						 $this->redirect(array('action' => 'index'));
						 
					}else{
					
                if ($this->StoreDistribution->save($this->request->data)) {
					
					$this->StoreDistribution->saveField('PURCHASE_QUANTITY',$pq);
					
					
					/*print_r($pq);					
					die;*/
					
					$this->StorePurchaseOrder->updateAll(
						array(
							'REMAINING_QUANTITY' => $rqty + $this->request->data['StoreDistribution']['QUANTITY'],
							
							
						),array('StorePurchaseOrder.ID '=>$purid)
					);
					
					$resp = $this->StorePurchaseOrder->find('all',array(
						
							'conditons' => array(
								'CATEGORY_ID' => $cat,
								'ITEM_ID' => $item,
							)));
							
						
					foreach($resp as $respp){
					//$livid = $res1['StorePurchaseOrder']['ID'];
					$totalstock1 = $respp['StorePurchaseOrder']['QUANTITY'];
					$purid1 = $respp['StorePurchaseOrder']['ID'];
					$rqty1 = $respp['StorePurchaseOrder']['REMAINING_QUANTITY'];
						}
					$finalstock = $totalstock1 - $rqty1;
					$this->loadModel('StoreLiveStock');
					$resl = $this->StoreLiveStock->find('first',array(
						
							'conditons' => array(
								'CATEGORY_ID' => $cat,
								'ITEM_ID' => $item,
							),
							'order' => 'StoreLiveStock.ID DESC'
							));
							$lid = $resl['StoreLiveStock']['ID'];
							
						if($resl)
						{
									$this->StoreLiveStock->updateAll(
						array(
							'STOCK' => $finalstock,
							
							
						),array('StoreLiveStock.ID '=>$lid)
					);
						}
						else{
					
					$this->StoreLiveStock->saveField('DIST_QUANTITY',$disq);
					$this->StoreLiveStock->saveField('CATEGORY_ID',$cat);
					$this->StoreLiveStock->saveField('ITEM_ID',$item);
					
					$this->StoreLiveStock->saveField('STOCK',$finalstock);
					$this->StoreLiveStock->saveField('DATE',$this->request->data["StoreDistribution"]["DATE"]);
						}
					$this->request->data["StoreDistribution"]["DATE"] = $this->General->datefordb($this->request->data["StoreDistribution"]["DATE"]);
					$this->StoreDistribution->saveField('DATE',$this->request->data["StoreDistribution"]["DATE"]);
					$this->StoreDistribution->saveField("REMAINING_QUANTITY",$finalstock);
					 
                    $this->Session->setFlash('Store Distribution  Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
			} }else {
                $this->Session->setFlash('Store Distribution  Not Added Please Try Again!', 'message_bad');
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

        $this->StoreDistribution->id = $id;
        if (empty($this->StoreDistribution->id)) {
            $this->Session->setFlash('Invalid Store Distribution !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->StoreDistribution->Validation()) {
                if ($this->StoreDistribution->save($this->request->data)) {
                    $this->Session->setFlash('Store Distribution Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Store Distribution Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Store Distribution Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $StoreDistribution = $this->StoreDistribution->find('first', array(
                'contain' => array(),
                'conditions' => array('ID' => $id)
            ));
            if(empty($StoreDistribution)) {
                $this->Session->setFlash('Invalid StoreDistribution !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $StoreDistribution;
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
                if ($this->StoreDistribution->delete($Id)) {
                    $this->Session->setFlash('Store Distribution is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Store Distribution.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
}
	