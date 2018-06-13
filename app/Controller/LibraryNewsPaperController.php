<?php
// app/Controller/UsersController.php


class LibraryNewsPaperController extends AppController
{
    var $name = 'LibraryNewsPaper';

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
        $this->LibraryNewsPaper->recursive = 0;
        $this->paginate = array(
            'conditions' => '',
            'limit' => PAGINATION_LIMIT_ADMIN,
            'order' => 'LibraryNewsPaper.created ASC'
        );
		
        $this->set('LibraryNewsPaper', $this->paginate('LibraryNewsPaper'));
    }

   public function admin_add()
    {
        $this->layout = 'admin_form_layout';
        $Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=LIBRARY_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        if ($this->request->is('post')) {
            $this->LibraryNewsPaper->set($this->request->data);
            if ($this->LibraryNewsPaper->Validation()) {
                $this->LibraryNewsPaper->create();
                if ($this->LibraryNewsPaper->save($this->request->data)) {
					
					$this->request->data['StudentRegistration']['PAPER_ID'] = $Session_data['ID'];
					$this->LibraryNewsPaper->saveField("created_by",$Session_data['ID']);
					
					$ip = (isset($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
					$this->LibraryNewsPaper->saveField("created_ip",$ip);
                    $this->Session->setFlash('Library NewsPaper Added Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                }
                } else {
                $this->Session->setFlash('Library NewsPaper Not Added Please Try Again!', 'message_bad');
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
		
		if($Session_data["ROLE_ID"]!=LIBRARY_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}

        $this->LibraryNewsPaper->id = $id;
        if (empty($this->LibraryNewsPaper->id)) {
            $this->Session->setFlash('Invalid LibraryNewsPaper !', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

        if ($this->request->is('put') || $this->request->is('post')) {
            if ($this->LibraryNewsPaper->Validation()) {
                if ($this->LibraryNewsPaper->save($this->request->data)) {
                    $this->Session->setFlash('LibraryNewsPaper Saved Successfully!', 'message_good');
                    $this->redirect(array('action' => 'index'));
                } else {
                    $this->Session->setFlash('LibraryNewsPaper Not Saved Please Try Again!', 'message_bad');
                }
            } else {
                $this->Session->setFlash('LibraryNewsPaper Not Saved Please Try Again!', 'message_bad');
            }
        } else {
            $LibraryNewsPaper = $this->LibraryNewsPaper->find('first', array(
                'contain' => array(),
                'conditions' => array('PAPER_ID' => $id)
            ));
            if(empty($LibraryNewsPaper)) {
                $this->Session->setFlash('Invalid LibraryNewsPaper !', 'message_bad');
                $this->redirect(array('action' => 'index'));
            }
            $this->request->data = $LibraryNewsPaper;
        }
    }

    public function admin_delete($Id = null)
    {
        $this->layout = 'admin_form_layout';
		
		$Session_data = $this->Session->read('Auth.Admin');

        if (empty($Session_data)) {
            $this->Session->setFlash('Please login', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }
		
		if($Session_data["ROLE_ID"]!=LIBRARY_ID) {
			$this->Session->setFlash('Not Authorised to View the Page', 'message_bad');
            $this->redirect(array('controller' => 'Users','action' => 'index'));
		}
		
        if (!empty($Id)) {
            try {
                if ($this->LibraryNewsPaper->delete($Id)) {
                    $this->Session->setFlash('LibraryNewsPaper is successfully deleted', 'message_good');
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
            $this->Session->setFlash('Invalid LibraryNewsPaper.', 'message_bad');
            $this->redirect(array('action' => 'index'));
        }

	}
}
