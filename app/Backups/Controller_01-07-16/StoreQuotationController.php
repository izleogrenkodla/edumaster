<?php
// app/Controller/UsersController.php


class StoreQuotationController extends AppController
{
    var $name = 'StoreQuotation';

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
        $this->StoreQuotation->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StoreQuotation.created ASC'
        );

        $this->set('StoreQuotation', $this->paginate('StoreQuotation'));
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
            $this->StoreQuotation->set($this->request->data);
            if ($this->StoreQuotation->Validation()) {
                $this->StoreQuotation->create();
                if ($this->StoreQuotation->save($this->request->data)) {
                   
                    $this->Session->setFlash('Store Quotation Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Store Quotation Not Added Please Try Again!', 'message_bad');
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

        $this->StoreQuotation->id = $id;
        if (empty($this->StoreQuotation->id)) {
            $this->Session->setFlash('Invalid Store Quotation !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->StoreQuotation->Validation()) {
                if ($this->StoreQuotation->save($this->request->data)) {
                    $this->Session->setFlash('Store Quotation Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Store Quotation Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Store Quotation Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $StoreQuotation = $this->StoreQuotation->find('first', array(
                'contain' => array(),
                'conditions' => array('ID' => $id)
            ));
            if(empty($StoreQuotation)) {
                $this->Session->setFlash('Invalid Store Quotation !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $StoreQuotation;
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
                if ($this->StoreQuotation->delete($Id)) {
                    $this->Session->setFlash('Store Quotation is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Store Quotation.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
}
