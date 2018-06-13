<?php
// app/Controller/UsersController.php
class MediumController extends AppController
{
    var $name = 'Medium';

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
        $this->Medium->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'Medium.MEDIUM_NAME ASC'
        );

        $this->set('mediums', $this->paginate('Medium'));
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
            $this->Medium->set($this->request->data);
            if ($this->Medium->Validation()) {
                $this->Medium->create();
                if ($this->Medium->save($this->request->data)) {
                    $this->Session->setFlash('Medium Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Medium Not Added Please Try Again!', 'message_bad');
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

        $this->Medium->id = $id;
        if (empty($this->Medium->id)) {
            $this->Session->setFlash('Invalid Medium !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->Medium->Validation()) {
                if ($this->Medium->save($this->request->data)) {
                    $this->Session->setFlash('Medium Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Medium Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Medium Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $Medium = $this->Medium->find('first', array(
                'contain' => array(),
                'conditions' => array('MEDIUM_ID' => $id)
            ));
            if(empty($Medium)) {
                $this->Session->setFlash('Invalid Medium !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $Medium;
        }
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->Medium->delete($Id)) {
                    $this->Session->setFlash('Medium is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Medium.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
}