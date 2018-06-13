<?php
// app/Controller/UsersController.php
class LibraryFineMasterController extends AppController
{
    var $name = 'LibraryFineMaster';

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
        $this->LibraryFineMaster->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
        );

        $this->set('fine', $this->paginate('LibraryFineMaster'));
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
            $this->LibraryFineMaster->set($this->request->data);
            if ($this->LibraryFineMaster->Validation()) {
                $this->LibraryFineMaster->create();
                if ($this->LibraryFineMaster->save($this->request->data)) {
                    $this->Session->setFlash('Library Fine  Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Library Fine  Not Added Please Try Again!', 'message_bad');
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

        $this->LibraryFineMaster->id = $id;
        if (empty($this->LibraryFineMaster->id)) {
            $this->Session->setFlash('Invalid Library Fine  !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->LibraryFineMaster->Validation()) {
                if ($this->LibraryFineMaster->save($this->request->data)) {
                    $this->Session->setFlash('Library Fine  Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Library Fine  Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Library Fine  Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $LibraryFineMaster = $this->LibraryFineMaster->find('first', array(
                'contain' => array(),
                'conditions' => array('ID' => $id)
            ));
            if(empty($LibraryFineMaster)) {
                $this->Session->setFlash('Invalid Library Fine  !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $LibraryFineMaster;
        }
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->LibraryFineMaster->delete($Id)) {
                    $this->Session->setFlash('Library Fine  is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid Library Fine .', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
}