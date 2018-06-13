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

   public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('post')) {
            $this->StoreDistribution->set($this->request->data);
            if ($this->StoreDistribution->Validation()) {
                $this->StoreDistribution->create();
                if ($this->StoreDistribution->save($this->request->data)) {
                    $this->Session->setFlash('Store Distribution  Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
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
