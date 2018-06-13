<?php
// app/Controller/UsersController.php


class StoreItemMstrController extends AppController
{
    var $name = 'StoreItemMstr';

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
        $this->StoreItemMstr->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StoreItemMstr.created ASC'
        );
			
        $this->set('StoreItemMstr', $this->paginate('StoreItemMstr'));
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
            $this->StoreItemMstr->set($this->request->data);
            if ($this->StoreItemMstr->Validation()) {
                $this->StoreItemMstr->create();
                if ($this->StoreItemMstr->save($this->request->data)) {

                    $this->request->data['StoreItemMstr']['USER_ID'] = $Session_data['ID'];
                    $this->StoreItemMstr->saveField("created_by",$Session_data['ID']);
                    
                    $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
                    $this->StoreItemMstr->saveField("created_ip",$ip);

                    $this->Session->setFlash('Library Group Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Library Group Not Added Please Try Again!', 'message_bad');
                }
        }

        $this->loadModel('StoreCategory');
        $cat = $this->StoreCategory->getStoreCategory();
        $this->set('cat',$cat);
    }

    public function admin_edit($id = null)
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        $this->StoreItemMstr->id = $id;
        if (empty($this->StoreItemMstr->id)) {
            $this->Session->setFlash('Invalid StoreItemMstr !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->StoreItemMstr->Validation()) {
                if ($this->StoreItemMstr->save($this->request->data)) {
                    $this->Session->setFlash('StoreItemMstr Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('StoreItemMstr Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('StoreItemMstr Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $StoreItemMstr = $this->StoreItemMstr->find('first', array(
                'contain' => array(),
                'conditions' => array('ID' => $id)
            ));
            if(empty($StoreItemMstr)) {
                $this->Session->setFlash('Invalid StoreItemMstr !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $StoreItemMstr;
        }

         $this->loadModel('StoreCategory');
        $cat = $this->StoreCategory->getStoreCategory();
        $this->set('cat',$cat);
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->StoreItemMstr->delete($Id)) {
                    $this->Session->setFlash('StoreItemMstr is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid StoreItemMstr.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
}
