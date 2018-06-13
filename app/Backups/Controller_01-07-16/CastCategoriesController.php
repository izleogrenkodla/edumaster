<?php
// app/Controller/UsersController.php
class CastCategoriesController extends AppController
{
    var $name = 'CastCategories';

    public function beforeFilter()
    {
        parent::beforeFilter();

        if(isset($this->Security) &&  ($this->RequestHandler->isAjax() || $this->RequestHandler->isPost())){
            $this->Security->validatePost = false;
            $this->Security->enabled = false;
            $this->Security->csrfCheck = false;
        }
    }

    public function admin_index()
    {
        $this->layout = 'admin_form_layout';
        $this->CastCategory->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'CastCategory.CAST_CAT_NAME ASC'
        );

        $this->set('CastCategories', $this->paginate('CastCategory'));
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
            $this->CastCategory->set($this->request->data);
            if ($this->CastCategory->Validation()) {
                $this->CastCategory->create();
                if ($this->CastCategory->save($this->request->data)) {
                    $this->Session->setFlash('CastCategory Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('CastCategory Not Added Please Try Again!', 'message_bad');
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

        $this->CastCategory->id = $id;
        if (empty($this->CastCategory->id)) {
            $this->Session->setFlash('Invalid CastCategory !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->CastCategory->Validation()) {
                if ($this->CastCategory->save($this->request->data)) {
                    $this->Session->setFlash('CastCategory Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('CastCategory Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('CastCategory Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $CastCategory = $this->CastCategory->find('first', array(
                'contain' => array(),
                'conditions' => array('CAST_CAT_ID' => $id)
            ));
            if(empty($CastCategory)) {
                $this->Session->setFlash('Invalid CastCategory !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $CastCategory;
        }
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->CastCategory->delete($Id)) {
                    $this->Session->setFlash('CastCategory is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid CastCategory.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
}