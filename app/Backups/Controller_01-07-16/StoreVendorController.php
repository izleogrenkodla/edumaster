<?php
// app/Controller/UsersController.php


class StoreVendorController extends AppController
{
    var $name = 'StoreVendor';

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
        $this->StoreVendor->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StoreVendor.created ASC'
        );
			
        $this->set('StoreVendor', $this->paginate('StoreVendor'));
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
            $this->StoreVendor->set($this->request->data);
            if ($this->StoreVendor->Validation()) {
                $this->StoreVendor->create();
                if ($this->StoreVendor->save($this->request->data)) {
                    $this->request->data['StoreVendor']['USER_ID'] = $Session_data['ID'];
                    $this->StoreVendor->saveField("created_by",$Session_data['ID']);
                    
                    $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
                    $this->StoreVendor->saveField("created_ip",$ip);
                    $this->Session->setFlash('Store Vendor Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Store Vendor Not Added Please Try Again!', 'message_bad');
                }
        }
    }

    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->StoreVendor->id = $id;
        if (empty($this->StoreVendor->id)) {
            $this->Session->setFlash('Invalid StoreVendor !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->StoreVendor->Validation()) {
                if ($this->StoreVendor->save($this->request->data)) {
                    $this->Session->setFlash('StoreVendor Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('StoreVendor Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('StoreVendor Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $StoreVendor = $this->StoreVendor->find('first', array(
                'contain' => array(),
                'conditions' => array('ID' => $id)
            ));
            if(empty($StoreVendor)) {
                $this->Session->setFlash('Invalid StoreVendor !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $StoreVendor;
        }
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->StoreVendor->delete($Id)) {
                    $this->Session->setFlash('StoreVendor is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid StoreVendor.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
}
