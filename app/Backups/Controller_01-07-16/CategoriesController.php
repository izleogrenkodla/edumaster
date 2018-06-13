<?php
// app/Controller/UsersController.php


class CategoriesController extends AppController
{
    var $name = 'Categories';

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
        $this->Category->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Category.CATEGORY_NAME ASC'
        );

        $this->set('categories', $this->paginate('Category'));
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
            $this->Category->set($this->request->data);
            if ($this->Category->Validation()) {
                $this->Category->create();
                if ($this->Category->save($this->request->data)) {
                    $this->Session->setFlash('Category Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Category Not Added Please Try Again!', 'message_bad');
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

        $this->Category->id = $id;
        if (empty($this->Category->id)) {
            $this->Session->setFlash('Invalid Category !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Category->Validation()) {
                if ($this->Category->save($this->request->data)) {
                    $this->Session->setFlash('Category Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Category Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Category Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Category = $this->Category->find('first', array(
                'contain' => array(),
                'conditions' => array('CATEGORY_ID' => $id)
            ));
            if(empty($Category)) {
                $this->Session->setFlash('Invalid Category !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Category;
        }
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->Category->delete($Id)) {
                    $this->Session->setFlash('Category is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Category.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
}
