<?php
// app/Controller/UsersController.php


class LibraryPublisherController extends AppController
{
    var $name = 'LibraryPublisher';

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
        $this->LibraryPublisher->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'LibraryPublisher.created ASC'
        );

        $this->set('LibraryPublisher', $this->paginate('LibraryPublisher'));
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
            $this->LibraryPublisher->set($this->request->data);
            if ($this->LibraryPublisher->Validation()) {
                $this->LibraryPublisher->create();
                if ($this->LibraryPublisher->save($this->request->data)) {
					
					$this->request->data['StudentRegistration']['USER_ID'] = $Session_data['ID'];
					$this->LibraryPublisher->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->LibraryPublisher->saveField("created_ip",$ip);
                    $this->Session->setFlash('Library Publisher Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Library Publisher Not Added Please Try Again!', 'message_bad');
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

        $this->LibraryPublisher->id = $id;
        if (empty($this->LibraryPublisher->id)) {
            $this->Session->setFlash('Invalid Library Publisher !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->LibraryPublisher->Validation()) {
                if ($this->LibraryPublisher->save($this->request->data)) {
                    $this->Session->setFlash('Library Publisher Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('Library Publisher Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('Library Publisher Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $LibraryPublisher = $this->LibraryPublisher->find('first', array(
                'contain' => array(),
                'conditions' => array('Publisher_ID' => $id)
            ));
            if(empty($LibraryPublisher)) {
                $this->Session->setFlash('Invalid Library Publisher !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $LibraryPublisher;
        }
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
        if (!empty($Id)) {
            try {
                if ($this->LibraryPublisher->delete($Id)) {
                    $this->Session->setFlash('LibraryPublisher is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid LibraryPublisher.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

    }
}
