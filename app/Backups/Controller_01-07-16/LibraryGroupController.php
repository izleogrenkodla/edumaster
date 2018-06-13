<?php
// app/Controller/UsersController.php


class LibraryGroupController extends AppController
{
    var $name = 'LibraryGroup';

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
        $this->LibraryGroup->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'LibraryGroup.created ASC'
        );
			
        $this->set('LibraryGroup', $this->paginate('LibraryGroup'));
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
            $this->LibraryGroup->set($this->request->data);
            if ($this->LibraryGroup->Validation()) {
                $this->LibraryGroup->create();
                if ($this->LibraryGroup->save($this->request->data)) {
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

        $this->LibraryGroup->id = $id;
        if (empty($this->LibraryGroup->id)) {
            $this->Session->setFlash('Invalid LibraryGroup !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->LibraryGroup->Validation()) {
                if ($this->LibraryGroup->save($this->request->data)) {
                    $this->Session->setFlash('LibraryGroup Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('LibraryGroup Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('LibraryGroup Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $LibraryGroup = $this->LibraryGroup->find('first', array(
                'contain' => array(),
                'conditions' => array('Group_ID' => $id)
            ));
            if(empty($LibraryGroup)) {
                $this->Session->setFlash('Invalid LibraryGroup !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $LibraryGroup;
        }
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->LibraryGroup->delete($Id)) {
                    $this->Session->setFlash('LibraryGroup is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid LibraryGroup.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
}
