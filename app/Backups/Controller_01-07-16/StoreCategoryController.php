<?php
// app/Controller/UsersController.php


class StoreCategoryController extends AppController
{
    var $name = 'StoreCategory';

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
        $this->StoreCategory->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'StoreCategory.created ASC'
        );
            
        $this->set('StoreCategory', $this->paginate('StoreCategory'));
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
            $this->StoreCategory->set($this->request->data);
            if ($this->StoreCategory->Validation()) {
                $this->StoreCategory->create();
                if ($this->StoreCategory->save($this->request->data)) {

                    $this->request->data['StoreCategory']['USER_ID'] = $Session_data['ID'];
                    $this->StoreCategory->saveField("created_by",$Session_data['ID']);
                    
                    $ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
                    $this->StoreCategory->saveField("created_ip",$ip);

                    $this->Session->setFlash('Library Group Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Library Group Not Added Please Try Again!', 'message_bad');
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

        $this->StoreCategory->id = $id;
        if (empty($this->StoreCategory->id)) {
            $this->Session->setFlash('Invalid StoreCategory !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->StoreCategory->Validation()) {
                if ($this->StoreCategory->save($this->request->data)) {
                    $this->Session->setFlash('StoreCategory Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('StoreCategory Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('StoreCategory Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $StoreCategory = $this->StoreCategory->find('first', array(
                'contain' => array(),
                'conditions' => array('ID' => $id)
            ));
            if(empty($StoreCategory)) {
                $this->Session->setFlash('Invalid StoreCategory !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $StoreCategory;
        }
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->StoreCategory->delete($Id)) {
                    $this->Session->setFlash('StoreCategory is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid StoreCategory.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
}
