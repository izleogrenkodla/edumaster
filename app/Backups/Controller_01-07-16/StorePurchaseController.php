<?php
// app/Controller/UsersController.php


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

        if ($this->request->is('post')) {
            $this->StorePurchase->set($this->request->data);
            if ($this->StorePurchase->Validation()) {
                $this->StorePurchase->create();
                if ($this->StorePurchase->save($this->request->data)) {
                   
                    $this->Session->setFlash('Store Purchase Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
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
